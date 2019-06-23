<?php
/*
 * User Registration Modal
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>
<div id="userRegistrationModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title account-cretion-title"><?php _e('Select Location', THEME_TEXTDOMAIN); ?></h4>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <?php theme_template_part('user-registration/customer-registration'); ?>
            </div>
            <!-- <div class="modal-footer">
                
            </div> -->
        </div>
    </div>
</div>

    <?php
