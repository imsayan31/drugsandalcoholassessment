<?php
/*
 * User Claim Assessment Modal
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>
<div id="userClaimAssessmentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e('Claim an Assessment', THEME_TEXTDOMAIN); ?></h4>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form name="userClaimAssessmentFrm" id="userClaimAssessmentFrm" action="javascript:void(0);" method="post">
                    <input type="hidden" name="action" value="user_claim_assessment"/>
                    <input type="hidden" name="user_claim_assessment_id" id="user_claim_assessment_id" value="" />

                    <div class="claim-assessment-cont"></div>

					<div class="claim-assesmnt-ready">
						<div class="row claim-data">
                        <div class="col-sm-4">
                            <?php _e('Interview Date & Time:'); ?>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                            	<div class="input-append date form_datetime">
								    <input type="text" name="claim_assessment_date" id="claim_assessment_date" value="" autocomplete="off" class="form-control" placeholder="<?php _e('Select Interview Date and time*', THEME_TEXTDOMAIN); ?>" />
								    <span class="add-on"><i class="icon-th"></i></span>
								</div>
                                <!-- <input type="text" name="claim_assessment_date" id="claim_assessment_date" value="" autocomplete="off" class="form-control" placeholder="<?php _e('Select Interview Date*', THEME_TEXTDOMAIN); ?>" /> -->
                                <div class="input-error-msg"></div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row claim-data">
                        <div class="col-sm-4">
                            
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" name="claim_assessment_time" id="claim_assessment_time" value="" autocomplete="off" class="form-control" placeholder="<?php _e('Select Interview Time*', THEME_TEXTDOMAIN); ?>" />
                                <div class="input-error-msg"></div>
                            </div>
                        </div>
                    </div> -->
				</div>
                    

                    <div class="">
                        <button type="submit" name="userClaimAsessmentSbmt" id="userClaimAsessmentSbmt" class="btn btn-primary btn-block ladda-button btn-claim" data-size="l" data-style="zoom-in" style="display: inline-block;"><?php _e('Claim', THEME_TEXTDOMAIN); ?></button>
                        <input type="button" class="close btn-cancel close-btn" data-dismiss="modal" value="<?php _e('Cancel', THEME_TEXTDOMAIN); ?>"/>
                    </div>
                </form>
                
            </div>
            <!-- <div class="modal-footer">
                
            </div> -->
        </div>
    </div>
</div>

    <?php
