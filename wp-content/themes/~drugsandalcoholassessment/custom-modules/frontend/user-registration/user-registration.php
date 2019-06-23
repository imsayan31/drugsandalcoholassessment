<?php
/*
 * customer Registration Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getLocation = $GeneralThemeObject->getLocation();
?>

<div class="col-lg-12">
    
    <!-- MultiStep Form -->
    <!-- Section Existing User -->
    <div class="bg-light-sky">
        <div class="registration_block">
            <label><?php _e('Already have an account?',THEME_TEXTDOMAIN); ?></label>
            <div class="row justify-content-sm-center">
                <div class="col-sm-6">
                    <a href="#userLoginModal" data-toggle="modal" class="btn btn-primary btn-block"><?php _e('Sign In', THEME_TEXTDOMAIN); ?></a>
                </div>
            </div>
        </div>
        <!-- End of Section Existing User -->

        <!-- Section New User -->
        <div class="registration_block">
            <label >
                <?php _e('Need a drug or alcohol assessment?',THEME_TEXTDOMAIN); ?>
            </label>
            <div class="row justify-content-sm-center">
                <div class="col-sm-6">
                    <a href="#userRegistrationModal" data-toggle="modal" class="btn btn-primary btn-block"><?php _e('Create an Account',THEME_TEXTDOMAIN); ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Section New User -->
    
    <div class="row justify-content-sm-center">
        <div class="col-sm-6">
            <div class="registration-list">
                <ul>
                    <li>Guaranteed court accepted</li>
                    <li>Choose the assessment you need</li>
                    <li>Certified phone interview from your own home</li>
                    <li>100% Money back guarantee</li>
                    <li>Rush service</li>
                </ul>
            </div>
        </div>
    </div>    
</div>


<!-- /.MultiStep Form -->

    <?php
