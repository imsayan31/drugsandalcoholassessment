<?php
/*
 * Customer Assessment Type Choosing Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$userDetails = $GeneralThemeObject->user_details();
?>

<!-- Choose Assesment Type -->

    <h3 class="fs-subtitle"><span><?php _e('Complete questionnaire',THEME_TEXTDOMAIN); ?></span></h3>
    <section class="first-question-set"></section>
   
    <!-- <input type="button" name="next" id="firstSurveyNext" class="survey_next action-button" value="Next"/> -->
    <input type="button" name="next" id="firstSurveyNext" class="survey_submit action-button" value="Submit"/>
        

<!-- End of Choose Assesment Type -->

    <?php
