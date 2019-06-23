<?php

/*
 *  AJAX :: User Forgot Password
 *  
 */
add_action('wp_ajax_user_forgot_password', 'ajaxForgotPassword');
add_action('wp_ajax_nopriv_user_forgot_password', 'ajaxForgotPassword');

if (!function_exists('ajaxForgotPassword')) {

    function ajaxForgotPassword() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;
        $user_forgot_email = strip_tags(trim($_POST['user_forgot_email']));
        
        if (empty($user_forgot_email)) {
            $msg = 'Enter your regsistered email.';
        } else if (!is_email($user_forgot_email)) {
            $msg = 'Enter email in proper format.';
        } else if (!email_exists($user_forgot_email)) {
            $msg = 'Email does not exist in our website.';
        } else {
            
            $getUserBy = get_user_by('email', $user_forgot_email);
            $resetPasswordLink = BASE_URL . '?reset_pass=' . base64_encode($getUserBy->ID);
            update_user_meta($getUserBy->ID, '_user_reset_password_link', $resetPasswordLink);
            
            /* Send Email To User */
            $userMessageTemp = $GeneralThemeObject->getEmailTemplates('mail-to-user-forgot-password', ['{%fname%}', '{%lname%}', '{%reset_password_link%}'], [$getUserBy->first_name, $getUserBy->last_name, $resetPasswordLink]);
            $userMailSubject = $userMessageTemp[0];
            $userMailTemp = $GeneralThemeObject->theme_email_template($userMessageTemp[1]);
            $GeneralThemeObject->send_email_func($user_forgot_email, $userMailSubject, $userMailTemp);
            
            $resp_arr['flag'] = TRUE;
            $msg = 'We have sent an reset password link on your registered email. Please check.';
            $resp_arr['url'] = BASE_URL;
        }

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}
