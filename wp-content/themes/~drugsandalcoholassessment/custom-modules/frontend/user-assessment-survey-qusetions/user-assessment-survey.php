<?php
/*
 * Customer Assessment Type Choosing Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$getOrderTypes = get_terms(THEME_PREFIX.'extra_cost',['hide_empty' => false, 'meta_key' => 'order_value', 'orderby' => 'meta_value_num', 'order' => 'ASC']);
$userDetails = $GeneralThemeObject->user_details();
?>

<!-- MultiStep Form -->

    <div class="col-sm-12">
        <form id="customerSurveyFrm" name="customerSurveyFrm" action="javascript:void(0);" method="post">
            <input type="hidden" name="action" value="customer_survey">
            <input type="hidden" name="main_product_id" id="main_product_id" value=""/>
            <input type="hidden" name="main_assessment_id" id="main_assessment_id" value=""/>
            <input type="hidden" name="exclude_question_id" id="exclude_question_id" value=""/>

            <!-- fieldsets -->
            <fieldset id="assessmentSurveySet1" class="account-register-fieldset">
                <?php theme_template_part('user-assessment-survey-qusetions/user-question-answers-set-1'); ?>
            </fieldset>

            <fieldset id="assessmentSurveySet2" style="display: none;" class="account-register-fieldset">
                <?php theme_template_part('user-assessment-survey-qusetions/user-question-answers-set-2'); ?>
            </fieldset>

        </form>
    </div>

<!-- /.MultiStep Form -->

    <?php
