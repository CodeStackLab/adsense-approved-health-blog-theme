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
        'supports'              => array( 'title', 'thumbnail' ), // Removed editor and excerpt to use custom meta boxes instead
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
 * 2. Add Meta Boxes
 */
function hba_add_reviewer_meta_boxes() {
    // Meta box for Assigning Reviewer to Posts
    add_meta_box(
        'hba_reviewer_meta_box',
        __( 'Medical Reviewer', 'healthbeyondage' ),
        'hba_reviewer_meta_box_html',
        'post',
        'side',
        'default'
    );

    // Meta box for Reviewer Details (Role & Bio) on the Reviewer CPT
    add_meta_box(
        'hba_reviewer_details_meta_box',
        __( 'Reviewer Profile Details', 'healthbeyondage' ),
        'hba_reviewer_details_meta_box_html',
        'hba_reviewer',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hba_add_reviewer_meta_boxes' );

/**
 * 3. Render Post Meta Box HTML (Assign Reviewer)
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

    echo '<div style="padding: 5px 0 10px;">';
    echo '<p style="margin-bottom: 8px;"><strong><label for="hba_reviewer_field">';
    _e( 'Select the Medical Reviewer for this article:', 'healthbeyondage' );
    echo '</label></strong></p>';

    echo '<select id="hba_reviewer_field" name="hba_reviewer_field" style="width:100%; max-width:100%; box-sizing:border-box; padding:4px 8px; border-radius:4px; border:1px solid #8c8f94; min-height:32px;">';
    echo '<option value="">' . __( '— Select Reviewer... —', 'healthbeyondage' ) . '</option>';
    
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
    echo '<p class="description" style="margin-top:12px; color:#646970; font-size:13px; line-height:1.4;">' . __( 'If left blank, the global Lead Medical Reviewer from Customizer settings will be used.', 'healthbeyondage' ) . '</p>';
    echo '</div>';
}

/**
 * 4. Render Reviewer Details Meta Box HTML (Role & Bio)
 */
function hba_reviewer_details_meta_box_html( $post ) {
    wp_nonce_field( 'hba_save_reviewer_details', 'hba_reviewer_details_nonce' );

    $role = get_post_meta( $post->ID, '_hba_reviewer_role', true );
    $bio  = get_post_meta( $post->ID, '_hba_reviewer_bio', true );

    echo '<p><strong><label for="hba_reviewer_role">' . __( 'Reviewer Role / Job Title', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_reviewer_role" name="hba_reviewer_role" value="' . esc_attr( $role ) . '" style="width:100%; max-width:400px;" placeholder="e.g. Lead Medical Reviewer" />';
    
    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_reviewer_bio">' . __( 'Reviewer Biography', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<p class="description" style="margin-bottom:0.5rem;">' . __( 'Write the full biography. This will be displayed on their dedicated profile page.', 'healthbeyondage' ) . '</p>';
    wp_editor( $bio, 'hba_reviewer_bio', array(
        'textarea_name' => 'hba_reviewer_bio',
        'textarea_rows' => 10,
        'media_buttons' => false,
        'teeny'         => true,
    ));

    echo '<p style="margin-top:2rem; padding:1rem; background:#f0f0f1; border-left:4px solid #2271b1;"><strong>Note on Profile Photo:</strong> To set the reviewer\'s profile photo, please use the standard <strong>"Featured Image"</strong> box located in the right-hand sidebar.</p>';
}

/**
 * 5. Save Meta Boxes Data
 */
function hba_save_reviewer_meta_box_data( $post_id ) {
    // Prevent autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Save Assign Reviewer on Posts
    if ( isset( $_POST['hba_reviewer_meta_box_nonce'] ) && wp_verify_nonce( $_POST['hba_reviewer_meta_box_nonce'], 'hba_save_reviewer_data' ) ) {
        if ( current_user_can( 'edit_post', $post_id ) ) {
            if ( isset( $_POST['hba_reviewer_field'] ) ) {
                $reviewer_id = sanitize_text_field( $_POST['hba_reviewer_field'] );
                update_post_meta( $post_id, '_hba_reviewer_id', $reviewer_id );
            } else {
                delete_post_meta( $post_id, '_hba_reviewer_id' );
            }
        }
    }

    // Save Reviewer Details on hba_reviewer CPT
    if ( isset( $_POST['hba_reviewer_details_nonce'] ) && wp_verify_nonce( $_POST['hba_reviewer_details_nonce'], 'hba_save_reviewer_details' ) ) {
        if ( current_user_can( 'edit_post', $post_id ) ) {
            if ( isset( $_POST['hba_reviewer_role'] ) ) {
                update_post_meta( $post_id, '_hba_reviewer_role', sanitize_text_field( $_POST['hba_reviewer_role'] ) );
            }
            if ( isset( $_POST['hba_reviewer_bio'] ) ) {
                update_post_meta( $post_id, '_hba_reviewer_bio', wp_kses_post( $_POST['hba_reviewer_bio'] ) );
            }
        }
    }
}
add_action( 'save_post', 'hba_save_reviewer_meta_box_data' );
