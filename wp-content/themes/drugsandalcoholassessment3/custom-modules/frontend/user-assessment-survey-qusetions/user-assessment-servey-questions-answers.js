jQuery(document).ready(function ($) {
    
    var $ = jQuery;
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    /* Next Click */
$(".survey_next").click(function(){
    //if(animating) return false;
    animating = true;

    var _this = $(this);

    /* Get ID of the step */
    var _this_id = $(this).prop('id');

    /* Get variables value */
    var exclude_question_id = $('#exclude_question_id').val();
    var main_product_id = $('#main_product_id').val();

        /* Data Generation For Second Set Of Questions */
        if(_this_id == 'firstSurveyNext'){
            var data = {
                action: 'get_question_set_2',
                exclude_question_id: exclude_question_id,
                main_product_id: main_product_id
            };

            $.post(SurveyQuestionAnswer.ajaxurl, data, function(resp){
                if(resp.flag == true){

                    /* Second Question Set */
                    $('.second-question-set').html(resp.msg);
                    
                        current_fs = _this.parent();
                        next_fs = _this.parent().next();
                    
                        //show the next fieldset
                        next_fs.show(); 
                        //hide the current fieldset with style
                        current_fs.animate({opacity: 0}, {
                        step: function(now, mx) {
                            //as the opacity of current_fs reduces to 0 - stored in "now"
                            //1. scale current_fs down to 80%
                            scale = 1 - (1 - now) * 0.2;
                            //2. bring next_fs from the right(50%)
                            left = (now * 50)+"%";
                            //3. increase opacity of next_fs to 1 as it moves in
                            opacity = 1 - now;
                            current_fs.css({
                        'transform': 'scale('+scale+')',
                        // 'position': 'absolute'
                            });
                            next_fs.css({'left': left, 'opacity': opacity});
                        }, 
                        duration: 800, 
                        complete: function(){
                            current_fs.hide();
                            animating = false;
                        }, 
                        //this comes from the custom easing plugin
                        easing: 'easeInOutBack'
                    }); 

                } else {

                    }
                },'json');
        }

    
});


/* Previous Click */
$(".survey_prev").click(function(){
    if(animating) return false;
    animating = true;
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //de-activate current step on progressbar
    //$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    console.log(previous_fs);
    
    //show the previous fieldset
    previous_fs.show(); 

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        }, 
        duration: 800, 
        complete: function(){
            current_fs.hide();
            animating = false;
        }, 
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

$('.survey_submit').on('click', function(){

        $('div.input-error-msg').text('');
        var data = $('#customerSurveyFrm').serialize();
        $('#full-site-loader').show();
        $.post(PickAssessment.ajaxurl, data, function(resp){
            $('#full-site-loader').hide();
            if(resp.flag == true){
                $('#user_ques_ans_val').val(resp.set_1_ques);
                $('#userSurveyQuestionsAnswersModal').modal('hide');
                $('#userAssessmentModal').modal('show');
            //     $.notify(resp.msg, {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999, 
            // placement: {
            //                 from: 'top',
            //                 align: 'center'
            //             }
            //         });
            //     siteRedirection(resp.url, 3000);
            } else{
                $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
            placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
            }
        },'json');

});

    /* Click to answer */
    /*$('.click-to-questions').on('click', function(){
        var _this = $(this);
        var _this_product = _this.data('product');
        var _this_assessment_id = _this.data('assessment_id');
        $('#main_product_id').val(_this_product);
        $('#main_assessment_id').val(_this_assessment_id);
        var data = {
            action: 'get_question_set_1',
            product: _this_product
        };
        $('#full-site-loader').show();
        $.post(SurveyQuestionAnswer.ajaxurl, data, function(resp){
            $('#full-site-loader').hide();
            if(resp.flag == true){
                $('#exclude_question_id').val(resp.set_1_ques);
                $('.first-question-set').html(resp.msg);
                $('#userSurveyQuestionsAnswersModal').modal('show');
            } else {

            }
        },'json');
    });*/

});

/* Site Redirection */
function siteRedirection(url, time) {
    setTimeout(function () {
        window.location.href = url;
    }, time);
}

/* Check String Contains Alphabets */
function checkForAlphabets(str) {
    var patt = /^[a-zA-Z ]+$/;
    if (patt.test(str) == true) {
        return true;
    } else {
        return false;
    }
}

/* Check String Contains Numbers */
function checkForNumbers(str) {
    var patt = /^\d+$/;
    if (patt.test(str) == true) {
        return true;
    } else {
        return false;
    }
}

/* Check String Contains Emails */
function checkForEmails(str) {
    var patt = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
    if (patt.test(str) == true) {
        return true;
    } else {
        return false;
    }
}

/* Check String Contains Passwords */
function checkForPassword(str) {
    var patt = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/;
    if (patt.test(str) == true) {
        return true;
    } else {
        return false;
    }
}