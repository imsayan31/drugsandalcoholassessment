<?php

/*
 *  AJAX :: User LogIn
 *  
 */
add_action('wp_ajax_user_login', 'ajaxUserLogin');
add_action('wp_ajax_nopriv_user_login', 'ajaxUserLogin');

if (!function_exists('ajaxUserLogin')) {

    function ajaxUserLogin() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;
        $user_login_mail = strip_tags(trim($_POST['user_login_mail']));
        $user_login_pass = strip_tags(trim($_POST['user_login_pass']));
        $user_login_remember = $_POST['user_login_remember'];



        $getUserData = get_user_by('email', $user_login_mail);


        $activeStatus = get_user_meta($getUserData->ID, '_user_active_status', TRUE);
        $checkPassword = wp_check_password($user_login_pass, $getUserData->user_pass);



        $userDetails = $GeneralThemeObject->user_details($getUserData->ID);
        

        if (empty($user_login_mail)) {
            $msg = 'Enter your registered email.';
        } else if (!is_email($user_login_mail)) {
            $msg = 'Enter your registered email in proper format.';
        } else if (!email_exists($user_login_mail)) {
            $msg = 'Email you entered does not exist in our website. Please check and type again.';
        } else if (empty($user_login_pass)) {
            $msg = 'Enter your password.';
        } else if ($checkPassword == FALSE) {
            $msg = 'You have entered wrong password.';
        } else if ($activeStatus == 2) {
            $msg = 'Your registered account has not been activated yet. Please check your registered email id and and activate it to log in.';
        } else if ($userDetails->data['role'] == 'employer') {
            $msg = 'You are not allowed to log in from here. Please go to your panel and log in.';
        } else {
            $creds = [
                'user_login' => $user_login_mail,
                'user_password' => $user_login_pass,
                'remember' => ($user_login_remember == 1) ? true : false
            ];



            $userSignOn = wp_signon($creds);
            if (!is_wp_error($userSignOn)) {
                $GeneralThemeObject->setSiteCookie($user_login_mail, $user_login_pass, $user_login_remember);
                $resp_arr['flag'] = TRUE;
                if($userDetails->data['role'] == 'customer'){
                    $resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
                } else if($userDetails->data['role'] == 'counselor'){
                    $resp_arr['url'] = COUNSELLOR_ACCOUNT_PAGE;
                }
                
                $msg = 'Welcome to ' . get_bloginfo('name');
            } else {
                $msg = $userSignOn->get_error_message();
            }
        }

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}
