<?php
/**
 * Health Topics System
 * Registers a custom taxonomy for Health Topics to be used on Posts.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function hba_register_health_topic_taxonomy() {
    $labels = array(
        'name'              => _x( 'Health Topics', 'taxonomy general name', 'healthbeyondage' ),
        'singular_name'     => _x( 'Health Topic', 'taxonomy singular name', 'healthbeyondage' ),
        'search_items'      => __( 'Search Health Topics', 'healthbeyondage' ),
        'all_items'         => __( 'All Health Topics', 'healthbeyondage' ),
        'parent_item'       => __( 'Parent Health Topic', 'healthbeyondage' ),
        'parent_item_colon' => __( 'Parent Health Topic:', 'healthbeyondage' ),
        'edit_item'         => __( 'Edit Health Topic', 'healthbeyondage' ),
        'update_item'       => __( 'Update Health Topic', 'healthbeyondage' ),
        'add_new_item'      => __( 'Add New Health Topic', 'healthbeyondage' ),
        'new_item_name'     => __( 'New Health Topic Name', 'healthbeyondage' ),
        'menu_name'         => __( 'Health Topics', 'healthbeyondage' ),
    );

    $args = array(
        'hierarchical'      => true, // Like categories, so they can have parents
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'topic' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'hba_health_topic', array( 'post' ), $args );
}
add_action( 'init', 'hba_register_health_topic_taxonomy', 0 );
