<?php
/**
 * Page Template — Health Beyond Age
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php hba_breadcrumb(); ?>

<div style="max-width:1180px;margin:0 auto;padding:3rem 1.5rem;">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header style="margin-bottom:2rem;">
            <h1 style="font-family:var(--serif);font-size:clamp(1.8rem,3vw,2.6rem);font-weight:700;color:var(--text);line-height:1.2;"><?php the_title(); ?></h1>
        </header>
        <div class="article-body">
            <?php the_content(); ?>
        </div>
        <?php wp_link_pages(['before' => '<div class="page-links">','after' => '</div>']); ?>
    </article>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
