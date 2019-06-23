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
        'value' => $userDetails->data['ID'],
        'compare' => '='
    ],
    [
        'key' => '_assessment_order_status',
        'value' => 4,
        'compare' => '='
    ]
]]);

// echo "<pre>";
// print_r($getUnclaimedAssessments[0]->ID);
// echo "</pre>";

$getClaimedAssessments = get_posts(['post_type' => THEME_PREFIX. 'assessment', 'posts_per_page' => -1, 'meta_query' => [
    'relation' => 'AND',
    [
        'key' => '_assessment_counselor',
        'value' => $userDetails->data['ID'],
        'compare' => '='
    ],
    [
        'key' => '_assessment_order_status',
        'value' => 5,
        'compare' => '>='
    ]
]]);

?>
<div class="sj-registration-form">

    <!-- Account Top Bar -->
    <div class="row">
        <div class="col-sm-12"><?php theme_template_part('account-sidebar/account-sidebar'); ?></div>
    </div>
    <!-- End of Account Top Bar -->

    <!-- My Claimed Assessment Section -->
	<div class="dashboard_block bg-light-sky">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php _e(count($getClaimedAssessments). ' Active Assessment(s)', THEME_TEXTDOMAIN); ?></h3>
            <?php
                    if(is_array($getClaimedAssessments) && count($getClaimedAssessments) > 0){
                        ?>
                    <div class="dashboard_table table-responsive">
                        <table>
                            <thead>
                                <th width="40%"><?php _e('Type', THEME_TEXTDOMAIN); ?></th>
                                <th width="25%"><?php _e('Status', THEME_TEXTDOMAIN); ?></th>
                                <th width="15%"><?php _e('Days waiting', THEME_TEXTDOMAIN); ?></th>
                                <th width="20%"><?php _e('Interview Schedule', THEME_TEXTDOMAIN); ?></th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($getClaimedAssessments as $eachClaimedAssessment) {
                                $assessment_details = $GeneralThemeObject->assessment_details($eachClaimedAssessment->ID);
                            ?>
                                <tr>
                                    <td><?php echo $assessment_details->data['title']; ?></td>
                                    <td><?php echo $assessment_details->data['order_status_text']; ?></td>
                                    <td><?php echo $assessment_details->data['days_left']; ?></td>
                                    <td><?php echo date('d M, Y H:i:s a', $assessment_details->data['final_interview_time']); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
						</div>
                        <?php
                    }
                    ?>
        </div>
    </div>
	</div>
    <!-- End of My Claimed Assessment Section -->

    <!-- My Unclaimed Assessment Section -->
	<div class=" dashboard_block bg-light-sky">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php _e(count($getUnclaimedAssessments). ' Unclaimed Assessment(s)', THEME_TEXTDOMAIN); ?></h3>
            <?php
                    if(is_array($getUnclaimedAssessments) && count($getUnclaimedAssessments) > 0){
                        ?>
                       <div class="dashboard_table table-responsive">
                        <table>
                            <thead>
                                <th width="40%"><?php _e('Type', THEME_TEXTDOMAIN); ?></th>
                                <th width="25%"><?php _e('Status', THEME_TEXTDOMAIN); ?></th>
                                <th width="15%"><?php _e('Date', THEME_TEXTDOMAIN); ?></th>
                                <th width="20%"><?php _e('Action', THEME_TEXTDOMAIN); ?></th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($getUnclaimedAssessments as $eachUnclaimedAssessment) {
                                $assessment_details = $GeneralThemeObject->assessment_details($eachUnclaimedAssessment->ID);
                                
                            ?>
                                <tr>
                                    <td><?php echo $assessment_details->data['title']; ?></td>
                                    <td><?php echo $assessment_details->data['order_status_text']; ?></td>
                                    <td><?php echo date('d M, Y', strtotime($assessment_details->data['date'])); ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="couns-claim-assessment" data-assessment="<?php echo base64_encode($eachUnclaimedAssessment->ID); ?>"><?php _e('Claim', THEME_TEXTDOMAIN); ?></a>
                                        <a href="javascript:void(0);" class="couns-view-survey-assessment" data-assessment="<?php echo base64_encode($eachUnclaimedAssessment->ID); ?>"><?php _e('View Survey Report', THEME_TEXTDOMAIN); ?></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
						</div>
                        <?php
                    }
                    ?>
        </div>
    </div>
	</div>
    <!-- End of My Unclaimed Assessment Section -->

    <!-- My Account Section -->
	<div class="dashboard_block">
    <div class="row">
        <div class="col-sm-12">
            <div class="account_left"><h3><?php _e('My Account', THEME_TEXTDOMAIN); ?></h3></div>
			<div class="account_left"><a href="javascript:void(0);" class="click-edit-link"><?php _e('Edit', THEME_TEXTDOMAIN); ?></a></div>
            <div class="clearfix"></div>
		</div>
        <div class="col-sm-12">
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
                                <button type="submit" name="userChangePassSbmt" id="userChangePassSbmt" class="btn btn-primary ladda-button" data-size="l" data-style="zoom-in"><?php _e('Change Password', THEME_TEXTDOMAIN); ?></button>
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
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.click-edit-link').on('click', function(){
            $('.user-accnt-frm, .user-accnt-disp').slideToggle();
        });
    });
</script>
<?php
