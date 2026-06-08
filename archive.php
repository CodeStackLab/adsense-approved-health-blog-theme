<?php
/**
 * Archive Template — General archives (date, author, tag, etc.)
 */
get_header();
?>

<div class="articles-hero">
    <div class="articles-hero-inner">
        <div class="eyebrow"><?php esc_html_e('Archive','healthbeyondage'); ?></div>
        <h1><?php the_archive_title(); ?></h1>
        <?php the_archive_description('<p>','</p>'); ?>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div class="articles-layout">
    <div class="articles-main">
        <div class="art-list">
            <?php if ( have_posts() ) {
                while ( have_posts() ) { the_post(); hba_article_list_item( get_the_ID() ); }
            } else {
                echo '<p>' . esc_html__('No posts found.','healthbeyondage') . '</p>';
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
