jQuery(document).ready(function ($) {


    /* Toggle Password */
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
          var input = $($(this).attr("toggle"));
          if (input.attr("type") == "password") {
            input.attr("type", "text");
          } else {
            input.attr("type", "password");
          }
    });

    /* Click to Sign Up */
    $('.click-sign-up').on('click', function () {
        $('#userLoginModal').modal('hide');
        $('#userRegModal').modal('show');
    });

    /* Click to Forgot Password */
    $('.click-forgot-pass').on('click', function () {
        $('#userLoginModal').modal('hide');
        $('#employerLoginModal').modal('hide');
        $('#userForgotPasswordModal').modal('show');
    });

    /* User Login Form Submit */
    $('#userLoginFrm').on('submit', function () {
        var user_login_mail = $('#user_login_mail').val();
        var user_login_pass = $('#user_login_pass').val();
        var emailValidation = checkForEmails(user_login_mail);
       

        if (!user_login_mail) {
            $('#user_login_mail').next('div.input-error-msg').text('Enter your email.');
            $('div.input-error-msg').not($('#user_login_mail').siblings('div.input-error-msg')).text('');
        } else if (emailValidation == false) {
            $('#user_login_mail').next('div.input-error-msg').text('Enter email in proper format.');
            $('div.input-error-msg').not($('#user_login_mail').siblings('div.input-error-msg')).text('');
        } else if (!user_login_pass) {
            $('#user_login_pass').siblings('div.input-error-msg').text('Enter your password.');
            $('div.input-error-msg').not($('#user_login_pass').siblings('div.input-error-msg')).text('');
        } else {
            $('div.input-error-msg').text('');
            var data = $(this).serialize();
            var findButton = document.getElementById('userLoginSbmt');
            var l = Ladda.create(findButton);
            l.start();
            $.post(Login.ajaxurl, data, function (resp) {
                if (resp.flag == true) {
                    $.notify(resp.msg, {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999, 
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                ,/*showProgressbar: true,*/});
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
