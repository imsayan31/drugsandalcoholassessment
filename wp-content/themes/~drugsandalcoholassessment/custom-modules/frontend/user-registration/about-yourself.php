<?php
/*
 * customer Registration Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getLocation = $GeneralThemeObject->getLocation();
?>

<!-- About Yourself -->
                
                <h3 class="fs-subtitle"><span>Step 2:</span> Tell Us About Yourself</h3>
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <div class="pop_mid_section1">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="rq-star">*</div><input type="text" name="user_first_name" id="user_first_name" class="form-control" placeholder="First Name*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="rq-star">*</div><input type="text" name="user_last_name" id="user_last_name" class="form-control" placeholder="Last Name*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="assessment-reason-sec">
                                <div class="assessment_header"><label>Reasons for assessment:</label></div>
                            <div class="row assessment">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="court_ordered" class="control control--checkbox">
                                            <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Court Ordered" id="court_ordered"> Court Ordered
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="professional_board" class="control control--checkbox">
                                            <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Professional board" id="professional_board"> Professional board
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="employer_recruitment" class="control control--checkbox">
                                            <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Employer Requirement" id="employer_recruitment"> Employer Requirement
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="personal_reasons" class="control control--checkbox">
                                            <input type="checkbox" class="user_assesment_reason" name="user_assesment_reason[]" value="Other/ Personal Reasons" id="personal_reasons"> Other/ Personal Reasons
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="assesment-reason-error input-error-msg"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center new-account-details-sec" style="display: none;">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div style="color:#ff0000; position:absolute; line-height:40px; margin-left:-15px; font-size:22px;">*</div><input type="email" name="user_email" id="user_duplicate_email" class="form-control" placeholder="Email*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div style="color:#ff0000; position:absolute; line-height:40px; margin-left:-15px; font-size:22px;">*</div><input type="text" name="user_phone" id="user_duplicate_phone" class="form-control" placeholder="Phone*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div style="color:#ff0000; position:absolute; line-height:40px; margin-left:-15px; font-size:22px;">*</div><input type="password" name="user_password" id="user_duplicate_password" class="form-control" placeholder="Password*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div style="color:#ff0000; position:absolute; line-height:40px; margin-left:-15px; font-size:22px;">*</div>
                                        <input type="password" name="user_cnf_password" id="user_duplicate_cnf_password" class="form-control" placeholder="Confirm Password*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control control--checkbox" for="user_duplicate_terms_agree">
                                            <input type="checkbox" name="user_terms_agree" id="user_duplicate_terms_agree" value="1" /> I agree to the terms & conditions. <a href="<?php echo TERMS_CONDITION_PAGE; ?>">
                                                <?php _e('More Info', THEME_TEXTDOMAIN); ?></a>
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                    <div class="user-terms-error input-error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
				
                <input type="button" name="next" id="thirdNext" class="next action-button" value="Next"/>
                <input type="button" name="previous" class="previous action-button-previous" value="Back"/>
                

<!-- End of About Yourself -->

    <?php
