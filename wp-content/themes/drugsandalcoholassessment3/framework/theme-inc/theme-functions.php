<?php
/*
 * This file containing all required functions of this theme
 */

/* Theme Template Part */
if (!function_exists('theme_template_part')) {

    function theme_template_part($file) {
        load_template(FRONTEND_MODULE . '/' . $file . '.php');
    }

}

/* User Account Activation */
if (!function_exists('userAccountActivation')) {

    function userAccountActivation() {
        if (isset($_GET['active_code']) && $_GET['active_code'] != '') {
            $activeCode = base64_decode($_GET['active_code']);

            $getUsers = get_users(['meta_query' => [
                    [
                        'key' => '_user_active_code',
                        'value' => $activeCode,
                        'compare' => '='
                    ],
                    [
                        'key' => '_user_active_status',
                        'value' => 2,
                        'compare' => '='
                    ]
            ]]);

            if (is_array($getUsers) && count($getUsers) > 0) {
                foreach ($getUsers as $eachUser) {
                    update_user_meta($eachUser->ID, '_user_active_status', 1);
                    update_user_meta($eachUser->ID, '_user_activation_link', '');
                }
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        $.notify('Your account has been successfully verified.', {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999/*showProgressbar: true,*/});
                        siteRedirection('<?php echo BASE_URL ?>', 5000);
                    });
                </script>
                <?php
            } else {
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        $.notify('Sorry!!! User not found.', {type: 'danger', delay: 5000, allow_dismiss: true, z_index: 9999/*showProgressbar: true,*/});
                        siteRedirection('<?php echo BASE_URL ?>', 5000);
                    });
                </script>
                <?php
            }
        }
    }

}

/* User Reset Password */
if (!function_exists('userResetPasswordActivation')) {

    function userResetPasswordActivation() {
        if (isset($_GET['reset_pass']) && $_GET['reset_pass'] != '') {
            $activeCode = base64_decode($_GET['reset_pass']);

            $getUserByID = get_user_by('id', $activeCode);

            $getUsers = get_users(['meta_query' => [
                    [
                        'key' => '_user_reset_password_link',
                        'value' => '',
                        'compare' => '!='
                    ]
            ]]);

            if ($getUserByID->ID && is_array($getUsers) && count($getUsers) > 0) {
                update_user_meta($getUserByID->ID, '_user_reset_password_link', '');
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        $.notify('You can reset your password from here.', {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999/*showProgressbar: true,*/});
                        $('#userResetPasswordModal').modal('show');
                    });
                </script>
                <?php
            } else {
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        $.notify('Sorry!!! User not found.', {type: 'danger', delay: 5000, allow_dismiss: true, z_index: 9999/*showProgressbar: true,*/});
                        siteRedirection('<?php echo BASE_URL ?>', 5000);
                    });
                </script>
                <?php
            }
        }
    }

}

// Function to change email address
function wpb_sender_email( $original_email_address ) {
    return 'tim.smith@example.com';
}

// Function to change sender name
function custom_wp_mail_from_name( $original_email_from ) {
    return get_bloginfo('name');
}