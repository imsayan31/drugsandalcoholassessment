<?php
/*
 * customer Registration Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>

<!-- Zipcode Verification Successful -->

    <!-- <h3 class="fs-subtitle"><span>Step 1: Verify Our Services are Available in Your Area</span></h3> -->
    <div class="email_comfirmed">
        <span></span>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/email_verify.png" /><br/>
        <?php _e('Location Confirmed', THEME_TEXTDOMAIN); ?>
    </div>
    
    <input type="button" name="previous" class="previous action-button-previous" value="Back"/>
    <input type="button" name="next" id="secondNext" class="next action-button" value="Proceed"/>
   
            

<!-- Zipcode Verification Successful -->

    <?php
