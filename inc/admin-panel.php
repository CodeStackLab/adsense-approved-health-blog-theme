<?php
/**
 * Health Beyond Age — Admin Panel
 * Custom admin menu and settings page.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* Register admin menu */
function hba_admin_menu() {
    add_menu_page(
        __( 'HBA Theme Settings', 'healthbeyondage' ),
        __( 'HBA Settings', 'healthbeyondage' ),
        'manage_options',
        'hba-theme-settings',
        'hba_admin_page',
        'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#22963F" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'),
        25
    );
    add_submenu_page( 'hba-theme-settings', __('General Settings','healthbeyondage'), __('General','healthbeyondage'), 'manage_options', 'hba-theme-settings', 'hba_admin_page' );
    add_submenu_page( 'hba-theme-settings', __('Homepage Settings','healthbeyondage'), __('Homepage','healthbeyondage'), 'manage_options', 'hba-homepage-settings', 'hba_homepage_admin_page' );
    add_submenu_page( 'hba-theme-settings', __('Go to Customizer','healthbeyondage'), __('Live Customizer ↗','healthbeyondage'), 'manage_options', 'customize.php?return=' . urlencode( admin_url('admin.php?page=hba-theme-settings') ) );
}
add_action( 'admin_menu', 'hba_admin_menu' );

/* Save settings */
function hba_save_settings() {
    if ( isset( $_POST['hba_save_general'] ) && check_admin_referer( 'hba_general_nonce' ) ) {
        $fields = [ 'hba_site_description', 'hba_medical_disclaimer_text', 'hba_footer_about', 'hba_footer_copyright',
                    'hba_contact_email', 'hba_contact_address', 'hba_social_facebook', 'hba_social_twitter',
                    'hba_social_instagram', 'hba_social_youtube', 'hba_social_pinterest', 'hba_ann_bar_text',
                    'hba_nav_cta_text', 'hba_nav_cta_url' ];
        foreach ( $fields as $f ) {
            if ( isset( $_POST[$f] ) ) {
                set_theme_mod( $f, sanitize_text_field( wp_unslash( $_POST[$f] ) ) );
            }
        }
        add_settings_error( 'hba_settings', 'hba_saved', __( 'Settings saved!', 'healthbeyondage' ), 'updated' );
    }
}
add_action( 'admin_init', 'hba_save_settings' );

