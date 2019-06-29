<?php

/*
 *  This  file contains all admin and front end scripts
 * 
 */

/*  Frontend Scripts  */
if (!function_exists('front_end_scripts')) {

    function front_end_scripts() {

        wp_enqueue_script('jquery');

        wp_register_script('bootstrap-js', ASSET_URL . '/js/bootstrap.js');
        wp_enqueue_script('bootstrap-js');

        wp_register_script('bootstrap-notify-js', ASSET_URL . '/js/bootstrap-notify.js');
        wp_enqueue_script('bootstrap-notify-js');

        wp_register_script('bootstrap-datetimepicker-js', ASSET_URL . '/js/bootstrap-datetimepicker.js');
        wp_enqueue_script('bootstrap-datetimepicker-js');

        wp_register_script('moment-js', ASSET_URL . '/js/moment.js');
        wp_enqueue_script('moment-js');

        wp_register_script('spin.min-js', ASSET_URL . '/js/spin.min.js');
        wp_enqueue_script('spin.min-js');

        wp_register_script('ladda.min-js', ASSET_URL . '/js/ladda.min.js');
        wp_enqueue_script('ladda.min-js');

        wp_register_script('jquery-ui-js', ASSET_URL . '/js/jquery-ui.js');
        wp_enqueue_script('jquery-ui-js');

        wp_register_script('chosen.jquery-js', ASSET_URL . '/js/chosen.jquery.js');
        wp_enqueue_script('chosen.jquery-js');

        wp_register_script('jquery.mask-js', ASSET_URL . '/js/jquery.mask.js');
        wp_enqueue_script('jquery.mask-js');

        /*wp_register_script('jquery-datatable-js', ASSET_URL . '/js/jquery.dataTables.min.js');
        wp_enqueue_script('jquery-datatable-js');*/

        wp_register_script('theme-js', ASSET_URL . '/js/theme.js');
        wp_enqueue_script('theme-js');

        wp_register_script('owl.carousel-js', ASSET_URL . '/js/owl.carousel.js');
        wp_enqueue_script('owl.carousel-js');

        wp_register_script('user-registration-js', THEME_URL . '/custom-modules/frontend/user-registration/user-registration.js');
        wp_enqueue_script('user-registration-js');

        wp_register_script('user-login-js', THEME_URL . '/custom-modules/frontend/user-login/user-login.js');
        wp_enqueue_script('user-login-js');

        wp_register_script('user-account-js', THEME_URL . '/custom-modules/frontend/user-account/user-account.js');
        wp_enqueue_script('user-account-js');

        wp_register_script('user-forgot-password-js', THEME_URL . '/custom-modules/frontend/user-forgot-password/user-forgot-password.js');
        wp_enqueue_script('user-forgot-password-js');

        wp_register_script('user-pickup-assessment-js', THEME_URL . '/custom-modules/frontend/user-pickup-assessment/user-pickup-assessment.js');
        wp_enqueue_script('user-pickup-assessment-js');

        wp_register_script('user-reset-password-js', THEME_URL . '/custom-modules/frontend/user-reset-password/user-reset-password.js');
        wp_enqueue_script('user-reset-password-js');

        wp_register_script('user-assessment-servey-questions-answers-js', THEME_URL . '/custom-modules/frontend/user-assessment-survey-qusetions/user-assessment-servey-questions-answers.js');
        wp_enqueue_script('user-assessment-servey-questions-answers-js');

        wp_register_script('user-phone-assessment-js', THEME_URL . '/custom-modules/frontend/user-phone-assessment/user-phone-assessment.js');
        wp_enqueue_script('user-phone-assessment-js');

        wp_register_script('user-claim-assessment-js', THEME_URL . '/custom-modules/frontend/user-claim-assessment/user-claim-assessment.js');
        wp_enqueue_script('user-claim-assessment-js');

        $passingObjs = [
            'baseurl' => BASE_URL,
            'ajaxurl' => admin_url('admin-ajax.php'),
            'facebook_app_id' => get_option('_facebook_app_id'),
            'linkedin_client_id' => get_option('_linkedin_client_id')
        ];

        wp_localize_script('theme-js', 'Front', $passingObjs);

        wp_localize_script('user-registration-js', 'Registration', $passingObjs);

        wp_localize_script('user-login-js', 'Login', $passingObjs);

        wp_localize_script('user-account-js', 'Account', $passingObjs);

        wp_localize_script('user-forgot-password-js', 'ForgotPassword', $passingObjs);

        wp_localize_script('user-reset-password-js', 'ResetPassword', $passingObjs);

        wp_localize_script('user-checkout-js', 'Checkout', $passingObjs);

        wp_localize_script('user-pickup-assessment-js', 'PickAssessment', $passingObjs);

        wp_localize_script('user-assessment-servey-questions-answers-js', 'SurveyQuestionAnswer', $passingObjs);

        wp_localize_script('user-phone-assessment-js', 'PhoneAssessment', $passingObjs);

        wp_localize_script('user-claim-assessment-js', 'ClaimAssessment', $passingObjs);
    }

}

