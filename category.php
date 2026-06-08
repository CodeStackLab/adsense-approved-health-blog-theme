<?php
/**
 * Category Archive Template — Health Beyond Age
 * Matches the category page design from healthbeyondage_updated_v3.html
 */
get_header();

$cat      = get_queried_object();
$cat_name = $cat->name ?? get_the_archive_title();
$cat_desc = $cat->description ?? '';
$cat_slug = $cat->slug ?? '';
$cat_count = $cat->count ?? 0;

// Category specific images
$cat_images = [
    'nutrition'         => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=160&q=80',
    'fitness'           => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=160&q=80',
    'mental-wellness'   => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=160&q=80',
    'preventive-health' => 'https://images.unsplash.com/photo-1584467541268-b040f83be3fd?w=160&q=80',
    'skin-care'         => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=160&q=80',
    'sleep'             => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=160&q=80',
];
$cat_ico_url = $cat_images[$cat_slug] ?? 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=160&q=80';
$custom_ico  = get_term_meta( $cat->term_id, 'hba_cat_image', true );
if ( $custom_ico ) $cat_ico_url = $custom_ico;
?>

<?php hba_breadcrumb(); ?>

<!-- CATEGORY HERO -->
<section class="cat-hero">
    <div class="cat-hero-inner">
        <div class="fade-up">
            <div class="cat-hero-ico" style="width:80px;height:80px;border-radius:16px;overflow:hidden;margin-bottom:1.2rem;">
                <img src="<?php echo esc_url($cat_ico_url); ?>" alt="<?php echo esc_attr($cat_name); ?>" style="width:100%;height:100%;object-fit:cover;" />
            </div>
            <div class="cat-eyebrow"><?php esc_html_e('Health Category','healthbeyondage'); ?></div>
            <h1><?php echo esc_html( $cat_name ); ?></h1>
            <?php if ( $cat_desc ) : ?>
                <p class="cat-desc"><?php echo esc_html( $cat_desc ); ?></p>
            <?php else : ?>
                <p class="cat-desc"><?php printf( esc_html__( 'Expert, evidence-based articles about %s — reviewed by qualified health professionals.', 'healthbeyondage' ), esc_html($cat_name) ); ?></p>
            <?php endif; ?>
            <div class="cat-stats">
                <div class="cat-stat"><div class="n"><?php echo esc_html($cat_count); ?></div><div class="l"><?php esc_html_e('Articles Published','healthbeyondage'); ?></div></div>
                <div class="cat-stat"><div class="n">100%</div><div class="l"><?php esc_html_e('Expert Reviewed','healthbeyondage'); ?></div></div>
                <div class="cat-stat"><div class="n">5 min</div><div class="l"><?php esc_html_e('Avg. Read Time','healthbeyondage'); ?></div></div>
            </div>
        </div>
        <div class="cat-hero-aside">
            <div class="cat-aside-title"><?php printf( esc_html__('Popular in %s','healthbeyondage'), esc_html($cat_name) ); ?></div>
            <?php
            $popular = new WP_Query([
                'category_name'  => $cat_slug,
                'posts_per_page' => 4,
                'meta_key'       => 'hba_view_count',
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC',
                'post_status'    => 'publish',
            ]);
            if ( ! $popular->have_posts() ) {
                // fallback to recent
                $popular = new WP_Query(['category_name' => $cat_slug, 'posts_per_page' => 4, 'post_status' => 'publish']);
            }
            while ( $popular->have_posts() ) : $popular->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="cat-aside-link">
                    <div class="ico">📄</div>
                    <div class="txt"><?php the_title(); ?></div>
                    <div class="arrow">→</div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<!-- FILTER BAR (tags in this category) -->
<div class="filter-bar">
    <div class="filter-inner">
        <span class="filter-label"><?php esc_html_e('Filter by:','healthbeyondage'); ?></span>
        <div class="filter-tags">
            <span class="tag active"><?php esc_html_e('All','healthbeyondage'); ?></span>
            <?php
            $cat_tags = get_tags(['number' => 8]);
            if ( $cat_tags ) {
                foreach ( $cat_tags as $tag ) {
                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag">' . esc_html($tag->name) . '</a>';
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- ARTICLES SECTION -->
<div class="section">

    <?php
    // Featured editor's pick
    $featured = new WP_Query([
        'category_name'  => $cat_slug,
        'posts_per_page' => 1,
        'meta_key'       => '_thumbnail_id',
        'post_status'    => 'publish',
    ]);
    if ( $featured->have_posts() ) : $featured->the_post();
        $ft_thumb = get_the_post_thumbnail_url( get_the_ID(), 'hba-featured' );
        $ft_author_id = get_the_author_meta('ID');
        $ft_initials  = hba_author_initials($ft_author_id);
        $ft_author    = get_the_author_meta('display_name');
        $ft_read_time = hba_reading_time(get_the_ID());
    ?>
        <a href="<?php the_permalink(); ?>" class="featured-longread fade-up">
            <div class="fl-body">
                <div class="fl-tag">⭐ <?php esc_html_e("Editor's Pick",'healthbeyondage'); ?></div>
                <h2><?php the_title(); ?></h2>
                <p><?php echo esc_html(get_the_excerpt()); ?></p>
                <div class="fl-meta">
                    <div class="fl-auth">
                        <div class="fl-av"><?php echo esc_html($ft_initials); ?></div>
                        <span><?php echo esc_html($ft_author); ?></span>
                    </div>
                    <span><?php echo get_the_date('M Y'); ?></span>
                    <span>· <?php echo esc_html($ft_read_time); ?></span>
                    <div class="medrev-badge">✓ <?php esc_html_e('Medically Reviewed','healthbeyondage'); ?></div>
                </div>
            </div>
            <div class="fl-thumb">
                <?php if ( $ft_thumb ) : ?>
                    <img src="<?php echo esc_url($ft_thumb); ?>" alt="<?php the_title_attribute(); ?>" />
                <?php endif; ?>
            </div>
        </a>
    <?php wp_reset_postdata(); endif; ?>

    <!-- Article Grid -->
    <div class="sec-hd fade-up">
        <h2><?php esc_html_e('Latest','healthbeyondage'); ?> <span><?php echo esc_html($cat_name); ?></span> <?php esc_html_e('Articles','healthbeyondage'); ?></h2>
        <span><?php printf( esc_html__('View all %d articles →','healthbeyondage'), (int)$cat_count ); ?></span>
    </div>

    <div class="art-grid">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                hba_article_card( get_the_ID() );
            }
        } else {
            echo '<p>' . esc_html__('No articles found.','healthbeyondage') . '</p>';
        }
        ?>
    </div>

    <?php hba_pagination(); ?>

</div>

<?php get_footer(); ?>
