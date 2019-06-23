<?php
/*
 * User Registration Modal
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>
<div class="modal fade popup_box" id="userAssessmentModal" role="dialog">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php _e('Pick an Assessment', THEME_TEXTDOMAIN); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="register_form">
                                <?php theme_template_part('user-pickup-assessment/user-pickup-assessment'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

    <?php