/*  Frontend Styles  */
if (!function_exists('front_end_styles')) {

    function front_end_styles() {

        wp_register_style('bootstrap-css', ASSET_URL . '/css/bootstrap.css');
        wp_enqueue_style('bootstrap-css');

        wp_register_style('bootstrap-datetimepicker-css', ASSET_URL . '/css/bootstrap-datetimepicker.css');
        wp_enqueue_style('bootstrap-datetimepicker-css');

        wp_register_style('animate-css', ASSET_URL . '/css/animate.css');
        wp_enqueue_style('animate-css');

        wp_register_style('ladda-themeless.min-css', ASSET_URL . '/css/ladda-themeless.min.css');
        wp_enqueue_style('ladda-themeless.min-css');

        wp_register_style('custom-radio-style-css', ASSET_URL . '/css/custom-radio-style.css');
        wp_enqueue_style('custom-radio-style-css');

        wp_register_style('chosen-css', ASSET_URL . '/css/chosen.css');
        wp_enqueue_style('chosen-css');

        wp_register_style('font-awesome-css', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('font-awesome-css');

        wp_register_style('owl-carousel-css', ASSET_URL . '/css/owl.carousel.css');
        wp_enqueue_style('owl-carousel-css');

        // wp_register_style('owl.carousel-css', ASSET_URL . '/css/owl.carousel.css');
        // wp_enqueue_style('owl.carousel-css');

        // wp_register_style('password_strength-css', ASSET_URL . '/css/password_strength.css');
        // wp_enqueue_style('password_strength-css');

        // wp_register_style('custom-radio-style-css', ASSET_URL . '/css/custom-radio-style.css');
        // wp_enqueue_style('custom-radio-style-css');

        // wp_register_style('jquery-ui-css', ASSET_URL . '/css/jquery-ui.css');
        // wp_enqueue_style('jquery-ui-css');

        // wp_register_style('croppie-min-css', ASSET_URL . '/css/croppie.min.css');
        // wp_enqueue_style('croppie-min-css');

        // wp_register_style('jquery-dataTables-css', ASSET_URL . '/css/jquery.dataTables.min.css');
        // wp_enqueue_style('jquery-dataTables-css');

        wp_register_style('style-css', ASSET_URL . '/css/style.css');
        wp_enqueue_style('style-css');

        wp_register_style('custom-css', ASSET_URL . '/css/custom.css');
        wp_enqueue_style('custom-css');
    }

}

/*  Admin Scripts  */
if (!function_exists('admin_end_scripts')) {

    function admin_end_scripts() {

        wp_register_script('admin-jquery.mask-js', ASSET_URL . '/js/jquery.mask.js');
        wp_enqueue_script('admin-jquery.mask-js');

        wp_register_script('theme-admin-js', ASSET_URL . '/js/theme-admin.js');
        wp_enqueue_script('theme-admin-js');

        $passingObjs = [
            'baseurl' => BASE_URL,
            'ajaxurl' => admin_url('admin-ajax.php')
        ];

        wp_localize_script('theme-admin-js', 'Back', $passingObjs);
    }

}

/*  Admin Styles  */
if (!function_exists('admin_end_styles')) {

    function admin_end_styles() {

        wp_register_style('theme-admin-css', ASSET_URL . '/css/theme-admin.css');
        wp_enqueue_style('theme-admin-css');

        /* wp_register_style('jquery-ui-css', ASSET_URL . '/css/jquery-ui.css');
          wp_enqueue_style('jquery-ui-css'); */
    }

}
