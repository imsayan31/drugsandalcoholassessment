<?php
/*
 * Customer Registration Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>

<!-- MultiStep Form -->
        <form id="customerRegFrm" name="customerRegFrm" action="javascript:void(0);" method="post">
            <input type="hidden" name="action" value="customer_registration">
            <input type="hidden" name="duplicate_email_id" id="duplicate_email_id" value=""/>
            <input type="hidden" name="duplicate_phone" id="duplicate_phone" value=""/>
            <input type="hidden" name="duplicate_password" id="duplicate_password" value=""/>
            <input type="hidden" name="duplicate_user_type" id="duplicate_user_type" value="customer"/>
            <input type="hidden" name="duplicate_user_location" id="duplicate_user_location" value=""/>
            
            <!-- fieldsets -->
            <fieldset id="initialAssessment" class="account-register-fieldset">
                <?php theme_template_part('user-registration/initial-assignment'); ?>
            </fieldset>

            <fieldset id="locationVerification" class="account-register-fieldset">
                <?php theme_template_part('user-registration/zipcode-verification'); ?>
            </fieldset>
            
            <fieldset id="zipcodeVerificationSuccessfull" style="display:none;" class="account-register-fieldset">
                <?php theme_template_part('user-registration/zipcode-verification-successful'); ?>
            </fieldset>
            
            <fieldset id="aboutYourself" style="display: none;" class="account-register-fieldset">
                <?php theme_template_part('user-registration/about-yourself'); ?>
            </fieldset>

<!--             <fieldset id="accountDetailsDuplicate" style="display: none;" class="account-register-fieldset">
                <?php //theme_template_part('user-registration/account-duplicate-details'); ?>
            </fieldset> -->

            <fieldset id="accountCreatedDuplicate" style="display: none;" class="account-register-fieldset">
                <?php theme_template_part('user-registration/account-duplicate-created'); ?>
            </fieldset>

        </form>

<!-- /.MultiStep Form -->

    <?php
