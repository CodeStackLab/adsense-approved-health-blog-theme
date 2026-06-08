<?php
/**
 * Template Name: Blog
 * Home/Blog Template — All Articles Page
 */
get_header();
?>

<div class="articles-hero">
    <div class="articles-hero-inner">
        <div class="eyebrow"><?php esc_html_e('Health Articles','healthbeyondage'); ?></div>
        <h1><?php esc_html_e('All Health Articles','healthbeyondage'); ?></h1>
        <p><?php esc_html_e('Evidence-based health content, medically reviewed by qualified professionals. Browse all topics below.','healthbeyondage'); ?></p>
        <form class="search-bar" method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search">
            <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Search articles...','healthbeyondage'); ?>" aria-label="<?php esc_attr_e('Search','healthbeyondage'); ?>" />
            <button type="submit"><?php esc_html_e('Search','healthbeyondage'); ?></button>
        </form>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div class="articles-layout">
    <div class="articles-main">

        <!-- Category Filter -->
        <div class="filter-bar" style="position:static;background:transparent;border:none;padding:0 0 1.5rem;">
            <div class="filter-inner" style="max-width:100%;padding:0;">
                <span class="filter-label"><?php esc_html_e('Filter by:','healthbeyondage'); ?></span>
                <div class="filter-tags">
                    <a href="<?php echo esc_url(home_url('/blog')); ?>" class="tag <?php echo ! is_category() ? 'active' : ''; ?>"><?php esc_html_e('All','healthbeyondage'); ?></a>
                    <?php
                    $cats = get_categories(['hide_empty' => true, 'number' => 8]);
                    foreach ( $cats as $cat ) {
                        $active = is_category($cat->term_id) ? 'active' : '';
                        echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="tag ' . $active . '">' . esc_html($cat->name) . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="art-list">
            <?php if ( have_posts() ) {
                while ( have_posts() ) { the_post(); hba_article_list_item( get_the_ID() ); }
            } else {
                echo '<p>' . esc_html__('No articles found.','healthbeyondage') . '</p>';
            } ?>
        </div>
        <?php hba_pagination(); ?>
    </div>

    <aside class="articles-sidebar">
        <div class="sidebar-box">
            <h4><?php esc_html_e('Browse Categories','healthbeyondage'); ?></h4>
            <?php
            $cats = get_categories(['hide_empty' => true]);
            foreach ( $cats as $cat ) :
            ?>
                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="sidebar-cat-link">
                    <?php echo esc_html($cat->name); ?>
                    <span class="cnt"><?php echo esc_html($cat->count); ?></span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="sidebar-box">
            <h4><?php esc_html_e('Popular Tags','healthbeyondage'); ?></h4>
            <?php
            $tags = get_tags(['number' => 10]);
            if ( $tags ) {
                foreach ( $tags as $tag ) {
                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag" style="margin:.2rem;">' . esc_html($tag->name) . '</a>';
                }
            }
            ?>
        </div>
    </aside>
</div>

<?php get_footer(); ?>
