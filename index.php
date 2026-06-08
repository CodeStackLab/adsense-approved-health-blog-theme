<?php
/**
 * Fallback index.php — Health Beyond Age
 */
get_header();
?>

<div class="articles-hero">
    <div class="articles-hero-inner">
        <div class="eyebrow"><?php esc_html_e('Latest','healthbeyondage'); ?></div>
        <h1><?php bloginfo('name'); ?></h1>
        <p><?php bloginfo('description'); ?></p>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div style="max-width:1180px;margin:0 auto;padding:2.5rem 1.5rem;">
    <div class="art-grid">
        <?php if ( have_posts() ) {
            while ( have_posts() ) { the_post(); hba_article_card( get_the_ID() ); }
        } else {
            echo '<p>' . esc_html__('No posts found.','healthbeyondage') . '</p>';
        } ?>
    </div>
    <?php hba_pagination(); ?>
</div>

<?php get_footer(); ?>
