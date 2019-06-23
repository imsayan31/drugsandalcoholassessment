<?php
/*
 * This file containing all post type's meta boxes of this theme
 */


if(!function_exists('adding_custom_meta_boxes')){
    function adding_custom_meta_boxes(){
        add_meta_box('survey-meta-box', 'Survey Management', 'survey_management_func', THEME_PREFIX.'survey_question', 'normal', 'high');
    }
}

if(!function_exists('adding_custom_meta_boxes_assessment')){
    function adding_custom_meta_boxes_assessment(){
        add_meta_box('assessment-meta-box', 'Assessment Report', 'ament_management_func', THEME_PREFIX.'assessment', 'normal', 'high');
        add_meta_box('assessment-action-meta-box', 'Assign Counselor', 'assign_counselor_func', THEME_PREFIX.'assessment', 'side', 'high');
        add_meta_box('assessment-change-assessment-status-meta-box', 'Change Assessment Status', 'change_assessment_status_func', THEME_PREFIX.'assessment', 'side', 'high');
    }
}

if(!function_exists('survey_management_func')){
    function survey_management_func(){
        global $post;
        $GeneralThemeObject = new GeneralTheme();
        $getProducts = $GeneralThemeObject->getProducts();
        $getSurveyDetails = $GeneralThemeObject->survey_details($post->ID);
        $getSurveyAnswers = $getSurveyDetails->data['answers'];
        if(is_array($getSurveyAnswers) && count($getSurveyAnswers) > 0){
            $tableStyle = 'display:block;';
        } else{
            $tableStyle = 'display:none;';
        }
        ?>
        
        <section class="add-question-sec">
            <div>
                <a href="javascript:void(0);" class="button button-primary add-survey-answer"><?php _e('+Add Answers', THEME_TEXTDOMAIN); ?></a>
            </div>
                <table class="widefat" style="<?php echo $tableStyle; ?> margin-top:10px;">
                    <tbody class="survey-answer-sec">
                        <?php
                        if(is_array($getSurveyAnswers) && count($getSurveyAnswers) > 0){
                            foreach ($getSurveyAnswers as $eachSurveyAns) {
                                ?>
                                <tr>
                                    <td><input type="text" name="survey_answers[]" value="<?php echo $eachSurveyAns ?>" placeholder="Enter answer" autocomplete="off"/></td>
                                    <td><a href="javascript:void(0);" class="remove-answers button button-primary">Remove answer</a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
        </section>
        <?php
    }
}

if(!function_exists('ament_management_func')){
    function ament_management_func(){
        global $post;
        $GeneralThemeObject = new GeneralTheme();
        $assessment_details = $GeneralThemeObject->assessment_details($post->ID);
        $assessmentQuestionAnswers = $assessment_details->data['assessment_question_answer'];
        $assessmentOrderType = get_term_by('slug', $assessment_details->data['product_order_type'], THEME_PREFIX . 'extra_cost');
        ?>

        <!-- Assessment Payment Section -->
        <section class="wrap">
            <table class="widefat">
                <thead>
                    <tr>
                        <th colspan="2"><strong><?php _e('Payment Information', THEME_TEXTDOMAIN); ?></strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php _e('Product:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo get_the_title($assessment_details->data['product']); ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Order Within:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessmentOrderType->name; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Order Total:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo '$'. number_format($assessment_details->data['order_total'], 2); ?></td>
                    </tr>
                    <?php if($assessment_details->data['assessment_coupon']): ?>
                    <tr>
                        <td><?php _e('Applied Coupon:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['assessment_coupon']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td><?php _e('Order Status:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['order_status_text']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Payment Status:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['payment_status_text']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Transaction ID:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['transaction_id']; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <!-- End of Assessment Payment Section -->

        <!-- Customer Survey Section -->
        <section class="wrap">
            <table class="widefat">
                <thead>
                    <tr>
                        <th colspan="2"><strong><?php _e('Customer\'s Survey Report', THEME_TEXTDOMAIN); ?></strong></th>
                    </tr>
                    <tr>
                        <th><strong><?php _e('Question', THEME_TEXTDOMAIN); ?></strong></th>
                        <th><strong><?php _e('Customer Answer', THEME_TEXTDOMAIN); ?></strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(is_array($assessmentQuestionAnswers) && count($assessmentQuestionAnswers) > 0){
                        foreach ($assessmentQuestionAnswers as $eachQues => $eachAns) {
                            ?>
                            <tr>
                                <td><?php echo $eachQues; ?></td>
                                <td><?php echo $eachAns; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                            <tr>
                                <td colspan="2"><?php _e('Not attended.', THEME_TEXTDOMAIN); ?></td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <!-- End of Customer Survey Section -->

        <!-- Customer Phone Assessment Section -->
        <section class="wrap">
            <table class="widefat">
                <thead>
                    <tr>
                        <th colspan="2"><strong><?php _e('Customer\'s Preferences', THEME_TEXTDOMAIN); ?></strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php _e('Contact No:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['assessment_user_phone']) ? $assessment_details->data['assessment_user_phone'] : 'Not provided yet.'; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Prefered Time:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['assessment_user_time']) ? $assessment_details->data['assessment_user_time'] : 'Not provided yet.'; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <!-- End of Customer Phone Assessment Section -->

        <!-- Counselor Final Assessment Section -->
        <section class="wrap">
            <table class="widefat">
                <thead>
                    <tr>
                        <th colspan="2"><strong><?php _e('Counselor\'s Preferences', THEME_TEXTDOMAIN); ?></strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php _e('Final Interview Time:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['final_interview_time']) ? date('d M, Y h:i:s a', $assessment_details->data['final_interview_time']) : 'Not provided yet.'; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <!-- End of Counselor Final Assessment Section -->

        <!-- Assessment Billing Section -->
        <section class="wrap">
            <table class="widefat">
                <thead>
                    <tr>
                        <th colspan="2"><strong><?php _e('Billing Information', THEME_TEXTDOMAIN); ?></strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php _e('First Name:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['billing_fname']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Last Name:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['billing_lname']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Email:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['billing_email']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Address:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['billing_address']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('City:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['billing_city']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Zipcode:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo $assessment_details->data['billing_zipcode']; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <!-- End of Assessment Billing Section -->

        <!-- Assessment Shipping Section -->
        <!-- <section class="wrap">
            <table class="widefat">
                <thead>
                    <tr>
                        <th colspan="2"><strong><?php _e('Shipping Information', THEME_TEXTDOMAIN); ?></strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php _e('First Name:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['shipping_fname']) ? $assessment_details->data['shipping_fname'] : $assessment_details->data['billing_fname']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Last Name:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['shipping_lname']) ? $assessment_details->data['shipping_lname'] : $assessment_details->data['billing_lname']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Email:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['shipping_email']) ? $assessment_details->data['shipping_email'] : $assessment_details->data['billing_email']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Address:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['shipping_address']) ? $assessment_details->data['shipping_address'] : $assessment_details->data['billing_address']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('City:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['shipping_city']) ? $assessment_details->data['shipping_city'] : $assessment_details->data['billing_city']; ?></td>
                    </tr>
                    <tr>
                        <td><?php _e('Zipcode:', THEME_TEXTDOMAIN); ?></td>
                        <td><?php echo ($assessment_details->data['shipping_zipcode']) ? $assessment_details->data['shipping_zipcode'] : $assessment_details->data['billing_zipcode']; ?></td>
                    </tr>
                </tbody>
            </table>
        </section> -->
        <!-- End of Assessment Shipping Section -->

        <?php
    }
} 

if(!function_exists('assign_counselor_func')){
    function assign_counselor_func(){
        global $post;
        $GeneralThemeObject = new GeneralTheme();
        $assessment_details = $GeneralThemeObject->assessment_details($post->ID);
        $getCounselors = get_users(['role' => 'counselor']);
        
        ?>

        <!-- Assign Counselor -->
        <section class="wrap">
            <select name="assign_assessment_counselor">
                <option value="">-Select Counselor-</option>
                <?php
                if(is_array($getCounselors) && count($getCounselors) > 0){
                    foreach ($getCounselors as $eachCounselor) {
                        $counselorDetails = $GeneralThemeObject->user_details($eachCounselor->ID);
                        ?>
                        <option value="<?php echo $counselorDetails->data['ID']; ?>" <?php selected($assessment_details->data['assessment_counselor'], $counselorDetails->data['ID']); ?>><?php echo $counselorDetails->data['fname'].' '. $counselorDetails->data['lname']; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </section>
        <!-- End of Assign Counselor -->

        <?php
    }
}

if(!function_exists('change_assessment_status_func')){
    function change_assessment_status_func(){
        global $post;
        $GeneralThemeObject = new GeneralTheme();
        $assessment_details = $GeneralThemeObject->assessment_details($post->ID);
        ?>
        <!-- Changing Assessment Status -->
        <section class="wrap">
            <select name="change_assessment_status">
                <option value="">-Select Status-</option>
                <option value="1" <?php selected($assessment_details->data['order_status'], 1); ?>>Purchased</option>
                <option value="2" <?php selected($assessment_details->data['order_status'], 2); ?>>Submitted Inventory</option>
                <option value="3" <?php selected($assessment_details->data['order_status'], 3); ?>>Time Prefference: <?php echo $assessment_details->data['assessment_user_time']; ?></option>
                <option value="4" <?php selected($assessment_details->data['order_status'], 4); ?>>Awaiting for counselor response</option>
                <option value="5" <?php selected($assessment_details->data['order_status'], 5); ?>>Assessment Accepted</option>
                <option value="6" <?php selected($assessment_details->data['order_status'], 6); ?>>Completed</option>
            </select>
        </section>
        <!-- End of Changing Assessment Status -->
        <?php
    }
}

if(!function_exists('saveSurveyDataFields')){
    function saveSurveyDataFields($post_id){
    	$GeneralThemeObject = new GeneralTheme();
        $survey_product = $_POST['survey_product'];
        $survey_answers = $_POST['survey_answers'];
        $assign_assessment_counselor = $_POST['assign_assessment_counselor'];
        $change_assessment_status = $_POST['change_assessment_status'];

        $get_existing_counselor = get_post_meta($post_id, '_assessment_counselor', TRUE);
        $postDetails = get_post($post_id);

        $assessmentDetails = $GeneralThemeObject->assessment_details($post_id);
        
        if($postDetails->post_type == THEME_PREFIX.'survey_question'){
            //update_post_meta($post_id, '_survey_product', $survey_product);
            update_post_meta($post_id, '_survey_answers', $survey_answers);
        } else if($postDetails->post_type == THEME_PREFIX.'assessment'){
            if(!empty($assign_assessment_counselor) && $change_assessment_status == 3){
                update_post_meta($post_id, '_assessment_order_status', 4);
            } else {
                update_post_meta($post_id, '_assessment_order_status', 3);
                update_post_meta($post_id, '_assessment_order_status', $change_assessment_status);
            }

            update_post_meta($post_id, '_assessment_counselor', $assign_assessment_counselor);
            

            /* Send Verification Code To User */
            if($get_existing_counselor != $assign_assessment_counselor){

                $counselorDetails = $GeneralThemeObject->user_details($assign_assessment_counselor);
                $customerDetails = $GeneralThemeObject->user_details($assessmentDetails->data['author']);

                $userMessageTemp = $GeneralThemeObject->getEmailTemplates('mail-to-counselor-for-assigning-customer-for-assessment', ['{%user_name%}', '{%customer%}', '{%title%}', '{%customer_contact_no%}', '{%date_time%}'], [$counselorDetails->data['fname'].' '. $counselorDetails->data['lname'], $customerDetails->data['fname'].' '. $customerDetails->data['lname'], $assessmentDetails->data['title'], $assessmentDetails->data['assessment_user_phone'], $assessmentDetails->data['assessment_user_time']]);
                $userMailSubject = $userMessageTemp[0];
                $userMailTemp = $GeneralThemeObject->theme_email_template($userMessageTemp[1]);
                $GeneralThemeObject->send_email_func($counselorDetails->data['email'], $userMailSubject, $userMailTemp);
                
            }
            

        }
        
    }
}