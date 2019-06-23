jQuery(document).ready(function ($) {

    /* Masking */
    $('#user_phone_updated').mask('(000) 000-0000');
    $('#user_zipcode').mask('00000');

    /* Employer Account Form Submit */
    $('#employerAccountFrm').on('submit', function () {
        var user_fname = $('#user_first_name_updated').val();
        var user_lname = $('#user_last_name_updated').val();
        var user_phone = $('#user_phone_updated').val();
        var user_zipcode = $('#user_zipcode').val();
        var user_assesment_reason = $('.user_assesment_reason').is(':checked');
        
        var user_location = $('.user_location')[0].selectedIndex;

        var fnameValidation = checkForAlphabets(user_fname);
        var lnameValidation = checkForAlphabets(user_lname);

        if (!user_fname) {
            $('#user_first_name_updated').siblings('div.input-error-msg').text('Enter your first name.');
            $('div.input-error-msg').not($('#user_first_name_updated').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_first_name_updated').offset().top
            });
        } else if (fnameValidation == false) {
            $('#user_first_name_updated').siblings('div.input-error-msg').text('First name should contain letters only.');
            $('div.input-error-msg').not($('#user_first_name_updated').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_first_name_updated').offset().top
            });
        } else if (!user_lname) {
            $('#user_last_name_updated').siblings('div.input-error-msg').text('Enter your last name.');
            $('div.input-error-msg').not($('#user_last_name_updated').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_last_name_updated').offset().top
            });
        } else if (lnameValidation == false) {
            $('#user_last_name_updated').siblings('div.input-error-msg').text('Last name should contain letters only.');
            $('div.input-error-msg').not($('#user_last_name_updated').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_last_name_updated').offset().top
            });
        } else if (!user_phone) {
            $('#user_phone_updated').siblings('div.input-error-msg').text('Enter your phone.');
            $('div.input-error-msg').not($('#user_phone_updated').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_phone_updated').offset().top
            });
        } else if (user_assesment_reason == false) {
            $('.assesment-reason-error').text('Select your reason to join this assesment.');
            $('div.input-error-msg').not($('.assesment-reason-error')).text('');
            $('html, body').animate({
                scrollTop: $('.user_assesment_reason').offset().top
            });
        } else if (!user_zipcode) {
            $('#user_zipcode').siblings('div.input-error-msg').text('Enter your zipcode.');
            $('div.input-error-msg').not($('#user_zipcode').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_zipcode').offset().top
            });
        } else {
            $('div.input-error-msg').text('');
            var data = $(this).serialize();
            var findButton = document.getElementById('employerAccountSbmt');
            var l = Ladda.create(findButton);
            l.start();
            $.post(Account.ajaxurl, data, function (resp) {
                if (resp.flag == true) {
                    $.notify(resp.msg, {type: 'success', delay: 3000, allow_dismiss: true, z_index: 9999, 
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                    siteRedirection(resp.url, 3000);
                } else {
                    $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
                placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
                }
            }, 'json').always(function () {
                l.stop();
            });
        }
    });

    /* User Change Password Form Submit */
    $('#userChangePassFrm').on('submit', function () {
        var user_old_pass = $('#user_old_pass').val();
        var user_new_pass = $('#user_new_pass_updated').val();
        var user_retype_new_pass = $('#user_cnf_new_pass').val();
        var passwordValidation = checkForPassword(user_new_pass);

        if (!user_old_pass) {
            $('#user_old_pass').next('div.input-error-msg').text('Enter your old password.');
            $('div.input-error-msg').not($('#user_old_pass').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_old_pass').offset().top
            });
        } else if (!user_new_pass) {
            $('#user_new_pass_updated').next('div.input-error-msg').text('Enter your new password.');
            $('div.input-error-msg').not($('#user_new_pass_updated').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_new_pass_updated').offset().top
            });
        } 
        /*else if (passwordValidation == false) {
            $('#user_new_pass_updated').next('div.input-error-msg').text('Password should contain one upper case letter, one special character and one number.');
            $('div.input-error-msg').not($('#user_new_pass_updated').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_new_pass_updated').offset().top
            });
        }*/
         else if (user_new_pass.length < 8) {
            $('#user_new_pass_updated').next('div.input-error-msg').text('Password length should be minimum 8.');
            $('div.input-error-msg').not($('#user_new_pass_updated').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_new_pass_updated').offset().top
            });
        } else if (!user_retype_new_pass) {
            $('#user_cnf_new_pass').next('div.input-error-msg').text('Re-type your new password.');
            $('div.input-error-msg').not($('#user_cnf_new_pass').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_new_pass_updated').offset().top
            });
        } else if (user_new_pass != user_retype_new_pass) {
            $('#user_cnf_new_pass').next('div.input-error-msg').text('Passwords do not match.');
            $('div.input-error-msg').not($('#user_cnf_new_pass').siblings('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_cnf_password').offset().top
            });
        } else {
            $('div.input-error-msg').text('');
            var data = $(this).serialize();
            var findButton = document.getElementById('userChangePassSbmt');
            var l = Ladda.create(findButton);
            l.start();
            $.post(Account.ajaxurl, data, function (resp) {
                if (resp.flag == true) {
                    $.notify(resp.msg, {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999, 
                placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
                    siteRedirection(resp.url, 3000);
                } else {
                    $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
                placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
                }
            }, 'json').always(function () {
                l.stop();
            });
        }
    });

    /* Counselor Claim Assessment */
    $('.claim-assessment').on('click', function(){
        var _this = $(this);
        var _this_assessment = _this.data('assessment');
        var data ={
            action: 'counselor_claim_assessment',
            assessment: _this_assessment
        };
        $.post(Account.ajaxurl, data, function (resp) {
            if (resp.flag == true) {
                $.notify(resp.msg, {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999, 
            placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
                siteRedirection(resp.url, 3000);
            } else {
                $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
            placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
            }
        }, 'json');
    });
    
});