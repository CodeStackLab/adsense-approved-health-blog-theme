<?php
/**
 * Health Beyond Age — WordPress Customizer
 * Each homepage section has its own dedicated Customizer section.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function hba_customizer( $wp_customize ) {

    /* ===== MAIN PANEL ===== */
    $wp_customize->add_panel( 'hba_panel', [
        'title'    => __( 'Theme Settings', 'healthbeyondage' ),
        'priority' => 10,
    ] );

    /* ============================
       SECTION: Brand Colors
    ============================ */
    $wp_customize->add_section( 'hba_colors', [
        'title'    => __( '🎨 Brand Colors', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 10,
    ] );

    foreach ( [
        'hba_primary_color'   => [ 'Primary Green',   '#1A7A3C' ],
        'hba_secondary_color' => [ 'Secondary Green',  '#22963F' ],
        'hba_body_bg'         => [ 'Body Background',  '#F5F8F6' ],
        'hba_text_color'      => [ 'Body Text Color',  '#111F16' ],
        'hba_link_color'      => [ 'Link Color',       '#1A7A3C' ],
        'hba_link_hover_color'=> [ 'Link Hover Color', '#22963F' ],
        'hba_button_color'    => [ 'Button Color',     '#22963F' ],
        'hba_button_text'     => [ 'Button Text Color','#ffffff' ],
        'hba_button_hov_bg'   => [ 'Button Hover BG',  '#1B6B3A' ],
        'hba_button_hov_text' => [ 'Button Hover Text','#ffffff' ],
        'hba_nav_color'       => [ 'Nav Link Color',   '#4a5568' ],
        'hba_nav_hov_color'   => [ 'Nav Hover Color',  '#1A7A3C' ],
        'hba_header_bg'       => [ 'Header Background', '#ffffff' ],
        'hba_footer_bg'       => [ 'Footer Background', '#111F16' ],
    ] as $key => $args ) {
        $wp_customize->add_setting( $key, [ 'default' => $args[1], 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, [ 'label' => $args[0], 'section' => 'hba_colors' ] ) );
    }

    /* ============================
       SECTION: Typography
    ============================ */
    $wp_customize->add_section( 'hba_typography', [
        'title'    => __( '✏️ Typography', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 20,
    ] );

    $font_choices = [
        "'DM Sans', system-ui, sans-serif"       => 'DM Sans (Default)',
        "'Inter', system-ui, sans-serif"         => 'Inter',
        "'Roboto', system-ui, sans-serif"        => 'Roboto',
        "'Open Sans', system-ui, sans-serif"     => 'Open Sans',
        "'Lato', system-ui, sans-serif"          => 'Lato',
        "'Montserrat', system-ui, sans-serif"    => 'Montserrat',
        "'Poppins', system-ui, sans-serif"       => 'Poppins',
        "'Nunito', system-ui, sans-serif"        => 'Nunito',
        "'Raleway', system-ui, sans-serif"       => 'Raleway',
        "'Ubuntu', system-ui, sans-serif"        => 'Ubuntu',
        "'Work Sans', system-ui, sans-serif"     => 'Work Sans',
        "'Rubik', system-ui, sans-serif"         => 'Rubik',
        "'Quicksand', system-ui, sans-serif"     => 'Quicksand',
        "'Oswald', system-ui, sans-serif"        => 'Oswald',
        "'Karla', system-ui, sans-serif"         => 'Karla',
        "'Fira Sans', system-ui, sans-serif"     => 'Fira Sans',
        "'Manrope', system-ui, sans-serif"       => 'Manrope',
        "'Outfit', system-ui, sans-serif"        => 'Outfit',
    ];
    $heading_choices = [
        "'Merriweather', Georgia, serif"         => 'Merriweather (Default)',
        "'Playfair Display', Georgia, serif"     => 'Playfair Display',
        "'Lora', Georgia, serif"                 => 'Lora',
        "'PT Serif', Georgia, serif"             => 'PT Serif',
        "'Noto Serif', Georgia, serif"           => 'Noto Serif',
        "'Crimson Text', Georgia, serif"         => 'Crimson Text',
        "'Libre Baskerville', Georgia, serif"    => 'Libre Baskerville',
        "'EB Garamond', Georgia, serif"          => 'EB Garamond',
        "'Bitter', Georgia, serif"               => 'Bitter',
        "'Cormorant Garamond', Georgia, serif"   => 'Cormorant Garamond',
        "'Spectral', Georgia, serif"             => 'Spectral',
        "'Fraunces', Georgia, serif"             => 'Fraunces',
        "'Arvo', Georgia, serif"                 => 'Arvo',
        // Also allow some sans-serifs for headings
        "'Montserrat', system-ui, sans-serif"    => 'Montserrat',
        "'Poppins', system-ui, sans-serif"       => 'Poppins',
        "'Oswald', system-ui, sans-serif"        => 'Oswald',
    ];

    $wp_customize->add_setting( 'hba_body_font',      [ 'default' => "'DM Sans', system-ui, sans-serif", 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_body_font',      [ 'label' => 'Body Font',         'section' => 'hba_typography', 'type' => 'select', 'choices' => $font_choices ] );

    $wp_customize->add_setting( 'hba_heading_font',   [ 'default' => "'Merriweather', Georgia, serif", 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_heading_font',   [ 'label' => 'Heading Font',      'section' => 'hba_typography', 'type' => 'select', 'choices' => $heading_choices ] );

    $wp_customize->add_setting( 'hba_base_font_size', [ 'default' => '15', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_base_font_size', [ 'label' => 'Base Font Size (px)', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 12, 'max' => 22] ] );

    $wp_customize->add_setting( 'hba_h1_size', [ 'default' => 2.5, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_h1_size', [ 'label' => 'H1 Base Size (rem)', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 5, 'step' => 0.1] ] );
    
    $wp_customize->add_setting( 'hba_h2_size', [ 'default' => 2.0, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_h2_size', [ 'label' => 'H2 Base Size (rem)', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 4, 'step' => 0.1] ] );
    
    $wp_customize->add_setting( 'hba_h3_size', [ 'default' => 1.5, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_h3_size', [ 'label' => 'H3 Base Size (rem)', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 0.8, 'max' => 3, 'step' => 0.1] ] );

    $wp_customize->add_setting( 'hba_h4_size', [ 'default' => 1.25, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_h4_size', [ 'label' => 'H4 Base Size (rem)', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 0.8, 'max' => 2.5, 'step' => 0.05] ] );

    $wp_customize->add_setting( 'hba_h5_size', [ 'default' => 1.1, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_h5_size', [ 'label' => 'H5 Base Size (rem)', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 0.7, 'max' => 2.0, 'step' => 0.05] ] );

    $wp_customize->add_setting( 'hba_h6_size', [ 'default' => 1.0, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_h6_size', [ 'label' => 'H6 Base Size (rem)', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 0.7, 'max' => 1.8, 'step' => 0.05] ] );

    $wp_customize->add_setting( 'hba_body_line_height', [ 'default' => 1.7, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_body_line_height', [ 'label' => 'Body Line Height', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 1.0, 'max' => 2.5, 'step' => 0.1] ] );

    $wp_customize->add_setting( 'hba_p_margin_bottom', [ 'default' => 1.5, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_p_margin_bottom', [ 'label' => 'Paragraph Margin Bottom (rem)', 'section' => 'hba_typography', 'type' => 'number', 'input_attrs' => ['min' => 0, 'max' => 4, 'step' => 0.1] ] );

    /* ============================
       SECTION: Header
    ============================ */
    $wp_customize->add_section( 'hba_header', [
        'title'    => __( '🔝 Header Settings', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 30,
    ] );

    $wp_customize->add_setting( 'hba_logo', [ 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hba_logo', [ 'label' => 'Site Logo', 'section' => 'hba_header' ] ) );

    $wp_customize->add_setting( 'hba_logo_width', [ 'default' => 200, 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_logo_width', [ 'label' => 'Logo Max Width (px)', 'section' => 'hba_header', 'type' => 'number', 'input_attrs' => ['min' => 50, 'max' => 600, 'step' => 5] ] );

    $wp_customize->add_setting( 'hba_nav_font_size', [ 'default' => 1.0, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nav_font_size', [ 'label' => 'Nav Menu Font Size (rem)', 'section' => 'hba_header', 'type' => 'number', 'input_attrs' => ['min' => 0.7, 'max' => 1.5, 'step' => 0.05] ] );

    $wp_customize->add_setting( 'hba_sticky_header', [ 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_sticky_header', [ 'label' => 'Enable Sticky Header', 'section' => 'hba_header', 'type' => 'checkbox' ] );

    $wp_customize->add_setting( 'hba_show_ann_bar',  [ 'default' => true, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_show_ann_bar',  [ 'label' => 'Show Announcement Bar', 'section' => 'hba_header', 'type' => 'checkbox' ] );

    $wp_customize->add_setting( 'hba_ann_bar_text',  [ 'default' => 'All content is <strong>medically reviewed</strong> by qualified health professionals — updated regularly for accuracy.', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_ann_bar_text',  [ 'label' => 'Announcement Bar Text', 'section' => 'hba_header', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_nav_cta_text',  [ 'default' => 'Newsletter', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nav_cta_text',  [ 'label' => 'Nav CTA Button Text', 'section' => 'hba_header', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_nav_cta_url',   [ 'default' => '#newsletter', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nav_cta_url',   [ 'label' => 'Nav CTA Button URL', 'section' => 'hba_header', 'type' => 'url' ] );

    /* ============================
       SECTION: Homepage — Hero
    ============================ */
    $wp_customize->add_section( 'hba_homepage_hero', [
        'title'    => __( '🦸 Homepage — Hero', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 40,
    ] );

    foreach ( [
        'hba_hero_eyebrow'   => [ 'Eyebrow Text',   'Evidence-Based Wellness',   'text' ],
        'hba_hero_title'     => [ 'Hero Title',      'Trusted Health Guidance For A Better Life', 'textarea' ],
        'hba_hero_subtitle'  => [ 'Hero Subtitle',   'Practical, Evidence-Based Wellness Advice Designed To Help You Live Healthier, Feel Stronger, And Age Confidently Every Day.', 'textarea' ],
        'hba_hero_btn1_text' => [ 'Button 1 Text',   'Explore Health Topics',  'text' ],
        'hba_hero_btn1_url'  => [ 'Button 1 URL',    '/topics',  'url' ],
        'hba_hero_btn2_text' => [ 'Button 2 Text',   'Latest Articles', 'text' ],
        'hba_hero_btn2_url'  => [ 'Button 2 URL',    '/blog', 'url' ],
        'hba_hero_trust1'    => [ 'Trust Badge 1',   'Medically Reviewed Content', 'text' ],
        'hba_hero_trust2'    => [ 'Trust Badge 2',   'Evidence-Based Research', 'text' ],
        'hba_hero_trust3'    => [ 'Trust Badge 3',   'Regularly Updated', 'text' ],
    ] as $key => $args ) {
        $wp_customize->add_setting( $key, [ 'default' => $args[1], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( $key, [ 'label' => $args[0], 'section' => 'hba_homepage_hero', 'type' => $args[2] ] );
    }

    // Hero colors & sizes
    $wp_customize->add_setting( 'hba_hero_bg',         [ 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hba_hero_bg',        [ 'label' => 'Hero Background Color', 'section' => 'hba_homepage_hero' ] ) );

    $wp_customize->add_setting( 'hba_hero_title_color', [ 'default' => '#111F16', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hba_hero_title_color', [ 'label' => 'Hero Title Color', 'section' => 'hba_homepage_hero' ] ) );

    $wp_customize->add_setting( 'hba_hero_sub_color',   [ 'default' => '#4a5568', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hba_hero_sub_color',   [ 'label' => 'Hero Subtitle Color', 'section' => 'hba_homepage_hero' ] ) );

    $wp_customize->add_setting( 'hba_hero_title_size',  [ 'default' => 2.4, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_hero_title_size',  [ 'label' => 'Title Font Size (rem)', 'section' => 'hba_homepage_hero', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 6, 'step' => 0.1] ] );

    $wp_customize->add_setting( 'hba_hero_font',        [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_hero_font',        [ 'label' => 'Hero Title Font', 'section' => 'hba_homepage_hero', 'type' => 'select', 'choices' => array_merge(['' => 'Use Default Heading Font'], $heading_choices) ] );

    $wp_customize->add_setting( 'hba_hero_title_weight',[ 'default' => '800', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_hero_title_weight',[ 'label' => 'Title Font Weight', 'section' => 'hba_homepage_hero', 'type' => 'select', 'choices' => [ '300' => 'Light', '400' => 'Normal', '500' => 'Medium', '600' => 'Semi-Bold', '700' => 'Bold', '800' => 'Extra Bold', '900' => 'Black' ] ] );

    $wp_customize->add_setting( 'hba_hero_text_align',  [ 'default' => 'center', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_hero_text_align',  [ 'label' => 'Hero Text Alignment', 'section' => 'hba_homepage_hero', 'type' => 'select', 'choices' => [ 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ] ] );

    $wp_customize->add_setting( 'hba_hero_padding',     [ 'default' => 2.0, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_hero_padding',     [ 'label' => 'Hero Vertical Padding (rem)', 'section' => 'hba_homepage_hero', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 12, 'step' => 0.5] ] );

    $wp_customize->add_setting( 'hba_hero_overlay',     [ 'default' => 0, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_hero_overlay',     [ 'label' => 'Hero Background Overlay Opacity (0-1)', 'section' => 'hba_homepage_hero', 'type' => 'number', 'input_attrs' => ['min' => 0, 'max' => 1, 'step' => 0.05] ] );

    $wp_customize->add_setting( 'hba_hero_text_shadow', [ 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_hero_text_shadow', [ 'label' => 'Enable Text Shadow on Hero', 'section' => 'hba_homepage_hero', 'type' => 'checkbox' ] );

    $wp_customize->add_setting( 'hba_hero_sub_size',    [ 'default' => 1.15, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_hero_sub_size',    [ 'label' => 'Subtitle Font Size (rem)', 'section' => 'hba_homepage_hero', 'type' => 'number', 'input_attrs' => ['min' => 0.5, 'max' => 3, 'step' => 0.05] ] );

    $wp_customize->add_setting( 'hba_hero_image',       [ 'default' => 'http://srv1740311.hstgr.cloud/wp-content/uploads/2026/06/Image-1-d2fab5ef.png', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hba_hero_image', [ 'label' => 'Hero Image', 'section' => 'hba_homepage_hero' ] ) );

    $wp_customize->add_setting( 'hba_expert_photo',     [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hba_expert_photo', [ 'label' => 'Reviewer Photo (Small Circle)', 'section' => 'hba_homepage_hero' ] ) );

    /* ============================
       SECTION: Editorial Policy Page
    ============================ */
    $wp_customize->add_section( 'hba_editorial_policy_section', [
        'title'    => __( '📰 Editorial Policy Page', 'healthbeyondage' ),
        'panel'    => 'hba_theme_options',
        'priority' => 36,
    ] );

    $wp_customize->add_setting( 'hba_ep_hero_eyebrow', [ 'default' => '⚕ Editorial Standards', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hba_ep_hero_eyebrow', [ 'label' => 'Hero Eyebrow', 'section' => 'hba_editorial_policy_section', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_ep_hero_title', [ 'default' => 'Our Editorial Policy', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hba_ep_hero_title', [ 'label' => 'Hero Title', 'section' => 'hba_editorial_policy_section', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_ep_hero_lede', [ 'default' => 'Health Beyond Age exists to help people make informed decisions about their health. That only works if you can trust what you read here. This page explains exactly how our content gets made — from research to fact-checking to medical review — so you always know what\'s behind the advice.', 'sanitize_callback' => 'wp_kses_post' ] );
    $wp_customize->add_control( 'hba_ep_hero_lede', [ 'label' => 'Hero Description', 'section' => 'hba_editorial_policy_section', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_ep_last_updated', [ 'default' => '📅 Last updated: June 2026', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hba_ep_last_updated', [ 'label' => 'Last Updated Text', 'section' => 'hba_editorial_policy_section', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_ep_review_freq', [ 'default' => '🔄 Reviewed annually, or sooner if guidelines change', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'hba_ep_review_freq', [ 'label' => 'Review Frequency', 'section' => 'hba_editorial_policy_section', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_ep_reviewer_id', [ 'default' => '', 'sanitize_callback' => 'absint' ] );
    $wp_customize->add_control( 'hba_ep_reviewer_id', [ 'label' => 'Sidebar Reviewer (Enter Reviewer Post ID)', 'section' => 'hba_editorial_policy_section', 'type' => 'number' ] );


    /* ============================
       SECTION: Homepage — Featured Articles
    ============================ */
    $wp_customize->add_section( 'hba_sect_featured', [
        'title'    => __( '📰 Homepage — Featured Articles', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 50,
    ] );

    $wp_customize->add_setting( 'hba_feat_title',     [ 'default' => 'Featured Articles',    'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_feat_title',     [ 'label' => 'Section Title',          'section' => 'hba_sect_featured', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_feat_link_text', [ 'default' => 'View all trending →',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_feat_link_text', [ 'label' => 'Link Text',              'section' => 'hba_sect_featured', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_feat_link_url',  [ 'default' => '/trending',            'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_feat_link_url',  [ 'label' => 'Link URL',               'section' => 'hba_sect_featured', 'type' => 'url' ] );

    /* ============================
       SECTION: Homepage — Explore Topics
    ============================ */
    $wp_customize->add_section( 'hba_sect_topics', [
        'title'    => __( '🏥 Homepage — Explore Topics', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 60,
    ] );

    $wp_customize->add_setting( 'hba_topics_title',     [ 'default' => 'Explore by Health Topic', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_topics_title',     [ 'label' => 'Section Title',             'section' => 'hba_sect_topics', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_topics_link_text', [ 'default' => 'View all topics →',       'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_topics_link_text', [ 'label' => 'Link Text',                 'section' => 'hba_sect_topics', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_topics_link_url',  [ 'default' => '/topics',                 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_topics_link_url',  [ 'label' => 'Link URL',                  'section' => 'hba_sect_topics', 'type' => 'url' ] );

    /* ============================
       SECTION: Homepage — Latest Articles
    ============================ */
    $wp_customize->add_section( 'hba_sect_latest', [
        'title'    => __( '📄 Homepage — Latest Articles', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 70,
    ] );

    $wp_customize->add_setting( 'hba_latest_title',          [ 'default' => 'Latest Articles',   'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_latest_title',          [ 'label' => 'Section Title',       'section' => 'hba_sect_latest', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_latest_link_text',      [ 'default' => 'View all articles →', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_latest_link_text',      [ 'label' => 'Link Text',           'section' => 'hba_sect_latest', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_latest_link_url',       [ 'default' => '/blog',             'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_latest_link_url',       [ 'label' => 'Link URL',            'section' => 'hba_sect_latest', 'type' => 'url' ] );

    $wp_customize->add_setting( 'hba_latest_articles_count', [ 'default' => 6, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_latest_articles_count', [ 'label' => 'Number of Articles to Show', 'section' => 'hba_sect_latest', 'type' => 'number', 'input_attrs' => ['min' => 3, 'max' => 12] ] );

    /* ============================
       SECTION: Homepage — Expert Quote
    ============================ */
    $wp_customize->add_section( 'hba_sect_expert', [
        'title'    => __( '👩‍⚕️ Homepage — Expert Quote', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 80,
    ] );

    $wp_customize->add_setting( 'hba_expert_name',     [ 'default' => 'Dr. Sarah Matheson',    'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_name',     [ 'label' => 'Expert Name',             'section' => 'hba_sect_expert', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_expert_role',     [ 'default' => 'Lead Medical Reviewer', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_role',     [ 'label' => 'Expert Role/Title',       'section' => 'hba_sect_expert', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_expert_quote',    [ 'default' => '"Good health isn\'t about perfection — it\'s about <strong>consistent, informed choices.</strong> Every article on this site is reviewed to give you the knowledge to make those choices with confidence."', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_quote',    [ 'label' => 'Expert Quote',            'section' => 'hba_sect_expert', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_expert_btn_text', [ 'default' => 'Meet Our Team',         'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_btn_text', [ 'label' => 'Button Text',             'section' => 'hba_sect_expert', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_expert_btn_url',  [ 'default' => '/team',                 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_btn_url',  [ 'label' => 'Button URL',              'section' => 'hba_sect_expert', 'type' => 'url' ] );

    /* ============================
       SECTION: Homepage — Newsletter
    ============================ */
    $wp_customize->add_section( 'hba_newsletter', [
        'title'    => __( '📧 Homepage — Newsletter', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 90,
    ] );

    $wp_customize->add_setting( 'hba_nl_chip',          [ 'default' => '✦ Weekly digest',     'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nl_chip',          [ 'label' => 'Chip Label (top badge)', 'section' => 'hba_newsletter', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_newsletter_title', [ 'default' => 'Stay Ahead of<br/>Your Health', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_newsletter_title', [ 'label' => 'Section Title',          'section' => 'hba_newsletter', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_newsletter_desc',  [ 'default' => 'Expert-curated wellness insights, the latest research, and practical tips — delivered every Friday. No noise, no spam.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_newsletter_desc',  [ 'label' => 'Description',            'section' => 'hba_newsletter', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_nl_placeholder',   [ 'default' => 'your@email.com',       'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nl_placeholder',   [ 'label' => 'Email Input Placeholder', 'section' => 'hba_newsletter', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_nl_btn',           [ 'default' => 'Subscribe Free',       'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nl_btn',           [ 'label' => 'Button Text',            'section' => 'hba_newsletter', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_nl_perk_1',        [ 'default' => 'Weekly health insights',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nl_perk_1',        [ 'label' => 'Perk 1 Text',            'section' => 'hba_newsletter', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_nl_perk_2',        [ 'default' => 'Evidence-based research', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nl_perk_2',        [ 'label' => 'Perk 2 Text',            'section' => 'hba_newsletter', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_nl_perk_3',        [ 'default' => 'Unsubscribe anytime',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_nl_perk_3',        [ 'label' => 'Perk 3 Text',            'section' => 'hba_newsletter', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_nl_bg',            [ 'default' => '#1A7A3C', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hba_nl_bg', [ 'label' => 'Newsletter Background Color', 'section' => 'hba_newsletter' ] ) );

    /* ============================
       SECTION: Homepage — Trust Metrics Bar
    ============================ */
    $wp_customize->add_section( 'hba_sect_metrics', [
        'title'    => __( '📊 Homepage — Trust Metrics', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 95,
    ] );

    foreach ( [
        0 => [ '150+',      'Expert Articles' ],
        1 => [ '5',         'Health Categories' ],
        2 => [ '100%',      'Medically Reviewed' ],
        3 => [ 'Since 2021','Publishing Since' ],
    ] as $i => $d ) {
        $wp_customize->add_setting( "hba_metric_{$i}_num", [ 'default' => $d[0], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_metric_{$i}_num", [ 'label' => "Metric " . ($i+1) . " — Number", 'section' => 'hba_sect_metrics', 'type' => 'text' ] );
        $wp_customize->add_setting( "hba_metric_{$i}_lbl", [ 'default' => $d[1], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_metric_{$i}_lbl", [ 'label' => "Metric " . ($i+1) . " — Label",  'section' => 'hba_sect_metrics', 'type' => 'text' ] );
    }

    /* ============================
       SECTION: Footer
    ============================ */
    $wp_customize->add_section( 'hba_footer', [
        'title'    => __( '🦶 Footer Settings', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 100,
    ] );

    $wp_customize->add_setting( 'hba_footer_about',     [ 'default' => 'Evidence-based health information to help you make informed choices and live a longer, healthier life.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_footer_about',     [ 'label' => 'Footer About Text', 'section' => 'hba_footer', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_footer_col1_title',[ 'default' => 'Categories', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_footer_col1_title',[ 'label' => 'Column 1 Title', 'section' => 'hba_footer', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_footer_col2_title',[ 'default' => 'Company', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_footer_col2_title',[ 'label' => 'Column 2 Title', 'section' => 'hba_footer', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_footer_col3_title',[ 'default' => 'Legal', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_footer_col3_title',[ 'label' => 'Column 3 Title', 'section' => 'hba_footer', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_footer_copyright', [ 'default' => '© ' . date('Y') . ' Health Beyond Age. All rights reserved.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_footer_copyright', [ 'label' => 'Copyright Text',   'section' => 'hba_footer', 'type' => 'text' ] );

    /* ============================
       SECTION: Social Links
    ============================ */
    $wp_customize->add_section( 'hba_social', [
        'title'    => __( '🔗 Social Links', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 110,
    ] );

    foreach ( [ 'facebook' => 'Facebook URL', 'twitter' => 'X / Twitter URL', 'instagram' => 'Instagram URL', 'youtube' => 'YouTube URL', 'pinterest' => 'Pinterest URL' ] as $key => $label ) {
        $wp_customize->add_setting( "hba_social_{$key}", [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
        $wp_customize->add_control( "hba_social_{$key}", [ 'label' => $label, 'section' => 'hba_social', 'type' => 'url' ] );
    }

    /* ============================
       SECTION: Single Post Settings
    ============================ */
    $wp_customize->add_section( 'hba_single_post', [
        'title'    => __( '📝 Single Post Settings', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 120,
    ] );

    foreach ( [
        'hba_sp_show_medrev' => 'Show Medically Reviewed Bar',
        'hba_sp_show_byline' => 'Show Author Byline',
        'hba_sp_show_tags'   => 'Show Article Tags',
        'hba_sp_show_share'  => 'Show Share Bar',
    ] as $id => $label ) {
        $wp_customize->add_setting( $id, [ 'default' => true, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'refresh' ] );
        $wp_customize->add_control( $id, [ 'label' => $label, 'section' => 'hba_single_post', 'type' => 'checkbox' ] );
    }

    $wp_customize->add_setting( 'hba_sp_title_size',     [ 'default' => 2.2,  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_sp_title_size',     [ 'label' => 'Article Title Font Size (rem)', 'section' => 'hba_single_post', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 5, 'step' => 0.1] ] );

    $wp_customize->add_setting( 'hba_sp_content_size',   [ 'default' => 0.92, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_sp_content_size',   [ 'label' => 'Article Body Font Size (rem)', 'section' => 'hba_single_post', 'type' => 'number', 'input_attrs' => ['min' => 0.7, 'max' => 1.5, 'step' => 0.05] ] );

    $wp_customize->add_setting( 'hba_sp_kt_bg',          [ 'default' => '#1B6B3A', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hba_sp_kt_bg',       [ 'label' => 'Key Takeaways Background', 'section' => 'hba_single_post' ] ) );

    $wp_customize->add_setting( 'hba_sp_callout_border', [ 'default' => '#27903F', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hba_sp_callout_border', [ 'label' => 'Callout Accent Border', 'section' => 'hba_single_post' ] ) );

    /* ============================
       SECTION: Layout Settings
    ============================ */
    $wp_customize->add_section( 'hba_layout', [
        'title'    => __( '⚙️ Layout Settings', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 130,
    ] );

    $wp_customize->add_setting( 'hba_show_sidebar_single', [ 'default' => true, 'sanitize_callback' => 'rest_sanitize_boolean' ] );
    $wp_customize->add_control( 'hba_show_sidebar_single', [ 'label' => 'Show Sidebar on Single Posts', 'section' => 'hba_layout', 'type' => 'checkbox' ] );

    $wp_customize->add_setting( 'hba_articles_per_page',   [ 'default' => 9,   'sanitize_callback' => 'absint' ] );
    $wp_customize->add_control( 'hba_articles_per_page',   [ 'label' => 'Articles Per Page',           'section' => 'hba_layout', 'type' => 'number', 'input_attrs' => ['min' => 3, 'max' => 30] ] );

    $wp_customize->add_setting( 'hba_excerpt_length',      [ 'default' => 20,  'sanitize_callback' => 'absint' ] );
    $wp_customize->add_control( 'hba_excerpt_length',      [ 'label' => 'Excerpt Word Length',         'section' => 'hba_layout', 'type' => 'number', 'input_attrs' => ['min' => 5, 'max' => 100] ] );

    $wp_customize->add_setting( 'hba_read_more_text',      [ 'default' => 'Read more', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_read_more_text',      [ 'label' => 'Read More Button Text',       'section' => 'hba_layout', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_scroll_to_top',       [ 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_scroll_to_top',       [ 'label' => 'Enable Scroll to Top Button', 'section' => 'hba_layout', 'type' => 'checkbox' ] );

    $wp_customize->add_setting( 'hba_show_breadcrumbs',    [ 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'refresh' ] );
    $wp_customize->add_control( 'hba_show_breadcrumbs',    [ 'label' => 'Show Breadcrumbs on Single Posts', 'section' => 'hba_layout', 'type' => 'checkbox' ] );

    $wp_customize->add_setting( 'hba_section_padding',     [ 'default' => 3.0, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_section_padding',     [ 'label' => 'Section Vertical Padding (rem)', 'section' => 'hba_layout', 'type' => 'number', 'input_attrs' => ['min' => 1, 'max' => 8, 'step' => 0.5] ] );

    $wp_customize->add_setting( 'hba_max_width',           [ 'default' => 1220, 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_max_width',           [ 'label' => 'Container Max Width (px)',    'section' => 'hba_layout', 'type' => 'number', 'input_attrs' => ['min' => 800, 'max' => 1600, 'step' => 10] ] );

    $wp_customize->add_setting( 'hba_section_margin',      [ 'default' => 0, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_section_margin',      [ 'label' => 'Section Vertical Margin (rem)', 'section' => 'hba_layout', 'type' => 'number', 'input_attrs' => ['min' => 0, 'max' => 8, 'step' => 0.5] ] );

    $wp_customize->add_setting( 'hba_card_padding',        [ 'default' => 1.5, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_card_padding',        [ 'label' => 'Article Card Padding (rem)',    'section' => 'hba_layout', 'type' => 'number', 'input_attrs' => ['min' => 0, 'max' => 4, 'step' => 0.1] ] );

    $wp_customize->add_setting( 'hba_card_title_size',     [ 'default' => 1.3, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_card_title_size',     [ 'label' => 'Article Card Title Size (rem)', 'section' => 'hba_layout', 'type' => 'number', 'input_attrs' => ['min' => 0.8, 'max' => 3, 'step' => 0.05] ] );

    /* ============================
       SECTION: Borders & Shapes
    ============================ */
    $wp_customize->add_section( 'hba_borders', [
        'title'    => __( '🔲 Borders & Shapes', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 135,
    ] );

    $wp_customize->add_setting( 'hba_border_radius',       [ 'default' => 12, 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_border_radius',       [ 'label' => 'Global Border Radius (px)',      'section' => 'hba_borders', 'type' => 'number', 'input_attrs' => ['min' => 0, 'max' => 40, 'step' => 1] ] );

    $wp_customize->add_setting( 'hba_btn_border_radius',   [ 'default' => 8, 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_btn_border_radius',   [ 'label' => 'Button Border Radius (px)',      'section' => 'hba_borders', 'type' => 'number', 'input_attrs' => ['min' => 0, 'max' => 40, 'step' => 1] ] );

    $wp_customize->add_setting( 'hba_img_border_radius',   [ 'default' => 12, 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_img_border_radius',   [ 'label' => 'Image Border Radius (px)',       'section' => 'hba_borders', 'type' => 'number', 'input_attrs' => ['min' => 0, 'max' => 40, 'step' => 1] ] );

    $wp_customize->add_setting( 'hba_border_thickness',    [ 'default' => 1, 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_border_thickness',    [ 'label' => 'Global Border Thickness (px)',   'section' => 'hba_borders', 'type' => 'number', 'input_attrs' => ['min' => 0, 'max' => 5, 'step' => 1] ] );

    /* ============================
       SECTION: Page — About Us
    ============================ */
    $wp_customize->add_section( 'hba_page_about', [
        'title'    => __( '📄 Page — About Us', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 110,
    ] );

    // Hero
    $wp_customize->add_setting( 'hba_about_hero_tag', [ 'default' => '✦ Our Story', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_hero_tag', [ 'label' => 'Hero Tag', 'section' => 'hba_page_about', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_about_hero_title', [ 'default' => 'Health Information You Can<br/><em>Actually Trust</em>', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_hero_title', [ 'label' => 'Hero Title', 'section' => 'hba_page_about', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_about_hero_desc', [ 'default' => 'Founded in 2021, Health Beyond Age exists to cut through the noise of the wellness industry and deliver evidence-based health guidance that genuinely helps people live longer, healthier lives.', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_hero_desc', [ 'label' => 'Hero Description', 'section' => 'hba_page_about', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_about_btn1_text', [ 'default' => 'Meet Our Team', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_btn1_text', [ 'label' => 'Button 1 Text', 'section' => 'hba_page_about', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_about_btn1_url', [ 'default' => '/team', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_btn1_url', [ 'label' => 'Button 1 URL', 'section' => 'hba_page_about', 'type' => 'url' ] );

    $wp_customize->add_setting( 'hba_about_btn2_text', [ 'default' => 'Read Our Articles', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_btn2_text', [ 'label' => 'Button 2 Text', 'section' => 'hba_page_about', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_about_btn2_url', [ 'default' => '/blog', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_btn2_url', [ 'label' => 'Button 2 URL', 'section' => 'hba_page_about', 'type' => 'url' ] );

    // Mission
    $wp_customize->add_setting( 'hba_about_mission_label', [ 'default' => 'Our Mission', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_mission_label', [ 'label' => 'Mission Label', 'section' => 'hba_page_about', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_about_mission_title', [ 'default' => 'Empowering <strong>Informed Decisions</strong> at Every Age', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_mission_title', [ 'label' => 'Mission Title', 'section' => 'hba_page_about', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_about_mission_text', [ 'default' => '<p>We believe that access to clear, accurate, and up-to-date health information is a fundamental need — not a privilege. That\'s why every article we publish is written by credentialed health professionals and reviewed by medical experts before it reaches you.</p><p>Our editorial team of doctors, registered dietitians, certified trainers, and mental health professionals ensures that what you read here reflects the current scientific consensus — not trends, not sponsored talking points.</p>', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_mission_text', [ 'label' => 'Mission Text (HTML allowed)', 'section' => 'hba_page_about', 'type' => 'textarea' ] );

    // Mission Pillars
    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting( "hba_about_p{$i}_icon", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_about_p{$i}_icon", [ 'label' => "Pillar {$i} Icon (Emoji)", 'section' => 'hba_page_about', 'type' => 'text' ] );
        $wp_customize->add_setting( "hba_about_p{$i}_title", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_about_p{$i}_title", [ 'label' => "Pillar {$i} Title", 'section' => 'hba_page_about', 'type' => 'text' ] );
        $wp_customize->add_setting( "hba_about_p{$i}_desc", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_about_p{$i}_desc", [ 'label' => "Pillar {$i} Desc", 'section' => 'hba_page_about', 'type' => 'textarea' ] );
    }

    // Core Values
    $wp_customize->add_setting( 'hba_about_val_label', [ 'default' => 'What We Stand For', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_val_label', [ 'label' => 'Values Label', 'section' => 'hba_page_about', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_about_val_title', [ 'default' => 'Our Core Values', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_val_title', [ 'label' => 'Values Title', 'section' => 'hba_page_about', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_about_val_desc', [ 'default' => 'The principles that guide every article, every decision, and every relationship we build with our readers.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_about_val_desc', [ 'label' => 'Values Description', 'section' => 'hba_page_about', 'type' => 'textarea' ] );

    for ( $i = 1; $i <= 6; $i++ ) {
        $wp_customize->add_setting( "hba_about_v{$i}_icon", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_about_v{$i}_icon", [ 'label' => "Value {$i} Icon (Emoji)", 'section' => 'hba_page_about', 'type' => 'text' ] );
        $wp_customize->add_setting( "hba_about_v{$i}_title", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_about_v{$i}_title", [ 'label' => "Value {$i} Title", 'section' => 'hba_page_about', 'type' => 'text' ] );
        $wp_customize->add_setting( "hba_about_v{$i}_desc", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_about_v{$i}_desc", [ 'label' => "Value {$i} Desc", 'section' => 'hba_page_about', 'type' => 'textarea' ] );
    }

    /* ============================
       SECTION: Page — Contact Us
    ============================ */
    $wp_customize->add_section( 'hba_page_contact', [
        'title'    => __( '📞 Page — Contact Us', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 111,
    ] );

    // Hero
    $wp_customize->add_setting( 'hba_contact_eyebrow', [ 'default' => 'Get In Touch', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_contact_eyebrow', [ 'label' => 'Hero Eyebrow', 'section' => 'hba_page_contact', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_contact_title', [ 'default' => 'We\'d Love to Hear From You', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_contact_title', [ 'label' => 'Hero Title', 'section' => 'hba_page_contact', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_contact_desc', [ 'default' => 'Have a question about our content, a correction to report, or a collaboration idea? Our team is here and ready to help.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_contact_desc', [ 'label' => 'Hero Description', 'section' => 'hba_page_contact', 'type' => 'textarea' ] );

    // Cards
    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( "hba_contact_c{$i}_icon", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_contact_c{$i}_icon", [ 'label' => "Card {$i} Icon (Emoji)", 'section' => 'hba_page_contact', 'type' => 'text' ] );
        $wp_customize->add_setting( "hba_contact_c{$i}_title", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_contact_c{$i}_title", [ 'label' => "Card {$i} Title", 'section' => 'hba_page_contact', 'type' => 'text' ] );
        $wp_customize->add_setting( "hba_contact_c{$i}_desc", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_contact_c{$i}_desc", [ 'label' => "Card {$i} Desc", 'section' => 'hba_page_contact', 'type' => 'textarea' ] );
        $wp_customize->add_setting( "hba_contact_c{$i}_email", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
        $wp_customize->add_control( "hba_contact_c{$i}_email", [ 'label' => "Card {$i} Email", 'section' => 'hba_page_contact', 'type' => 'text' ] );
    }

    $wp_customize->add_setting( 'hba_contact_time', [ 'default' => '⏱ We aim to respond to all enquiries within <strong>2–3 business days</strong>.', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_contact_time', [ 'label' => 'Response Time Notice', 'section' => 'hba_page_contact', 'type' => 'textarea' ] );

    // Sidebar
    $wp_customize->add_setting( 'hba_contact_notice_title', [ 'default' => 'Important Notice', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_contact_notice_title', [ 'label' => 'Sidebar Notice Title', 'section' => 'hba_page_contact', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_contact_notice_desc', [ 'default' => 'Health Beyond Age does not provide personalised medical advice. For health concerns, please consult a qualified healthcare professional.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_contact_notice_desc', [ 'label' => 'Sidebar Notice Desc', 'section' => 'hba_page_contact', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_contact_notice_link', [ 'default' => 'Read our Medical Disclaimer →', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_contact_notice_link', [ 'label' => 'Sidebar Notice Link Text', 'section' => 'hba_page_contact', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_contact_notice_url', [ 'default' => '/medical-disclaimer', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_contact_notice_url', [ 'label' => 'Sidebar Notice Link URL', 'section' => 'hba_page_contact', 'type' => 'url' ] );

    /* ============================
       SECTION: Page — Team
    ============================ */
    $wp_customize->add_section( 'hba_page_team', [
        'title'    => __( '👥 Page — Team', 'healthbeyondage' ),
        'panel'    => 'hba_panel',
        'priority' => 112,
    ] );

    $wp_customize->add_setting( 'hba_team_label', [ 'default' => 'Our Experts', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_team_label', [ 'label' => 'Hero Label', 'section' => 'hba_page_team', 'type' => 'text' ] );

    $wp_customize->add_setting( 'hba_team_title', [ 'default' => 'Meet the Team Behind<br/>Health Beyond Age', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_team_title', [ 'label' => 'Hero Title', 'section' => 'hba_page_team', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_team_desc', [ 'default' => 'Every article on this site is shaped by credentialed health professionals &mdash; doctors, dietitians, trainers, and researchers committed to accuracy and your wellbeing.', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_team_desc', [ 'label' => 'Hero Description', 'section' => 'hba_page_team', 'type' => 'textarea' ] );

    $wp_customize->add_setting( 'hba_team_grid_title', [ 'default' => 'Medical Reviewers & Editorial Team', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_team_grid_title', [ 'label' => 'Grid Title', 'section' => 'hba_page_team', 'type' => 'text' ] );

    /* ============================
       SELECTIVE REFRESH PARTIALS
       (Pencil icons on front-page)
    ============================ */
    if ( isset( $wp_customize->selective_refresh ) ) {
        $partials = [
            // Header
            'hba_logo'                  => '.logo-img',
            'hba_nav_cta_text'          => '.nav-right .btn-green',
            // Hero
            'hba_hero_eyebrow'          => '.home-eyebrow',
            'hba_hero_title'            => '.home-hero h1',
            'hba_hero_subtitle'         => '.home-hero p.home-hero-subtitle',
            'hba_hero_btn1_text'        => '.home-ctas .btn-primary',
            'hba_hero_btn2_text'        => '.home-ctas .btn-secondary',
            // Featured Articles
            'hba_feat_title'            => '.feat-hd h2',
            'hba_feat_link_text'        => '.feat-hd a.sec-hd-link',
            // Topics
            'hba_topics_title'          => '.explore-topics-hd h2',
            'hba_topics_link_text'      => '.explore-topics-hd a',
            // Latest Articles
            'hba_latest_title'          => '.latest-hd h2',
            'hba_latest_link_text'      => '.latest-hd a.sec-hd-link',
            'hba_latest_articles_count' => '.art-grid',
            // Expert Quote
            'hba_expert_name'           => '.home-medrev-card h4, .expert-strip-inner .exp-name',
            'hba_expert_role'           => '.expert-strip-inner .exp-role',
            'hba_expert_quote'          => '.exp-quote',
            'hba_expert_btn_text'       => '.expert-strip .btn-green',
            // Newsletter
            'hba_nl_chip'               => '.nl-chip',
            'hba_newsletter_title'      => '.nl-inner h2',
            'hba_newsletter_desc'       => '.nl-inner p',
            'hba_nl_btn'                => '.nl-form button',
            'hba_nl_perk_1'             => '.nl-perks .nl-perk:nth-child(1)',
            'hba_nl_perk_2'             => '.nl-perks .nl-perk:nth-child(2)',
            'hba_nl_perk_3'             => '.nl-perks .nl-perk:nth-child(3)',
            // Announcement bar
            'hba_ann_bar_text'          => '.ann-bar',
            // Footer
            'hba_footer_about'          => '.foot-about',
            'hba_footer_copyright'      => '.foot-copy',
            'hba_footer_col1_title'     => '.foot-col:nth-of-type(1) h5',
            'hba_footer_col2_title'     => '.foot-col:nth-of-type(2) h5',
            'hba_footer_col3_title'     => '.foot-col:nth-of-type(3) h5',
            // About Us
            'hba_about_hero_tag'        => '.about-hero-inner .about-tag',
            'hba_about_hero_title'      => '.about-hero-inner h1',
            'hba_about_hero_desc'       => '.about-hero-inner p',
            'hba_about_btn1_text'       => '.about-hero-ctas .btn-white',
            'hba_about_btn2_text'       => '.about-hero-ctas .btn-outline-white',
            'hba_about_mission_label'   => '.mission-strip .mission-label',
            'hba_about_mission_title'   => '.mission-strip h2',
            'hba_about_val_label'       => '.values-section .label',
            'hba_about_val_title'       => '.values-section h2',
            'hba_about_val_desc'        => '.values-section .section-title p',
            // Contact Us
            'hba_contact_eyebrow'       => '.articles-hero-inner .eyebrow',
            'hba_contact_title'         => '.articles-hero-inner h1',
            'hba_contact_desc'          => '.articles-hero-inner p',
            'hba_contact_time'          => '.contact-notice p',
            'hba_contact_notice_title'  => '.important-notice h3',
            'hba_contact_notice_desc'   => '.important-notice p',
            'hba_contact_notice_link'   => '.important-notice a',
            // Team
            'hba_team_label'            => '.team-hero-label',
            'hba_team_title'            => '.team-hero-title',
            'hba_team_desc'             => '.team-hero-desc',
            'hba_team_grid_title'       => '.team-section-title',
        ];

        // Contact Cards
        for ( $i = 1; $i <= 3; $i++ ) {
            $partials["hba_contact_c{$i}_icon"] = ".contact-cards > div:nth-child({$i}) > div:first-child";
            $partials["hba_contact_c{$i}_title"] = ".contact-cards > div:nth-child({$i}) > div:last-child h3";
            $partials["hba_contact_c{$i}_desc"] = ".contact-cards > div:nth-child({$i}) > div:last-child p";
            $partials["hba_contact_c{$i}_email"] = ".contact-cards > div:nth-child({$i}) > div:last-child a";
        }

        // About Pillars
        for ( $i = 1; $i <= 4; $i++ ) {
            $partials["hba_about_p{$i}_icon"] = ".mission-pillars .pillar:nth-child({$i}) .pillar-ico";
            $partials["hba_about_p{$i}_title"] = ".mission-pillars .pillar:nth-child({$i}) h4";
            $partials["hba_about_p{$i}_desc"] = ".mission-pillars .pillar:nth-child({$i}) p";
        }
        
        // About Values
        for ( $i = 1; $i <= 6; $i++ ) {
            $partials["hba_about_v{$i}_icon"] = ".values-grid .value-card:nth-child({$i}) .value-ico";
            $partials["hba_about_v{$i}_title"] = ".values-grid .value-card:nth-child({$i}) h3";
            $partials["hba_about_v{$i}_desc"] = ".values-grid .value-card:nth-child({$i}) p";
        }

        // Trust metrics
        for ( $i = 0; $i < 4; $i++ ) {
            $partials["hba_metric_{$i}_num"] = ".trust-metrics-inner .tmet-stat:nth-child(" . ($i+1) . ") .num";
            $partials["hba_metric_{$i}_lbl"] = ".trust-metrics-inner .tmet-stat:nth-child(" . ($i+1) . ") .lbl";
        }

        foreach ( $partials as $setting_id => $selector ) {
            $wp_customize->selective_refresh->add_partial( $setting_id, [
                'selector'         => $selector,
                'fallback_refresh' => true,
                'render_callback'  => function( $partial ) {
                    return get_theme_mod( $partial->id );
                },
            ] );
        }
    }
}
add_action( 'customize_register', 'hba_customizer' );

/* ===== Load Customizer Preview JS ===== */
function hba_customizer_preview_js() {
    wp_enqueue_script( 'hba-customizer-preview', HBA_URI . '/assets/js/customizer-preview.js', ['jquery','customize-preview'], HBA_VERSION, true );
}
add_action( 'customize_preview_init', 'hba_customizer_preview_js' );



