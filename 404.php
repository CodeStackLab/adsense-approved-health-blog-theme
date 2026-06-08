<?php
/**
 * 404 Template — Health Beyond Age
 */
get_header();
?>
<div style="text-align:center;padding:6rem 1.5rem;">
    <div style="font-size:5rem;margin-bottom:1rem;">🔍</div>
    <h1 style="font-family:var(--serif);font-size:2.5rem;color:var(--text);margin-bottom:1rem;">404</h1>
    <p style="font-size:1rem;color:var(--mid);margin-bottom:2rem;"><?php esc_html_e("Page not found. Let's get you back on track.",'healthbeyondage'); ?></p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-green" style="display:inline-block;padding:.82rem 2rem;font-size:.95rem;"><?php esc_html_e('← Back to Home','healthbeyondage'); ?></a>
</div>
<?php get_footer(); ?>
