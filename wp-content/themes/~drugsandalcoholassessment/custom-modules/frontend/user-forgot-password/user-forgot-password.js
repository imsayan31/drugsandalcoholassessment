jQuery(document).ready(function ($) {
    
    /* Click to Sign In */
    $('.click-sign-in').on('click', function () {
        $('#userForgotPasswordModal').modal('hide');
        $('#userLoginModal').modal('show');
    });

    /* User Forgot Password */
    $('#userForgotPasswordFrm').on('submit', function () {
        var user_forgot_email = $('#user_forgot_email').val();
        var emailValidation = checkForEmails(user_forgot_email);

        if (!user_forgot_email) {
            $('#user_forgot_email').next('div.input-error-msg').text('Enter your registered email.');
            $('div.input-error-msg').not($('#user_forgot_email').siblings('div.input-error-msg')).text('');
        } else if (emailValidation == false) {
            $('#user_forgot_email').next('div.input-error-msg').text('Enter email in proper format.');
            $('div.input-error-msg').not($('#user_forgot_email').siblings('div.input-error-msg')).text('');
        } else {
            $('div.input-error-msg').text('');
            var data = $(this).serialize();
            var findButton = document.getElementById('userForgotPasswordSbmt');
            var l = Ladda.create(findButton);
            l.start();
            
            $.post(ForgotPassword.ajaxurl, data, function (resp) {
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
});