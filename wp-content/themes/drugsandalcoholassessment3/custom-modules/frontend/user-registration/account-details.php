<?php
/*
 * Customer Registration Page
 * 
 */
?>

<!-- Account Details -->
            
                <!-- <h3 class="fs-subtitle"><span>Step 3: Account Details</span></h3> -->
                <div class="pop_mid_section1">
                    <div class="row justify-content-md-center">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div style="color:#ff0000; position:absolute; line-height:40px; margin-left:-15px; font-size:22px;">*</div><input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div style="color:#ff0000; position:absolute; line-height:40px; margin-left:-15px; font-size:22px;">*</div><input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="Phone*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div style="color:#ff0000; position:absolute; line-height:40px; margin-left:-15px; font-size:22px;">*</div><input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div style="color:#ff0000; position:absolute; line-height:40px; margin-left:-15px; font-size:22px;">*</div>
                                        <input type="password" name="user_cnf_password" id="user_cnf_password" class="form-control" placeholder="Confirm Password*" autocomplete="off" />
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control control--checkbox" for="user_terms_agree">
                                            <input type="checkbox" name="user_terms_agree" id="user_terms_agree" value="1" /> I agree to the terms & conditions. <a href="<?php echo TERMS_CONDITION_PAGE; ?>">
                                                <?php _e('More Info', THEME_TEXTDOMAIN); ?></a>
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                    <div class="user-terms-error input-error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
                <input type="button" name="previous" class="previous action-button-previous" value="Back"/>
                <input type="button" name="next" id="fourthNext" class="next action-button" value="Create Account"/>
                
                
           
<!-- End of Account Details -->

    <?php
