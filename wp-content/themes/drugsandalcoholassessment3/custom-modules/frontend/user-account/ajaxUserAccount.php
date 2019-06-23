<?php

/*
 *  AJAX :: Employer Account Update
 *  
 */
add_action('wp_ajax_employer_account', 'ajaxEmployerAccountUpdate');

if (!function_exists('ajaxEmployerAccountUpdate')) {

    function ajaxEmployerAccountUpdate() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        /* Form 1 data */
        $user_location = $_POST['user_location'];
        $user_zipcode = $_POST['user_zipcode'];

        /* Form 2 data */
        $user_first_name = strip_tags(trim($_POST['user_first_name']));
        $user_last_name = strip_tags(trim($_POST['user_last_name']));
        $user_assesment_reason = $_POST['user_assesment_reason'];

        /* Form 3 data */
        $user_phone = strip_tags(trim($_POST['user_phone']));

        $userDetails = $GeneralThemeObject->user_details();
        $userID = $userDetails->data['ID'];

        $zipcodeExists = term_exists($user_zipcode, THEME_PREFIX . 'zipcode');

        if (empty($user_first_name)) {
            $msg = 'Enter your first name.';
        } else if (!ctype_alpha($user_first_name)) {
            $msg = 'First name should only contain alphabets.';
        } else if (empty($user_last_name)) {
            $msg = 'Enter your last name.';
        } else if (!ctype_alpha($user_last_name)) {
            $msg = 'Last name should only contain alphabets.';
        } else if (empty($user_phone)) {
            $msg = 'Enter your phone number.';
        } 
        /*else if (!$zipcodeExists) {
            $msg = 'Sorry!!! Our service is not available at your area.';
        }*/
         else {

            /* Save User Meta Data */
            update_user_meta($userID, 'first_name', $user_first_name);
            update_user_meta($userID, 'last_name', $user_last_name);
            update_user_meta($userID, '_user_location', $user_location);
            update_user_meta($userID, '_user_zipcode', $user_zipcode);
            update_user_meta($userID, '_user_phone', $user_phone);
            update_user_meta($userID, '_assesment_reason', $user_assesment_reason);
            
            $msg = 'All data are saved.';
            $resp_arr['flag'] = TRUE;
            if($userDetails->data['role'] == 'customer'){
                $resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
            } else if($userDetails->data['role'] == 'counselor'){
                $resp_arr['url'] = COUNSELLOR_ACCOUNT_PAGE;
            }
            
        }

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}


add_action('wp_ajax_user_change_password', 'ajaxChangePassword');

if (!function_exists('ajaxChangePassword')) {

    function ajaxChangePassword() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $msg = NULL;
        $GeneralThemeObject = new GeneralTheme();
        $user_old_pass = strip_tags(trim($_POST['user_old_pass']));
        $user_new_pass = strip_tags(trim($_POST['user_new_pass']));
        $user_retype_new_pass = strip_tags(trim($_POST['user_retype_new_pass']));

        $userDetails = get_userdata(get_current_user_id());
        $passwordValidation = $GeneralThemeObject->passwordValidation($user_new_pass);

        if (empty($user_old_pass)) {
            $msg = 'Enter your old password.';
        } else if (!wp_check_password($user_old_pass, $userDetails->user_pass)) {
            $msg = 'Your old password not matched.';
        } else if (empty($user_new_pass)) {
            $msg = 'Enter your new password.';
        } elseif (strlen($user_new_pass) < 8) {
            $msg = 'Your new password should have at least 8 characters.';
        } 
        /*else if ($passwordValidation == FALSE) {
            $msg = 'Your password should contain one upper case letter, one special character and one number.';
        } */
         else if (strcmp($user_old_pass, $user_new_pass) == 0) {
            $msg = 'Your new password should be different from old one.';
        } else if (strcmp($user_new_pass, $user_retype_new_pass) != 0) {
            $msg = 'Re-type your new password for confirmation.';
        } else {

            /* Update user password */
            $updateUserData = [
                'ID' => get_current_user_id(),
                'user_pass' => $user_new_pass
            ];
            wp_update_user($updateUserData);
            $resp_arr['flag'] = TRUE;
            $msg = 'Your password has been successfully updated.';
        }

        $resp_arr['msg'] = $msg;

        echo json_encode($resp_arr);
        exit;
    }

}


add_action('wp_ajax_counselor_claim_assessment', 'ajaxCounselorClaimAssessment');

if (!function_exists('ajaxCounselorClaimAssessment')) {

    function ajaxCounselorClaimAssessment() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $msg = NULL;
        $GeneralThemeObject = new GeneralTheme();
        $assessment = base64_decode($_POST['assessment']);

        $assessmentDetails = $GeneralThemeObject->assessment_details($assessment_details);

        

        $resp_arr['msg'] = $msg;

        echo json_encode($resp_arr);
        exit;
    }

}
