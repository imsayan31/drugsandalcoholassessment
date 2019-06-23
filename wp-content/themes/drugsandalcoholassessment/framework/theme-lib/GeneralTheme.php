<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneralTheme
 *
 * @author sbr
 */
class GeneralTheme {

    public function __construct() {
        global $wpdb;
        $this->db = &$wpdb;
        $this->resume_file_type = ['docx', 'doc', 'pdf'];
    }

    public function send_email_func($to, $subject, $message, $attachments = array()) {

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        //$headers .= 'From: <webmaster@example.com>' . "\r\n";

        wp_mail($to, $subject, $message, $headers, $attachments);
    }

    public function theme_email_template($email_template) {
        $message = '<!DOCTYPE html>';
        $message .= '<html>';
        $message .= '<head>';
        $message .= '<title>' . get_bloginfo('name') . '</title>';
        $message .= '</head>';
        $message .= '<body>';
        $message .= '<table style="border: 5px solid #5695d0;width: 100%;height: 150px;">';
        $message .= '<tr>';
        $message .= '<th><a href="' . BASE_URL . '"><img src="' . ASSET_URL . '/images/logo.png' . '" style="padding:10px;"/></a></th>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= '<table style="border: 5px solid #5695d0;width: 100%;border-top: none;padding:10px;">';
        $message .= $email_template;
        $message .= '</table>';
        $message .= '<table style="width:100%;background-color:#333;border: 5px solid #333;">';
        $message .= '<tr>';
        $message .= '<th style="padding:12px;"><span style="color:#fff;font-size:15px; font-weight: normal;font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;">&copy; Copyright ' . date('Y') . ' All Rights Reserved.</span></th>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= '</body>';
        $message .= '</html>';

        return $message;
    }

    public function getEmailTemplates($mail_name, array $replacingStrings, array $replacedStrings) {
        $getMailTemplates = new WP_Query(['post_type' => THEME_PREFIX . 'mail_template', 'name' => $mail_name]);
        if ($getMailTemplates->have_posts()) {
            while ($getMailTemplates->have_posts()) {
                $getMailTemplates->the_post();
                $getMailContent = str_replace($replacingStrings, $replacedStrings, get_the_content());
                $getMailSubject = get_post_meta(get_the_ID(), 'mail_subject', TRUE);
            }
        }
        $returnedVal[0] = $getMailSubject;
        $returnedVal[1] = $getMailContent;
        return $returnedVal;
    }

    public function setSiteCookie($userEmail, $userPass, $userRember) {
        if ($userRember == 1) {
            /* $set_remember_user_data['user_email'] = $userEmail;
              $set_remember_user_data['user_pass'] = $userPass;
              $set_remember_user_data['user_remember'] = $userRember; */
            setcookie('set_remember_user_email', $userEmail, time() + (86400 * 30), '/', '.' . $_SERVER['SERVER_NAME']);
            setcookie('set_remember_user_password', $userPass, time() + (86400 * 30), '/', '.' . $_SERVER['SERVER_NAME']);
        } else {
            setcookie('set_remember_user_email', '', time() - 3600, '/', '.' . $_SERVER['SERVER_NAME']);
            setcookie('set_remember_user_password', '', time() - 3600, '/', '.' . $_SERVER['SERVER_NAME']);
        }
    }

    public function getSiteCookie() {
        $getUserCookieData = new stdClass();
        if (isset($_COOKIE['set_remember_user_email']) && $_COOKIE['set_remember_user_email'] != '' && isset($_COOKIE['set_remember_user_password']) && $_COOKIE['set_remember_user_password'] != '') {
            $getUserCookieData->user_email = $_COOKIE['set_remember_user_email'];
            $getUserCookieData->user_pass = $_COOKIE['set_remember_user_password'];
        }
        return $getUserCookieData;
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function common_file_upload($uploadedFile) {
        if (!function_exists('wp_handle_upload')) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }

        $upload_overrides = array('test_form' => false);

        $movefile = wp_handle_upload($uploadedFile, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            return $movefile;
        } else {
            return $movefile['error'];
        }
    }

