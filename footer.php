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
                <p class="foot-about"><?php echo esc_html( get_theme_mod( 'hba_footer_about', 'Evidence-based health information to help you live a longer, healthier life.' ) ); ?></p>
                <div class="socials">
                    <?php
                    $social_icons = [
                        'facebook'  => 'f',
                        'twitter'   => '𝕏',
                        'youtube'   => '▶',
                        'pinterest' => '𝗣',
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
            <div class="med-pill">✓ <?php esc_html_e( 'All Content Medically Reviewed', 'healthbeyondage' ); ?></div>
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
