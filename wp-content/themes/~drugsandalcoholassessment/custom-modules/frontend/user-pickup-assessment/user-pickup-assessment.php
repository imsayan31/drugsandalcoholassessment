<?php
/*
 * Customer Pick Up Assessment Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>


<!-- MultiStep Form -->

    
        <form id="customerPickUpAssessmentFrm" name="customerPickUpAssessmentFrm" action="javascript:void(0);" method="post" >
            <input type="hidden" name="action" value="customer_pickup_assessment">
            <!-- <input type="hidden" name="product_id" id="product_id" value=""/> -->
            <input type="hidden" name="product_name_val" id="product_name_val" value=""/>
            <input type="hidden" name="product_order_val" id="product_order_val" value=""/>
            <input type="hidden" name="product_extra_cost_val" id="product_extra_cost_val" value=""/>
            <input type="hidden" name="stripeToken" id="stripeToken" value="">
            <input type="hidden" name="user_ques_ans_val" id="user_ques_ans_val" value="">

            <!-- fieldsets -->

            <fieldset id="assessmentChoosing" class="account-register-fieldset">
                <?php theme_template_part('user-pickup-assessment/user-choose-assessmet-type'); ?>
            </fieldset>

            <?php if(!is_user_logged_in()): ?>
                <fieldset id="accountDetails" style="display: none;" class="account-register-fieldset">
                            <?php theme_template_part('user-registration/account-details'); ?>
                        </fieldset>

                        <!-- <fieldset id="emailConfirmation" style="display: none;" class="account-register-fieldset">
                            <?php //theme_template_part('user-registration/email-confirmation'); ?>
                        </fieldset> -->

                        <fieldset id="accountCreated" style="display: none;" class="account-register-fieldset">
                            <?php theme_template_part('user-registration/account-created'); ?>
                        </fieldset>
            <?php endif; ?>

            <fieldset id="orderMethodChoosing" style="display: none;" class="account-register-fieldset">
                <?php theme_template_part('user-pickup-assessment/user-choose-order-method'); ?>
            </fieldset>

            <fieldset id="billingInformation" style="display: none;" class="account-register-fieldset">
                <?php theme_template_part('user-pickup-assessment/user-billing-information'); ?>
            </fieldset>

            <fieldset id="paymentInformation" style="display: none;" class="account-register-fieldset">
                <?php theme_template_part('user-pickup-assessment/user-payment-information'); ?>
            </fieldset>

            <fieldset id="paymentPageInfo" style="display: none;" class="account-register-fieldset">
                <?php theme_template_part('user-pickup-assessment/user-stripe-payment'); ?>
            </fieldset>

        </form>
              
    



<!-- /.MultiStep Form -->
    <?php
