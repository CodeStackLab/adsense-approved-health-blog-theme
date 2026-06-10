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
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'team-member' ),
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
    
    // Extended fields
    $email               = get_post_meta( $post->ID, '_hba_team_email', true );
    $years_practice      = get_post_meta( $post->ID, '_hba_team_years_practice', true );
    $articles_reviewed   = get_post_meta( $post->ID, '_hba_team_articles_reviewed', true );
    $publications_count  = get_post_meta( $post->ID, '_hba_team_publications_count', true );
    $joined_year         = get_post_meta( $post->ID, '_hba_team_joined_year', true );
    $quote               = get_post_meta( $post->ID, '_hba_team_quote', true );
    $education           = get_post_meta( $post->ID, '_hba_team_education', true );
    $certifications      = get_post_meta( $post->ID, '_hba_team_certifications', true );
    $publications_list   = get_post_meta( $post->ID, '_hba_team_publications_list', true );

    echo '<p><strong><label for="hba_team_role">' . __( 'Role / Job Title', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_team_role" name="hba_team_role" value="' . esc_attr( $role ) . '" style="width:100%; max-width:400px;" placeholder="e.g. Lead Medical Reviewer" />';
    
    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_credentials">' . __( 'Credentials', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_team_credentials" name="hba_team_credentials" value="' . esc_attr( $credentials ) . '" style="width:100%; max-width:400px;" placeholder="e.g. MD, Internal Medicine &middot; 18 yrs" />';

    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_tags">' . __( 'Specialties / Tags', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<p class="description" style="margin-bottom:0.5rem;">' . __( 'Enter specialties separated by commas (e.g. Preventive Medicine, Aging, Cardiovascular)', 'healthbeyondage' ) . '</p>';
    echo '<input type="text" id="hba_team_tags" name="hba_team_tags" value="' . esc_attr( $tags ) . '" style="width:100%;" />';
    
    echo '<hr style="margin:2rem 0;">';
    echo '<h3>' . __( 'Quick Stats', 'healthbeyondage' ) . '</h3>';
    
    echo '<p><strong><label for="hba_team_years_practice">' . __( 'Years of Clinical Practice', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_team_years_practice" name="hba_team_years_practice" value="' . esc_attr( $years_practice ) . '" style="width:100%; max-width:200px;" placeholder="e.g. 18+" />';

    echo '<p><strong><label for="hba_team_articles_reviewed">' . __( 'Articles Reviewed', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_team_articles_reviewed" name="hba_team_articles_reviewed" value="' . esc_attr( $articles_reviewed ) . '" style="width:100%; max-width:200px;" placeholder="e.g. 340+" />';

    echo '<p><strong><label for="hba_team_publications_count">' . __( 'Research Publications (Count)', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_team_publications_count" name="hba_team_publications_count" value="' . esc_attr( $publications_count ) . '" style="width:100%; max-width:200px;" placeholder="e.g. 12" />';

    echo '<p><strong><label for="hba_team_joined_year">' . __( 'Joined Year', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="text" id="hba_team_joined_year" name="hba_team_joined_year" value="' . esc_attr( $joined_year ) . '" style="width:100%; max-width:200px;" placeholder="e.g. 2021" />';

    echo '<hr style="margin:2rem 0;">';
    echo '<h3>' . __( 'Extended Profile Info', 'healthbeyondage' ) . '</h3>';

    echo '<p><strong><label for="hba_team_email">' . __( 'Email Contact', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="email" id="hba_team_email" name="hba_team_email" value="' . esc_attr( $email ) . '" style="width:100%; max-width:400px;" placeholder="e.g. sarah.matheson@healthbeyondage.com" />';

    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_quote">' . __( 'Personal Quote', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<textarea id="hba_team_quote" name="hba_team_quote" style="width:100%;" rows="3">' . esc_textarea( $quote ) . '</textarea>';

    $about = get_post_meta( $post->ID, '_hba_team_about', true );
    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_about">' . __( 'About / Biography', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<p class="description" style="margin-bottom:0.5rem;">' . __( 'This text will appear in the "About" section before the quote. You can also use the main WordPress editor at the top.', 'healthbeyondage' ) . '</p>';
    echo '<textarea id="hba_team_about" name="hba_team_about" style="width:100%;" rows="5">' . esc_textarea( $about ) . '</textarea>';

    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_education">' . __( 'Education & Training', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<p class="description" style="margin-bottom:0.5rem;">' . __( 'One entry per line. Example: Doctor of Medicine (MD) | Johns Hopkins School of Medicine - 2005', 'healthbeyondage' ) . '</p>';
    echo '<textarea id="hba_team_education" name="hba_team_education" style="width:100%;" rows="4">' . esc_textarea( $education ) . '</textarea>';

    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_certifications">' . __( 'Certifications & Memberships', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<p class="description" style="margin-bottom:0.5rem;">' . __( 'Comma-separated or one per line.', 'healthbeyondage' ) . '</p>';
    echo '<textarea id="hba_team_certifications" name="hba_team_certifications" style="width:100%;" rows="3">' . esc_textarea( $certifications ) . '</textarea>';

    echo '<p style="margin-top:1.5rem;"><strong><label for="hba_team_publications_list">' . __( 'Selected Publications', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<p class="description" style="margin-bottom:0.5rem;">' . __( 'One publication per line.', 'healthbeyondage' ) . '</p>';
    echo '<textarea id="hba_team_publications_list" name="hba_team_publications_list" style="width:100%;" rows="4">' . esc_textarea( $publications_list ) . '</textarea>';

    echo '<hr style="margin:2rem 0;">';
    echo '<h3>' . __( 'Social Links', 'healthbeyondage' ) . '</h3>';

    $linkedin = get_post_meta( $post->ID, '_hba_team_linkedin', true );
    echo '<p><strong><label for="hba_team_linkedin">' . __( 'LinkedIn URL', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="url" id="hba_team_linkedin" name="hba_team_linkedin" value="' . esc_attr( $linkedin ) . '" style="width:100%; max-width:400px;" placeholder="https://linkedin.com/in/..." />';

    $twitter = get_post_meta( $post->ID, '_hba_team_twitter', true );
    echo '<p style="margin-top:1rem;"><strong><label for="hba_team_twitter">' . __( 'Twitter/X URL', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="url" id="hba_team_twitter" name="hba_team_twitter" value="' . esc_attr( $twitter ) . '" style="width:100%; max-width:400px;" placeholder="https://twitter.com/..." />';

    $website = get_post_meta( $post->ID, '_hba_team_website', true );
    echo '<p style="margin-top:1rem;"><strong><label for="hba_team_website">' . __( 'Personal Website', 'healthbeyondage' ) . '</label></strong></p>';
    echo '<input type="url" id="hba_team_website" name="hba_team_website" value="' . esc_attr( $website ) . '" style="width:100%; max-width:400px;" placeholder="https://..." />';

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
            if ( isset( $_POST['hba_team_email'] ) ) {
                update_post_meta( $post_id, '_hba_team_email', sanitize_email( $_POST['hba_team_email'] ) );
            }
            if ( isset( $_POST['hba_team_years_practice'] ) ) {
                update_post_meta( $post_id, '_hba_team_years_practice', sanitize_text_field( $_POST['hba_team_years_practice'] ) );
            }
            if ( isset( $_POST['hba_team_articles_reviewed'] ) ) {
                update_post_meta( $post_id, '_hba_team_articles_reviewed', sanitize_text_field( $_POST['hba_team_articles_reviewed'] ) );
            }
            if ( isset( $_POST['hba_team_publications_count'] ) ) {
                update_post_meta( $post_id, '_hba_team_publications_count', sanitize_text_field( $_POST['hba_team_publications_count'] ) );
            }
            if ( isset( $_POST['hba_team_joined_year'] ) ) {
                update_post_meta( $post_id, '_hba_team_joined_year', sanitize_text_field( $_POST['hba_team_joined_year'] ) );
            }
            if ( isset( $_POST['hba_team_quote'] ) ) {
                update_post_meta( $post_id, '_hba_team_quote', sanitize_textarea_field( $_POST['hba_team_quote'] ) );
            }
            if ( isset( $_POST['hba_team_about'] ) ) {
                update_post_meta( $post_id, '_hba_team_about', wp_kses_post( $_POST['hba_team_about'] ) );
            }
            if ( isset( $_POST['hba_team_education'] ) ) {
                update_post_meta( $post_id, '_hba_team_education', sanitize_textarea_field( $_POST['hba_team_education'] ) );
            }
            if ( isset( $_POST['hba_team_certifications'] ) ) {
                update_post_meta( $post_id, '_hba_team_certifications', sanitize_textarea_field( $_POST['hba_team_certifications'] ) );
            }
            if ( isset( $_POST['hba_team_publications_list'] ) ) {
                update_post_meta( $post_id, '_hba_team_publications_list', sanitize_textarea_field( $_POST['hba_team_publications_list'] ) );
            }
            if ( isset( $_POST['hba_team_linkedin'] ) ) {
                update_post_meta( $post_id, '_hba_team_linkedin', esc_url_raw( $_POST['hba_team_linkedin'] ) );
            }
            if ( isset( $_POST['hba_team_twitter'] ) ) {
                update_post_meta( $post_id, '_hba_team_twitter', esc_url_raw( $_POST['hba_team_twitter'] ) );
            }
            if ( isset( $_POST['hba_team_website'] ) ) {
                update_post_meta( $post_id, '_hba_team_website', esc_url_raw( $_POST['hba_team_website'] ) );
            }
        }
    }
}
add_action( 'save_post', 'hba_save_team_meta_box_data' );
