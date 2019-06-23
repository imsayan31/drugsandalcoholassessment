<?php
/*
 * Customer Assessment Type Choosing Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getOrderTypes = get_terms(THEME_PREFIX.'extra_cost',['hide_empty' => false, 'meta_key' => 'order_value', 'orderby' => 'meta_value_num', 'order' => 'ASC']);
?>

<!-- Choose Assesment Type -->

     <h3 class="fs-subtitle"><span><?php _e('Select order method',THEME_TEXTDOMAIN); ?></span></h3> 
    
            <?php
            if(is_array($getOrderTypes) && count($getOrderTypes) > 0){
                foreach ($getOrderTypes as $eachOrderType) {
                    $extraCostVal = get_field('additional_cost', $eachOrderType);
                    ?>
					<div class="row justify-content-md-center">
                      <div class="col-md-10">
                       <div class="pop_mid_section">
                        <div class="form-group">
                            <label class="control control--radio" for="user_order_type_<?php echo $eachOrderType->slug; ?>">
                                <input type="radio" name="user_order_type" class="user_order_type" id="user_order_type_<?php echo $eachOrderType->slug; ?>" value="<?php echo $eachOrderType->slug; ?>" /> <?php echo $eachOrderType->name; ?><?php echo ($extraCostVal == 0) ? ' (No extra cost)' : ' (+ $'.$extraCostVal.')'; ?>
                                <div class="control__indicator"></div>
                            </label>
                        </div>
                    </div>
                        </div>
					</div>
                    <?php
                }
            }
            ?>    
            <div class="user-order-error input-error-msg"></div>
        
            <div class="order_text">
                These timeframes begin once your interview with the evaluator is complete. We will schedule you as soon as we can.
                <br>
                Questions? Call <a href="tel:1-833-573-7658">1-833-573-7658</a> or email <a href="mailto:info@drugsandalcoholassessments.com">info@drugsandalcoholassessments.com
</a>
            </div>
			
<!--			<div class="order_text1">
			     <h3>More about Drug & Alcohol Assessment</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
				when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
				into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
				and more recently with desktop publishing software</p>
            </div>-->

            <div class="coupon-code-sec">
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <span class="coupon-code-text" style="font-size: 15px; font-weight: bold;">
                                <?php _e('You can enter offer code if you have any',THEME_TEXTDOMAIN); ?></span>
                            <input type="text" name="user_coupon_code" id="user_coupon_code" class="form-control" autocomplete="off" style="margin-top: 10px;" value="" placeholder="<?php _e('Enter coupon code',THEME_TEXTDOMAIN); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="button" name="previous" class="assmnt_prev action-button-previous" value="Back"/>
            <input type="button" name="next" id="secondAssessmentNext" class="assmnt_next action-button" value="Next"/>
            

<!-- End of Choose Assesment Type -->

    <?php
