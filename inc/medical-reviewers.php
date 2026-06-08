<?php
/**
 * Medical Reviewers System
 * Registers the Custom Post Type and Meta Box for assigning reviewers to posts.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 1. Register Custom Post Type for Medical Reviewers
 */
function hba_register_reviewer_cpt() {
    $labels = array(
        'name'                  => _x( 'Medical Reviewers', 'Post Type General Name', 'healthbeyondage' ),
        'singular_name'         => _x( 'Medical Reviewer', 'Post Type Singular Name', 'healthbeyondage' ),
        'menu_name'             => __( 'Reviewers', 'healthbeyondage' ),
        'name_admin_bar'        => __( 'Reviewer', 'healthbeyondage' ),
        'archives'              => __( 'Reviewer Archives', 'healthbeyondage' ),
        'attributes'            => __( 'Reviewer Attributes', 'healthbeyondage' ),
        'parent_item_colon'     => __( 'Parent Reviewer:', 'healthbeyondage' ),
        'all_items'             => __( 'All Reviewers', 'healthbeyondage' ),
        'add_new_item'          => __( 'Add New Reviewer', 'healthbeyondage' ),
        'add_new'               => __( 'Add New', 'healthbeyondage' ),
        'new_item'              => __( 'New Reviewer', 'healthbeyondage' ),
        'edit_item'             => __( 'Edit Reviewer', 'healthbeyondage' ),
        'update_item'           => __( 'Update Reviewer', 'healthbeyondage' ),
        'view_item'             => __( 'View Reviewer', 'healthbeyondage' ),
        'view_items'            => __( 'View Reviewers', 'healthbeyondage' ),
        'search_items'          => __( 'Search Reviewer', 'healthbeyondage' ),
        'not_found'             => __( 'Not found', 'healthbeyondage' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'healthbeyondage' ),
    );
    $args = array(
        'label'                 => __( 'Medical Reviewer', 'healthbeyondage' ),
        'description'           => __( 'Medical reviewers for articles', 'healthbeyondage' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ), // Excerpt = Role, Thumbnail = Avatar, Title = Name, Editor = Bio
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-clipboard',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true, // Enable profile pages for reviewers
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'reviewer' ),
    );
    register_post_type( 'hba_reviewer', $args );
}
add_action( 'init', 'hba_register_reviewer_cpt', 0 );


/**
 * 2. Add Meta Box to Posts
 */
function hba_add_reviewer_meta_box() {
    add_meta_box(
        'hba_reviewer_meta_box',
        __( 'Medical Reviewer', 'healthbeyondage' ),
        'hba_reviewer_meta_box_html',
        'post',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'hba_add_reviewer_meta_box' );

/**
 * 3. Render Meta Box HTML
 */
function hba_reviewer_meta_box_html( $post ) {
    wp_nonce_field( 'hba_save_reviewer_data', 'hba_reviewer_meta_box_nonce' );

    $current_reviewer = get_post_meta( $post->ID, '_hba_reviewer_id', true );

    // Get all published reviewers
    $reviewers = get_posts( array(
        'post_type'      => 'hba_reviewer',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    ));

    echo '<p><label for="hba_reviewer_field">';
    _e( 'Select the Medical Reviewer for this article:', 'healthbeyondage' );
    echo '</label></p>';

    echo '<select id="hba_reviewer_field" name="hba_reviewer_field" style="width:100%;">';
    echo '<option value="">' . __( '— Select Reviewer (or use global setting) —', 'healthbeyondage' ) . '</option>';
    
    if ( $reviewers ) {
        foreach ( $reviewers as $rev ) {
            printf(
                '<option value="%s" %s>%s</option>',
                esc_attr( $rev->ID ),
                selected( $current_reviewer, $rev->ID, false ),
                esc_html( $rev->post_title )
            );
        }
    }
    echo '</select>';
    echo '<p class="description">' . __( 'If left blank, the global Lead Medical Reviewer from Customizer settings will be used.', 'healthbeyondage' ) . '</p>';
}

/**
 * 4. Save Meta Box Data
 */
function hba_save_reviewer_meta_box_data( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['hba_reviewer_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['hba_reviewer_meta_box_nonce'], 'hba_save_reviewer_data' ) ) {
        return;
    }
    // Prevent autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Check permissions
    if ( isset( $_POST['post_type'] ) && 'post' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    // Save field
    if ( isset( $_POST['hba_reviewer_field'] ) ) {
        $reviewer_id = sanitize_text_field( $_POST['hba_reviewer_field'] );
        update_post_meta( $post_id, '_hba_reviewer_id', $reviewer_id );
    } else {
        delete_post_meta( $post_id, '_hba_reviewer_id' );
    }
}
add_action( 'save_post', 'hba_save_reviewer_meta_box_data' );
