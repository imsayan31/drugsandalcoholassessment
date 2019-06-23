<?php

/*
 *  AJAX :: Order Review Process
 *  
 */
add_action('wp_ajax_order_review_process', 'ajaxOrderReviewProcess');
add_action('wp_ajax_nopriv_order_review_process', 'ajaxOrderReviewProcess');

if (!function_exists('ajaxOrderReviewProcess')) {

    function ajaxOrderReviewProcess() {
        global $wpdb;
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => '', 'newMsg' => '', 'totalOrderVal' => '', 'product_name' => '', 'extraCostName' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        $product_id = base64_decode($_POST['product_id']);
        $order_type = $_POST['order_type'];
        $user_coupon_code = strip_tags(trim($_POST['user_coupon_code']));

        $getProductDetails = $GeneralThemeObject->product_details($product_id);
        $getOrderTypeVal = get_term_by('slug', $order_type, THEME_PREFIX.'extra_cost');
        $getOrderExtraVal = get_field('additional_cost', $getOrderTypeVal);
        $getTotalOrderVal = $getProductDetails->data['product_price'] + $getOrderExtraVal;

        /* Coupon Section */
        $coupon_id = $wpdb->get_var( "SELECT ID FROM ". THEME_PREFIX.'posts' ." WHERE post_title = '" . $user_coupon_code . "'" );
        $getCouponVal = get_post_meta($coupon_id, 'coupon_discount_amount', TRUE);
        $getCouponExpiryDate = strtotime(get_post_meta($coupon_id, 'coupon_expiry_date', TRUE));
        $currDate = strtotime(date('Y-m-d'));
        $discountAmount = (($getProductDetails->data['product_price'] * $getCouponVal)/100);

        $newMsg = NULL;
        $newMsg .= '<table>';
        $newMsg .= '<tbody>';
        $newMsg .= '<tr>';
        $newMsg .= '<td>Product: '. get_the_title($product_id) .'</td><td>'. '$'.number_format($getProductDetails->data['product_price'], 2)  .'</td>';
        $newMsg .= '</tr>';
        $newMsg .= '<tr>';
        $newMsg .= '<td>Delivery: '. $getOrderTypeVal->name .'</td><td>'. '$'.$getOrderExtraVal  .'</td>';
        $newMsg .= '</tr>';

        if($coupon_id == ''){
            $newMsg .= '<tr>';
            $newMsg .= '<td>Coupon can not be applied: <strong>'. $user_coupon_code .'</strong></td><td>Coupon not found</td>';
            $newMsg .= '</tr>';
        } else if($user_coupon_code && $currDate < $getCouponExpiryDate){
            $newMsg .= '<tr>';
            $newMsg .= '<td>Coupon applied: <strong>'. $user_coupon_code .'</strong></td><td>'. ' - $'. number_format($discountAmount, 2)  .'</td>';
            $newMsg .= '</tr>';
            $getTotalOrderVal = $getProductDetails->data['product_price'] + $getOrderExtraVal - $discountAmount;
        } else if($user_coupon_code && $currDate > $getCouponExpiryDate){
            $newMsg .= '<tr>';
            $newMsg .= '<td>Coupon can not be applied: <strong>'. $user_coupon_code .'</strong></td><td>Expiry date: '. date('d M, Y', $getCouponExpiryDate) .'</td>';
            $newMsg .= '</tr>';
        } 

        $newMsg .= '<tr>';
        $newMsg .= '<td>Total: </td><td>'. '$'. number_format($getTotalOrderVal, 2) .'</td>';
        $newMsg .= '</tr>';
        $newMsg .= '</tbody>';
        $newMsg .= '</table>';

        $resp_arr['flag'] = TRUE;
        $resp_arr['newMsg'] = $newMsg;
        // $resp_arr['totalOrderVal'] = base64_encode(number_format($getTotalOrderVal, 2));
        $resp_arr['totalOrderVal'] = number_format($getTotalOrderVal, 2);
        $resp_arr['productName'] = get_the_title($product_id);
        $resp_arr['extraCostName'] = 'Within '.$getOrderTypeVal->name;

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}

/*
 *  AJAX :: Customer Makes Payment
 *  
 */
add_action('wp_ajax_customer_pickup_assessment', 'ajaxCustomerPicksupAssessment');
add_action('wp_ajax_nopriv_customer_pickup_assessment', 'ajaxCustomerPicksupAssessment');

if (!function_exists('ajaxCustomerPicksupAssessment')) {

    function ajaxCustomerPicksupAssessment() {
        $resp_arr = ['flag' => FALSE, 'msg' => '', 'url' => '', 'verification_code' => ''];
        $GeneralThemeObject = new GeneralTheme();
        $msg = NULL;

        $product_id = base64_decode($_POST['product_id']);
        $user_order_type = $_POST['user_order_type'];
        $user_coupon_code = $_POST['user_coupon_code'];
        $getOrderTypeBy = get_term_by('slug', $user_order_type, THEME_PREFIX.'extra_cost');

        $userDetails = $GeneralThemeObject->user_details();

        // $user_billing_fname = strip_tags(trim($_POST['user_billing_fname']));
        // $user_billing_lname = strip_tags(trim($_POST['user_billing_lname']));
        // $user_billing_email = strip_tags(trim($_POST['user_billing_email']));
        
        $user_billing_fname = $userDetails->data['fname'];
        $user_billing_lname = $userDetails->data['lname'];
        $user_billing_email = $userDetails->data['email'];
        $user_billing_address = strip_tags(trim($_POST['user_billing_address']));
        $user_billing_city = strip_tags(trim($_POST['user_billing_city']));
        $user_billing_zipcode = strip_tags(trim($_POST['user_billing_zipcode']));
        $user_ques_ans_val = unserialize($_POST['user_ques_ans_val']);
        
        // $user_shipping_fname = strip_tags(trim($_POST['user_shipping_fname']));
        // $user_shipping_lname = strip_tags(trim($_POST['user_shipping_lname']));
        // $user_shipping_email = strip_tags(trim($_POST['user_shipping_email']));
        // $user_shipping_address = strip_tags(trim($_POST['user_shipping_address']));
        // $user_shipping_city = strip_tags(trim($_POST['user_shipping_city']));
        // $user_shipping_zipcode = strip_tags(trim($_POST['user_shipping_zipcode']));

        $stripeToken = $_POST['stripeToken'];
        $product_order_val = (int) $_POST['product_order_val'];

        /* Get Stripe Secret Key */
        $get_stripe_secret_key = get_option('_stripe_secret_key');

            // echo "<pre>";
            // print_r($stripeToken);
            // echo "</pre>";
            // exit;

            /* Create Verification Code */
            $randomCode = $GeneralThemeObject->generateRandomString(6);

            \Stripe\Stripe::setApiKey($get_stripe_secret_key);

            /* For original purpose */
          $charge = \Stripe\Charge::create(
                [
                'amount' => $product_order_val * 100,
                //'amount' => 1 * 100,
                'currency' => 'usd',
                'description' => get_the_title($product_id).' within '. $getOrderTypeBy->name,
                'source' => $stripeToken,
            ]
        );


        //           echo "<pre>";
        //   print_r($charge);
        //   echo "</pre>";
        //   exit;

        /* For testing purpose */
        // $charge->paid = TRUE;
        // $charge->id = 'ch_1DpV3s2eZvKYlo2Ckl'.$randomCode;

        

            if($charge->paid == TRUE){

                /* Create Assessment */
                $assessmentDataArr = [
                    'post_type' => THEME_PREFIX.'assessment',
                    'post_title' => 'Assessment No. '. $randomCode .' - '. get_the_title($product_id),
                    'post_status' => 'publish',
                    'post_author' => $userDetails->data['ID']
                ];

                $assessment_id = wp_insert_post($assessmentDataArr);

                /* Update Assessment Data */
                update_post_meta($assessment_id, '_assessment_auth_id', $randomCode);
                update_post_meta($assessment_id, '_assessment_product', $product_id);
                update_post_meta($assessment_id, '_assessment_product_order_type', $user_order_type);
                update_post_meta($assessment_id, '_assessment_order_total', $product_order_val);
                update_post_meta($assessment_id, '_assessment_order_status', 1);
                update_post_meta($assessment_id, '_assessment_payment_status', 1);
                update_post_meta($assessment_id, '_assessment_payment_transaction_id', $charge->id);
                
                update_post_meta($assessment_id, '_assessment_billing_fname', $user_billing_fname);
                update_post_meta($assessment_id, '_assessment_billing_lname', $user_billing_lname);
                update_post_meta($assessment_id, '_assessment_billing_email', $user_billing_email);
                update_post_meta($assessment_id, '_assessment_billing_address', $user_billing_address);
                update_post_meta($assessment_id, '_assessment_billing_city', $user_billing_city);
                update_post_meta($assessment_id, '_assessment_billing_zipcode', $user_billing_zipcode);

                update_post_meta($assessment_id, '_assessment_order_status', 2);
                update_post_meta($assessment_id, '_assessment_question_answer_set', $user_ques_ans_val);

                if($user_coupon_code){
                    update_post_meta($assessment_id, '_assessment_coupon_applied', $user_coupon_code);
                }
                
                // update_post_meta($assessment_id, '_assessment_shipping_fname', $user_shipping_fname);
                // update_post_meta($assessment_id, '_assessment_shipping_lname', $user_shipping_lname);
                // update_post_meta($assessment_id, '_assessment_shipping_email', $user_shipping_email);
                // update_post_meta($assessment_id, '_assessment_shipping_address', $user_shipping_address);
                // update_post_meta($assessment_id, '_assessment_shipping_city', $user_shipping_city);
                // update_post_meta($assessment_id, '_assessment_shipping_zipcode', $user_shipping_zipcode);

                $assessment_details = $GeneralThemeObject->assessment_details($assessment_id);

                $assessmentOrderType = get_term_by('slug', $assessment_details->data['product_order_type'], THEME_PREFIX . 'extra_cost');

                /* Send Email To User */
            $userMessageTemp = $GeneralThemeObject->getEmailTemplates('mail-to-user-for-purchasing-assessment', 
                [
                    '{%user_name%}',
                    '{%title%}',
                    '{%product%}',
                    '{%order_type%}',
                    '{%order_total%}',
                    '{%payment_status%}',
                    '{%transaction_id%}'
                ], 
                [
                    $userDetails->data['fname'].' '.$userDetails->data['lname'], 
                    $assessment_details->data['title'], 
                    get_the_title($assessment_details->data['product']), 
                    $assessmentOrderType->name, 
                    '$'. number_format($assessment_details->data['order_total'], 2), 
                    $assessment_details->data['payment_status_text'], 
                    $assessment_details->data['transaction_id']
                ]
            );
            $userMailSubject = $userMessageTemp[0];
            $userMailTemp = $GeneralThemeObject->theme_email_template($userMessageTemp[1]);
            $GeneralThemeObject->send_email_func($userDetails->data['email'], $userMailSubject, $userMailTemp);

                /* Send Email To Admin */
            $admin_email = get_option('admin_email');
            $adminMessageTemp = $GeneralThemeObject->getEmailTemplates('mail-to-admin-for-purchasing-assessment', 
                [
                    '{%user_name%}', 
                    '{%title%}', 
                    '{%product%}', 
                    '{%order_type%}', 
                    '{%order_total%}',
                    '{%payment_status%}',
                    '{%transaction_id%}'
                ], 
                [
                    $userDetails->data['fname'].' '.$userDetails->data['lname'], 
                    $assessment_details->data['title'], 
                    get_the_title($assessment_details->data['product']), 
                    $assessmentOrderType->name, 
                    '$'. number_format($assessment_details->data['order_total'], 2), 
                    $assessment_details->data['payment_status_text'], 
                    $assessment_details->data['transaction_id']
                ]
            );
            $adminMailSubject = $adminMessageTemp[0];
            $adminMailTemp = $GeneralThemeObject->theme_email_template($adminMessageTemp[1]);
            $GeneralThemeObject->send_email_func($admin_email, $adminMailSubject, $adminMailTemp);

            $resp_arr['flag'] = TRUE;
            //$resp_arr['verification_code'] = $randomCode;
            $resp_arr['url'] = CUSTOMER_ACCOUNT_PAGE;
            // $msg = 'Your payment is successful. Now follow a brief survey.';
            $msg = 'Your payment is successful. Now schedule your interview.';

            } else {
                $msg = 'Your payment can not be completed now. Please try again later.';
            }

        $resp_arr['msg'] = $msg;
        echo json_encode($resp_arr);
        exit;
    }

}

