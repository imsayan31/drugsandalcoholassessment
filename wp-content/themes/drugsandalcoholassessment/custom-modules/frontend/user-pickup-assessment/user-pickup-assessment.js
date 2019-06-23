jQuery(document).ready(function ($) {

    /* Masking */
    $('#user_billing_zipcode').mask('00000');
    $('#user_card_number').mask('0000 0000 0000 0000');
    $('#user_card_expiry_date').mask('00 / 0000');

    /* Clicking on product */
    $('.product_selection').on('click', function(){
        var _this_product = $(this);
        var _product_id = _this_product.data('product_id');
        // $('#product_id').val(_product_id);
        _this_product.siblings('p').slideDown();
        console.log(_this_product.siblings('p'));
        _this_product.closest('li').siblings().find('p').slideUp();
    });

    /* Clicking On Shipping Details */
    $('.user_shipping_billing').on('click', function(){
        if($(this).is(':checked') == true){
            $('.shipping-details-sec').slideUp();
        } else{
            $('.shipping-details-sec').slideDown();
        }
    });
   
    
    var $ = jQuery;
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    /* Next Click */
$(".assmnt_next").click(function(){
    //if(animating) return false;
    animating = true;

    var _this = $(this);

    /* Get ID of the step */
    var _this_id = $(this).prop('id');

    /* Get variables value */
    // var product_id = $('#product_id').val(); 
    var product_id = $('.product_selection').is(':checked');

    var user_order_type = $('.user_order_type').is(':checked');

    /* Billing Details */
    var user_billing_fname = $('#user_billing_fname').val();
    var user_billing_lname = $('#user_billing_lname').val();
    var firstNameChecking = checkForAlphabets(user_billing_fname);
    var lastNameChecking = checkForAlphabets(user_billing_lname);

    var user_billing_email = $('#user_billing_email').val();
    var user_billing_address = $('#user_billing_address').val();
    var user_billing_city = $('#user_billing_city').val();
    var user_billing_zipcode = $('#user_billing_zipcode').val();

    /* Shipping Details */
    var user_shipping_fname = $('#user_shipping_fname').val();
    var user_shipping_lname = $('#user_shipping_lname').val();
    var shippingFirstNameChecking = checkForAlphabets(user_shipping_fname);
    var shippingLastNameChecking = checkForAlphabets(user_shipping_lname);

    var user_shipping_email = $('#user_shipping_email').val();
    var user_shipping_address = $('#user_shipping_address').val();
    var user_shipping_city = $('#user_shipping_city').val();
    var user_shipping_zipcode = $('#user_shipping_zipcode').val();

    var billingEmailChecking = checkForEmails(user_billing_email);
    var shippingEmailChecking = checkForEmails(user_shipping_email);

    if (_this_id == 'firstAssessmentNext') {
        $('#userAssessmentModal').find('h4.modal-title').text('Account Details');
    }

    if(_this_id == 'firstAssessmentNext' && product_id == false){

        $('.product-choosing-error').text('Select your assessment type.');
        $('div.input-error-msg').not($('.product-choosing-error')).text('');

    } 
    // else if(_this_id == 'firstAssessmentNext' && product_id == true){

    // }
     else if(_this_id == 'secondAssessmentNext' && user_order_type == false){
            
        $('.user-order-error').text('Choose your order type.');
        $('div.input-error-msg').not($('.user-order-error')).text('');
            
    } 
    /*else if(_this_id == 'thirdAssessmentNext' && !user_billing_email){
            
        $('#user_billing_email').next('div.input-error-msg').text('Enter your billing email.');
        $('div.input-error-msg').not($('#user_billing_email').next('div.input-error-msg')).text('');
            
    } else if(_this_id == 'thirdAssessmentNext' && billingEmailChecking == false){
            
        $('#user_billing_email').next('div.input-error-msg').text('Enter your billing email in proper format.');
        $('div.input-error-msg').not($('#user_billing_email').next('div.input-error-msg')).text('');
            
    } */
    /*else if(_this_id == 'thirdAssessmentNext' && !user_billing_fname){
            
        $('#user_billing_fname').next('div.input-error-msg').text('Enter your billing first name.');
        $('div.input-error-msg').not($('#user_billing_fname').next('div.input-error-msg')).text('');
            
    }*/ 
    /*else if(_this_id == 'thirdAssessmentNext' && firstNameChecking == false){
            
        $('#user_billing_fname').next('div.input-error-msg').text('Enter your billing first name.');
        $('div.input-error-msg').not($('#user_billing_fname').next('div.input-error-msg')).text('');
            
    } */
    /*else if(_this_id == 'thirdAssessmentNext' && !user_billing_lname){
            
        $('#user_billing_lname').next('div.input-error-msg').text('Enter your billing last name.');
        $('div.input-error-msg').not($('#user_billing_lname').next('div.input-error-msg')).text('');
            
    }*/ 
    /*else if(_this_id == 'thirdAssessmentNext' && lastNameChecking == false){
            
        $('#user_billing_lname').next('div.input-error-msg').text('Enter your billing last name.');
        $('div.input-error-msg').not($('#user_billing_lname').next('div.input-error-msg')).text('');
            
    } */
    else if(_this_id == 'thirdAssessmentNext' && !user_billing_address){
            
        $('#user_billing_address').next('div.input-error-msg').text('Enter your billing address.');
        $('div.input-error-msg').not($('#user_billing_address').next('div.input-error-msg')).text('');
            
    } else if(_this_id == 'thirdAssessmentNext' && !user_billing_city){
            
        $('#user_billing_city').next('div.input-error-msg').text('Enter billing city.');
        $('div.input-error-msg').not($('#user_billing_city').next('div.input-error-msg')).text('');
            
    } else if(_this_id == 'thirdAssessmentNext' && !user_billing_zipcode){
            
        $('#user_billing_zipcode').next('div.input-error-msg').text('Enter billing zipcode.');
        $('div.input-error-msg').not($('#user_billing_zipcode').next('div.input-error-msg')).text('');
            
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


        /* Data Generation For Order Review */
        if(_this_id == 'secondAssessmentNext' && user_order_type == true){

            var user_coupon_code = $('#user_coupon_code').val();

            var data = {
                action: 'order_review_process',
                product_id: $('input[name="product_id"]:checked').val(),
                order_type: $('input[name="user_order_type"]:checked').val(),
                user_coupon_code: user_coupon_code
            };

            $.post(PickAssessment.ajaxurl, data, function(resp){
                if(resp.flag == true){
                    $('.order-overview').html(resp.newMsg);
                    $('#product_order_val').val(resp.totalOrderVal);
                    $('#product_name_val').val(resp.productName);
                    $('#product_extra_cost_val').val(resp.extraCostName);
                    //$('.stripe-button').data('amount', resp.totalOrderVal);
                } else {

                }
            },'json');
        }
            
    }
    
});


/* Previous Click */
$(".assmnt_prev").click(function(){
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

$('.assmnt_submit').on('click', function(){

    var _this_id = $(this).prop('id');

    var stripeTokenVal = $('#customerPickUpAssessmentFrm').find('input[name="stripeToken"]').val();

    if(!stripeTokenVal){
        $('.stripe-token-error').text('Please make payment by clicking Purchase button');
    } else {
        $('div.input-error-msg').text('');
        var data = $('#customerPickUpAssessmentFrm').serialize();
        $('#full-site-loader').show();
        $.post(PickAssessment.ajaxurl, data, function(resp){
            $('#full-site-loader').hide();
            if(resp.flag == true){
                $.notify(resp.msg, {type: 'success', delay: 5000, allow_dismiss: true, z_index: 9999, 
placement: {
                            from: 'top',
                            align: 'center'
                        }
            ,/*showProgressbar: true,*/});
                siteRedirection(resp.url, 3000);
            } else{
                $.notify(resp.msg, {type: 'danger', delay: 3000, allow_dismiss: true, z_index: 9999, 
            placement: {
                            from: 'top',
                            align: 'center'
                        },/*showProgressbar: true,*/});
            }
        },'json');
    }

    
    /* Payment Button Click */
    // $(document.body).on('click', '#customButton', function(){

        

    // });

    /* Close Payment Window After Successfull Payment */

});








// $(".submit").click(function(){
//     return false;
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