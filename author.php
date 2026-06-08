<?php
/**
 * Author Archive Template — Health Beyond Age
 */
get_header();

$author = get_queried_object();
$author_id = $author->ID;
$author_name = $author->display_name;
$author_bio = get_the_author_meta( 'description', $author_id );
$author_role = get_the_author_meta( 'hba_author_role', $author_id ) ?: 'Health & Wellness Author';

// Count posts
$post_count = count_user_posts( $author_id );
?>

<div class="author-hero">
    <div class="author-hero-inner">
        <div class="author-hero-av">
            <?php echo get_avatar( $author_id, 140, '', $author_name . ' Profile Picture' ); ?>
        </div>
        <div class="author-hero-cnt">
            <div class="eyebrow"><?php esc_html_e( 'Meet the Author', 'healthbeyondage' ); ?></div>
            <h1><?php echo esc_html( $author_name ); ?></h1>
            <div class="author-role"><?php echo esc_html( $author_role ); ?></div>
            <?php if ( $author_bio ) : ?>
                <div class="author-bio">
                    <p><?php echo wp_kses_post( $author_bio ); ?></p>
                </div>
            <?php endif; ?>

            <?php
            // Social & Contact Links
            $user_url = get_the_author_meta('user_url', $author_id);
            $twitter = get_the_author_meta('twitter', $author_id);
            $facebook = get_the_author_meta('facebook', $author_id);
            $linkedin = get_the_author_meta('linkedin', $author_id);
            $instagram = get_the_author_meta('instagram', $author_id);

            if ( $user_url || $twitter || $facebook || $linkedin || $instagram ) :
            ?>
            <div class="author-links">
                <?php if ( $user_url ) : ?><a href="<?php echo esc_url($user_url); ?>" target="_blank" title="Website">🌐</a><?php endif; ?>
                <?php if ( $twitter ) : ?><a href="<?php echo esc_url($twitter); ?>" target="_blank" title="Twitter">𝕏</a><?php endif; ?>
                <?php if ( $facebook ) : ?><a href="<?php echo esc_url($facebook); ?>" target="_blank" title="Facebook">f</a><?php endif; ?>
                <?php if ( $linkedin ) : ?><a href="<?php echo esc_url($linkedin); ?>" target="_blank" title="LinkedIn">in</a><?php endif; ?>
                <?php if ( $instagram ) : ?><a href="<?php echo esc_url($instagram); ?>" target="_blank" title="Instagram">📸</a><?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="author-stats">
                <span>📝 <?php printf( esc_html__( '%d Published Articles', 'healthbeyondage' ), $post_count ); ?></span>
            </div>
        </div>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div class="articles-layout">
    <div class="articles-main">
        <div class="sec-hd" style="margin-bottom:1.5rem; border-bottom:1px solid var(--border); padding-bottom:1rem;">
            <h2 style="font-size:1.4rem; font-family:var(--serif); margin:0;">
                <?php printf( esc_html__( 'Articles by %s', 'healthbeyondage' ), $author_name ); ?>
            </h2>
        </div>

        <div class="art-list">
            <?php if ( have_posts() ) {
                while ( have_posts() ) { the_post(); hba_article_list_item( get_the_ID() ); }
            } else {
                echo '<p>' . esc_html__('No articles found for this author.','healthbeyondage') . '</p>';
            } ?>
        </div>
        <?php hba_pagination(); ?>
    </div>
    <aside class="articles-sidebar">
        <div class="sidebar-box">
            <h4><?php esc_html_e('Categories','healthbeyondage'); ?></h4>
            <?php
            $cats = get_categories(['hide_empty' => true]);
            foreach ( $cats as $c ) :
            ?>
                <a href="<?php echo esc_url(get_category_link($c->term_id)); ?>" class="sidebar-cat-link">
                    <?php echo esc_html($c->name); ?>
                    <span class="cnt"><?php echo esc_html($c->count); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </aside>
</div>

<?php get_footer(); ?>
