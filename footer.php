<?php
/**
 * Footer Template — Health Beyond Age
 */
?>

<?php hba_newsletter_section(); ?>

<!-- TRUST METRICS BAR -->
<div class="trust-metrics-bar">
    <div class="trust-metrics-inner">
        <?php
        $defaults = [
            ['150+','Expert Articles'],
            ['5','Health Categories'],
            ['100%','Medically Reviewed'],
            ['Since 2021','Publishing Since'],
        ];
        foreach ( $defaults as $i => $d ) :
            $num = get_theme_mod( "hba_metric_{$i}_num", $d[0] );
            $lbl = get_theme_mod( "hba_metric_{$i}_lbl", $d[1] );
        ?>
        <div class="tmet-stat">
            <span class="num"><?php echo esc_html( $num ); ?></span>
            <span class="lbl"><?php echo esc_html( $lbl ); ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="site-footer" role="contentinfo">
    <div class="foot-inner">
        <div class="foot-top">

            <!-- Brand Column -->
            <div>
                <div class="foot-logo">
                    <?php
                    $logo = get_theme_mod( 'hba_logo', 'http://srv1740311.hstgr.cloud/wp-content/uploads/2026/06/Logo-e0d0210e.png' );
                    if ( $logo ) : ?>
                        <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo('name'); ?>" />
                    <?php endif; ?>
                </div>
                <p class="foot-about"><?php echo esc_html( get_theme_mod( 'hba_footer_about', 'Evidence-based health information to help you make informed choices and live a longer, healthier life.' ) ); ?></p>
                <div class="socials">
                    <?php
                    $social_icons = [
                        'facebook'  => '<svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
                        'twitter'   => '<svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M21.5 2h-4l-5.5 8L6.5 2h-4l7.5 10.5L2.5 22h4l6-8.5 6 8.5h4l-8-11.5L21.5 2zm-6.5 16h2L8 4H6l9 14z"/></svg>',
                        'youtube'   => '<svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M22.5 6.5s-.2-1.6-1-2.4c-.9-.9-2-.9-2.5-1-3.5-.3-8.8-.3-8.8-.3s-5.3 0-8.8.3c-.5.1-1.6.1-2.5 1-.8.8-1 2.4-1 2.4S0 8.5 0 10.5v3c0 2 .2 4 .2 4s.2 1.6 1 2.4c.9.9 2 .9 2.5 1 3.5.3 8.8.3 8.8.3s5.3 0 8.8-.3c.5-.1 1.6-.1 2.5-1 .8-.8 1-2.4 1-2.4s.2-2 .2-4v-3c0-2-.2-4-.2-4zM9 15.5v-7L15.5 12 9 15.5z"/></svg>',
                        'pinterest' => '<svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12 0a12 12 0 0 0-4.37 23.18c-.03-.84-.06-2.12.01-3.04.09-1.22.58-4.48.58-4.48s-.15-.3-.15-.74c0-.7.4-1.21.9-1.21.43 0 .63.32.63.7 0 .43-.27 1.07-.42 1.67-.12.5.25.91.74.91.88 0 1.56-1.12 1.56-2.73 0-1.27-.85-2.2-2.3-2.2-1.67 0-2.7 1.25-2.7 2.65 0 .41.12.7.3.92.08.1.1.16.07.26-.03.11-.1.38-.11.43-.02.09-.08.12-.18.07-.63-.26-1.03-1.08-1.03-1.74 0-1.42 1.05-3.09 3.42-3.09 1.9 0 3.39 1.35 3.39 3.16 0 1.9-1.2 3.43-2.85 3.43-.56 0-1.08-.29-1.26-.64l-.34 1.32c-.12.47-.46 1.05-.68 1.4A12 12 0 1 0 12 0z"/></svg>',
                    ];
                    foreach ( $social_icons as $key => $icon ) :
                        $url = get_theme_mod( "hba_social_{$key}", '' );
                        if ( $url ) : ?>
                            <a href="<?php echo esc_url( $url ); ?>" class="soc-btn" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $key ); ?>">
                                <?php echo $icon; ?>
                            </a>
                        <?php else : ?>
                            <div class="soc-btn"><?php echo $icon; ?></div>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>

            <!-- Categories Column -->
            <div class="foot-col">
                <h5><?php esc_html_e( 'Categories', 'healthbeyondage' ); ?></h5>
                <ul>
                    <?php
                    $cats = get_categories(['number' => 6, 'hide_empty' => true]);
                    foreach ( $cats as $cat ) :
                    ?>
                        <li><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Company Column -->
            <div class="foot-col">
                <h5><?php esc_html_e( 'Company', 'healthbeyondage' ); ?></h5>
                <ul>
                    <li><a href="<?php echo esc_url( home_url('/about') ); ?>"><?php esc_html_e('About Us','healthbeyondage'); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url('/team') ); ?>"><?php esc_html_e('Meet Our Team','healthbeyondage'); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url('/contact') ); ?>"><?php esc_html_e('Contact Us','healthbeyondage'); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url('/blog') ); ?>"><?php esc_html_e('All Articles','healthbeyondage'); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link('post') ); ?>"><?php esc_html_e('Trending','healthbeyondage'); ?></a></li>
                </ul>
            </div>

            <!-- Legal Column -->
            <div class="foot-col">
                <h5><?php esc_html_e( 'Legal', 'healthbeyondage' ); ?></h5>
                <ul>
                    <li><a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>"><?php esc_html_e('Privacy Policy','healthbeyondage'); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url('/terms-of-use') ); ?>"><?php esc_html_e('Terms of Use','healthbeyondage'); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url('/medical-disclaimer') ); ?>"><?php esc_html_e('Medical Disclaimer','healthbeyondage'); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url('/cookie-policy') ); ?>"><?php esc_html_e('Cookie Policy','healthbeyondage'); ?></a></li>
                </ul>
            </div>

        </div>

        <div class="foot-bottom">
            <span class="foot-copy"><?php echo esc_html( get_theme_mod( 'hba_footer_copyright', '© ' . date('Y') . ' Health Beyond Age. All rights reserved.' ) ); ?></span>

        </div>
    </div>
