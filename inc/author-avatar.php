<?php
/**
 * Custom Author Avatar using WordPress Media Library
 */

// 1. Enqueue media scripts on profile pages
add_action( 'admin_enqueue_scripts', 'hba_enqueue_avatar_scripts' );
function hba_enqueue_avatar_scripts( $hook ) {
    if ( 'profile.php' !== $hook && 'user-edit.php' !== $hook ) {
        return;
    }
    wp_enqueue_media();
}

add_action( 'admin_footer-profile.php', 'hba_avatar_js' );
add_action( 'admin_footer-user-edit.php', 'hba_avatar_js' );
function hba_avatar_js() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            var mediaUploader;
            $('#hba-upload-avatar-button').click(function(e) {
                e.preventDefault();
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Profile Picture',
                    button: { text: 'Choose Picture' },
                    multiple: false
                });
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#hba_custom_avatar_id').val(attachment.id);
                    $('#hba-avatar-preview').attr('src', attachment.url).show();
                    $('#hba-remove-avatar-button').show();
                });
                mediaUploader.open();
            });

            $('#hba-remove-avatar-button').click(function(e){
                e.preventDefault();
                $('#hba_custom_avatar_id').val('');
                $('#hba-avatar-preview').attr('src', '').hide();
                $(this).hide();
            });
        });
    </script>
    <?php
}

// 2. Add custom field to user profile
add_action( 'show_user_profile', 'hba_custom_avatar_field' );
add_action( 'edit_user_profile', 'hba_custom_avatar_field' );
function hba_custom_avatar_field( $user ) {
    $avatar_id = get_user_meta( $user->ID, '_hba_custom_avatar_id', true );
    $avatar_url = '';
    if ( $avatar_id ) {
        $avatar_url = wp_get_attachment_image_url( $avatar_id, 'medium' );
    }
    ?>
    <h3>Custom Profile Picture</h3>
    <table class="form-table">
        <tr>
            <th><label for="hba_custom_avatar_id">Profile Picture</label></th>
            <td>
                <div style="margin-bottom: 10px;">
                    <img id="hba-avatar-preview" src="<?php echo esc_url($avatar_url); ?>" style="max-width: 150px; height: auto; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1); display: <?php echo $avatar_url ? 'block' : 'none'; ?>;" />
                </div>
                <input type="hidden" name="hba_custom_avatar_id" id="hba_custom_avatar_id" value="<?php echo esc_attr( $avatar_id ); ?>" />
                <button type="button" class="button button-primary" id="hba-upload-avatar-button">Upload / Choose Image</button>
                <button type="button" class="button" id="hba-remove-avatar-button" style="display: <?php echo $avatar_id ? 'inline-block' : 'none'; ?>; color: #b32d2e; border-color: #b32d2e;">Remove Image</button>
                <p class="description">Upload a custom profile picture from your local PC to replace the default Gravatar.</p>
            </td>
        </tr>
    </table>
    <?php
}

// 3. Save custom field
add_action( 'personal_options_update', 'hba_save_custom_avatar_field' );
add_action( 'edit_user_profile_update', 'hba_save_custom_avatar_field' );
function hba_save_custom_avatar_field( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) && ! current_user_can( 'edit_users' ) ) {
        return false;
    }
    if ( isset( $_POST['hba_custom_avatar_id'] ) ) {
        update_user_meta( $user_id, '_hba_custom_avatar_id', sanitize_text_field( $_POST['hba_custom_avatar_id'] ) );
    } else {
        delete_user_meta( $user_id, '_hba_custom_avatar_id' );
    }
}

// 4. Override get_avatar filter
add_filter( 'get_avatar', 'hba_override_gravatar', 10, 5 );
function hba_override_gravatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user_id = false;

    // Determine the user ID
    if ( is_numeric( $id_or_email ) ) {
        $user_id = (int) $id_or_email;
    } elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) ) {
        $user_id = (int) $id_or_email->user_id;
    } elseif ( is_string( $id_or_email ) && is_email( $id_or_email ) ) {
        $user = get_user_by( 'email', $id_or_email );
        if ( $user ) {
            $user_id = $user->ID;
        }
    }

    if ( $user_id ) {
        $custom_avatar_id = get_user_meta( $user_id, '_hba_custom_avatar_id', true );
        if ( $custom_avatar_id ) {
            $image = wp_get_attachment_image_src( $custom_avatar_id, array($size, $size) );
            if ( $image ) {
                $avatar = "<img alt='" . esc_attr( $alt ) . "' src='" . esc_url( $image[0] ) . "' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
            }
        }
    }

    return $avatar;
}
