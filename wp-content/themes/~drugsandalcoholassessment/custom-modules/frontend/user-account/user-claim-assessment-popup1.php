<?php
/*
 * User Registration Modal
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>
<div id="userClaimAssessmentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e('Initial Inventory', THEME_TEXTDOMAIN); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form name="userClaimAssessmentFrm" id="userClaimAssessmentFrm" action="javascript:void(0);" method="post">
                    <input type="hidden" name="action" value="user_confirm_assessment"/>
                    <!-- <input type="hidden" name="user_phone_assessment_product_id" id="user_phone_assessment_product_id" value=""/>
                    <input type="hidden" name="user_phone_assessment_id" id="user_phone_assessment_id" value="" autocomplete="off" /> -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="phone_assessmet_number" class="
                                form-control" id="phone_assessmet_number" value="" placeholder="<?php _e('Phone number', THEME_TEXTDOMAIN); ?>" />
                                <div class="input-error-msg"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="phone_assessment_time" class="form-control phone_assessment_time">
                                    <option value=""><?php _e('When should we call?', THEME_TEXTDOMAIN); ?></option>
                                    <option value="Morning (7am - 10am)"><?php _e('Morning (7am - 10am)', THEME_TEXTDOMAIN); ?></option>
                                    <option value="Midday (10am - 2pm)"><?php _e('Midday (10am - 2pm)', THEME_TEXTDOMAIN); ?></option>
                                    <option value="Afternoon (2pm - 4pm)"><?php _e('Afternoon (2pm - 4pm)', THEME_TEXTDOMAIN); ?></option>
                                    <option value="Night (8pm - 11pm)"><?php _e('Night (8pm - 11pm)', THEME_TEXTDOMAIN); ?></option>
                                    <option value="No preference"><?php _e('No preference', THEME_TEXTDOMAIN); ?></option>
                                </select>
                                <div class="phone-assessment-time-error input-error-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" name="userPhoneAsessmentSbmt" id="userPhoneAsessmentSbmt" class="btn btn-primary btn-block ladda-button" data-size="l" data-style="zoom-in"><?php _e('Submit', THEME_TEXTDOMAIN); ?></button>
                    </div>
                </form>
                
            </div>
            <!-- <div class="modal-footer">
                
            </div> -->
        </div>
    </div>
</div>

    <?php
