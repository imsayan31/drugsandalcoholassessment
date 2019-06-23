<?php
/*
 * User Registration Modal
 * 
 */
$GeneralThemeObject = new GeneralTheme();
?>
<div id="userSurveyQuestionsAnswersModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e('Questionnaire', THEME_TEXTDOMAIN); ?></h4>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                 <div class="pop_mid_section1" style="max-height: 500px;overflow-y: scroll;"><?php theme_template_part('user-assessment-survey-qusetions/user-assessment-survey'); ?></div>
            </div>
            <!-- <div class="modal-footer">
                
            </div> -->
        </div>
    </div>
</div>

    <?php