</footer>

<!-- ==================== PAGE NAVIGATION (Browse Pages) ==================== -->
<details id="page-nav">
  <summary>Browse Pages</summary>
  <div id="page-nav-list">
    <div class="pnav-section">Main</div>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/') ); ?>">🏠 Home</a>
    
    <div class="pnav-section">Category Pages</div>
    <?php
    $cat_link = function($slug) {
        $cat = get_category_by_slug($slug);
        return $cat ? get_category_link($cat->term_id) : '#';
    };
    ?>
    <a class="pnav-btn" href="<?php echo esc_url( $cat_link('nutrition') ); ?>">🥦 Nutrition</a>
    <a class="pnav-btn" href="<?php echo esc_url( $cat_link('mental-wellness') ); ?>">🧠 Mental Wellness</a>
    <a class="pnav-btn" href="<?php echo esc_url( $cat_link('preventive-health') ); ?>">🩺 Preventive Health</a>
    <a class="pnav-btn" href="<?php echo esc_url( $cat_link('fitness') ); ?>">🏋️ Fitness</a>
    <a class="pnav-btn" href="<?php echo esc_url( $cat_link('skin-care') ); ?>">✨ Skin Care</a>
    
    <div class="pnav-section">Company Pages</div>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/about') ); ?>">About Us</a>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/team') ); ?>">Meet Our Team</a>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/contact') ); ?>">Contact Us</a>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/blog') ); ?>">All Articles</a>
    <a class="pnav-btn" href="<?php echo esc_url( get_post_type_archive_link('post') ); ?>">Trending</a>
    
    <div class="pnav-section">Legal Pages</div>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/privacy-policy') ); ?>">Privacy Policy</a>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/terms-of-use') ); ?>">Terms of Use</a>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/medical-disclaimer') ); ?>">Medical Disclaimer</a>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/disclaimer') ); ?>">Disclaimer</a>
    <a class="pnav-btn" href="<?php echo esc_url( home_url('/cookie-policy') ); ?>">Cookie Policy</a>
  </div>
</details>

<?php wp_footer(); ?>
</body>
</html>
