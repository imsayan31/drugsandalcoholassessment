<?php

/*
 *  AJAX :: Zipcode Verification
 *  
 */
add_action('wp_ajax_zipcode_verification', 'ajaxZipcodeVerification');
add_action('wp_ajax_nopriv_zipcode_verification', 'ajaxZipcodeVerification');

if (!function_exists('ajaxZipcodeVerification')) {

    function ajaxZipcodeVerification() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        /* User Email */
        //$zipcode = strip_tags(trim($_POST['zipcode']));
        $user_location = $_POST['zipcode'];
        

        if (empty($user_location)) {
            $msg = 'Select your location.';
        } else {

            $zipcodeExists = term_exists($user_location, THEME_PREFIX . 'state');

            if($zipcodeExists){
                $resp_arr['flag'] = TRUE;
            } else{
                $msg = 'Sorry!!! Our service is not available at your area.';
            }

            
        }

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}


/*
 *  AJAX :: Send Verification Code
 *  
 */
add_action('wp_ajax_send_verification_code', 'ajaxSendVerificationCode');
add_action('wp_ajax_nopriv_send_verification_code', 'ajaxSendVerificationCode');

if (!function_exists('ajaxSendVerificationCode')) {

    function ajaxSendVerificationCode() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => '', 'verification_code' => '', 'user_email' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        /* User Email */
        $user_email = strip_tags(trim($_POST['user_email']));
        $user_first_name = strip_tags(trim($_POST['user_first_name']));
        $user_last_name = strip_tags(trim($_POST['user_last_name']));

        if (empty($user_first_name)) {
            $msg = 'Enter your first name.';
        } else if (!ctype_alpha($user_first_name)) {
            $msg = 'First name should only contain alphabets.';
        } else if (empty($user_last_name)) {
            $msg = 'Enter your last name.';
        } else if (!ctype_alpha($user_last_name)) {
            $msg = 'Last name should only contain alphabets.';
        } else if (empty($user_email)) {
            $msg = 'Enter your email.';
        } else if (!is_email($user_email)) {
            $msg = 'Email is not in coprrect format.';
        } else if (email_exists($user_email)) {
            $msg = 'Email already used by another user. Please try another.';
        } else {

            /* Create Verification Code */
            $randomCode = $GeneralThemeObject->generateRandomString(4);
            

            /* Send Verification Code To User */
            $userMessageTemp = $GeneralThemeObject->getEmailTemplates('mail-to-user-for-sending-verification-code', ['{%user_name%}', '{%verification_code%}'], [$user_first_name.' '. $user_last_name, $randomCode]);
            $userMailSubject = $userMessageTemp[0];
            $userMailTemp = $GeneralThemeObject->theme_email_template($userMessageTemp[1]);
            $GeneralThemeObject->send_email_func($user_email, $userMailSubject, $userMailTemp);

            $resp_arr['flag'] = TRUE;
            $resp_arr['verification_code'] = $randomCode;
            $resp_arr['user_email'] = $user_email;
            $resp_arr['url'] = COUNSELLOR_ACCOUNT_PAGE;
            $msg = 'Please check your email inbox/spam folder to get the 4 digit activation code and put it here.';
        }

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}



/*
 *  AJAX :: Customer Registration
 *  
 */
add_action('wp_ajax_customer_registration', 'ajaxCustomerRegistration');
add_action('wp_ajax_nopriv_customer_registration', 'ajaxCustomerRegistration');

