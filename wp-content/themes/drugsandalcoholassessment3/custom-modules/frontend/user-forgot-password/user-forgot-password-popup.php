<?php
/*
 * User Forgot Password Modal
 * 
 */
?>

<div class="modal fade popup_box" id="userForgotPasswordModal" role="dialog">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php _e('Forgot Password', THEME_TEXTDOMAIN); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="register_form">
                                <form name="userForgotPasswordFrm" id="userForgotPasswordFrm" action="javascript:void(0);" method="post">
                    <input type="hidden" name="action" value="user_forgot_password"/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="email" name="user_forgot_email" id="user_forgot_email" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Email*', THEME_TEXTDOMAIN); ?>"/>
                                <div class="input-error-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" name="userForgotPasswordSbmt" id="userForgotPasswordSbmt" class="btn btn-primary ladda-button" data-size="l" data-style="zoom-in"><?php _e('Submit', THEME_TEXTDOMAIN); ?></button>
                    </div>
                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                <div class="text-center">
                    <?php _e('A reset password link will be sent to your registered email address.', THEME_TEXTDOMAIN); ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

    <?php
