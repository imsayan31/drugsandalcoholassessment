<?php
/*
 * customer Registration Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getLocation = $GeneralThemeObject->getLocation();
?>

<!-- Zipcode Verification -->

            
                <!-- <h2 class="fs-title">Location Availability</h2> -->
                <h3 class="fs-subtitle">Step 1: Verify Our Services are Available in Your Area</h3>
                <div class="form-group"><!-- user_location -->
                    <input type="text" name="user_location" id="user_location" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Zip code',THEME_TEXTDOMAIN); ?>"/>
                    <div class="user-location-error input-error-msg"></div>
                </div>
                <input type="button" name="next" id="firstNext" class="next action-button" value="Verify Location"/>
            



<!-- End of Zipcode Verification -->

    <?php