if (!function_exists('ajaxCustomerRegistration')) {

    function ajaxCustomerRegistration() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => '', 'user_type' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        /* Initial Assesment data */
        $assessment_due_date = strip_tags(trim($_POST['assessment_due_date']));
        $assessment_type_confrm = $_POST['assessment_type_confrm'];
        $assessment_online_confrm = $_POST['assessment_online_confrm'];

        /* Form 1 data */
        $user_location = $_POST['user_location'];

        /* Form 2 data */
        $user_fname = strip_tags(trim($_POST['user_first_name']));
        $user_lname = strip_tags(trim($_POST['user_last_name']));
        $user_assesment_reason = $_POST['user_assesment_reason'];

        /* Form 3 data */
        // $user_email = strip_tags(trim($_POST['user_email']));
        // $user_phone = strip_tags(trim($_POST['user_phone']));
        // $user_password = strip_tags(trim($_POST['user_password']));
        // $user_cnf_password = strip_tags(trim($_POST['user_cnf_password']));
        // $user_type = $_POST['user_type'];

        $user_email = strip_tags(trim($_POST['duplicate_email_id']));
        $user_phone = strip_tags(trim($_POST['duplicate_phone']));
        $user_password = strip_tags(trim($_POST['duplicate_password']));
        $user_type = $_POST['duplicate_user_type'];
        $duplicate_user_location = $_POST['duplicate_user_location'];

        $user_terms_agree  = $_POST['user_terms_agree'];

        if (empty($user_location)) {
            $msg = 'Select your location.';
        } else if (empty($user_fname)) {
            $msg = 'Enter your first name.';
        } else if (!ctype_alpha($user_fname)) {
            $msg = 'First name should only contain alphabets.';
        } else if (empty($user_lname)) {
            $msg = 'Enter your last name.';
        } else if (!ctype_alpha($user_lname)) {
            $msg = 'Last name should only contain alphabets.';
        } else if (empty($user_email)) {
            $msg = 'Enter your email.';
        } else if (!is_email($user_email)) {
            $msg = 'Email is not in coprrect format.';
        } else if (email_exists($user_email)) {
            $msg = 'Email already used by another user. Please try another.';
        } else if (empty($user_phone)) {
            $msg = 'Enter your phone number.';
        } else if (empty($user_password)) {
            $msg = 'Enter your password.';
        } else if (strlen($user_password) < 8) {
            $msg = 'Password length should be minimum 8.';
        } 
        /*else if (empty($user_cnf_password)) {
            $msg = 'Confirm your password with original one.';
        } else if (strcmp($user_password, $user_cnf_password) != 0) {
            $msg = 'Confirm your password with original one.';
        }*/
         else if (empty($user_type)) {
            $msg = 'Select your user type.';
        } else if ($user_type != 'customer' && $user_type != 'counselor') {
            $msg = 'User type does not belong to our website.';
        } else {

            /* Create User */
            $userID = wp_create_user($user_email, $user_password, $user_email);
            $userData = new WP_User($userID);
            $userData->remove_role('subscriber');
            $userData->add_role($user_type);
            $randomCode = $GeneralThemeObject->generateRandomString(4);
            $activationLink = BASE_URL . '?active_code=' . base64_encode($randomCode);

            /* Save User Meta Data */
            update_user_meta($userID, 'first_name', $user_fname);
            update_user_meta($userID, 'last_name', $user_lname);

            //update_user_meta($userID, '_user_zipcode', $duplicate_user_location);
            update_user_meta($userID, '_user_phone', $user_phone);
            update_user_meta($userID, '_assesment_reason', $user_assesment_reason);
            update_user_meta($userID, '_user_terms_agree', $user_terms_agree);
            update_user_meta($userID, '_user_active_status', 1);
            update_user_meta($userID, '_user_location', $user_location);
            update_user_meta($userID, '_user_assessment_due_date', $assessment_due_date);
            update_user_meta($userID, '_user_assessment_type_confirmation', $assessment_type_confrm);
            update_user_meta($userID, '_user_assessment_online_cofirmation', $assessment_online_confrm);

            /* Send Email To User */
            $userMessageTemp = $GeneralThemeObject->getEmailTemplates('mail-to-user-for-creating-account', ['{%user_name%}'], [$user_fname.' '.$user_lname]);
            $userMailSubject = $userMessageTemp[0];
            $userMailTemp = $GeneralThemeObject->theme_email_template($userMessageTemp[1]);
            $GeneralThemeObject->send_email_func($user_email, $userMailSubject, $userMailTemp);

            /* Send Email To Admin */
            $admin_email = get_option('admin_email');
            $adminMessageTemp = $GeneralThemeObject->getEmailTemplates('mail-to-admin-for-user-registration', ['{%user_name%}', '{%user_role%}', '{%blog_name%}', '{%email%}', '{%contact_no%}'], [$user_fname.' '. $user_lname, ucfirst($user_type), get_bloginfo('name'), $user_email, $user_phone]);
            $adminMailSubject = $adminMessageTemp[0];
            $adminMailTemp = $GeneralThemeObject->theme_email_template($adminMessageTemp[1]);
            $GeneralThemeObject->send_email_func($admin_email, $adminMailSubject, $adminMailTemp);

            /* Auto Login */
            $GeneralThemeObject->autoLogin($user_email);

            $resp_arr['flag'] = TRUE;
            $msg = 'Thanks for showing ineterst with us. Your account has been created and verified successfully.';
            $resp_arr['url'] = ($user_type == 'customer') ? CUSTOMER_ACCOUNT_PAGE : COUNSELLOR_ACCOUNT_PAGE;
            
        }

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}
