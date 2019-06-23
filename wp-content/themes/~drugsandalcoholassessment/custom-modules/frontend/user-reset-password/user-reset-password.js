jQuery(document).ready(function ($) {

    /* User Reset Password */
    $('#userResetPasswordFrm').on('submit', function () {
        var user_new_pass = $('#user_new_pass').val();
        var user_retype_new_pass = $('#user_retype_new_pass').val();
        var passwordValidation = checkForPassword(user_new_pass);

        if (!user_new_pass) {
            $('#user_new_pass').next('div.input-error-msg').text('Enter your new password.');
            $('div.input-error-msg').not($('#user_new_pass').siblings('div.input-error-msg')).text('');
        } else if (passwordValidation == false) {
            $('#user_new_pass').next('div.input-error-msg').text('Password should contain one upper case letter, one special character and one number.');
            $('div.input-error-msg').not($('#user_new_pass').siblings('div.input-error-msg')).text('');
        } else if (user_new_pass.length < 8) {
            $('#user_new_pass').next('div.input-error-msg').text('Password length should be greater than 8.');
            $('div.input-error-msg').not($('#user_new_pass').siblings('div.input-error-msg')).text('');
        } else if (!user_retype_new_pass) {
            $('#user_retype_new_pass').next('div.input-error-msg').text('Retype your new password.');
            $('div.input-error-msg').not($('#user_retype_new_pass').siblings('div.input-error-msg')).text('');
        } else if (user_new_pass != user_retype_new_pass) {
            $('#user_retype_new_pass').next('div.input-error-msg').text('Your new password not matched.');
            $('div.input-error-msg').not($('#user_retype_new_pass').siblings('div.input-error-msg')).text('');
        } else {
            $('div.input-error-msg').text('');
            var data = $(this).serialize();
            var findButton = document.getElementById('userResetPasswordSbmt');
            var l = Ladda.create(findButton);
            l.start();
            $.post(ResetPassword.ajaxurl, data, function (resp) {
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