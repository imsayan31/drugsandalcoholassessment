<?php

/*
 *  All files initialization area
 * 
 */
require THEME_INC . '/theme-admin-menu.php';
require THEME_INC . '/theme-core.php';
require THEME_INC . '/theme-functions.php';
require THEME_INC . '/theme-scripts.php';
require THEME_INC . '/theme-meta-boxes.php';

require THEME_LIB . '/GeneralTheme.php';
//require THEME_LIB . '/woo-paypal-pro-gateway-class.php';
require THEME_LIB . '/stripe-lib/init.php';
/*require THEME_LIB . '/subscription-list-table.php';
require THEME_LIB . '/subscription-details-list-table.php';*/

/*
 *  All Actions & Filters
 *  
 */

add_action('init', 'theme_core_setup');
add_action('wp_head', 'userAccountActivation');
add_action('wp_head', 'userResetPasswordActivation');
add_action('admin_menu', 'theme_admin_menu');
add_action('wp_enqueue_scripts', 'front_end_scripts');
add_action('wp_enqueue_scripts', 'front_end_styles');
add_action('admin_enqueue_scripts', 'admin_end_scripts');
add_action('admin_enqueue_scripts', 'admin_end_styles');
add_action('after_setup_theme', 'theme_setup_func');
add_action('show_user_profile', 'extra_user_profile_fields');
add_action('edit_user_profile', 'extra_user_profile_fields');
add_action('personal_options_update', 'save_extra_user_profile_fields');
add_action('edit_user_profile_update', 'save_extra_user_profile_fields');
add_action('add_meta_boxes_' . THEME_PREFIX . 'survey_question', 'adding_custom_meta_boxes');
add_action('add_meta_boxes_' . THEME_PREFIX . 'assessment', 'adding_custom_meta_boxes_assessment');
add_action('save_post', 'saveSurveyDataFields');

add_filter('show_admin_bar', '__return_false');
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'custom_wp_mail_from_name' );

function theme_setup_func() {

    add_role('customer', __('Customer'));
    add_role('counselor', __('Counselor'));

    //add_image_size('home_event_images', 355, 235);
    //add_image_size('home_celebrity_images', 360, 270);
    //add_image_size('home_testimonial_images', 85, 85);

}

/*
 *  All Pages
 *  
 */

if (!defined('BASE_URL'))
    define('BASE_URL', get_bloginfo('url') . '/');

if (!defined('CANDIDATE_REGISTRATION_PAGE'))
    define('CANDIDATE_REGISTRATION_PAGE', BASE_URL . 'candidate-registration');

if (!defined('COUNSELLOR_ACCOUNT_PAGE'))
    define('COUNSELLOR_ACCOUNT_PAGE', BASE_URL . 'counsellor-account');

if (!defined('USER_REGISTRATION_PAGE'))
    define('USER_REGISTRATION_PAGE', BASE_URL . 'user-registration');

if (!defined('CUSTOMER_ACCOUNT_PAGE'))
    define('CUSTOMER_ACCOUNT_PAGE', BASE_URL . 'customer-account');

if (!defined('EMPLOYER_DASHBOARD_PAGE'))
    define('EMPLOYER_DASHBOARD_PAGE', BASE_URL . 'employer-dashboard');

if (!defined('CHECKOUT_PAGE'))
    define('CHECKOUT_PAGE', BASE_URL . 'checkout');

if (!defined('ABOUT_US_PAGE'))
    define('ABOUT_US_PAGE', BASE_URL . 'about');

if (!defined('CONTACT_US_PAGE'))
    define('CONTACT_US_PAGE', BASE_URL . 'contact');

if (!defined('TERMS_CONDITION_PAGE'))
    define('TERMS_CONDITION_PAGE', BASE_URL . 'terms-conditions');

if (!defined('BLOG_PAGE'))
    define('BLOG_PAGE', BASE_URL . 'blog');


/*
 *  All Tables
 *  
 */
/*if (!defined('TBL_SUBSCRIPTION'))
    define('TBL_SUBSCRIPTION', THEME_PREFIX . 'subscription');*/

/*
 *  All Admin Modules
 *  
 */
//require ADMIN_MODULE . '/user-participants/user-participants.php';
require ADMIN_MODULE . '/user-details-section/user-details-section.php';
//require ADMIN_MODULE . '/job-details-section/job-details-section.php';
//require ADMIN_MODULE . '/subscribed-employers/subscribed-employers.php';

/*
 *  All Frontend Modules
 *  
 */
require FRONTEND_MODULE . '/user-registration/ajaxUserRegistration.php';
require FRONTEND_MODULE . '/user-login/ajaxUserLogin.php';
require FRONTEND_MODULE . '/user-account/ajaxUserAccount.php';
require FRONTEND_MODULE . '/user-forgot-password/ajaxForgotPassword.php';
require FRONTEND_MODULE . '/user-reset-password/ajaxResetPassword.php';
require FRONTEND_MODULE . '/user-pickup-assessment/ajaxUserPickupAssessment.php';
require FRONTEND_MODULE . '/user-assessment-survey-qusetions/ajaxUserAssessmentSurveyQuestionsAnswers.php';
require FRONTEND_MODULE . '/user-phone-assessment/ajaxUserPhoneAssessment.php';
require FRONTEND_MODULE . '/user-claim-assessment/ajaxUserClaimAssessment.php';
