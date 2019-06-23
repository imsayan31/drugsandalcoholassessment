<?php
/*
 * User Reset Password Modal
 * 
 */
?>
<div class="modal fade popup_box" id="userResetPasswordModal" role="dialog">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php _e('Reset Password', THEME_TEXTDOMAIN); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="register_form">
                                <form name="userResetPasswordFrm" id="userResetPasswordFrm" action="javascript:void(0);" method="post">
                    <input type="hidden" name="action" value="user_reset_password"/>
                    <input type="hidden" name="user_data" value="<?php echo (isset($_GET['reset_pass']) && $_GET['reset_pass'] != '') ? $_GET['reset_pass'] : ''; ?>"/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="password" name="user_new_pass" class="form-control" id="user_new_pass" placeholder="<?php _e('New password*', THEME_TEXTDOMAIN); ?>" value=""/><div class="input-error-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="password" name="user_retype_new_pass" class="form-control" id="user_retype_new_pass" placeholder="<?php _e('Re-type new password*', THEME_TEXTDOMAIN); ?>" value=""/>
                                <div class="input-error-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" name="userResetPasswordSbmt" id="userResetPasswordSbmt" class="btn btn-primary ladda-button" data-size="l" data-style="zoom-in"><?php _e('Submit', THEME_TEXTDOMAIN); ?></button>
                    </div>
                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                <div class="text-center">
                    <?php _e('By using this new password you can login to your account.', THEME_TEXTDOMAIN); ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

    <?php
