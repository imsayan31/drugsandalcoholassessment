<?php
/*
 * User Forgot Password Modal
 * 
 */
?>
<div id="userForgotPasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog1">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e('Forgot Password', THEME_TEXTDOMAIN); ?></h4>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <?php _e('A reset password link will be sent to your registered email address.', THEME_TEXTDOMAIN); ?>
            </div>
        </div>
    </div>
</div>
    <?php
