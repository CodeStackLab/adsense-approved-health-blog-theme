<?php
/**
 * 404 Template — Health Beyond Age
 */
get_header();
?>

<div class="page-hdr" style="padding-bottom: 4rem;">
    <div class="eyebrow"><?php esc_html_e( 'Error 404', 'healthbeyondage' ); ?></div>
    <h1><?php esc_html_e( 'Page Not Found', 'healthbeyondage' ); ?></h1>
    <p><?php esc_html_e( "We couldn't find the page you're looking for. It might have been moved, or the link you clicked might be broken.", 'healthbeyondage' ); ?></p>
    
    <div style="max-width: 500px; margin: 2.5rem auto 0;">
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display: flex; gap: .5rem;">
            <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search for health topics...', 'healthbeyondage' ); ?>" style="flex: 1; padding: .85rem 1.25rem; border: none; border-radius: 8px; font-family: var(--sans); font-size: .95rem; outline: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" required />
            <button type="submit" class="btn-green" style="border: none; cursor: pointer;"><?php esc_html_e( 'Search', 'healthbeyondage' ); ?></button>
        </form>
    </div>
</div>

<div class="section" style="background: var(--off); padding-top: 4rem;">
    <div class="sec-hd" style="text-align: center; margin-bottom: 2.5rem;">
        <h2 style="font-family: var(--serif); font-size: 2rem; color: var(--text); font-weight: 700; margin: 0;"><?php esc_html_e( 'Read Our Latest Articles Instead', 'healthbeyondage' ); ?></h2>
    </div>
    
    <div class="art-grid" style="max-width: 1180px; margin: 0 auto; padding: 0 1.5rem;">
        <?php
        $latest = new WP_Query([
            'posts_per_page'      => 6,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ]);
        if ( $latest->have_posts() ) {
            while ( $latest->have_posts() ) {
                $latest->the_post();
                hba_article_card( get_the_ID() );
            }
            wp_reset_postdata();
        }
        ?>
    </div>
    
    <div style="text-align: center; margin-top: 3rem;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-green" style="font-size: 1rem; padding: .9rem 2.5rem;">← <?php esc_html_e( 'Back to Home', 'healthbeyondage' ); ?></a>
    </div>
</div>

<?php get_footer(); ?>
