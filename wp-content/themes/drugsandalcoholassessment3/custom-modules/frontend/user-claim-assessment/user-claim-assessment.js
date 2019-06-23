jQuery(document).ready(function ($) {
    
    var $ = jQuery;

    var todayDate = new Date().getDate();

    /* Phone Number Masking */
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy hh:ii",
        startDate: new Date(),
        endDate: new Date(new Date().setDate(todayDate + 30))
    });

    /* Claim Assessment Preparation */
    $('.couns-claim-assessment').on('click', function(){
        var _this = $(this);
        var _this_assessment = _this.data('assessment');

        var data = {
            action: 'preparing_for_claiming',
            assessment: _this_assessment
        };
        $('#full-site-loader').show();
        $.post(ClaimAssessment.ajaxurl, data, function(resp){
            $('#full-site-loader').hide();
            if(resp.flag == true){
                $('.claim-assessment-cont').html(resp.msg);
                $('#userClaimAssessmentModal').modal('show');
                $('#user_claim_assessment_id').val(_this_assessment);
            } else {
                $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
            placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
            }
        },'json');
    });

    /* View Assessment Survey Report */
    $('.couns-view-survey-assessment').on('click', function(){
        var _this = $(this);
        var _this_assessment = _this.data('assessment');

        var data = {
            action: 'view_survey_report',
            assessment: _this_assessment
        };
        $('#full-site-loader').show();
        $.post(ClaimAssessment.ajaxurl, data, function(resp){
            $('#full-site-loader').hide();
            if(resp.flag == true){
                //console.log($('#userViewAssessmentSurveyModal').modal('show'));
                $('.view-assessment-survey-cont').html(resp.msg);
                $('#userViewAssessmentSurveyModal').modal('show');
            } else {
                $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
            placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
            }
        },'json');
    });

    
    /* Claim Assessment */
    $('#userClaimAssessmentFrm').on('submit', function(){

        var claim_assessment_date = $('#claim_assessment_date').val();

        if(!claim_assessment_date){
            $('#claim_assessment_date').parent('.input-append').siblings('div.input-error-msg').text('Select date when you are available to take this assessment.');
            $('div.input-error-msg').not($('#claim_assessment_date').parent('.input-append').siblings('div.input-error-msg')).text('');
        } else {
            
            $('div.input-error-msg').text('');
            var data = $(this).serialize();
            var findButton = document.getElementById('userClaimAsessmentSbmt');
            var l = Ladda.create(findButton);
            l.start();
            $('#full-site-loader').show();
            $.post(PhoneAssessment.ajaxurl, data, function(resp){
                $('#full-site-loader').hide();
                if(resp.flag == true){
                    $.notify(resp.msg, {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999, 
                placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
                    siteRedirection(resp.url, 3000);
                } else{
                    $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
                placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
                }
            },'json').always(function () {
                l.stop();
            });
        }   
    });

    /* Click to Phone Assessment */
    $('.click-to-phone-assessment').on('click', function(){
        var _this = $(this);
        var _this_product = _this.data('product');
        var _this_assessment_id = _this.data('assessment_id');
        $('#user_phone_assessment_product_id').val(_this_product);
        $('#user_phone_assessment_id').val(_this_assessment_id);
        // console.log(_this_assessment_id);
        // return;
        var data = {
            action: 'get_phone_assessment_data',
            assessment_id: _this_assessment_id
        };
        $('#full-site-loader').show();
        $.post(PhoneAssessment.ajaxurl, data, function(resp){
            $('#full-site-loader').hide();
            if(resp.flag == true){
                $('#phone_assessmet_number').val(resp.phone_number);
                $('option[value="'+ resp.assmnt_time +'"]').attr('selected', 'selected');
                $('#userPhoneAssessmentModal').modal('show');
            } else{
                $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
            placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
            }
        },'json');
    });

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