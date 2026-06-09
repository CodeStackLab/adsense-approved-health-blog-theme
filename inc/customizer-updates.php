<?php
// We will insert this block into inc/customizer.php before the selective refresh partials
    $wp_customize->add_setting( 'hba_feat_title', [ 'default' => 'Featured Articles', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_feat_title', [ 'label' => 'Featured Title', 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
    $wp_customize->add_setting( 'hba_feat_link_text', [ 'default' => 'View all trending →', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_feat_link_text', [ 'label' => 'Featured Link Text', 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
    $wp_customize->add_setting( 'hba_feat_link_url', [ 'default' => '/trending', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_feat_link_url', [ 'label' => 'Featured Link URL', 'section' => 'hba_homepage_sections', 'type' => 'url' ] );

    $wp_customize->add_setting( 'hba_topics_title', [ 'default' => 'Explore by Health Topic', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_topics_title', [ 'label' => 'Topics Title', 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
    $wp_customize->add_setting( 'hba_topics_link_text', [ 'default' => 'View all topics →', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_topics_link_text', [ 'label' => 'Topics Link Text', 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
    $wp_customize->add_setting( 'hba_topics_link_url', [ 'default' => '/topics', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_topics_link_url', [ 'label' => 'Topics Link URL', 'section' => 'hba_homepage_sections', 'type' => 'url' ] );

    $wp_customize->add_setting( 'hba_latest_title', [ 'default' => 'Latest Articles', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_latest_title', [ 'label' => 'Latest Title', 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
    $wp_customize->add_setting( 'hba_latest_link_text', [ 'default' => 'View all articles →', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_latest_link_text', [ 'label' => 'Latest Link Text', 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
    $wp_customize->add_setting( 'hba_latest_link_url', [ 'default' => '/blog', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_latest_link_url', [ 'label' => 'Latest Link URL', 'section' => 'hba_homepage_sections', 'type' => 'url' ] );

    $wp_customize->add_setting( 'hba_expert_btn_text', [ 'default' => 'Meet Our Team', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_btn_text', [ 'label' => 'Expert Button Text', 'section' => 'hba_homepage_sections', 'type' => 'text' ] );
    $wp_customize->add_setting( 'hba_expert_btn_url', [ 'default' => '/team', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
    $wp_customize->add_control( 'hba_expert_btn_url', [ 'label' => 'Expert Button URL', 'section' => 'hba_homepage_sections', 'type' => 'url' ] );

