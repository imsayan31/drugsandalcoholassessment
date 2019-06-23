<?php
/*
 * Customer Payment Page
 * 
 */
$GeneralThemeObject = new GeneralTheme();
$get_stripe_public_key = get_option('_stripe_public_key');
?>

<!-- Choose Assesment Type -->

    <h3 class="fs-subtitle"><span><?php _e('Enter payment information',THEME_TEXTDOMAIN); ?></span></h3>
    <ul class="password-validation-instruct">
      <li>Once your payment pop-up closes, click next to proceed.</li>
    </ul>
    <div class="row justify-content-md-center">
        <div class="col-md-10">
            <div class="form-group text-center">
                <button id="customButton" class="btn btn-primary">Purchase</button>
                <div class="stripe-token-error input-error-msg"></div>
            </div>
        </div>
    </div>
    
	<input type="button" name="previous" class="assmnt_prev action-button-previous" value="Back"/>
    <input type="button" name="next" id="fifthAssessmentNext" class="assmnt_submit action-button" value="Next"/>
    

<!-- End of Choose Assesment Type -->
  <script src="https://checkout.stripe.com/checkout.js"></script>
  <script type="text/javascript">
      var $ = jQuery;
  var handler = StripeCheckout.configure({
    key: '<?php echo $get_stripe_public_key; ?>',
    image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
    locale: 'auto',
    token: function(token) {
      // You can access the token ID with `token.id`.
      // Get the token ID to your server-side code for use.
      //console.log(token.id);
      $('#stripeToken').val(token.id);
    }
  });

  document.getElementById('customButton').addEventListener('click', function(e) {
          var productName = $('#product_name_val').val();
          var productOrderVal = $('#product_order_val').val();
          var originalProductVal = (productOrderVal * 100);
          var extraCostVal = $('#product_extra_cost_val').val();

          $('#customButton').hide();

          // Open Checkout with further options:
        handler.open({
          name: productName,
          description: extraCostVal,
          // zipCode: true,
          amount: originalProductVal
        });
        e.preventDefault();
  });

      // Close Checkout on page navigation:
      window.addEventListener('popstate', function() {
        handler.close();
        $('#customButton').hide();
      });


  </script>
    <?php
