<?php
/**
 * Team Members System
 * Registers the Custom Post Type and Meta Box for Team members.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 1. Register Custom Post Type for Team Members
 */
function hba_register_team_cpt() {
    $labels = array(
        'name'                  => _x( 'Team Members', 'Post Type General Name', 'healthbeyondage' ),
        'singular_name'         => _x( 'Team Member', 'Post Type Singular Name', 'healthbeyondage' ),
        'menu_name'             => __( 'Team', 'healthbeyondage' ),
        'name_admin_bar'        => __( 'Team Member', 'healthbeyondage' ),
        'archives'              => __( 'Team Archives', 'healthbeyondage' ),
        'attributes'            => __( 'Team Attributes', 'healthbeyondage' ),
        'parent_item_colon'     => __( 'Parent Team Member:', 'healthbeyondage' ),
        'all_items'             => __( 'All Team Members', 'healthbeyondage' ),
        'add_new_item'          => __( 'Add New Team Member', 'healthbeyondage' ),
        'add_new'               => __( 'Add Team', 'healthbeyondage' ),
        'new_item'              => __( 'New Team Member', 'healthbeyondage' ),
        'edit_item'             => __( 'Edit Team Member', 'healthbeyondage' ),
        'update_item'           => __( 'Update Team Member', 'healthbeyondage' ),
        'view_item'             => __( 'View Team Member', 'healthbeyondage' ),
        'view_items'            => __( 'View Team', 'healthbeyondage' ),
        'search_items'          => __( 'Search Team', 'healthbeyondage' ),
        'not_found'             => __( 'Not found', 'healthbeyondage' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'healthbeyondage' ),
    );
    $args = array(
        'label'                 => __( 'Team Member', 'healthbeyondage' ),
        'description'           => __( 'Team members and contributors', 'healthbeyondage' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => false,
    );
    register_post_type( 'hba_team', $args );
}
add_action( 'init', 'hba_register_team_cpt', 0 );


/**
 * 2. Add Meta Boxes
 */
function hba_add_team_meta_boxes() {
    add_meta_box(
        'hba_team_details_meta_box',
        __( 'Team Profile Details', 'healthbeyondage' ),
        'hba_team_details_meta_box_html',
        'hba_team',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hba_add_team_meta_boxes' );

/**
 * 3. Render Team Details Meta Box HTML
 */
function hba_team_details_meta_box_html( $post ) {
    wp_nonce_field( 'hba_save_team_details', 'hba_team_details_nonce' );

    $role        = get_post_meta( $post->ID, '_hba_team_role', true );
    $credentials = get_post_meta( $post->ID, '_hba_team_credentials', true );
    $tags        = get_post_meta( $post->ID, '_hba_team_tags', true );

    echo '<p><strong><label for="hba_team_role">' . __( 'Role / Job Title', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_team_role" name="hba_team_role" value="' . esc_attr( $role ) . '" style="width:100%; max-width:400px;" placeholder="e.g. Lead Medical Reviewer" />';
    
    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_credentials">' . __( 'Credentials', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_team_credentials" name="hba_team_credentials" value="' . esc_attr( $credentials ) . '" style="width:100%; max-width:400px;" placeholder="e.g. MD, Internal Medicine &middot; 18 yrs" />';

    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_tags">' . __( 'Specialties / Tags', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<p class="description" style="margin-bottom:0.5rem;">' . __( 'Enter specialties separated by commas (e.g. Preventive Medicine, Aging, Cardiovascular)', 'healthbeyondage' ) . '</p>';
    echo '<input type="text" id="hba_team_tags" name="hba_team_tags" value="' . esc_attr( $tags ) . '" style="width:100%;" />';
    
    echo '<p style="margin-top:2rem; padding:1rem; background:#f0f0f1; border-left:4px solid #2271b1;"><strong>Note:</strong> Set the team member\'s profile photo using the <strong>"Featured Image"</strong> box. Write their full biography in the main editor above.</p>';
}

/**
 * 4. Save Meta Boxes Data
 */
function hba_save_team_meta_box_data( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset( $_POST['hba_team_details_nonce'] ) && wp_verify_nonce( $_POST['hba_team_details_nonce'], 'hba_save_team_details' ) ) {
        if ( current_user_can( 'edit_post', $post_id ) ) {
            if ( isset( $_POST['hba_team_role'] ) ) {
                update_post_meta( $post_id, '_hba_team_role', sanitize_text_field( $_POST['hba_team_role'] ) );
            }
            if ( isset( $_POST['hba_team_credentials'] ) ) {
                update_post_meta( $post_id, '_hba_team_credentials', sanitize_text_field( $_POST['hba_team_credentials'] ) );
            }
            if ( isset( $_POST['hba_team_tags'] ) ) {
                update_post_meta( $post_id, '_hba_team_tags', sanitize_text_field( $_POST['hba_team_tags'] ) );
            }
        }
    }
}
add_action( 'save_post', 'hba_save_team_meta_box_data' );
