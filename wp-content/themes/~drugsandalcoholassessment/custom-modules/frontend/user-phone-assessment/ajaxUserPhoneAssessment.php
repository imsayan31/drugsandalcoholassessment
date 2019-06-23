<?php

/*
 *  AJAX :: Customer Phone Assessment Submit
 *  
 */
add_action('wp_ajax_user_phone_assessment', 'ajaxUserPhoneAssessmentSubmit');

if (!function_exists('ajaxUserPhoneAssessmentSubmit')) {

    function ajaxUserPhoneAssessmentSubmit() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        $product_id = base64_decode($_POST['user_phone_assessment_product_id']);
        $assessment_id = base64_decode($_POST['user_phone_assessment_id']);
        $phone_assessmet_number = strip_tags(trim($_POST['phone_assessmet_number']));
        $phone_assessment_time = $_POST['phone_assessment_time'];

        update_post_meta($assessment_id, '_assessment_user_phone_number', $phone_assessmet_number);
        update_post_meta($assessment_id, '_assessment_user_time', $phone_assessment_time);
        update_post_meta($assessment_id, '_assessment_order_status', 3);

        $resp_arr['flag'] = TRUE;
        $resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
        $resp_arr['msg'] = 'Thanks for providing your available schedule.';

        echo json_encode($resp_arr);
        exit;
    }

}


/*
 *  AJAX :: Customer Phone Assessment Update
 *  
 */
add_action('wp_ajax_get_phone_assessment_data', 'ajaxGetPhoneAssessmentData');

if (!function_exists('ajaxGetPhoneAssessmentData')) {

    function ajaxGetPhoneAssessmentData() { 
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => '', 'phone_number' => '', 'assmnt_time' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        $assessment_id = base64_decode($_POST['assessment_id']);
        $assessmentDetails = $GeneralThemeObject->assessment_details($assessment_id);

        $resp_arr['flag'] = TRUE;
        $resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
        $resp_arr['phone_number'] = $assessmentDetails->data['assessment_user_phone'];
        $resp_arr['assmnt_time'] = $assessmentDetails->data['assessment_user_time'];
        $resp_arr['msg'] = 'Thanks for providing your available schedule.';

        echo json_encode($resp_arr);
        exit;
    }

}