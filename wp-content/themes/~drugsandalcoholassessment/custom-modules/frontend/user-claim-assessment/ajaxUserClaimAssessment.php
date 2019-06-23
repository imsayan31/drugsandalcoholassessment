<?php

/*
 *  AJAX :: Counselor Preparing For Claiming
 *  
 */
add_action('wp_ajax_preparing_for_claiming', 'ajaxUserPreparingForClaiming');

if (!function_exists('ajaxUserPreparingForClaiming')) {

    function ajaxUserPreparingForClaiming() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;
        $assessment_id = base64_decode($_POST['assessment']);
        $assessmentDetails = $GeneralThemeObject->assessment_details($assessment_id);
        $userDetails = $GeneralThemeObject->user_details($assessmentDetails->data['author']);

        $msg .= '<div class="row claim-data">';
        $msg .= '<div class="col-sm-4">Type:</div>';
        $msg .= '<div class="col-sm-8">'. get_the_title($assessmentDetails->data['product']) . '</div>';
        $msg .= '</div>';
        
        $msg .= '<div class="row claim-data">';
        $msg .= '<div class="col-sm-4">Client name:</div>';
        $msg .= '<div class="col-sm-8">'. $userDetails->data['fname'].' '. $userDetails->data['lname'] . '</div>';
        $msg .= '</div>';

        $msg .= '<div class="row claim-data">';
        $msg .= '<div class="col-sm-4">Email:</div>';
        $msg .= '<div class="col-sm-8">'. $userDetails->data['email'] . '</div>';
        $msg .= '</div>';

        $msg .= '<div class="row claim-data">';
        $msg .= '<div class="col-sm-4">Phone:</div>';
        $msg .= '<div class="col-sm-8">'. $assessmentDetails->data['assessment_user_phone'] . '</div>';
        $msg .= '</div>';

        $msg .= '<div class="row claim-data">';
        $msg .= '<div class="col-sm-4">Time Preference:</div>';
        $msg .= '<div class="col-sm-8">'. $assessmentDetails->data['assessment_user_time'] . '</div>';
        $msg .= '</div>';


        $resp_arr['flag'] = TRUE;
        //$resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
        $resp_arr['msg'] = $msg;

        echo json_encode($resp_arr);
        exit;
    }

}

/*
 *  AJAX :: Counselor Viewing Assessment Survey Report
 *  
 */
add_action('wp_ajax_view_survey_report', 'ajaxUserViewingAssessment');

if (!function_exists('ajaxUserViewingAssessment')) {

    function ajaxUserViewingAssessment() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;
        $assessment_id = base64_decode($_POST['assessment']);
        $assessmentDetails = $GeneralThemeObject->assessment_details($assessment_id);
        $userDetails = $GeneralThemeObject->user_details($assessmentDetails->data['author']);
        $assessmentQuestionAnswers = $assessmentDetails->data['assessment_question_answer'];

        $msg .= '<div class="table-responsive">';
        $msg .= '<table style="text-align:left;">';
        $msg .= '<thead>';

        // $msg .= '<tr>';
        // $msg .= '<th colspan="2"><strong>Customer\'s Survey Report</strong></th>';
        // $msg .= '</tr>';
        
        $msg .= '<tr>';
        $msg .= '<th><strong>Question</strong></th>';
        $msg .= '<th><strong>Customer Answer</strong></th>';
        $msg .= '</tr>';

        $msg .= '</thead>';

        $msg .= '<tbody>';
        if(is_array($assessmentQuestionAnswers) && count($assessmentQuestionAnswers) > 0){
            foreach ($assessmentQuestionAnswers as $eachQues => $eachAns) {
                $msg .= '<tr>';
                $msg .= '<td>'. $eachQues . '</td>';
                $msg .= '<td>'. $eachAns . '</td>';
                $msg .= '</tr>';
            }
        } else {
            $msg .= '<tr>';
                $msg .= '<td colspan="2">Not attended.</td>';
                $msg .= '</tr>';
        }
        
        $msg .= '</tbody>';
        $msg .= '</table>';
        $msg .= '</div>';

        $resp_arr['flag'] = TRUE;
        //$resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
        $resp_arr['msg'] = $msg;

        echo json_encode($resp_arr);
        exit;
    }

}


/*
 *  AJAX :: Customer Phone Assessment Update
 *  
 */
add_action('wp_ajax_user_claim_assessment', 'ajaxUserClaimAssessmentSubmit');

if (!function_exists('ajaxUserClaimAssessmentSubmit')) {

    function ajaxUserClaimAssessmentSubmit() { 
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        $assessment_id = base64_decode($_POST['user_claim_assessment_id']);
        $claim_assessment_date = $_POST['claim_assessment_date'];
        
        $assessmentDetails = $GeneralThemeObject->assessment_details($assessment_id);

        $userDetails = $GeneralThemeObject->user_details($assessmentDetails->data['author']);
        $counselorDetails = $GeneralThemeObject->user_details();

        update_post_meta($assessment_id, '_assessment_final_date_time', strtotime($claim_assessment_date));
        update_post_meta($assessment_id, '_assessment_order_status', 5);

        /* Send Email To User */
            $userMessageTemp = $GeneralThemeObject->getEmailTemplates('mail-to-customer-for-final-assessment-scheduling', ['{%user_name%}', '{%title%}', '{%counselor%}', '{%date_time%}', '{%counselor_contact_no%}'], [$userDetails->data['fname'].' '.$userDetails->data['lname'], $assessment_details->data['title'], get_the_title($assessmentDetails->data['product']), $counselorDetails->data['fname'].''. $counselorDetails->data['lname'], '$'. number_format($assessment_details->data['order_total'], 2), $assessment_details->data['payment_status_text'], date('d M, Y h:i', strtotime($claim_assessment_date)), $counselorDetails->data['phone']]);
            $userMailSubject = $userMessageTemp[0];
            $userMailTemp = $GeneralThemeObject->theme_email_template($userMessageTemp[1]);
            $GeneralThemeObject->send_email_func($userDetails->data['email'], $userMailSubject, $userMailTemp);

        $resp_arr['flag'] = TRUE;
        $resp_arr['url'] = COUNSELLOR_ACCOUNT_PAGE;
        $resp_arr['msg'] = 'Thanks for providing your available schedule.';

        echo json_encode($resp_arr);
        exit;
    }

}

