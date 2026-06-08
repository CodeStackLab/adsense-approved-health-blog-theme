<?php
/**
 * Template Name: Legal Page
 * Shared template for Privacy Policy, Terms of Use, Disclaimer, Medical Disclaimer, Cookie Policy
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="articles-hero" style="background:var(--off); text-align:center; padding:3rem 1.5rem 2.5rem;">
    <div class="articles-hero-inner" style="max-width:800px; margin:0 auto;">
        <div class="eyebrow"><?php esc_html_e('Legal Information','healthbeyondage'); ?></div>
        <h1 style="font-family:var(--serif); font-size:clamp(1.8rem,3.5vw,2.8rem); font-weight:700; color:var(--text); margin-bottom:.5rem;">
            <?php the_title(); ?>
        </h1>
        <p style="font-size:.85rem; color:var(--muted); margin:0;">
            <?php echo esc_html('Last Updated: June 2026'); ?>
        </p>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div style="max-width:800px; margin:0 auto; padding:2.5rem 1.5rem 5rem;">
    <article id="post-<?php the_ID(); ?>" <?php post_class('legal-page'); ?> style="font-size:1rem; line-height:1.8; color:var(--text);">
        <div class="article-body">
            <?php the_content(); ?>
        </div>
        
        <div style="margin-top:3rem; padding:1.5rem; background:var(--off); border-radius:12px; border-left:4px solid var(--g1);">
            <p style="margin:0; font-size:.9rem; color:var(--mid);">
                <strong>Questions about this page?</strong> Please <a href="<?php echo esc_url(home_url('/contact')); ?>" style="color:var(--g1);">contact us</a> and we will be happy to help.
            </p>
        </div>
    </article>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
