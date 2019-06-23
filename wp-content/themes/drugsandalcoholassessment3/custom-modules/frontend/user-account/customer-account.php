<?php
/*
 *  User Account Page
 */
$GeneralThemeObject = new GeneralTheme();
$userDetails = $GeneralThemeObject->user_details();
$getLocation = $GeneralThemeObject->getLocation();
$getUserAssessments = $GeneralThemeObject->getCustomerAssessments($userDetails->data['ID']);
?>
<div class="sj-registration-form">

    <!-- Account Top Bar -->
    <div class="row">
        <div class="col-sm-12"><?php theme_template_part('account-sidebar/account-sidebar'); ?></div>
    </div>
    <!-- End of Account Top Bar -->
 <div class="row">      
    <!-- My Assessment Section -->
	 <div class="col-sm-12">  
         <h3><?php _e('My Assessments', THEME_TEXTDOMAIN); ?></h3>
        <div class="dashboard_block table-tr-last-child bg-light-sky">
            <div class="dashboard_table table-responsive">
                <table>
                    <!-- <thead>
                        <th><?php _e('Title', THEME_TEXTDOMAIN); ?></th>
                        <th><?php _e('Assessment Status', THEME_TEXTDOMAIN); ?></th>
                        <th><?php _e('Requested On', THEME_TEXTDOMAIN); ?></th>
                        <th><?php _e('Status', THEME_TEXTDOMAIN); ?></th>
                    </thead> -->
    				<thead>
                        <th width="20%">Assessment No.</th>
                        <th width="60%">Assessment Details</th>
                        <!-- <th width="20%">Date</th> -->
                        <th width="20%">Status</th>
                    </thead>
    				
                    <tbody>
                        <?php
                        if(is_array($getUserAssessments) && count($getUserAssessments) > 0){
                            foreach ($getUserAssessments as $eachAssessment) {
                                $assessment_details = $GeneralThemeObject->assessment_details($eachAssessment->ID);
                                // echo "<pre>";
                                // print_r($assessment_details);
                                // echo "</pre>";
                                $assessmentCounselorDetails = $GeneralThemeObject->user_details($assessment_details->data['assessment_counselor']);
                                if($assessment_details->data['order_status'] == 1){
                                    $orderText = 'Step 1: Fill out Initial Inventory; a brief survey to better understand the situation. <a href="javascript:void(0);" class="click-to-questions" data-assessment_id="'. base64_encode($eachAssessment->ID) .'" data-product="'. base64_encode($assessment_details->data['product']) .'">Click here to proceed.</a>';
                                } elseif($assessment_details->data['order_status'] == 2){
                                    $orderText = 'Step 2: Schedule a time and meet with a certified counselor. <a href="javascript:void(0);" class="click-to-phone-assessment" data-assessment_id="'. base64_encode($eachAssessment->ID) .'" data-product="'. base64_encode($assessment_details->data['product']) .'">Click here to proceed.</a>';
                                } elseif($assessment_details->data['order_status'] == 3){
                                    $orderText = 'Step 3: Sit tight, we are reviewing your inventory. We will set up a call to '. $assessment_details->data['assessment_user_phone'] .' during '. $assessment_details->data['assessment_user_time'] .'. <a href="javascript:void(0);" class="click-to-phone-assessment" data-assessment_id="'. base64_encode($eachAssessment->ID) .'" data-product="'. base64_encode($assessment_details->data['product']) .'">Change phone assessment preferences.</a>';
                                } elseif($assessment_details->data['order_status'] == 4){
                                    $orderText = 'Step 4: Your assessment will be with '. $assessmentCounselorDetails->data['fname'].' '. $assessmentCounselorDetails->data['lname'] .'. Now he/she will set the final time for interview.';
                                } else if($assessment_details->data['order_status'] == 5){
                                    $orderText = 'Step 5: We are finalizing your assessment. This will be completed by '. date('d M, Y H:i:s a', $assessment_details->data['final_interview_time']);
                                } else if($assessment_details->data['order_status'] == 6){
                                    $orderText = 'Step 6: Completed on '. date('l, d M, Y', $assessment_details->data['final_interview_time']);
                                }
                            ?>
                            <tr>
                                <td><?php echo $assessment_details->data['title']; ?></td>
                                <td><?php echo $orderText; ?></td>
                                <!-- <td><?php echo date('d M, Y', strtotime($assessment_details->data['date'])); ?></td> -->
                                <td><?php echo $assessment_details->data['order_status_text']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="4">
                                <div class="new-assmnt">
                                    <a href="#userAssessmentModal" data-toggle="modal"><?php _e('Purchase New Assessment', THEME_TEXTDOMAIN); ?></a>
                                </div>    
                            </td>
                        </tr>
                        <?php } else{ ?>
                            <tr>
                            <td colspan="4">
                                No assessment found.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="new-assmnt register_form">
                                    <a href="#userAssessmentModal" data-toggle="modal" class="action-button"><?php _e('Take an Assessment', THEME_TEXTDOMAIN); ?></a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
	</div>
    <!-- End of My Assessment Section -->
</div>

    <!-- My Account Section -->
    <div class="row">
	<div class="col-sm-12">  
            <h3><?php _e('My Account', THEME_TEXTDOMAIN); ?></h3>
        <div class="dashboard_block">
            <div class="account_left"><a href="javascript:void(0);" class="click-edit-link"><?php _e('Edit', THEME_TEXTDOMAIN); ?></a></div>
            <div class="clearfix"></div>
            <div>
                <div class="user-accnt-disp">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <table class="user-accnt-table">
                                <tbody>
                                   <tr>
                                       <td><?php _e('Name', THEME_TEXTDOMAIN); ?></td>
                                       <td><?php echo $userDetails->data['fname'].' '. $userDetails->data['lname']; ?></td>
                                   </tr>
                                   <tr>
                                       <td><?php _e('Email', THEME_TEXTDOMAIN); ?></td>
                                       <td><?php echo $userDetails->data['email']; ?></td>
                                   </tr>
                                   <tr>
                                       <td><?php _e('Phone', THEME_TEXTDOMAIN); ?></td>
                                       <td><?php echo $userDetails->data['phone']; ?></td>
                                   </tr>
                                   <tr>
                                       <td><?php _e('Location', THEME_TEXTDOMAIN); ?></td>
                                       <td><?php echo $userDetails->data['location_display_name'].', '. $userDetails->data['zipcode']; ?></td>
                                   </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="user-accnt-frm" style="display: none;">
                   <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <form name="employerAccountFrm" id="employerAccountFrm" action="javascript:void(0);" method="post">
                                <input type="hidden" name="action" value="employer_account"/>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="user_first_name" id="user_first_name_updated" class="form-control" placeholder="First Name*" autocomplete="off" value="<?php echo $userDetails->data['fname']; ?>" />
                                            <div class="input-error-msg"></div>     
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="user_last_name" id="user_last_name_updated" class="form-control" placeholder="Last Name*" autocomplete="off" value="<?php echo $userDetails->data['lname']; ?>"/>   
                                            <div class="input-error-msg"></div>     
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="user_email" id="user_email_updated" class="form-control" placeholder="Email*" disabled="disabled" autocomplete="off" value="<?php echo $userDetails->data['email']; ?>" />
                                                <div class="input-error-msg"></div>     
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="user_phone" id="user_phone_updated" class="form-control" placeholder="Phone*" autocomplete="off" value="<?php echo $userDetails->data['phone']; ?>"/>
                                            <div class="input-error-msg"></div>     
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="user_location" class="chosen user_location">
                                            <option value="">-Select Your Location*-</option>
                                            <?php
                                                if(is_array($getLocation) && count($getLocation) > 0){
                                                    foreach ($getLocation as $eachLocation) {
                                                        $shortname = get_field('shortname', $eachLocation);
                                                        ?>
                                                        <option value="<?php echo $shortname; ?>" <?php selected($shortname, $userDetails->data['location']); ?>><?php echo $eachLocation->name; ?></option>
                                                        <?php
                                                    }

                                                } 
                                             ?>
                                        </select>
                                        <div class="user-location-error input-error-msg"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="user_zipcode" id="user_zipcode" class="form-control" placeholder="Zipcode*" value="<?php echo $userDetails->data['zipcode']; ?>"/>
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12">
                                    <label>Reasons for assessment</label>
                                            <div class="form-group">
                                                <label for="court_ordered1" class="control control--checkbox">
                                                    <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Court Ordered" id="court_ordered1" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Court Ordered', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>/> Court Ordered
                                                    <div class="control__indicator"></div>
                                                </label>
                                                <label for="professional_board1" class="control control--checkbox">
                                                    <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Professional board" id="professional_board1" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Professional board', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Professional board
                                                    <div class="control__indicator"></div>
                                                </label>
                                                <label for="employer_recruitment1" class="control control--checkbox">
                                                    <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Employer Requirement" id="employer_recruitment1" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Employer Requirement', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Employer Requirement
                                                    <div class="control__indicator"></div>
                                                </label>
                                                <label for="personal_reasons1" class="control control--checkbox">
                                                    <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Other/ Personal Reasons" id="personal_reasons1" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Other/ Personal Reasons', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Other/ Personal Reasons
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            <div class="assesment-reason-error input-error-msg"></div>
                                </div>
                                </div>

                                <div class="">
                                    <button type="submit" name="employerAccountSbmt" id="employerAccountSbmt" class="btn btn-primary ladda-button" style="background:#F20044;border-color: #F20044;" data-size="l" data-style="zoom-in"><?php _e('Save', THEME_TEXTDOMAIN); ?></button>
                                </div>
                            </form>

                            <hr>
                            <label><?php _e('Change Password', THEME_TEXTDOMAIN); ?></label>

                            <form name="userChangePassFrm" id="userChangePassFrm" action="javascript:void(0);" method="get">
                                <input type="hidden" name="action" value="user_change_password"/>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="password" name="user_old_pass" class="form-control" id="user_old_pass" placeholder="<?php _e('Old password*', THEME_TEXTDOMAIN); ?>" value=""/>
                                            <div class="input-error-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="user_new_pass" class="form-control" id="user_new_pass_updated" placeholder="<?php _e('New password*', THEME_TEXTDOMAIN); ?>" value=""/><div class="input-error-msg"></div>
                                            <div class="input-error-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="user_retype_new_pass" class="form-control" id="user_cnf_new_pass" placeholder="<?php _e('Re-type new password*', THEME_TEXTDOMAIN); ?>" value=""/>
                                            <div class="input-error-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="submit" name="userChangePassSbmt" id="userChangePassSbmt" style="background:#F20044;border-color: #F20044;" class="btn btn-primary ladda-button" data-size="l" data-style="zoom-in"><?php _e('Change Password', THEME_TEXTDOMAIN); ?></button>
                                </div>
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <!-- End of My Account Section -->
	</div>
    
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.click-edit-link').on('click', function(){
            $('.user-accnt-frm, .user-accnt-disp').slideToggle();
        });
    });
</script>

<?php
