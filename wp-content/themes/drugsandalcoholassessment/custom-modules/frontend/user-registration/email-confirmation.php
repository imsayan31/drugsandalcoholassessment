<?php
/*
 * Customer Registration Page
 *
 */
$GeneralThemeObject = new GeneralTheme(); 
?>
<style type="text/css">
    #given-email-addrs {
        font-size: 15px;
    letter-spacing: 6px;
    font-weight: 600;
    margin-top: -25px;
    text-align: center;
    margin-bottom: 10px;
    text-transform: lowercase;
    }
    .div-send-new-code{
        text-align: center;
        margin-bottom: 8px;
    }
</style>
<!-- Email Confirmation -->

                <h3 class="fs-subtitle"><span>Step 4: Confirm Email address</span></h3>
                <div class="pop_mid_section1">
                    <div class="row justify-content-md-center">
                        <div class="col-md-10">
                            <h6 style="text-align: center;"><?php _e('We sent a code to the email address:', THEME_TEXTDOMAIN); ?>
                            <br>
                            <h5 id="given-email-addrs"></h5>
                            <input type="hidden" name="verification_data" id="verification_data" value="" />
                            <div class="form-group">
                                <div class="rq-star">*</div><input type="text" name="user_verification_code" id="user_verification_code" class="form-control" placeholder="Enter email confirmation code here" autocomplete="off" />
                                <div class="input-error-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="div-send-new-code"><a href="javascript:void(0);" class="send-new-code"><?php _e('Send New Code',THEME_TEXTDOMAIN); ?></a></div>
                </div>
				
                <input type="submit" name="submit" id="fifthNext" class="submit action-button" value="Verify"/>
                <input type="button" name="previous" class="previous action-button-previous" value="Back"/>
                

<!-- End of Email Confirmation -->

    <?php
