<?php
/*
 * User Login Modal
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getSiteCookie = $GeneralThemeObject->getSiteCookie();
?>

<div class="modal fade popup_box" id="userLoginModal" role="dialog">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php _e('Sign In', THEME_TEXTDOMAIN); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="register_form">
                                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <form name="userLoginFrm" id="userLoginFrm" action="javascript:void(0);" method="post">
                            <input type="hidden" name="action" value="user_login"/>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="rq-star">*</div><input type="email" name="user_login_mail" id="user_login_mail" class="form-control" autocomplete="off" value="<?php echo (isset($getSiteCookie->user_email) && $getSiteCookie->user_email != '') ? $getSiteCookie->user_email : ''; ?>" placeholder="<?php _e('Email*', THEME_TEXTDOMAIN); ?>"/>
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="rq-star">*</div><input type="password" name="user_login_pass" id="user_login_pass" class="form-control" autocomplete="off" value="<?php echo (isset($getSiteCookie->user_pass) && $getSiteCookie->user_pass != '') ? $getSiteCookie->user_pass : ''; ?>" placeholder="<?php _e('Password*', THEME_TEXTDOMAIN); ?>"/>
                                        <span toggle="#user_login_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        <div class="input-error-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6" style="text-align:left;">
                                    <div class="form-group">
                                        <label class="control control--checkbox" for="user_login_remember">
                                            <input type="checkbox" name="user_login_remember" id="user_login_remember" value="1" <?php echo (isset($getSiteCookie->user_pass) && $getSiteCookie->user_pass != '') ? 'checked' : ''; ?>/><?php _e('Remember me', THEME_TEXTDOMAIN); ?>
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 text-md-right">
                                    <div class="form-group">
                                        <a href="javascript:void(0);" class="click-forgot-pass"><?php _e('Forgot password?', THEME_TEXTDOMAIN); ?></a>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <button type="submit" name="userLoginSbmt" id="userLoginSbmt" class="btn btn-primary btn-block ladda-button" data-size="l" data-style="zoom-in"><?php _e('Sign In', THEME_TEXTDOMAIN); ?></button>
                            </div>
                        </form>
                    </div>
                    
                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                <div class="text-center">
                    <?php _e('New Member?', THEME_TEXTDOMAIN); ?><a href="javascript:void(0);" class="sign-up-modal-click"><?php _e(' Sign Up', THEME_TEXTDOMAIN); ?></a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


    <?php
