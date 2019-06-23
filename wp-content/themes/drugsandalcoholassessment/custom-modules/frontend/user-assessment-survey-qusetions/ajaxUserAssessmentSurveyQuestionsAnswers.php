<?php

/*
 *  AJAX :: Prepare Survey Set 1
 *  
 */
add_action('wp_ajax_get_question_set_1', 'ajaxGetSurveySet1');
add_action('wp_ajax_nopriv_get_question_set_1', 'ajaxGetSurveySet1');

if (!function_exists('ajaxGetSurveySet1')) {

    function ajaxGetSurveySet1() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => '', 'set_1_ques' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;
        $questSet1Arr = [];
        $product_id = base64_decode($_POST['product']);

        $getRandomSurveyQuestions = $GeneralThemeObject->getRandomSurveyQuestions();

        if(is_array($getRandomSurveyQuestions) && count($getRandomSurveyQuestions) > 0){
            foreach ($getRandomSurveyQuestions as $eachSurveyQues) {
                $questSet1Arr[] = $eachSurveyQues;
                $getSurveyDetails = $GeneralThemeObject->survey_details($eachSurveyQues);
                $getAnswers = $getSurveyDetails->data['answers'];
                $msg .= '<div class="row justify-content-md-center random-ques-set">';
                $msg .= '<input type="hidden" name="survey_question_list[]" value="'. $eachSurveyQues .'"/>';
                $msg .= '<div class="col-md-10">';
                $msg .= '<div class="form-group">';
                $msg .= '<span>'. $getSurveyDetails->data['title'] .'</span>';
                $msg .= '<div>';
                $msg .= '<select name="survey_answer_list[]" class="survey_answers form-control">';
                $msg .= '<option value="">-Select an answer-</option>';
                if(is_array($getAnswers) && count($getAnswers) > 0){
                    foreach ($getAnswers as $eachAnswer) {
                        $msg .= '<option value="'. $eachAnswer .'">'. $eachAnswer .'</option>';
                    }
                }
                $msg .= '</select>';
                $msg .= '</div>';
                $msg .= '</div>';
                $msg .= '</div>';
                $msg .= '</div>';
            }
        }

        $resp_arr['flag'] = TRUE;
        $resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
        $resp_arr['set_1_ques'] = serialize($questSet1Arr);
        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}


/*
 *  AJAX :: Prepare Survey Set 2
 *  
 */
add_action('wp_ajax_get_question_set_2', 'ajaxGetSurveySet2');

if (!function_exists('ajaxGetSurveySet2')) {

    function ajaxGetSurveySet2() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => '', 'set_1_ques' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;
        $questSet1Arr = [];
        $product_id = base64_decode($_POST['main_product_id']);
        $exclude_question_id = unserialize($_POST['exclude_question_id']);

        $getRandomSurveyQuestions = $GeneralThemeObject->getRandomSurveyQuestions($exclude_question_id);

        if(is_array($getRandomSurveyQuestions) && count($getRandomSurveyQuestions) > 0){
            foreach ($getRandomSurveyQuestions as $eachSurveyQues) {
                $questSet1Arr[] = $eachSurveyQues;
                $getSurveyDetails = $GeneralThemeObject->survey_details($eachSurveyQues);
                $getAnswers = $getSurveyDetails->data['answers'];
                $msg .= '<div class="row justify-content-md-center random-ques-set">';
                $msg .= '<input type="hidden" name="survey_question_list[]" value="'. $eachSurveyQues .'"/>';
                $msg .= '<div class="col-md-10">';
                $msg .= '<div class="form-group">';
                $msg .= '<span>'. $getSurveyDetails->data['title'] .'</span>';
                $msg .= '<div>';
                $msg .= '<select name="survey_answer_list[]" class="survey_answers form-control">';
                $msg .= '<option value="">-Select an answer-</option>';
                if(is_array($getAnswers) && count($getAnswers) > 0){
                    foreach ($getAnswers as $eachAnswer) {
                        $msg .= '<option value="'. $eachAnswer .'">'. $eachAnswer .'</option>';
                    }
                }
                $msg .= '</select>';
                $msg .= '</div>';
                $msg .= '</div>';
                $msg .= '</div>';
                $msg .= '</div>';
            }
        }


        $resp_arr['flag'] = TRUE;
        $resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
        //$resp_arr['set_1_ques'] = serialize($questSet1Arr);
        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}


/*
 *  AJAX :: Customer Survey Submit
 *  
 */
add_action('wp_ajax_customer_survey', 'ajaxCustomerServeySubmit');
add_action('wp_ajax_nopriv_customer_survey', 'ajaxCustomerServeySubmit');

if (!function_exists('ajaxCustomerServeySubmit')) {

    function ajaxCustomerServeySubmit() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => '', 'set_1_ques' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;
        $questSet1Arr = [];
        $product_id = base64_decode($_POST['main_product_id']);
        $assessment_id = base64_decode($_POST['main_assessment_id']);
        $survey_question_list = $_POST['survey_question_list'];
        $survey_answer_list = $_POST['survey_answer_list'];
        
        $question_answer_set = [];

        if(is_array($survey_question_list) && count($survey_question_list) > 0){
            foreach ($survey_question_list as $key => $value) {
                $getQuestionTitle = get_the_title($value);
                if (!empty($survey_answer_list[$key])) {
                    $question_answer_set[$getQuestionTitle] = $survey_answer_list[$key];
                } else {
                    $question_answer_set[$getQuestionTitle] = 'Not answered.';
                }
            }
        }

        // update_post_meta($assessment_id, '_assessment_order_status', 2);
        // update_post_meta($assessment_id, '_assessment_question_answer_set', $question_answer_set);
        
        $msg = 'Thanks for your time. Your survey has been completed. Now pick up your first assessment.';

        $resp_arr['flag'] = TRUE;
        $resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
        $resp_arr['msg'] = $msg;
        $resp_arr['set_1_ques'] = serialize($question_answer_set);

        echo json_encode($resp_arr);
        exit;
    }

}