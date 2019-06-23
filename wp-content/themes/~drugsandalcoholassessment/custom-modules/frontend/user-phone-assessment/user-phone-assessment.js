jQuery(document).ready(function ($) {
    
    var $ = jQuery;

    /* Phone Number Masking */
    $('#phone_assessmet_number').mask('(000) 000-0000');

    $('#userPhoneAssessmentFrm').on('submit', function(){

        var phone_assessmet_number = $('#phone_assessmet_number').val();
        var phone_assessment_time = $('.phone_assessment_time')[0].selectedIndex;

        if(!phone_assessmet_number){
            $('#phone_assessmet_number').siblings('div.input-error-msg').text('Enter your phone number.');
            $('div.input-error-msg').not($('#phone_assessmet_number').siblings('div.input-error-msg')).text('');
        } else if(phone_assessment_time == 0){
            $('.phone-assessment-time-error').text('Select the time you are available to take calls.');
            $('div.input-error-msg').not($('.phone-assessment-time-error')).text('');
        } else {
            $('div.input-error-msg').text('');
            var data = $(this).serialize();
            var findButton = document.getElementById('employerAccountSbmt');
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
                        }
                ,/*showProgressbar: true,*/});
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