/* Admin Page */
function hba_admin_page() {
    settings_errors( 'hba_settings' );
    ?>
    <div class="wrap hba-admin-panel">
        <h1 style="display:flex;align-items:center;gap:10px;">
            <span style="color:#1A7A3C;font-size:1.5rem">🏥</span>
            <?php esc_html_e( 'Health Beyond Age — Theme Settings', 'healthbeyondage' ); ?>
        </h1>
        <p style="color:#688573;margin-bottom:20px;"><?php esc_html_e( 'Configure your theme. Use the Live Customizer for real-time preview.', 'healthbeyondage' ); ?></p>

        <div style="display:flex;gap:12px;margin-bottom:24px;">
            <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary" style="background:#1A7A3C;border-color:#1A7A3C;">
                🎨 <?php esc_html_e( 'Open Live Customizer', 'healthbeyondage' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url() ); ?>" target="_blank" class="button">
                🌐 <?php esc_html_e( 'View Site', 'healthbeyondage' ); ?>
            </a>
        </div>

        <form method="post">
            <?php wp_nonce_field( 'hba_general_nonce' ); ?>
            <div class="hba-settings-grid">

                <div class="hba-settings-section">
                    <h3><?php esc_html_e( 'Site Information', 'healthbeyondage' ); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><?php esc_html_e( 'Site Description', 'healthbeyondage' ); ?></th>
                            <td><input type="text" name="hba_site_description" value="<?php echo esc_attr( get_theme_mod( 'hba_site_description', '' ) ); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e( 'Contact Email', 'healthbeyondage' ); ?></th>
                            <td><input type="email" name="hba_contact_email" value="<?php echo esc_attr( get_theme_mod( 'hba_contact_email', '' ) ); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e( 'Contact Address', 'healthbeyondage' ); ?></th>
                            <td><textarea name="hba_contact_address" rows="3" class="regular-text"><?php echo esc_textarea( get_theme_mod( 'hba_contact_address', '' ) ); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <div class="hba-settings-section">
                    <h3><?php esc_html_e( 'Header', 'healthbeyondage' ); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><?php esc_html_e( 'Announcement Bar Text', 'healthbeyondage' ); ?></th>
                            <td><textarea name="hba_ann_bar_text" rows="2" class="regular-text"><?php echo esc_textarea( get_theme_mod( 'hba_ann_bar_text', 'All content is <strong>medically reviewed</strong> by qualified health professionals.' ) ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e( 'Nav CTA Button Text', 'healthbeyondage' ); ?></th>
                            <td><input type="text" name="hba_nav_cta_text" value="<?php echo esc_attr( get_theme_mod( 'hba_nav_cta_text', 'Newsletter' ) ); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e( 'Nav CTA Button URL', 'healthbeyondage' ); ?></th>
                            <td><input type="url" name="hba_nav_cta_url" value="<?php echo esc_url( get_theme_mod( 'hba_nav_cta_url', '#newsletter' ) ); ?>" class="regular-text" /></td>
                        </tr>
                    </table>
                </div>

                <div class="hba-settings-section">
                    <h3><?php esc_html_e( 'Footer', 'healthbeyondage' ); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><?php esc_html_e( 'Footer About Text', 'healthbeyondage' ); ?></th>
                            <td><textarea name="hba_footer_about" rows="3" class="regular-text"><?php echo esc_textarea( get_theme_mod( 'hba_footer_about', 'Evidence-based health information to help you live a longer, healthier life.' ) ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e( 'Copyright Text', 'healthbeyondage' ); ?></th>
                            <td><input type="text" name="hba_footer_copyright" value="<?php echo esc_attr( get_theme_mod( 'hba_footer_copyright', '© ' . date('Y') . ' Health Beyond Age. All rights reserved.' ) ); ?>" class="regular-text" /></td>
                        </tr>
                    </table>
                </div>

                <div class="hba-settings-section">
                    <h3><?php esc_html_e( 'Social Links', 'healthbeyondage' ); ?></h3>
                    <table class="form-table">
                        <?php
                        $socials = ['facebook'=>'Facebook','twitter'=>'X / Twitter','instagram'=>'Instagram','youtube'=>'YouTube','pinterest'=>'Pinterest'];
                        foreach ( $socials as $key => $label ) : ?>
                        <tr>
                            <th><?php echo esc_html( $label ); ?></th>
                            <td><input type="url" name="hba_social_<?php echo $key; ?>" value="<?php echo esc_url( get_theme_mod( "hba_social_{$key}", '' ) ); ?>" class="regular-text" placeholder="https://..." /></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="hba-settings-section">
                    <h3><?php esc_html_e( 'Medical Disclaimer', 'healthbeyondage' ); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><?php esc_html_e( 'Disclaimer Text', 'healthbeyondage' ); ?></th>
                            <td><textarea name="hba_medical_disclaimer_text" rows="4" class="regular-text"><?php echo esc_textarea( get_theme_mod( 'hba_medical_disclaimer_text', 'The information on this website is for informational purposes only and not a substitute for professional medical advice.' ) ); ?></textarea></td>
                        </tr>
                    </table>
                </div>

            </div>
            <p>
                <input type="submit" name="hba_save_general" class="button button-primary" value="<?php esc_attr_e( 'Save Settings', 'healthbeyondage' ); ?>" style="background:#1A7A3C;border-color:#1A7A3C;" />
            </p>
        </form>

        <div style="background:#E8F5EC;border:1px solid #B8E4C4;border-radius:8px;padding:16px;margin-top:24px;">
            <strong>💡 Tip:</strong> <?php esc_html_e( 'Use the Live Customizer for real-time preview of colors, fonts, hero content, and more.', 'healthbeyondage' ); ?>
            <a href="<?php echo esc_url( admin_url('customize.php') ); ?>" style="color:#1A7A3C;font-weight:600;"><?php esc_html_e( 'Open Customizer →', 'healthbeyondage' ); ?></a>
        </div>
    </div>
    <?php
}

/* Homepage Admin Page */
function hba_homepage_admin_page() {
    ?>
    <div class="wrap hba-admin-panel">
        <h1>🏠 <?php esc_html_e('Homepage Settings','healthbeyondage'); ?></h1>
        <p><?php esc_html_e('These settings control the homepage content. For live preview, use the Customizer.','healthbeyondage'); ?></p>
        <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=hba_homepage_hero' ) ); ?>" class="button button-primary" style="background:#1A7A3C;border-color:#1A7A3C;margin-bottom:20px;">
            🎨 <?php esc_html_e( 'Edit Homepage in Customizer', 'healthbeyondage' ); ?>
        </a>
        <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:20px;">
            <h3><?php esc_html_e('Quick Reference — Customizer Sections','healthbeyondage'); ?></h3>
            <ul style="list-style:disc;padding-left:20px;line-height:2;">
                <li><strong><?php esc_html_e('Hero Section','healthbeyondage'); ?></strong>: <?php esc_html_e('Title, subtitle, buttons, hero image, trust badges','healthbeyondage'); ?></li>
                <li><strong><?php esc_html_e('Expert Strip','healthbeyondage'); ?></strong>: <?php esc_html_e('Expert name, role, quote, photo','healthbeyondage'); ?></li>
                <li><strong><?php esc_html_e('Trust Metrics','healthbeyondage'); ?></strong>: <?php esc_html_e('Stats numbers and labels','healthbeyondage'); ?></li>
                <li><strong><?php esc_html_e('Newsletter Section','healthbeyondage'); ?></strong>: <?php esc_html_e('Title and description','healthbeyondage'); ?></li>
                <li><strong><?php esc_html_e('Footer','healthbeyondage'); ?></strong>: <?php esc_html_e('About text, copyright','healthbeyondage'); ?></li>
                <li><strong><?php esc_html_e('Colors','healthbeyondage'); ?></strong>: <?php esc_html_e('Brand colors, button colors, backgrounds','healthbeyondage'); ?></li>
                <li><strong><?php esc_html_e('Typography','healthbeyondage'); ?></strong>: <?php esc_html_e('Body font, heading font, base size','healthbeyondage'); ?></li>
            </ul>
        </div>
    </div>
    <?php
}
