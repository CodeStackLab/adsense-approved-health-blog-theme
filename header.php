<?php
/**
 * Header Template — Health Beyond Age
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>



<nav class="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'healthbeyondage' ); ?>">
    <div class="nav-wrap">

        <div class="logo-area">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php
                $logo = get_theme_mod( 'hba_logo', 'http://srv1740311.hstgr.cloud/wp-content/uploads/2026/06/Logo-e0d0210e.png' );
                if ( $logo ) : ?>
                    <img class="logo-img" src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                <?php else : ?>
                    <span style="font-family:var(--serif);font-weight:700;font-size:1.1rem;color:var(--g1);"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </a>
        </div>

        <div class="nav-menu-wrap">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'nav-links',
                'container'      => false,
                'fallback_cb'    => function() {
                    $cats = get_categories(['number' => 5, 'hide_empty' => true]);
                    echo '<ul class="nav-links">';
                    foreach ( $cats as $cat ) {
                        echo '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
                    }
                    echo '</ul>';
                }
            ]);
            ?>

            <div class="nav-right">
                <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn-ghost"><?php esc_html_e( 'About Us', 'healthbeyondage' ); ?></a>
                <a href="<?php echo esc_url( get_theme_mod( 'hba_nav_cta_url', home_url( '/blog' ) ) ); ?>" class="btn-green">
                    <?php echo esc_html( get_theme_mod( 'hba_nav_cta_text', 'All Articles' ) ); ?>
                </a>
            </div>
        </div>

        <button class="hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>

    </div>
</nav>
