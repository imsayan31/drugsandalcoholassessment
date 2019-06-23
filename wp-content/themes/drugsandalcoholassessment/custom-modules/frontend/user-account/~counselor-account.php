<?php
/*
 *  User Account Page
 */
$GeneralThemeObject = new GeneralTheme();
$userDetails = $GeneralThemeObject->user_details();
$getLocation = $GeneralThemeObject->getLocation();
if ($userDetails->data['role'] == 'customer'):
    wp_redirect(CUSTOMER_ACCOUNT_PAGE);
    exit;
endif;

$getUnclaimedAssessments = get_posts(['post_type' => THEME_PREFIX. 'assessment', 'posts_per_page' => -1, 'meta_query' => [
    'relation' => 'AND',
    [
        'key' => '_assessment_counselor',
        'value' => $userDetails->data['user_id'],
        'compare' => '='
    ],
    [
        'key' => '_assessment_order_status',
        'value' => 3,
        'compare' => '='
    ]
]]);

?>
<div class="sj-registration-form">

    <!-- Account Top Bar -->
    <section class="row">
        <div><?php theme_template_part('account-sidebar/account-sidebar'); ?></div>
    </section>
    <!-- End of Account Top Bar -->

    <!-- My Unclaimed Assessment Section -->
    <section class="row">
        <div class="col-sm-3">
            <h3><?php _e('My Unclaimed Assessments', THEME_TEXTDOMAIN); ?></h3>
        </div>
        <div class="col-sm-9">
            <table>
                <thead>
                    <th><?php _e('Type', THEME_TEXTDOMAIN); ?></th>
                    <th><?php _e('Status', THEME_TEXTDOMAIN); ?></th>
                    <th><?php _e('Days waiting', THEME_TEXTDOMAIN); ?></th>
                    <th><?php _e('Action', THEME_TEXTDOMAIN); ?></th>
                </thead>
                <tbody>
                    <?php
                    if(is_array($getUnclaimedAssessments) && count($getUnclaimedAssessments) > 0){
                        foreach ($getUnclaimedAssessments as $eachUnclaimedAssessment) {
                            $assessment_details = $GeneralThemeObject->assessment_details($eachAssessment->ID);
                            if($assessment_details->data['order_status'] == 1){
                                $orderText = '';
                            } elseif($assessment_details->data['order_status'] == 2){
                                $orderText = '';
                            } elseif($assessment_details->data['order_status'] == 3){
                                $orderText = '';
                            } elseif($assessment_details->data['order_status'] == 4){
                                $orderText = '';
                            } else if($assessment_details->data['order_status' == 5]){
                                $orderText = '';
                            } 
                        ?>
                        <tr>
                            <td><?php echo $assessment_details->data['title']; ?></td>
                            <td><?php echo $assessment_details->data['order_status_text']; ?></td>
                            <td><?php echo date('d M, Y', strtotime($assessment_details->data['date'])); ?></td>
                            <td><a href="javascript:void(0);" class="claim-assessment" data-assessment="<?php echo base64_encode($eachAssessment->ID); ?>"><?php _e('Claim', THEME_TEXTDOMAIN); ?></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4">
                            <div>
                            <a href="#userAssessmentModal" data-toggle="modal"><?php _e('Purchase New Assessment', THEME_TEXTDOMAIN); ?></a>
                            </div>    
                        </td>
                    </tr>
                    <?php } else{ ?>
                    <tr>
                        <td colspan="4">
                            <div>
                            <a href="#userAssessmentModal" data-toggle="modal"><?php _e('Take an Assessment', THEME_TEXTDOMAIN); ?></a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
        </div>
    </section>
    <!-- End of My Unclaimed Assessment Section -->

    <!-- My Account Section -->
    <section class="row">
        <div class="col-sm-3">
            <h3><?php _e('My Account', THEME_TEXTDOMAIN); ?></h3>
        </div>
        <div class="col-sm-9">
            <a href="javascript:void(0);" class="click-edit-link"><?php _e('Edit', THEME_TEXTDOMAIN); ?></a>
            <div class="user-accnt-disp">
                <div class="row">
                    <div class="col-sm-6">
                        <div><?php _e('Name', THEME_TEXTDOMAIN); ?></div>
                        <div><?php _e('Email', THEME_TEXTDOMAIN); ?></div>
                        <div><?php _e('Phone', THEME_TEXTDOMAIN); ?></div>
                        <div><?php _e('Location', THEME_TEXTDOMAIN); ?></div>
                    </div>
                    <div class="col-sm-6">
                        <div><?php echo $userDetails->data['fname'].' '. $userDetails->data['lname']; ?></div>
                        <div><?php echo $userDetails->data['email']; ?></div>
                        <div><?php echo $userDetails->data['phone']; ?></div>
                        <div><?php echo $userDetails->data['location_display_name'].', '. $userDetails->data['zipcode']; ?></div>
                    </div>
                </div>
            </div>
            <div class="user-accnt-frm" style="display: none;">
                <form name="employerAccountFrm" id="employerAccountFrm" action="javascript:void(0);" method="post">
                    <input type="hidden" name="action" value="employer_account"/>
                        
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="user_first_name" id="user_first_name" class="form-control" placeholder="First Name*" autocomplete="off" value="<?php echo $userDetails->data['fname']; ?>" />
                                <div class="input-error-msg"></div>     
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="user_last_name" id="user_last_name" class="form-control" placeholder="Last Name*" autocomplete="off" value="<?php echo $userDetails->data['lname']; ?>"/>   
                                <div class="input-error-msg"></div>     
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email*" disabled="disabled" autocomplete="off" value="<?php echo $userDetails->data['email']; ?>" />
                                    <div class="input-error-msg"></div>     
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="Phone*" autocomplete="off" value="<?php echo $userDetails->data['phone']; ?>"/>
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
                                    <label for="court_ordered" class="control control--checkbox">
                                        <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Court Ordered" id="court_ordered" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Court Ordered', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>/> Court Ordered
                                        <div class="control__indicator"></div>
                                    </label>
                                    <label for="professional_board" class="control control--checkbox">
                                        <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Professional board" id="professional_board" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Professional board', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Professional board
                                        <div class="control__indicator"></div>
                                    </label>
                                    <label for="employer_recruitment" class="control control--checkbox">
                                        <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Employer Requirement" id="employer_recruitment" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Employer Requirement', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Employer Requirement
                                        <div class="control__indicator"></div>
                                    </label>
                                    <label for="personal_reasons" class="control control--checkbox">
                                        <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Other/ Personal Reasons" id="personal_reasons" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Other/ Personal Reasons', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Other/ Personal Reasons
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                                <div class="assesment-reason-error input-error-msg"></div>
                    </div>
                    </div>

                    <div class="">
                        <button type="submit" name="employerAccountSbmt" id="employerAccountSbmt" class="btn btn-primary ladda-button" data-size="l" data-style="zoom-in"><?php _e('Save', THEME_TEXTDOMAIN); ?></button>
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
                                <input type="password" name="user_new_pass" class="form-control" id="user_new_pass" placeholder="<?php _e('New password*', THEME_TEXTDOMAIN); ?>" value=""/><div class="input-error-msg"></div>
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
                        <button type="submit" name="userChangePassSbmt" id="userChangePassSbmt" class="btn btn-primary ladda-button" data-size="l" data-style="zoom-in"><?php _e('Change Password', THEME_TEXTDOMAIN); ?></button>
                    </div>
                </form>

            </div>
        </div>
    </section>
    <!-- End of My Account Section -->

</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.click-edit-link').on('click', function(){
            $('.user-accnt-frm, .user-accnt-disp').slideToggle();
        });
    });
</script>
<?php
