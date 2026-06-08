<?php
/**
 * Page Template — Health Beyond Age
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$has_thumb = has_post_thumbnail();
?>

<div class="articles-hero" style="background:var(--off); text-align:center; padding: 4rem 1.5rem;">
    <div class="articles-hero-inner" style="max-width:800px; margin:0 auto;">
        <h1 style="font-family:var(--serif); font-size:clamp(2rem, 4vw, 3.2rem); font-weight:700; color:var(--text); line-height:1.2; margin-bottom:0;">
            <?php the_title(); ?>
        </h1>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div class="page-container" style="max-width:800px; margin:0 auto; padding:2rem 1.5rem 5rem;">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <?php if ( $has_thumb ) : ?>
            <div class="page-featured-img" style="margin-bottom:3rem; border-radius:16px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                <?php the_post_thumbnail('full', ['style' => 'width:100%; height:auto; display:block;']); ?>
            </div>
        <?php endif; ?>

        <div class="article-body" style="font-size:1.1rem; line-height:1.8; color:var(--text);">
            <?php the_content(); ?>
        </div>
        
        <?php wp_link_pages(['before' => '<div class="page-links">','after' => '</div>']); ?>
    </article>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
