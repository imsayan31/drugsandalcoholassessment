jQuery(document).ready(function ($) {

    /* Customer Reg Pop Up Open */
    $('.customer-reg-popup').on('click', function(){
        $('#userRegistrationModal').modal('show');
        $('#userRegistrationChooseModal').modal('hide');
        $('#duplicate_user_type').val('customer');
        $('.new-account-details-sec').hide();
        $('.assessment-reason-sec').show();
    });

    /* Counselor Reg Pop Up Open */
    $('.counselor-reg-popup').on('click', function(){
        $('#userRegistrationModal').modal('show');
        $('#userRegistrationChooseModal').modal('hide');
        $('#duplicate_user_type').val('counselor');
        $('.new-account-details-sec').show();
        $('.assessment-reason-sec').hide();
    });

    /* Click to Sign In */
    $('.click-sign-in').on('click', function () {
        $('#userRegModal').modal('hide');
        $('#userLoginModal').modal('show');
    });

    /* Click to Employer Sign In */
    $('.click-employee-sign-in').on('click', function () {

        $('#employerLoginModal').modal('show');
    });

    /* Change State */
    $('.user_location').on('change', function(){
        var _this_val = $(this).val();
        //console.log(_this_desc);
        $('.state-description-' + _this_val).show();
        $('.state-description-' + _this_val).siblings('.all-state-desc').hide();
    });

    /* Masking */
    $('#user_phone').mask('(000) 000-0000');
   
    
    var $ = jQuery;
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches


    /* Next Click */
            /* Next Click */
$(".next").click(function(){
    //if(animating) return false;
    animating = true;

    var _this = $(this);

    /* Get ID of the step */
    var _this_id = $(this).prop('id');

    /* Modal Title Change */
    if(_this_id == 'secondNext'){
        /* Header Text Change */
        $('.account-cretion-title').text('Your Info');
    }

    /* Get variables value */
    var user_location = $('.user_location')[0].selectedIndex;

    var user_first_name = $('#user_first_name').val();
    var user_last_name = $('#user_last_name').val();
    var user_assesment_reason = $('.user_assesment_reason').is(':checked');
    var firstNameChecking = checkForAlphabets(user_first_name);
    var lastNameChecking = checkForAlphabets(user_last_name);

    var user_email = $('#user_email').val();
    var user_phone = $('#user_phone').val();
    var user_password = $('#user_password').val();
    var user_cnf_password = $('#user_cnf_password').val();
    //var user_type = $('.user_type').is(':checked');
    var user_terms_agree = $('#user_terms_agree').is(':checked');
    var emailChecking = checkForEmails(user_email);
    var passwordChecking = checkForPassword(user_password);

    var user_duplicate_email = $('#user_duplicate_email').val();
    var user_duplicate_phone = $('#user_duplicate_phone').val();
    var user_duplicate_password = $('#user_duplicate_password').val();
    var user_duplicate_cnf_password = $('#user_duplicate_cnf_password').val();
    //var user_type = $('.user_type').is(':checked');
    var user_duplicate_terms_agree = $('#user_duplicate_terms_agree').is(':checked');

    var emailDuplicateChecking = checkForEmails(user_duplicate_email);
    var passwordDuplicateChecking = checkForPassword(user_duplicate_password);


    var user_type_checked = $('.user_type[checked="checked"]').val();
    var duplicate_user_location = $('.user_location').val();
    var duplicate_user_type = $('#duplicate_user_type').val();

    if(_this_id == 'firstNext' && user_location == 0){
        $('.user-location-error').text('Select your location.');
        $('div.input-error-msg').not($('.user-location-error')).text('');
        
    } else if(_this_id == 'firstNext' && user_location > 0){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        var data = {
            action: 'zipcode_verification',
            zipcode: $('.user_location').val()
        };

        var findButton = document.getElementById('userLoginSbmt');
            var l = Ladda.create(findButton);
            l.start();
        $('#full-site-loader').show();
        $.post(Registration.ajaxurl, data, function(resp){
            $('#full-site-loader').hide();
            if(resp.flag == true){

                /* Header Text Change */
                $('.account-cretion-title').text('Location Verified');

                $('.div.input-error-msg').text('');

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

                $('#duplicate_user_location').val(duplicate_user_location);
                
        } else {
                $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
            placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
                return;
            }
        },'json').always(function () {
                l.stop();
            });


    } else if(_this_id == 'thirdNext' && !user_first_name){
            console.log('I am second.');
            $('#user_first_name').next('div.input-error-msg').text('Enter your first name.');
            $('div.input-error-msg').not($('#user_first_name').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_first_name').offset().top
            });
            
    } else if(_this_id == 'thirdNext' && firstNameChecking == false){
            console.log('I am second.');
            $('#user_first_name').next('div.input-error-msg').text('First name should contain letters only.');
            $('div.input-error-msg').not($('#user_first_name').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_first_name').offset().top
            });
            
    } else if(_this_id == 'thirdNext' && !user_last_name){

            $('#user_last_name').next('div.input-error-msg').text('Enter your last name.');
            $('div.input-error-msg').not($('#user_last_name').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_last_name').offset().top
            });
            
    } else if(_this_id == 'thirdNext' && lastNameChecking == false){
            
            $('#user_last_name').next('div.input-error-msg').text('Last name should contain letters only.');
            $('div.input-error-msg').not($('#user_last_name').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_last_name').offset().top
            });
            
    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && !user_duplicate_email){

        $('#user_duplicate_email').next('div.input-error-msg').text('Enter your email.');
            $('div.input-error-msg').not($('#user_duplicate_email').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_duplicate_email').offset().top
            });
            
    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && emailDuplicateChecking == false){

        $('#user_duplicate_email').next('div.input-error-msg').text('Enter your email in proper format.');
            $('div.input-error-msg').not($('#user_duplicate_email').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_duplicate_email').offset().top
            });

    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && !user_duplicate_phone){

        $('#user_duplicate_phone').next('div.input-error-msg').text('Enter your phone number.');
            $('div.input-error-msg').not($('#user_duplicate_phone').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_duplicate_phone').offset().top
            });

    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && !user_duplicate_password){

        $('#user_duplicate_password').next('div.input-error-msg').text('Enter your password.');
            $('div.input-error-msg').not($('#user_duplicate_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_duplicate_password').offset().top
            });

    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && user_duplicate_password.length < 8){

        $('#user_duplicate_password').next('div.input-error-msg').text('Password length must be greater than equals to 8.');
            $('div.input-error-msg').not($('#user_duplicate_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_duplicate_password').offset().top
            });

    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && passwordDuplicateChecking == false){

        $('#user_duplicate_password').next('div.input-error-msg').text('Password must contain one Upper case letter, one special character and one number.');
            $('div.input-error-msg').not($('#user_duplicate_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_duplicate_password').offset().top
            });

    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && !user_duplicate_cnf_password){

        $('#user_duplicate_cnf_password').next('div.input-error-msg').text('Confirm your password.');
            $('div.input-error-msg').not($('#user_duplicate_cnf_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_duplicate_cnf_password').offset().top
            });

    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && user_duplicate_password != user_duplicate_cnf_password){

        $('#user_duplicate_cnf_password').next('div.input-error-msg').text('Passwords do not match.');
            $('div.input-error-msg').not($('#user_duplicate_cnf_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_duplicate_cnf_password').offset().top
            });

    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'customer' && user_assesment_reason == false){
        $('.assesment-reason-error').text('Select your reason to join this assesment.');
            $('div.input-error-msg').not($('.assesment-reason-error')).text('');
            $('html, body').animate({
                scrollTop: $('.user_assesment_reason').offset().top
            });

    } else if(_this_id == 'thirdNext' && duplicate_user_type == 'counselor' && user_duplicate_terms_agree == false){

        $('.user-terms-error').text('You must need to agree our all terms and conditions.');
            $('div.input-error-msg').not($('.user-terms-error')).text('');
            $('html, body').animate({
                scrollTop: $('.user-terms-error').offset().top
            });
            
    } else if(_this_id == 'thirdNext' && user_first_name && user_last_name && user_assesment_reason == true && duplicate_user_type == 'customer'){
        
        /* Preparing for Questions & Answers */
        var data = {
            action: 'get_question_set_1',
        };
        $('#full-site-loader').show();
        $.post(SurveyQuestionAnswer.ajaxurl, data, function(resp){
            $('#full-site-loader').hide();
            if(resp.flag == true){
                $('#exclude_question_id').val(resp.set_1_ques);
                $('.first-question-set').html(resp.msg);
                $('#userRegistrationModal').modal('hide');
                $('#userSurveyQuestionsAnswersModal').modal('show');
            } else {

            }
        },'json');

    } else if(_this_id == 'thirdNext' && user_first_name && user_last_name && user_duplicate_email && user_duplicate_phone && user_duplicate_password && user_duplicate_cnf_password && duplicate_user_type == 'counselor'){


            $('#duplicate_email_id').val(user_duplicate_email);
            $('#duplicate_phone').val(user_duplicate_phone);
            $('#duplicate_password').val(user_duplicate_password);

            var data  = $('#customerRegFrm').serialize();

            $.post(Registration.ajaxurl, data, function(resp){
                if(resp.flag == true) {
                        $('div.input-error-msg').text('');

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

                    setTimeout(function(){
                            siteRedirection(resp.url);
                    }, 3000);

                 }
            },'json');       

    } else if(_this_id == 'fourthNext' && !user_email){

        $('#user_email').next('div.input-error-msg').text('Enter your email.');
            $('div.input-error-msg').not($('#user_email').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_email').offset().top
            });

    } else if(_this_id == 'fourthNext' && emailChecking == false){

        $('#user_email').next('div.input-error-msg').text('Enter your email in proper format.');
            $('div.input-error-msg').not($('#user_email').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_email').offset().top
            });

    } else if(_this_id == 'fourthNext' && !user_phone){

        $('#user_phone').next('div.input-error-msg').text('Enter your phone number.');
            $('div.input-error-msg').not($('#user_phone').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_phone').offset().top
            });

    } else if(_this_id == 'fourthNext' && !user_password){

        $('#user_password').next('div.input-error-msg').text('Enter your password.');
            $('div.input-error-msg').not($('#user_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_password').offset().top
            });

    } else if(_this_id == 'fourthNext' && user_password.length < 8){

        $('#user_password').next('div.input-error-msg').text('Password length must be greater than equals to 8.');
            $('div.input-error-msg').not($('#user_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_password').offset().top
            });

    } else if(_this_id == 'fourthNext' && passwordChecking == false){

        $('#user_password').next('div.input-error-msg').text('Password must contain one Upper case letter, one special character and one number.');
            $('div.input-error-msg').not($('#user_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_password').offset().top
            });

    } else if(_this_id == 'fourthNext' && !user_cnf_password){

        $('#user_cnf_password').next('div.input-error-msg').text('Confirm your password.');
            $('div.input-error-msg').not($('#user_cnf_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_cnf_password').offset().top
            });

    } else if(_this_id == 'fourthNext' && user_password != user_cnf_password){

        $('#user_cnf_password').next('div.input-error-msg').text('Passwords do not match.');
            $('div.input-error-msg').not($('#user_cnf_password').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_cnf_password').offset().top
            });

    } else if(_this_id == 'fourthNext' && user_terms_agree == false){

        $('.user-terms-error').text('You must need to agree our all terms and conditions.');
            $('div.input-error-msg').not($('.user-terms-error')).text('');
            $('html, body').animate({
                scrollTop: $('.user-terms-error').offset().top
            });
            
    } else {

        /* User Account Creation */
        if(_this_id == 'fourthNext'){

            $('#duplicate_email_id').val(user_email);
            $('#duplicate_phone').val(user_phone);
            $('#duplicate_password').val(user_password);

            var data  = $('#customerRegFrm').serialize();

            $.post(Registration.ajaxurl, data, function(resp){
                if(resp.flag == true) {

                        $('div.input-error-msg').text('');

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

                    setTimeout(function(){

                            /* Order Type Choosing Fieldset Occurance */
                            $('#orderMethodChoosing').show(); 
                            $('#accountCreated').fadeOut();
                            $('#accountCreated').animate({opacity: 0}, {

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
                     }, 2000);
                    
                } else {
                    $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
                        placement: {
                                    from: 'top',
                                    align: 'center'
                                },
                    });
                }
            },'json');

        } else {

                $('div.input-error-msg').text('');

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
        
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
        } 
    }
    
});

    /* Previous Click */
    $(".previous").click(function(){
        //if(animating) return false;
        animating = true;
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //de-activate current step on progressbar
        //$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
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

    $('.submit').on('click', function(){

        var _this_id = $(this).prop('id');
        var _this = $(this);

        var user_verification_code = $('#user_verification_code').val();
        var verification_data = $('#verification_data').val();

        var original_data = btoa(verification_data);
        
        if(_this_id == 'fifthNext' && !user_verification_code){

            $('#user_verification_code').next('div.input-error-msg').text('Enter your 4 digit verification code.');
            $('div.input-error-msg').not($('#user_verification_code').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_verification_code').offset().top
            });

        } else if(_this_id == 'fifthNext' && user_verification_code != verification_data) {

            $('#user_verification_code').next('div.input-error-msg').text('Verification code is incorrect.');
            $('div.input-error-msg').not($('#user_verification_code').next('div.input-error-msg')).text('');
            $('html, body').animate({
                scrollTop: $('#user_verification_code').offset().top
            });

        } else if(_this_id == 'fifthNext' && user_verification_code == verification_data) {

            $('div.input-error-msg').text('');
            var data  = $('#customerRegFrm').serialize();
            $.post(Registration.ajaxurl, data, function(resp){
                if(resp.flag == true){
                    $('#emailConfirmation').fadeOut('fast');
                    $('#accountCreated').fadeIn('fast');
                    
                    setTimeout(function(){
                        /* Order Type Choosing Fieldset Occurance */
        
                        //show the next fieldset
                        $('#orderMethodChoosing').show(); 
                        //hide the current fieldset with style
                        $('#accountCreated').fadeOut();
                        $('#accountCreated').animate({opacity: 0}, {
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
                     //setUpQuestionAnswers();
                 }, 3000);
                    

                    // setTimeout(function(){
                    //     $('#userRegistrationModal').modal('hide');
                    //     $('#userAssessmentModal').modal('show');
                    // },3000);
                    //$.notify(resp.msg, {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999/*showProgressbar: true,*/});
                    //siteRedirection(resp.url, 3000);
                } else{
                    $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
                placement: {
                                from: 'top',
                                align: 'center'
                            },/*showProgressbar: true,*/});
                }
            },'json');
        }

    });
});




/* Preparing for questions and answers */
function setUpQuestionAnswers(){
    
                        var data = {
                            action: 'get_question_set_1',
                            //product: _this_product
                        };
                        $('#full-site-loader').show();
                        $.post(SurveyQuestionAnswer.ajaxurl, data, function(resp){
                            $('#full-site-loader').hide();
                            if(resp.flag == true){
                                $('#exclude_question_id').val(resp.set_1_ques);
                                $('.first-question-set').html(resp.msg);
                                $('#userRegistrationModal').modal('hide');
                                $('#userSurveyQuestionsAnswersModal').modal('show');
                            } else {

                            }
                        },'json');
}

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