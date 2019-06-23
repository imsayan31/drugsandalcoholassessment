<?php
/*
 * User Registration Modal
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>
<style type="text/css">
    .choose-user-type-button{
        background: #5695d0;
        padding: 6px 20px;
        border-radius: 5px !important;
        color: #fff;
        margin-left: 20px;
        font-size: 20px;
    }
</style>
<div class="register_form">
    <div id="userRegistrationChooseModal" class="modal fade popup_box" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title account-cretion-title"><?php _e('Choose User Type', THEME_TEXTDOMAIN); ?></h4>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <a href="javascript:void(0);" class="ladda-button customer-reg-popup choose-user-type-button"><?php _e('Customer', THEME_TEXTDOMAIN); ?></a>
                <a href="javascript:void(0);" class="ladda-button counselor-reg-popup choose-user-type-button"><?php _e('Counselor', THEME_TEXTDOMAIN); ?></a>
            </div>
            <!-- <div class="modal-footer">
                
            </div> -->
        </div>
    </div>
</div>
</div>


    <?php
