<?php
/**
 * Single Post Template — Health Beyond Age
 * Matches single-article.html design exactly.
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

hba_count_post_views( get_the_ID() );

$cats      = get_the_category();
$cat       = ! empty( $cats ) ? $cats[0] : null;
$cat_name  = $cat ? $cat->name : '';
$cat_link  = $cat ? get_category_link( $cat->term_id ) : home_url('/blog');
$cat_slug  = $cat ? $cat->slug : '';
$author_id = get_the_author_meta('ID');
$author    = get_the_author_meta('display_name');
$author_bio = get_the_author_meta('description');
$initials  = hba_author_initials( $author_id );

$custom_avatar_id = get_user_meta( $author_id, '_hba_custom_avatar_id', true );
if ( $custom_avatar_id ) {
    $avatar_html = wp_get_attachment_image( $custom_avatar_id, [80, 80] );
} else {
    $avatar_html = esc_html( $initials );
}
$read_time = hba_reading_time( get_the_ID() );
$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'hba-featured' );
// Medical Reviewer Logic
$cpt_reviewer_id = get_post_meta( get_the_ID(), '_hba_reviewer_id', true );
$reviewer_name = '';
$reviewer_role = '';
$reviewer_bio  = '';
$reviewer_img  = '';
$reviewer_link = '';

if ( $cpt_reviewer_id ) {
    $rev_post = get_post( $cpt_reviewer_id );
    if ( $rev_post && $rev_post->post_status === 'publish' ) {
        $reviewer_name = $rev_post->post_title;
        $reviewer_role = get_post_meta( $cpt_reviewer_id, '_hba_reviewer_role', true ) ?: $rev_post->post_excerpt;
        $reviewer_bio  = get_post_meta( $cpt_reviewer_id, '_hba_reviewer_bio', true ) ?: $rev_post->post_content;
        $reviewer_img  = get_the_post_thumbnail_url( $cpt_reviewer_id, 'thumbnail' );
        $reviewer_link = get_permalink( $cpt_reviewer_id );
    }
}

// Fallback if no specific reviewer is selected
if ( empty( $reviewer_name ) ) {
    $reviewer_name = get_post_meta( get_the_ID(), 'hba_reviewer_name', true ) ?: get_theme_mod( 'hba_expert_name', 'Dr. Sarah Matheson, MBChB, MRCGP' );
    $reviewer_role = get_post_meta( get_the_ID(), 'hba_reviewer_role', true ) ?: get_theme_mod( 'hba_expert_role', 'Lead Medical Reviewer' );
    $reviewer_bio  = get_theme_mod( 'hba_expert_bio', '18 years of clinical experience in general practice, specialising in preventive medicine and healthy aging.' );
    $reviewer_img  = get_theme_mod( 'hba_expert_photo', 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=100&q=80' );
    $reviewer_link = home_url('/team');
}

// Build TOC from H2 headings in content
$content  = get_the_content();
preg_match_all( '/<h2[^>]*>(.*?)<\/h2>/i', $content, $headings );
$toc = $headings[1] ?? [];

// Process content — add IDs to H2s, and inject mobile TOC before the first H2
$h2_count = 0;
$mobile_toc_html = '';
if ( ! empty( $toc ) ) {
    $mobile_toc_html .= '<div class="mobile-toc">';
    $mobile_toc_html .= '<div class="mobile-toc-hd">📋 ' . esc_html__( 'Table of Contents', 'healthbeyondage' ) . '</div>';
    $mobile_toc_html .= '<ul class="toc-list">';
    foreach ( $toc as $heading ) {
        $id = sanitize_title( wp_strip_all_tags( $heading ) );
        $mobile_toc_html .= '<li><a href="#' . esc_attr($id) . '">' . esc_html( wp_strip_all_tags($heading) ) . '</a></li>';
    }
    $mobile_toc_html .= '</ul></div>';
}

$processed_content = preg_replace_callback( '/<h2([^>]*)>(.*?)<\/h2>/i', function($m) use (&$h2_count, $mobile_toc_html) {
    $h2_count++;
    $id = sanitize_title( wp_strip_all_tags( $m[2] ) );
    $h2_tag = "<h2{$m[1]} id=\"{$id}\">{$m[2]}</h2>";
    if ( $h2_count === 1 && ! empty( $mobile_toc_html ) ) {
        return $mobile_toc_html . $h2_tag;
    }
    return $h2_tag;
}, apply_filters( 'the_content', $content ) );

$tags = get_the_tags();
?>

<?php hba_breadcrumb(); ?>

<div class="article-layout">

    <!-- ARTICLE MAIN -->
    <main class="article-main" role="main">

        <?php if ( $cat_name ) : ?>
            <div class="article-cat">
                <a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a>
            </div>
        <?php endif; ?>

        <h1><?php the_title(); ?></h1>

        <!-- Byline -->
        <?php if ( get_theme_mod( 'hba_sp_show_byline', true ) ) : ?>
        <div class="article-byline">
            <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="byline-author" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'healthbeyondage' ), $author ) ); ?>">
                <div class="byline-av"><?php echo $avatar_html; ?></div>
                <div>
                    <div class="byline-name"><?php echo esc_html( $author ); ?></div>
                    <div class="byline-cred"><?php echo esc_html( get_the_author_meta('user_description', $author_id) ?: 'Health Writer' ); ?></div>
                </div>
            </a>
            <div class="byline-sep"></div>
            <div class="byline-info"><strong><?php esc_html_e('Published:','healthbeyondage'); ?></strong> <?php echo get_the_date(); ?></div>
            <div class="byline-sep"></div>
            <div class="byline-info"><strong><?php echo esc_html( $read_time ); ?></strong></div>
            <div class="byline-sep"></div>
            <div class="byline-info">✓ <strong><?php esc_html_e('Medically reviewed','healthbeyondage'); ?></strong></div>
        </div>
        <?php endif; ?>

        <!-- Medical Review Bar -->
        <?php if ( get_theme_mod( 'hba_sp_show_medrev', true ) ) : ?>
        <div class="medrev-bar">
            <div style="font-size:1.2rem">🩺</div>
            <p>
                <strong><?php printf( esc_html__( 'Medically reviewed by %s.', 'healthbeyondage' ), esc_html( $reviewer_name ) ); ?></strong>
                <?php printf( esc_html__( ' This article has been reviewed for accuracy by a qualified medical professional. Last reviewed: %s.', 'healthbeyondage' ), get_the_modified_date('F Y') ); ?>
                <a href="<?php echo esc_url( home_url('/team') ); ?>"><?php esc_html_e( 'Learn about our review process.', 'healthbeyondage' ); ?></a>
            </p>
        </div>
        <?php endif; ?>

        <!-- Hero Image -->
        <div class="article-hero-img <?php echo ! $thumb_url ? 'placeholder' : ''; ?>">
            <?php if ( $thumb_url ) : ?>
                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" />
            <?php else : ?>
                🏥
            <?php endif; ?>
        </div>

        <!-- Article Body -->
        <div class="article-body">
            <?php echo $processed_content; ?>
        </div>

        <!-- Tags -->
        <?php if ( $tags && get_theme_mod( 'hba_sp_show_tags', true ) ) : ?>
            <div class="article-tags">
                <?php foreach ( $tags as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="article-tag"><?php echo esc_html( $tag->name ); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Share Bar -->
        <?php if ( get_theme_mod( 'hba_sp_show_share', true ) ) : ?>
        <div class="share-bar">
            <span class="share-label"><?php esc_html_e( 'Share this article:', 'healthbeyondage' ); ?></span>
            <button class="share-btn" data-share="facebook">f <?php esc_html_e('Facebook','healthbeyondage'); ?></button>
            <button class="share-btn" data-share="twitter">𝕏 <?php esc_html_e('X / Twitter','healthbeyondage'); ?></button>
            <button class="share-btn" data-share="copy">🔗 <?php esc_html_e('Copy Link','healthbeyondage'); ?></button>
            <button class="share-btn" data-share="email">📧 <?php esc_html_e('Email','healthbeyondage'); ?></button>
        </div>
        <?php endif; ?>

        <!-- Related Articles -->
        <?php
        $related = new WP_Query([
            'posts_per_page'      => 3,
            'post__not_in'        => [get_the_ID()],
            'category__in'        => wp_get_post_categories( get_the_ID() ),
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ]);
        if ( $related->have_posts() ) :
        ?>
            <div class="related-articles">
                <div class="sec-hd">
                    <h2><?php esc_html_e('Related','healthbeyondage'); ?> <span><?php esc_html_e('Articles','healthbeyondage'); ?></span></h2>
                    <?php if ( $cat ) : ?>
                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">More <?php echo esc_html($cat->name); ?> →</a>
                    <?php endif; ?>
                </div>
                <div class="art-grid">
                    <?php while ( $related->have_posts() ) { $related->the_post(); hba_article_card( get_the_ID() ); } wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <!-- SIDEBAR -->
    <?php if ( get_theme_mod( 'hba_show_sidebar_single', true ) ) : ?>
    <aside class="sidebar">

        <!-- Table of Contents -->
        <?php if ( ! empty( $toc ) ) : ?>
        <div class="sidebar-card sidebar-toc-card">
            <div class="sidebar-card-hd">📋 <?php esc_html_e( 'Table of Contents', 'healthbeyondage' ); ?></div>
            <div class="sidebar-card-body">
                <ul class="toc-list">
                    <?php foreach ( $toc as $heading ) :
                        $id = sanitize_title( wp_strip_all_tags( $heading ) );
                    ?>
                        <li><a href="#<?php echo esc_attr($id); ?>"><?php echo esc_html( wp_strip_all_tags($heading) ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <!-- Reviewed By -->
        <div class="sidebar-card">
            <div class="sidebar-card-hd">🩺 <?php esc_html_e( 'Reviewed By', 'healthbeyondage' ); ?></div>
            <div class="reviewer-card">
                <?php if ( $reviewer_img ) : ?>
                    <div class="photo" style="width:60px;height:60px;border-radius:50%;background:var(--g-pale);display:flex;align-items:center;justify-content:center;margin:0 auto .6rem;border:2px solid var(--g-light);overflow:hidden;">
                        <img src="<?php echo esc_url( $reviewer_img ); ?>" alt="<?php echo esc_attr( $reviewer_name ); ?>" style="width:100%;height:100%;object-fit:cover;" />
                    </div>
                <?php else : ?>
                    <div class="photo" style="width:60px;height:60px;border-radius:50%;background:var(--g-pale);display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin:0 auto .6rem;border:2px solid var(--g-light);">👩‍⚕️</div>
                <?php endif; ?>
                <h4><?php echo esc_html( $reviewer_name ); ?></h4>
                <div class="role"><?php echo esc_html( $reviewer_role ); ?></div>
                <?php if ( $reviewer_bio ) : ?>
                    <p><?php echo wp_kses_post( wp_trim_words( wp_strip_all_tags($reviewer_bio), 20 ) ); ?></p>
                <?php endif; ?>
                <a href="<?php echo esc_url( $reviewer_link ); ?>" style="display:block;margin-top:.75rem;font-size:.75rem;color:var(--g1);font-weight:600;"><?php esc_html_e('View full profile →','healthbeyondage'); ?></a>
            </div>
        </div>

        <!-- Related Articles -->
        <?php
        $side_related = new WP_Query([
            'posts_per_page'      => 4,
            'post__not_in'        => [get_the_ID()],
            'category__in'        => wp_get_post_categories( get_the_ID() ),
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ]);
        if ( $side_related->have_posts() ) :
        ?>
        <div class="sidebar-card">
            <div class="sidebar-card-hd">📖 <?php esc_html_e( 'Related Articles', 'healthbeyondage' ); ?></div>
            <div class="sidebar-card-body">
                <?php while ( $side_related->have_posts() ) : $side_related->the_post(); ?>
                    <div class="related-item">
                        <div class="related-ico">
                            <?php $rt = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
                            if ( $rt ) : ?>
                                <img src="<?php echo esc_url($rt); ?>" alt="" />
                            <?php else : ?>🏥<?php endif; ?>
                        </div>
                        <div class="related-body">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <span><?php echo esc_html( hba_reading_time( get_the_ID() ) ); ?></span>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Newsletter -->
        <div class="sidebar-card nl-sidebar">
            <div class="sidebar-card-body">
                <div style="font-size:1.5rem;margin-bottom:.6rem">📬</div>
                <div style="font-family:var(--serif);font-size:1rem;color:#fff;font-weight:700;margin-bottom:.4rem"><?php esc_html_e('Weekly Health Digest','healthbeyondage'); ?></div>
                <p style="font-size:.75rem;color:rgba(255,255,255,.55);line-height:1.6;margin-bottom:1rem;font-weight:300"><?php esc_html_e('Get the best articles delivered every Friday.','healthbeyondage'); ?></p>
                <input type="email" placeholder="your@email.com" />
                <button><?php esc_html_e('Subscribe Free','healthbeyondage'); ?></button>
            </div>
        </div>

    </aside>
    <?php endif; ?>

</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