    public function create_attachment($uploadedFile) {
        $filename = $uploadedFile['file'];

        $attachment = array(
            'guid' => $uploadedFile['url'],
            'post_mime_type' => $uploadedFile['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $filename);

        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
        wp_update_attachment_metadata($attach_id, $attach_data);
        return $attach_id;
    }

    public function insertDataIntoTable($tableName, array $data) {
        $inserted_id = $this->db->insert($tableName, $data);
        return $inserted_id;
    }

    public function updateDataInTable($tableName, array $updatedData, array $whereData) {
        $updatedRows = $this->db->update($tableName, $updatedData, $whereData);
        return $updatedRows;
    }

    public function deleteDataFromTable($tableName, array $whereData) {
        $deletedRows = $this->db->delete($tableName, $whereData);
        return $deletedRows;
    }

    public function fetchDataFromTable($tableName, $selectQuery = NULL) {
        $fetchQuery = "SELECT * FROM " . $tableName . " WHERE `ID` != ''";
        if ($selectQuery) {
            $fetchQuery .= $selectQuery;
        }
        $fetchQueryResults = $this->db->get_results($fetchQuery);
        return $fetchQueryResults;
    }

    public function autoLogin($email) {
        $chk_user = get_user_by('email', $email);
        wp_set_current_user($chk_user->ID, $chk_user->user_login);
        wp_set_auth_cookie($chk_user->ID);
        do_action('wp_login', $chk_user->user_login);
    }

    public function user_details($user_id = NULL) {
        if (!$user_id) {
            $user_id = get_current_user_id();
        }
        $userObject = new stdClass();
        $getUserData = get_user_by('id', $user_id);

        $userLocation = get_user_meta($user_id, '_user_location', TRUE);
        $getLocationDetails = get_terms(THEME_PREFIX.'state',['hide_empty' => FALSE, 'meta_query' => [
            [
                'key' => 'shortname',
                'value' => $userLocation,
                'compare' => '=',
            ]
        ]]);


        $userObject->data = [
            'ID' => $user_id,
            'user_name' => $getUserData->user_login,
            'email' => $getUserData->user_email,
            'role' => $getUserData->roles[0],
            'fname' => get_user_meta($user_id, 'first_name', TRUE),
            'lname' => get_user_meta($user_id, 'last_name', TRUE),
            'activation_code' => get_user_meta($user_id, '_user_active_code', TRUE),
            'active_status' => get_user_meta($user_id, '_user_active_status', TRUE),
            'assessment_reason' => get_user_meta($user_id, '_assesment_reason', TRUE),
            'location' => get_user_meta($user_id, '_user_location', TRUE),
            'location_display_name' => $getLocationDetails[0]->name,
            'zipcode' => get_user_meta($user_id, '_user_zipcode', TRUE),
            'phone' => get_user_meta($user_id, '_user_phone', TRUE),
            'assessment_due_date' => get_user_meta($user_id, '_user_assessment_due_date', TRUE),
            'type_confirmation' => get_user_meta($user_id, '_user_assessment_type_confirmation', TRUE),
            'onile_confirmation' => get_user_meta($user_id, '_user_assessment_online_cofirmation', TRUE),
        ];

        return (object) $userObject;
    }

    public function getLocation($state_id = NULL) {
        $getLocationArgs = ['taxonomy' => THEME_PREFIX . 'state', 'hide_empty' => FALSE];
        if ($state_id) {
            $getLocationArgs['parent'] = $state_id;
        } else {
            $getLocationArgs['parent'] = 0;
        }
        $getLocations = get_terms($getLocationArgs);
        return $getLocations;
    }

    public function product_details($job_id) {
        $jobDetails = new stdClass();
        $jobData = get_post($job_id);


        $jobPrice = get_post_meta($job_id, 'product_price', TRUE);

        $jobDetails->data = [
            'ID' => $job_id,
            'title' => $jobData->post_title,
            'content' => $jobData->post_content,
            'author' => $jobData->post_author,
            'date' => $jobData->post_date,
            'product_price' => $jobPrice
        ];

        return (object) $jobDetails;
    }

    public function passwordValidation($password) {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $password)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function userNameValidation($name) {
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function populateMonths() {
        $monthArr = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];
        return $monthArr;
    }

    public function is_valid_card_number($toCheck) {
        if (!is_numeric($toCheck))
            return false;

        $number = preg_replace('/[^0-9]+/', '', $toCheck);
        $strlen = strlen($number);
        $sum = 0;

        if ($strlen < 13)
            return false;

        for ($i = 0; $i < $strlen; $i++) {
            $digit = substr($number, $strlen - $i - 1, 1);
            if ($i % 2 == 1) {
                $sub_total = $digit * 2;
                if ($sub_total > 9) {
                    $sub_total = 1 + ($sub_total - 10);
                }
            } else {
                $sub_total = $digit;
            }
            $sum += $sub_total;
        }

        if ($sum > 0 AND $sum % 10 == 0)
            return true;

        return false;
    }

    /* public function is_valid_card_type($toCheck) {
      return $toCheck AND in_array($toCheck, self::$acceptable_cards);
      } */

    public function is_valid_expiry($month, $year) {
        $now = time();
        $thisYear = (int) date('Y', $now);
        $thisMonth = (int) date('m', $now);

        if (is_numeric($year) && is_numeric($month)) {
            $thisDate = mktime(0, 0, 0, $thisMonth, 1, $thisYear);
            $expireDate = mktime(0, 0, 0, $month, 1, $year);

            return $thisDate <= $expireDate;
        }

        return false;
    }

    public function is_valid_cvv_number($toCheck) {
        $length = strlen($toCheck);
        return is_numeric($toCheck) AND $length > 2 AND $length < 5;
    }


    public function get_zipcodes_by_radius($zip, $radius, $type = NULL) {
        $d = $radius;
        //$r = 3959; //earth's radius in miles
        $r = 6371.39; //earth's radius in km
        $listedZips = [];

        /* $zip = 711204;
          $radius = 2; */

        $getLatLng = " AND `zipcode`='" . $zip . "'";
        $getZipcodeDetails = $this->getDataFromGeoLocationTbl($getLatLng);

        $latitude = $getZipcodeDetails[0]->latitude;
        $longitude = $getZipcodeDetails[0]->longitude;

        $newSQL = "SELECT zipcode,"
                . "( $r * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( latitude ) ) ) )"
                . " AS distance "
                . "FROM " . TBL_GEO_LOCATION . " "
                . "HAVING distance < $radius "
                . "LIMIT 0 , 20;";

        $getResultantLocations = $this->db->get_results($newSQL);

        if (is_array($getResultantLocations) && count($getResultantLocations) > 0) {
            foreach ($getResultantLocations as $eachResultantZipcode) {
                $listedZips[] = $eachResultantZipcode->zipcode;
            }
            $uniqueZipCodes = array_unique($listedZips);
        }

        return $uniqueZipCodes;
    }

    public function getFileSize($file) {
        $bytes = filesize(get_attached_file($file));
        $s = array('b', 'Kb', 'Mb', 'Gb');
        $e = floor(log($bytes) / log(1024));
        return sprintf('%.2f ' . $s[$e], ($bytes / pow(1024, floor($e))));
    }

    public function getFileName($file) {
        $fileName = basename(get_attached_file($file));
        return $fileName;
    }

    public function getFileURL($file) {
        $fileURL = wp_get_attachment_url($file);
        return $fileURL;
    }

    public function getFilePath($file) {
        $filePath = get_attached_file($file);
        return $filePath;
    }

    public function dateDiff($d1, $d2) {
        return round(abs(strtotime($d1) - strtotime($d2)) / 86400);
    }

    public function insertIntoGeoLocationTbl(array $data) {
        $insertedID = $this->db->insert(TBL_GEO_LOCATION, $data);
        return $insertedID;
    }

    public function getDataFromGeoLocationTbl($searchParams = NULL) {
        $getDataFromGeoLocationQuery = "SELECT * FROM " . TBL_GEO_LOCATION . " WHERE `ID`!=''";
        if ($searchParams) {
            $getDataFromGeoLocationQuery .= $searchParams;
        }
        $getDataFromGeoLocationQueryRes = $this->db->get_results($getDataFromGeoLocationQuery);
        return $getDataFromGeoLocationQueryRes;
    }

    public function updateGeoLocationTbl(array $updatedData, array $whereData) {
        $updatedResult = $this->db->update(TBL_GEO_LOCATION, $updatedData, $whereData);
        return $updatedResult;
    }

    public function checkGeoLocationExists($place_id, $lat, $lng, $address, $zipcode) {
        $existanceQuery = " AND `place_id`='" . $place_id . "' AND `latitude`='" . $lat . "' AND `longitude`='" . $lng . "'";
        $getResults = $this->getDataFromGeoLocationTbl($existanceQuery);
        if (is_array($getResults) && count($getResults) > 0) {
            return TRUE;
        } else {
            $insertedDataArgs = [
                'place_id' => $place_id,
                'address' => $address,
                'zipcode' => $zipcode,
                'latitude' => $lat,
                'longitude' => $lng,
            ];
            $insertIntoGeoLocation = $this->insertIntoGeoLocationTbl($insertedDataArgs);
            return $insertIntoGeoLocation;
        }
    }

    public function getProducts(){
        $getAssessments = get_posts(['post_type' => THEME_PREFIX.'product', 'posts_per_page' => -1]);
        return $getAssessments;
    }

    public function getAssessmentStatus(){
        $getAssesmentStatus = get_terms(THEME_PREFIX . 'status', ['hide_empty' => FALSE]);
        return $getAssessmentStatus;
    }

    public function getAssessmentStatusDetails($assessment){
        // $assessmentObject = new stdClass();
        // $getAssessmentDetails = get_term_by('slug', $assessment, THEME_PREFIX . 'status');

        // $assessmentObject->data = [
        //     'id' => $getAssessmentDetails->term_id,
        //     'name' => $getAssessmentDetails->name,
        //     'slug' => $getAssessmentDetails->slug,
        //     'status_description' => $getAssessmentDetails->term_id,
        // ];
    }

    public function getCustomerAssessments($user_id){
        $getUserAssessments = get_posts(['post_type' => THEME_PREFIX.'assessment', 'author' => $user_id, 'posts_per_page' => -1]);
        return $getUserAssessments;
    }

    public function assessment_details($assessment_id){
        $assessmentObj = new stdClass();
        $assessmentDetails = get_post($assessment_id);

        $paymentStatus = get_post_meta($assessment_id, '_assessment_payment_status', true);
        $orderStatus = get_post_meta($assessment_id, '_assessment_order_status', true);
        $getFinalInterviewTime = get_post_meta($assessment_id, '_assessment_final_date_time', true);

if($getFinalInterviewTime){
    $finalDate = date('Y-m-d', $getFinalInterviewTime);
        $todayDate = date('Y-m-d');

        $date1=date_create($finalDate);
        $date2=date_create($todayDate);
        $diff=date_diff($date1,$date2);

        $totalDiff = $diff->format("%a days");
    } else{
        $totalDiff = '';
    }
        

        if($paymentStatus == 1){
            $paymentStatusText = 'Paid';
        } else if($paymentStatus == 1){
            $paymentStatusText = 'Unpaid';
        }

        if($orderStatus == 1){
            $orderStatusText = 'Purchased';
        } else if($orderStatus == 2){
            $orderStatusText = 'Submitted Inventory';
        } else if($orderStatus == 3){
            $orderStatusText = 'Time Prefference: '. get_post_meta($assessment_id, '_assessment_user_time', true);
        } else if($orderStatus == 4){
            $orderStatusText = 'Awaiting for counselor response';
        } else if($orderStatus == 5){
            $orderStatusText = 'Assessment Accepted';
        } else if($orderStatus == 6){
            $orderStatusText = 'Completed';
        }


        $assessmentObj->data = [
            'ID' => $assessmentDetails->ID,
            'title' => $assessmentDetails->post_title,
            'author' => $assessmentDetails->post_author,
            'date' => $assessmentDetails->post_date,
            'auth_id' => get_post_meta($assessment_id, '_assessment_auth_id', true),
            'product' => get_post_meta($assessment_id, '_assessment_product', true),
            'product_order_type' => get_post_meta($assessment_id, '_assessment_product_order_type', true),
            'order_total' => get_post_meta($assessment_id, '_assessment_order_total', true),
            'order_status' => get_post_meta($assessment_id, '_assessment_order_status', true),
            'payment_status' => get_post_meta($assessment_id, '_assessment_payment_status', true),
            'transaction_id' => get_post_meta($assessment_id, '_assessment_payment_transaction_id', true),
            'billing_fname' => get_post_meta($assessment_id, '_assessment_billing_fname', true),
            'billing_lname' => get_post_meta($assessment_id, '_assessment_billing_lname', true),
            'billing_email' => get_post_meta($assessment_id, '_assessment_billing_email', true),
            'billing_address' => get_post_meta($assessment_id, '_assessment_billing_address', true),
            'billing_city' => get_post_meta($assessment_id, '_assessment_billing_city', true),
            'billing_zipcode' => get_post_meta($assessment_id, '_assessment_billing_zipcode', true),
            'shipping_fname' => get_post_meta($assessment_id, '_assessment_shipping_fname', true),
            'shipping_lname' => get_post_meta($assessment_id, '_assessment_shipping_lname', true),
            'shipping_email' => get_post_meta($assessment_id, '_assessment_shipping_email', true),
            'shipping_address' => get_post_meta($assessment_id, '_assessment_shipping_address', true),
            'shipping_city' => get_post_meta($assessment_id, '_assessment_shipping_city', true),
            'shipping_zipcode' => get_post_meta($assessment_id, '_assessment_shipping_zipcode', true),
            'assessment_question_answer' => get_post_meta($assessment_id, '_assessment_question_answer_set', true),
            'assessment_user_phone' => get_post_meta($assessment_id, '_assessment_user_phone_number', true),
            'assessment_user_time' => get_post_meta($assessment_id, '_assessment_user_time', true),
            'assessment_counselor' => get_post_meta($assessment_id, '_assessment_counselor', true),
            'assessment_coupon' => get_post_meta($assessment_id, '_assessment_coupon_applied', true),
            'final_interview_time' => $getFinalInterviewTime,
            'days_left' => $totalDiff,
            'payment_status_text' => $paymentStatusText,
            'order_status_text' => $orderStatusText,
        ];

        return (object) $assessmentObj;
    }

    public function getSurveyQuestions($exclude = NULL){
        $getSurveyQuesARgs = ['post_type' => THEME_PREFIX.'survey_question', 'posts_per_page' => -1, 'meta_key' => 'question_order', 'orderby' => 'meta_value_num', 'order' => 'ASC'
        /*'meta_query' => [
            [
                'key' => '_survey_product',
                'value' => $product_id,
                'compare' => '='
            ]]*/
        ];
        if(is_array($exclude) && count($exclude) > 0){
            $getSurveyQuesARgs['exclude'] = $exclude;
        }
        $getSurveyQuestions = get_posts($getSurveyQuesARgs);
        return $getSurveyQuestions;
    }

    public function getRandomSurveyQuestions($exclude = NULL){
        $randomSurveyQues = [];
        $getAllSurveyQues = $this->getSurveyQuestions();

        if(is_array($getAllSurveyQues) && count($getAllSurveyQues) > 0){
            foreach ($getAllSurveyQues as $eachSurveyQues) {
                $randomSurveyQues[] = $eachSurveyQues->ID;
            }
        }
        // $newRandQues = array_rand($randomSurveyQues, count($getAllSurveyQues));
        // $randomSurveyQuesIDs[0] = $randomSurveyQues[$newRandQues[0]];
        // $randomSurveyQuesIDs[1] = $randomSurveyQues[$newRandQues[1]];
        // return $randomSurveyQuesIDs;
        return $randomSurveyQues;
    }

    public function survey_details($survey_id){
        $surveyObj = new stdClass();
        $surveyDetails = get_post($survey_id);

        $surveyObj->data = [
            'ID' => $surveyDetails->ID,
            'title' => $surveyDetails->post_title,
            'author' => $surveyDetails->post_author,
            'date' => $surveyDetails->post_date,
            'product_id' => get_post_meta($survey_id, '_survey_product', true),
            'answers' => get_post_meta($survey_id, '_survey_answers', true),
        ];

        return (object) $surveyObj;
    }

}
