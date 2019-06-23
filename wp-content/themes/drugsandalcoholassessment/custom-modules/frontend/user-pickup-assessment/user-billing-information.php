<?php
/*
 * Customer Assessment Type Choosing Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getOrderTypes = get_terms(THEME_PREFIX.'extra_cost',['hide_empty' => false, 'meta_key' => 'order_value', 'orderby' => 'meta_value_num', 'order' => 'ASC']);
$userDetails = $GeneralThemeObject->user_details();
?>

<!-- Choose Assesment Type -->

    <h3 class="fs-subtitle"><span><?php _e('Confirm Billing information',THEME_TEXTDOMAIN); ?></span></h3>
    
<div class="pop_mid_section1">
    <!-- Billing Details -->

        <section>
            <!-- <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="email" class="form-control" id="user_billing_email" name="user_billing_email" placeholder="<?php _e('Billing Email', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['billing_email']) ? $userDetails->data['billing_email'] : $userDetails->data['email']; ?>"/>
                        <div class="input-error-msg"></div>
                    </div>
                </div>
            </div> -->

        <!-- <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_billing_fname" name="user_billing_fname" placeholder="<?php _e('Billing First Name', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['billing_fname']) ? $userDetails->data['billing_fname'] : $userDetails->data['fname']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_billing_lname" name="user_billing_lname" placeholder="<?php _e('Billing Last Name', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['billing_lname']) ? $userDetails->data['billing_lname'] : $userDetails->data['lname']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_billing_address" name="user_billing_address" placeholder="<?php _e('Billing Address', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['billing_address']) ? $userDetails->data['billing_address'] : $userDetails->data['billing_address']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_billing_city" name="user_billing_city" placeholder="<?php _e('City', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['billing_city']) ? $userDetails->data['billing_city'] : $userDetails->data['location_display_name']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_billing_zipcode" name="user_billing_zipcode" placeholder="<?php _e('Zipcode', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['billing_zipcode']) ? $userDetails->data['billing_zipcode'] : $userDetails->data['zipcode']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>
        </section>
        

        <!-- End of Billing Details -->

        <!-- <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                <label class="control control--checkbox" for="user_shipping_billing">
                    <input type="checkbox" name="user_shipping_billing" class="user_shipping_billing" checked id="user_shipping_billing" value="1" /> <?php _e('Shipping address is the same as Billing.', THEME_TEXTDOMAIN); ?>
                    <div class="control__indicator"></div>
                </label>
            </div>
            </div>
        </div> -->
            
        <!-- Shipping Details  -->  
        <!-- <section class="shipping-details-sec" style="display: none;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="email" class="form-control" id="user_shipping_email" name="user_shipping_email" placeholder="<?php _e('Shipping Email', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['shipping_email']) ? $userDetails->data['shipping_email'] : $userDetails->data['billing_email']; ?>"/>
                        <div class="input-error-msg"></div>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_shipping_fname" name="user_shipping_fname" placeholder="<?php _e('Shipping First Name', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['shipping_fname']) ? $userDetails->data['shipping_fname'] : $userDetails->data['billing_fname']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_shipping_lname" name="user_shipping_lname" placeholder="<?php _e('Shipping Last Name', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['shipping_lname']) ? $userDetails->data['shipping_lname'] : $userDetails->data['billing_lname']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                <input type="text" class="form-control" id="user_shipping_address" name="user_shipping_address" placeholder="<?php _e('Shipping Address', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['shipping_address']) ? $userDetails->data['shipping_address'] : $userDetails->data['billing_address']; ?>"/>
                <div class="input-error-msg"></div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_shipping_city" name="user_shipping_city" placeholder="<?php _e('City', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['shipping_city']) ? $userDetails->data['shipping_city'] : $userDetails->data['billing_city']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_shipping_zipcode" name="user_shipping_zipcode" placeholder="<?php _e('Zipcode', THEME_TEXTDOMAIN); ?>" value="<?php echo ($userDetails->data['shipping_zipcode']) ? $userDetails->data['shipping_zipcode'] : $userDetails->data['billing_zipcode']; ?>"/>
                    <div class="input-error-msg"></div>
                </div>
            </div>
        </div>
        </section> -->
            
 </div>        
        
        <!-- End of Shipping Details  -->    
        
        <input type="button" name="previous" class="assmnt_prev action-button-previous" value="Back"/>
        <input type="button" name="next" id="thirdAssessmentNext" class="assmnt_next action-button" value="Next"/>
        

<!-- End of Choose Assesment Type -->

    <?php
