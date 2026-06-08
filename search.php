<?php
/**
 * Search Results Template — Health Beyond Age
 */
get_header();
?>

<div class="articles-hero">
    <div class="articles-hero-inner">
        <div class="eyebrow"><?php esc_html_e('Search Results','healthbeyondage'); ?></div>
        <h1><?php printf( esc_html__('Results for: "%s"','healthbeyondage'), '<em>' . esc_html(get_search_query()) . '</em>' ); ?></h1>
        <p><?php printf( esc_html__('%d articles found.','healthbeyondage'), (int)$wp_query->found_posts ); ?></p>
        <form class="search-bar" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Search articles...','healthbeyondage'); ?>" />
            <button type="submit"><?php esc_html_e('Search','healthbeyondage'); ?></button>
        </form>
    </div>
</div>

<div class="articles-layout">
    <div class="articles-main">
        <?php if ( have_posts() ) : ?>
            <div class="art-list">
                <?php while ( have_posts() ) { the_post(); hba_article_list_item( get_the_ID() ); } ?>
            </div>
            <?php hba_pagination(); ?>
        <?php else : ?>
            <div class="no-results">
                <h2><?php esc_html_e('No results found','healthbeyondage'); ?></h2>
                <p><?php esc_html_e('Try a different search term or browse our categories.','healthbeyondage'); ?></p>
                <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn-green" style="display:inline-block;margin-top:1rem;"><?php esc_html_e('Browse All Articles','healthbeyondage'); ?></a>
            </div>
        <?php endif; ?>
    </div>
    <aside class="articles-sidebar">
        <div class="sidebar-box">
            <h4><?php esc_html_e('Categories','healthbeyondage'); ?></h4>
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
    </aside>
</div>

<?php get_footer(); ?>
