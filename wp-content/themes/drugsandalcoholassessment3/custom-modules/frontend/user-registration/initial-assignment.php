<?php
/*
 * Initial Assessment Section
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getLocation = $GeneralThemeObject->getLocation();
?>
<!-- Initial Assessment Verification -->

            
                <!-- <h2 class="fs-title">Location Availability</h2> -->
                <!-- <h3 class="fs-subtitle">
                	<span>Step 1: Initial Assessment</span>
                </h3> -->
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <div class="pop_mid_section1" style="text-align: left;">

                            <div class="row form-group">
                                <div class="col-sm-12">
                                    When is your assessment due?
                                    <div class="form-group" style="margin-top: 10px;">
                                        <input type="date" name="assessment_due_date" id="assessment_due_date" class="form-control" placeholder="When is your assessment due?*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                Is the assessment for an employer or court ordered? 
                                <div class="confirm-employer" style="margin-top: 10px;">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control control--radio" for="assessment_type_confrm_employer">
                                                <input type="radio" name="assessment_type_confrm" class="assessment_type_confrm" id="assessment_type_confrm_employer" value="1" /> Employer
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control control--radio" for="assessment_type_confrm_court">
                                                <input type="radio" name="assessment_type_confrm" class="assessment_type_confrm" id="assessment_type_confrm_court" value="2" /> Court
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control control--radio" for="assessment_type_confrm_both">
                                                <input type="radio" name="assessment_type_confrm" class="assessment_type_confrm" id="assessment_type_confrm_both" value="3" /> Both
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="assessment-confrm-error input-error-msg"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="confirm-employer" style="margin-top: 10px;">
                                    Do you prefer to do an online assessment?
                                     <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control control--radio" for="assessment_online_confrm_yes">
                                                <input type="radio" name="assessment_online_confrm" class="assessment_online_confrm" id="assessment_online_confrm_yes" value="1" /> Yes
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control control--radio" for="assessment_online_confrm_no">
                                                <input type="radio" name="assessment_online_confrm" class="assessment_online_confrm" id="assessment_online_confrm_no" value="2" /> No
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="assessment-online-error input-error-msg"></div>                                
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
                <input type="button" name="next" id="initialNext" class="next action-button btn btn-primary" value="Next"/>
                        

<!-- End of Initial Assessment Verification -->

    <?php
