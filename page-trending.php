<?php
/**
 * Template Name: Trending Articles
 * Matches trending.html design exactly.
 */
get_header();

// Get most viewed posts
$trending = new WP_Query([
    'posts_per_page' => 10,
    'meta_key'       => 'hba_view_count',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
    'post_status'    => 'publish',
]);

// If no view counts yet, just use recent
if ( ! $trending->have_posts() ) {
    $trending = new WP_Query(['posts_per_page' => 10, 'post_status' => 'publish']);
}

$posts_arr = [];
if ( $trending->have_posts() ) {
    while ( $trending->have_posts() ) {
        $trending->the_post();
        $posts_arr[] = get_the_ID();
    }
    wp_reset_postdata();
}
?>

<!-- PAGE HEADER -->
<div class="page-hdr">
    <div class="eyebrow">🔥 <?php esc_html_e('Most read right now','healthbeyondage'); ?></div>
    <h1><?php esc_html_e('Trending Articles','healthbeyondage'); ?></h1>
    <p><?php esc_html_e('The most-read health articles on Health Beyond Age this week — chosen by our readers.','healthbeyondage'); ?></p>
</div>

<div class="section">
    <!-- Period Tabs -->
    <div class="period-tabs">
        <button class="period-tab active"><?php esc_html_e('This Week','healthbeyondage'); ?></button>
        <button class="period-tab"><?php esc_html_e('This Month','healthbeyondage'); ?></button>
        <button class="period-tab"><?php esc_html_e('All Time','healthbeyondage'); ?></button>
    </div>

    <!-- Top 1 + stack 2–5 -->
    <div class="trending-hero-grid">

        <!-- #1 Featured -->
        <?php if ( ! empty( $posts_arr[0] ) ) :
            $p1_id    = $posts_arr[0];
            $p1_thumb = get_the_post_thumbnail_url($p1_id, 'hba-featured');
            $p1_cats  = get_the_category($p1_id);
            $p1_cat   = $p1_cats[0]->name ?? '';
            $p1_views = hba_get_post_views($p1_id);
        ?>
        <div class="trend-main">
            <div class="trend-main-img">
                <?php if ($p1_thumb) : ?>
                    <img src="<?php echo esc_url($p1_thumb); ?>" alt="<?php echo esc_attr(get_the_title($p1_id)); ?>" />
                <?php endif; ?>
                <div class="rank-badge">1</div>
                <div class="hot-badge">🔥 <?php esc_html_e('Hot','healthbeyondage'); ?></div>
            </div>
            <div class="trend-main-body">
                <?php if ($p1_cat) : ?>
                    <div style="font-size:.65rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--g1);margin-bottom:.5rem;"><?php echo esc_html($p1_cat); ?></div>
                <?php endif; ?>
                <h2><?php echo esc_html(get_the_title($p1_id)); ?></h2>
                <p><?php echo esc_html(wp_trim_words(get_the_excerpt($p1_id),20)); ?></p>
                <div style="display:flex;align-items:center;gap:.75rem;margin-top:1rem;font-size:.75rem;color:var(--muted)">
                    <span><?php echo get_the_date('', $p1_id); ?></span>
                    <span>·</span>
                    <span><?php echo esc_html(hba_reading_time($p1_id)); ?></span>
                    <?php if ($p1_views) : ?>
                        <span>·</span>
                        <span><?php echo esc_html($p1_views); ?> reads</span>
                    <?php endif; ?>
                </div>
                <a href="<?php echo esc_url(get_permalink($p1_id)); ?>" class="btn-green" style="display:inline-block;margin-top:1.1rem;padding:.7rem 1.6rem;font-size:.9rem;">
                    <?php esc_html_e('Read Article','healthbeyondage'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- #2–5 Stack -->
        <div class="trend-stack">
            <?php
            for ( $i = 1; $i <= 4; $i++ ) {
                if ( empty($posts_arr[$i]) ) continue;
                $pid     = $posts_arr[$i];
                $p_cats  = get_the_category($pid);
                $p_cat   = $p_cats[0]->name ?? '';
                $p_views = hba_get_post_views($pid);
                ?>
                <a href="<?php echo esc_url(get_permalink($pid)); ?>" class="trend-item">
                    <div class="trend-rank"><?php echo esc_html($i + 1); ?></div>
                    <div class="trend-body">
                        <?php if ($p_cat) : ?>
                            <div class="trend-cat"><?php echo esc_html($p_cat); ?></div>
                        <?php endif; ?>
                        <h4><?php echo esc_html(get_the_title($pid)); ?></h4>
                        <div class="trend-meta">
                            <?php if ($p_views) echo esc_html($p_views) . ' reads · '; ?>
                            <?php echo esc_html(hba_reading_time($pid)); ?>
                        </div>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </div>

    <!-- More Trending -->
    <div class="sec-hd">
        <h2><?php esc_html_e('More','healthbeyondage'); ?> <span><?php esc_html_e('Trending Now','healthbeyondage'); ?></span></h2>
        <a href="<?php echo esc_url(home_url('/blog')); ?>"><?php esc_html_e('View all articles →','healthbeyondage'); ?></a>
    </div>
    <div class="art-grid">
        <?php
        $more_ids = array_slice($posts_arr, 5, 3);
        foreach ( $more_ids as $pid ) {
            hba_article_card($pid);
        }
        // If not enough trending, fill with recent
        if ( count($more_ids) < 3 ) {
            $fill = new WP_Query(['posts_per_page' => 3 - count($more_ids), 'post__not_in' => $posts_arr, 'post_status' => 'publish']);
            while ($fill->have_posts()) { $fill->the_post(); hba_article_card(get_the_ID()); }
            wp_reset_postdata();
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>
