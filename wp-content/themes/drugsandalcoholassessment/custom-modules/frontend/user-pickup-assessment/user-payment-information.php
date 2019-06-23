<?php
/*
 * Customer Assessment Type Choosing Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getOrderTypes = get_terms(THEME_PREFIX.'extra_cost',['hide_empty' => false, 'meta_key' => 'order_value', 'orderby' => 'meta_value_num', 'order' => 'ASC']);
?>

<!-- Choose Assesment Type -->

    <h3 class="fs-subtitle"><span><?php _e('Payment Confirmation',THEME_TEXTDOMAIN); ?></span></h3>
    <section class="payment-info-sec">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="order-overview"></div>
                <!-- 
                    <div class="form-group">
                        <span class="coupon-code-text"><?php _e('You can enter coupon code if you have any.',THEME_TEXTDOMAIN); ?></span>
                        <input type="text" name="user_coupon_code" id="user_coupon_code" class="form-control" autocomplete="off" value="" placeholder="<?php _e('Enter coupon code',THEME_TEXTDOMAIN); ?>" />
                        <input type="button" id="applyCouponCode" class="" value="Apply Now"/>
                    </div>
                -->
            </div>
        </div>
	</section>
	
	<input type="button" name="previous" class="assmnt_prev action-button-previous" value="Back"/>
    <input type="button" name="next" id="fourthAssessmentNext" class="assmnt_next action-button" value="Confirm"/>
    

<!-- End of Choose Assesment Type -->

    <?php
