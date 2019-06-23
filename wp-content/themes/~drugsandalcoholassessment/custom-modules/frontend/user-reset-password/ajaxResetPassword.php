<?php

/*
 *  AJAX :: User Forgot Password
 *  
 */
add_action('wp_ajax_user_reset_password', 'ajaxResetPassword');
add_action('wp_ajax_nopriv_user_reset_password', 'ajaxResetPassword');

if (!function_exists('ajaxResetPassword')) {

    function ajaxResetPassword() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;
        $user_new_pass = strip_tags(trim($_POST['user_new_pass']));
        $user_retype_new_pass = strip_tags(trim($_POST['user_retype_new_pass']));
        $user_id = base64_decode($_POST['user_data']);
        $passwordValidation = $GeneralThemeObject->passwordValidation($user_new_pass);

        if (empty($user_new_pass)) {
            $msg = 'Enter your new password.';
        } else if ($passwordValidation == FALSE) {
            $msg = 'Your password should contain one upper case letter, one special character and one number.';
        } else if (empty($user_retype_new_pass)) {
            $msg = 'Retype your new password.';
        } else if (strcmp($user_new_pass, $user_retype_new_pass)) {
            $msg = 'Your new password not matched.';
        } else {

            $userUpdatedData = [
                'ID' => $user_id,
                'user_pass' => $user_new_pass
            ];

            wp_update_user($userUpdatedData);

            $resp_arr['flag'] = TRUE;
            $msg = 'Your password has been reset successfully.';
            $resp_arr['url'] = BASE_URL;
        }

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}
