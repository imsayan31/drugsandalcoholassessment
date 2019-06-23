<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('extra_user_profile_fields')) {

    function extra_user_profile_fields($user) {
        $GeneralThemeObject = new GeneralTheme();
        $userDetails = $GeneralThemeObject->user_details($user->ID);
        $getLocation = $GeneralThemeObject->getLocation();
        $getUserAssessments = $GeneralThemeObject->getCustomerAssessments($userDetails->data['user_id']);
        ?>

        <?php if ($userDetails->data['role'] == 'customer' || $userDetails->data['role'] == 'counselor'): ?>
            <h3><?php _e('User Basic & Contact Information', THEME_TEXTDOMAIN); ?></h3>
            <table class="form-table">
                
                <tr>
                    <th><label for=""><?php _e("Location"); ?></label></th>
                    <td>
                        <select name="user_location" class="chosen user_location">
                            <option value="">-Select Location*-</option>
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
                    </td>
                </tr>
                
                <tr>
                    <th><label for="user_zipcode"><?php _e("Zipcode"); ?></label></th>
                    <td>
                        <input type="text" name="user_zipcode" id="user_zipcode" class="form-control" placeholder="Zipcode*" value="<?php echo $userDetails->data['zipcode']; ?>"/><br />
                    </td>
                </tr>
                <tr>
                    <th><label for="user_phone_updated"><?php _e("Phone No"); ?></label></th>
                    <td>
                        <input type="text" name="user_phone" id="user_phone_updated" class="form-control" placeholder="Phone*" autocomplete="off" value="<?php echo $userDetails->data['phone']; ?>"/><br />
                    </td>
                </tr>
               <tr>
                    <th><label for="user_reasons_for_assessments"><?php _e("Reasons for Assessments"); ?></label></th>
                    <td>
                        <label for="court_ordered1">
                            <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Court Ordered" id="court_ordered1" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Court Ordered', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>/> Court Ordered
                        </label>
                        <label for="professional_board1">
                            <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Professional board" id="professional_board1" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Professional board', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Professional board
                        </label>
                        <label for="employer_recruitment1">
                            <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Employer Requirement" id="employer_recruitment1" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Employer Requirement', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Employer Requirement
                        </label>
                        <label for="personal_reasons1">
                            <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Other/ Personal Reasons" id="personal_reasons1" <?php echo (is_array($userDetails->data['assessment_reason']) && count($userDetails->data['assessment_reason']) > 0 && in_array('Other/ Personal Reasons', $userDetails->data['assessment_reason'])) ? 'checked' : ''; ?>> Other/ Personal Reasons
                        </label>
                    </td>
                </tr>
                <tr>
                    <th><label for="assessment_due_date"><?php _e("Assessment Due Date"); ?></label></th>
                    <td>
                        <input type="date" name="assessment_due_date" id="assessment_due_date" class="form-control" placeholder="Assessment Due Date*" value="<?php echo $userDetails->data['assessment_due_date']; ?>"/><br />
                    </td>
                </tr>
                <tr>
                    <th><label for="assessment_type_confrm"><?php _e("Is the assessment for an employer or court ordered?"); ?></label></th>
                    <td>
                        <label for="assessment_type_confrm_employer">
                            <input type="radio" class="assessment_type_confrm" name="assessment_type_confrm" value="1" id="assessment_type_confrm_employer" <?php echo ($userDetails->data['type_confirmation'] == 1) ? 'checked' : ''; ?>/> Employer
                        </label>
                        <label for="assessment_type_confrm_court">
                            <input type="radio" class="assessment_type_confrm" name="assessment_type_confrm" value="2" id="assessment_type_confrm_court" <?php echo ($userDetails->data['type_confirmation'] == 2) ? 'checked' : ''; ?>/> Court
                        </label>
                        <label for="assessment_type_confrm_both">
                            <input type="radio" class="assessment_type_confrm" name="assessment_type_confrm" value="3" id="assessment_type_confrm_both" <?php echo ($userDetails->data['type_confirmation'] == 3) ? 'checked' : ''; ?>/> Both
                        </label>
                    </td>
                </tr>
                <tr>
                    <th><label for="assessment_online_confrm"><?php _e("Do you prefer to do an online assessment?"); ?></label></th>
                    <td>
                        <label for="assessment_online_confrm_yes">
                            <input type="radio" class="assessment_online_confrm" name="assessment_type_confrm" value="1" id="assessment_online_confrm_yes" <?php echo ($userDetails->data['onile_confirmation'] == 1) ? 'checked' : ''; ?>/> Yes
                        </label>
                        <label for="assessment_online_confrm_yes">
                            <input type="radio" class="assessment_online_confrm" name="assessment_online_confrm" value="2" id="assessment_online_confrm_yes" <?php echo ($userDetails->data['onile_confirmation'] == 2) ? 'checked' : ''; ?>/> No
                        </label>
                    </td>
                </tr>
            </table>
        <?php 
        endif; 
    }

}

if (!function_exists('save_extra_user_profile_fields')) {

    function save_extra_user_profile_fields($userID) {
        $GeneralThemeObject = new GeneralTheme();
        $userDetails = $GeneralThemeObject->user_details($userID);
        if (!current_user_can('edit_user', $userID)) {
            return false;
        }

        /* Initial Assesment data */
        $assessment_due_date = strip_tags(trim($_POST['assessment_due_date']));
        $assessment_type_confrm = $_POST['assessment_type_confrm'];
        $assessment_online_confrm = $_POST['assessment_online_confrm'];
        
        /* Form 1 data */
        $user_location = $_POST['user_location'];
        $user_zipcode = $_POST['user_zipcode'];

        /* Form 2 data */
        $user_first_name = strip_tags(trim($_POST['user_first_name']));
        $user_last_name = strip_tags(trim($_POST['user_last_name']));
        $user_assesment_reason = $_POST['user_assesment_reason'];

        /* Form 3 data */
        $user_phone = strip_tags(trim($_POST['user_phone']));

        if ($userDetails->data['role'] == 'customer' || $userDetails->data['role'] == 'counselor') {

            /* Save meta Fields */
            update_user_meta($userID, '_user_location', $user_location);
            update_user_meta($userID, '_user_zipcode', $user_zipcode);
            update_user_meta($userID, '_user_phone', $user_phone);
            update_user_meta($userID, '_assesment_reason', $user_assesment_reason);
            update_user_meta($userID, '_user_assessment_due_date', $assessment_due_date);
            update_user_meta($userID, '_user_assessment_type_confirmation', $assessment_type_confrm);
            update_user_meta($userID, '_user_assessment_online_cofirmation', $assessment_online_confrm);
        } 
    }

}


