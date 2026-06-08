<?php
/**
 * Health Beyond Age — WordPress Customizer
 * Full customizer integration for colors, fonts, typography,
 * header, footer, homepage sections, social links, and more.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function hba_customizer( $wp_customize ) {

    /* ===== PANEL ===== */
    $wp_customize->add_panel( 'hba_panel', [
        'title'       => __( 'Theme Settings', 'healthbeyondage' ),
        'description' => __( 'Customize Health Beyond Age theme settings.', 'healthbeyondage' ),
        'priority'    => 10,
    ] );

    /* ============================
       SECTION: Brand Colors
    ============================ */
    $wp_customize->add_section( 'hba_colors', [
        'title' => __( 'Brand Colors', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $color_settings = [
        'hba_primary_color'   => [ __( 'Primary Green', 'healthbeyondage' ),   '#1A7A3C' ],
        'hba_secondary_color' => [ __( 'Secondary Green', 'healthbeyondage' ), '#22963F' ],
        'hba_body_bg'         => [ __( 'Body Background', 'healthbeyondage' ), '#F5F8F6' ],
        'hba_text_color'      => [ __( 'Body Text Color', 'healthbeyondage' ), '#111F16' ],
        'hba_button_color'    => [ __( 'Button Color', 'healthbeyondage' ),    '#22963F' ],
    ];

    foreach ( $color_settings as $key => $args ) {
        $wp_customize->add_setting( $key, [
            'default'           => $args[1],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ] );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, [
            'label'   => $args[0],
            'section' => 'hba_colors',
        ] ) );
    }

    /* ============================
       SECTION: Typography / Fonts
    ============================ */
    $wp_customize->add_section( 'hba_typography', [
        'title' => __( 'Typography', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $font_choices = [
        "'DM Sans', system-ui, sans-serif"        => 'DM Sans (Default)',
        "'Inter', system-ui, sans-serif"           => 'Inter',
        "'Roboto', system-ui, sans-serif"          => 'Roboto',
        "'Open Sans', system-ui, sans-serif"       => 'Open Sans',
        "'Lato', system-ui, sans-serif"            => 'Lato',
    ];
    $heading_choices = [
        "'Merriweather', Georgia, serif"           => 'Merriweather (Default)',
        "'Playfair Display', Georgia, serif"       => 'Playfair Display',
        "'Lora', Georgia, serif"                   => 'Lora',
        "Georgia, serif"                           => 'Georgia',
    ];

    $wp_customize->add_setting( 'hba_body_font', [ 'default' => "'DM Sans', system-ui, sans-serif", 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_body_font', [ 'label' => __( 'Body Font', 'healthbeyondage' ), 'section' => 'hba_typography', 'type' => 'select', 'choices' => $font_choices ] );

    $wp_customize->add_setting( 'hba_heading_font', [ 'default' => "'Merriweather', Georgia, serif", 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_heading_font', [ 'label' => __( 'Heading Font', 'healthbeyondage' ), 'section' => 'hba_typography', 'type' => 'select', 'choices' => $heading_choices ] );

    $wp_customize->add_setting( 'hba_base_font_size', [ 'default' => '15', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_base_font_size', [ 'label' => __( 'Base Font Size (px)', 'healthbeyondage' ), 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 12, 'max' => 22] ] );

    /* ============================
       SECTION: Header
    ============================ */
    $wp_customize->add_section( 'hba_header', [
        'title' => __( 'Header Settings', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $wp_customize->add_setting( 'hba_logo', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hba_logo', [
        'label'   => __( 'Site Logo', 'healthbeyondage' ),
        'section' => 'hba_header',
    ] ) );

    $wp_customize->add_setting( 'hba_ann_bar_text', [ 'default' => 'All content is <strong>medically reviewed</strong> by qualified health professionals — updated regularly for accuracy.', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_ann_bar_text', [ 'label' => __( 'Announcement Bar Text', 'healthbeyondage' ), 'section' => 'hba_header', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_show_ann_bar', [ 'default' => true, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_show_ann_bar', [ 'label' => __( 'Show Announcement Bar', 'healthbeyondage' ), 'section' => 'hba_header', 'type' => 'checkbox' ] );

    $wp_customize->add_setting( 'hba_nav_cta_text', [ 'default' => 'Newsletter', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nav_cta_text', [ 'label' => __( 'Nav CTA Button Text', 'healthbeyondage' ), 'section' => 'hba_header', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_nav_cta_url', [ 'default' => '#newsletter', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nav_cta_url', [ 'label' => __( 'Nav CTA Button URL', 'healthbeyondage' ), 'section' => 'hba_header', 'type' => 'url' ] );

    /* ============================
       SECTION: Homepage Hero
    ============================ */
    $wp_customize->add_section( 'hba_homepage_hero', [
        'title' => __( 'Homepage Hero', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $hero_settings = [
        'hba_hero_eyebrow'    => [ __( 'Eyebrow Text', 'healthbeyondage' ),   'TRUSTED HEALTH GUIDANCE', 'text' ],
        'hba_hero_title'      => [ __( 'Hero Title', 'healthbeyondage' ),     'Trusted Health Guidance For A Better Life', 'textarea' ],
        'hba_hero_subtitle'   => [ __( 'Hero Subtitle', 'healthbeyondage' ),  'Practical, Evidence-Based Wellness Advice Designed To Help You Live Healthier, Feel Stronger, And Age Confidently Every Day.', 'textarea' ],
        'hba_hero_btn1_text'  => [ __( 'Button 1 Text', 'healthbeyondage' ),  'Explore Health Topics', 'text' ],
        'hba_hero_btn1_url'   => [ __( 'Button 1 URL', 'healthbeyondage' ),   '/blog', 'url' ],
        'hba_hero_btn2_text'  => [ __( 'Button 2 Text', 'healthbeyondage' ),  'Latest Articles', 'text' ],
        'hba_hero_btn2_url'   => [ __( 'Button 2 URL', 'healthbeyondage' ),   '/blog', 'url' ],
        'hba_hero_trust1'     => [ __( 'Trust Badge 1', 'healthbeyondage' ),  'Medically Reviewed Content', 'text' ],
        'hba_hero_trust2'     => [ __( 'Trust Badge 2', 'healthbeyondage' ),  'Evidence-Based Research', 'text' ],
    ];

    foreach ( $hero_settings as $key => $args ) {
        $wp_customize->add_setting( $key, [ 'default' => $args[1], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( $key, [ 'label' => $args[0], 'section' => 'hba_homepage_hero', 'type' => $args[2] ] );
    }

    $wp_customize->add_setting( 'hba_hero_image', [ 'default' => 'http://srv1740311.hstgr.cloud/wp-content/uploads/2026/06/Image-1-d2fab5ef.png', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hba_hero_image', [
        'label'   => __( 'Hero Image', 'healthbeyondage' ),
        'section' => 'hba_homepage_hero',
    ] ) );

    /* ============================
       SECTION: Homepage Sections
    ============================ */
    $wp_customize->add_section( 'hba_homepage_sections', [
        'title' => __( 'Homepage Sections', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $wp_customize->add_setting( 'hba_latest_articles_count', [ 'default' => 6, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_latest_articles_count', [ 'label' => __( 'Latest Articles Count', 'healthbeyondage' ), 'section' => 'hba_homepage_sections', 'type' => 'number', 'input_attrs' => ['min' => 3, 'max' => 12] ] );

    $wp_customize->add_setting( 'hba_expert_name', [ 'default' => 'Dr. Sarah Matheson', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_name', [ 'label' => __( 'Expert Name', 'healthbeyondage' ), 'section' => 'hba_homepage_sections', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_expert_role', [ 'default' => 'Lead Medical Reviewer', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_role', [ 'label' => __( 'Expert Role', 'healthbeyondage' ), 'section' => 'hba_homepage_sections', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_expert_quote', [ 'default' => '"Good health isn\'t about perfection — it\'s about <strong>consistent, informed choices.</strong> Every article on this site is reviewed to give you the knowledge to make those choices with confidence."', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_quote', [ 'label' => __( 'Expert Quote', 'healthbeyondage' ), 'section' => 'hba_homepage_sections', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_expert_photo', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hba_expert_photo', [ 'label' => __( 'Expert Photo', 'healthbeyondage' ), 'section' => 'hba_homepage_sections' ] ) );

    // Trust metrics
    foreach ( ['150+|Expert Articles','5|Health Categories','100%|Medically Reviewed','Since 2021|Publishing Since'] as $i => $val ) {
        list( $num, $lbl ) = explode( '|', $val );
        $wp_customize->add_setting( "hba_metric_{$i}_num", [ 'default' => $num, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_metric_{$i}_num", [ 'label' => "Metric " . ($i+1) . " Number", 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
        $wp_customize->add_setting( "hba_metric_{$i}_lbl", [ 'default' => $lbl, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_metric_{$i}_lbl", [ 'label' => "Metric " . ($i+1) . " Label", 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
    }

    /* ============================
       SECTION: Newsletter
    ============================ */
    $wp_customize->add_section( 'hba_newsletter', [
        'title' => __( 'Newsletter Section', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $wp_customize->add_setting( 'hba_newsletter_title', [ 'default' => 'Stay Ahead of<br/>Your Health', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_newsletter_title', [ 'label' => __( 'Newsletter Title', 'healthbeyondage' ), 'section' => 'hba_newsletter', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_newsletter_desc', [ 'default' => 'Expert-curated wellness insights, the latest research, and practical tips — delivered every Friday. No noise, no spam.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_newsletter_desc', [ 'label' => __( 'Newsletter Description', 'healthbeyondage' ), 'section' => 'hba_newsletter', 'type' => 'textarea' ] );

    /* ============================
       SECTION: Footer
    ============================ */
    $wp_customize->add_section( 'hba_footer', [
        'title' => __( 'Footer Settings', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $wp_customize->add_setting( 'hba_footer_about', [ 'default' => 'Evidence-based health information to help you live a longer, healthier life.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_footer_about', [ 'label' => __( 'Footer About Text', 'healthbeyondage' ), 'section' => 'hba_footer', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_footer_copyright', [ 'default' => '© ' . date('Y') . ' Health Beyond Age. All rights reserved.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_footer_copyright', [ 'label' => __( 'Copyright Text', 'healthbeyondage' ), 'section' => 'hba_footer', 'type' => 'text' ] );

    /* ============================
       SECTION: Social Links
    ============================ */
    $wp_customize->add_section( 'hba_social', [
        'title' => __( 'Social Links', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $socials = [ 'facebook' => 'Facebook URL', 'twitter' => 'X / Twitter URL', 'instagram' => 'Instagram URL', 'youtube' => 'YouTube URL', 'pinterest' => 'Pinterest URL' ];
    foreach ( $socials as $key => $label ) {
        $wp_customize->add_setting( "hba_social_{$key}", [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
        $wp_customize->add_control( "hba_social_{$key}", [ 'label' => __( $label, 'healthbeyondage' ), 'section' => 'hba_social', 'type' => 'url' ] );
    }

    /* ============================
       SECTION: Contact Info
    ============================ */
    $wp_customize->add_section( 'hba_contact_info', [
        'title' => __( 'Contact Information', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $wp_customize->add_setting( 'hba_contact_email', [ 'default' => '', 'sanitize_callback' => 'sanitize_email' ] );
    $wp_customize->add_control( 'hba_contact_email', [ 'label' => __( 'Contact Email', 'healthbeyondage' ), 'section' => 'hba_contact_info', 'type' => 'email' ] );

    $wp_customize->add_setting( 'hba_contact_address', [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hba_contact_address', [ 'label' => __( 'Address', 'healthbeyondage' ), 'section' => 'hba_contact_info', 'type' => 'textarea' ] );

    /* ============================
       SECTION: Layout Settings
    ============================ */
    $wp_customize->add_section( 'hba_layout', [
        'title' => __( 'Layout Settings', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    $wp_customize->add_setting( 'hba_show_sidebar_single', [ 'default' => true, 'sanitize_callback' => 'rest_sanitize_boolean' ] );
    $wp_customize->add_control( 'hba_show_sidebar_single', [ 'label' => __( 'Show Sidebar on Single Posts', 'healthbeyondage' ), 'section' => 'hba_layout', 'type' => 'checkbox' ] );

    $wp_customize->add_setting( 'hba_articles_per_page', [ 'default' => 9, 'sanitize_callback' => 'absint' ] );
    $wp_customize->add_control( 'hba_articles_per_page', [ 'label' => __( 'Articles Per Page', 'healthbeyondage' ), 'section' => 'hba_layout', 'type' => 'number', 'input_attrs' => ['min' => 3, 'max' => 30] ] );

    /* ============================
       SECTION: Single Post Settings
    ============================ */
    $wp_customize->add_section( 'hba_single_post', [
        'title' => __( 'Single Post Settings', 'healthbeyondage' ),
        'panel' => 'hba_panel',
    ] );

    // Toggles
    $toggles = [
        'hba_sp_show_medrev' => 'Show Medically Reviewed Bar',
        'hba_sp_show_byline' => 'Show Author Byline',
        'hba_sp_show_tags'   => 'Show Article Tags',
        'hba_sp_show_share'  => 'Show Share Bar',
    ];
    foreach ( $toggles as $id => $label ) {
        $wp_customize->add_setting( $id, [ 'default' => true, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'refresh' ] );
        $wp_customize->add_control( $id, [ 'label' => __( $label, 'healthbeyondage' ), 'section' => 'hba_single_post', 'type' => 'checkbox' ] );
    }

    // Typography
    $wp_customize->add_setting( 'hba_sp_title_size', [ 'default' => 2.2, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_sp_title_size', [ 'label' => __( 'Title Font Size (rem)', 'healthbeyondage' ), 'section' => 'hba_single_post', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 5, 'step' => 0.1] ] );

    $wp_customize->add_setting( 'hba_sp_content_size', [ 'default' => 0.92, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_sp_content_size', [ 'label' => __( 'Content Font Size (rem)', 'healthbeyondage' ), 'section' => 'hba_single_post', 'type' => 'number', 'input_attrs' => ['min' => 0.7, 'max' => 1.5, 'step' => 0.05] ] );

    // Colors
    $wp_customize->add_setting( 'hba_sp_kt_bg', [ 'default' => '#1B6B3A', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hba_sp_kt_bg', [ 'label' => __( 'Key Takeaways Background', 'healthbeyondage' ), 'section' => 'hba_single_post' ] ) );

    $wp_customize->add_setting( 'hba_sp_callout_border', [ 'default' => '#27903F', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hba_sp_callout_border', [ 'label' => __( 'Callout Accent Border', 'healthbeyondage' ), 'section' => 'hba_single_post' ] ) );
}
add_action( 'customize_register', 'hba_customizer' );

/* ===== Selective Refresh bindings ===== */
function hba_customizer_preview_js() {
    wp_enqueue_script( 'hba-customizer-preview', HBA_URI . '/assets/js/customizer-preview.js', ['jquery','customize-preview'], HBA_VERSION, true );
}
add_action( 'customize_preview_init', 'hba_customizer_preview_js' );
