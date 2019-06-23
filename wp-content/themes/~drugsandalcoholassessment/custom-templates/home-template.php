<?php
/*
 * Template Name: Home Template
 * 
 */
get_header();
$GeneralThemeObject = new GeneralTheme();
if(is_user_logged_in()){
	$userDetails = $GeneralThemeObject->user_details();

				if($userDetails->data['role'] == 'customer'){
					$redirectTo = CUSTOMER_ACCOUNT_PAGE;
				} else if($userDetails->data['role'] == 'counselor'){
					$redirectTo = COUNSELLOR_ACCOUNT_PAGE;
				}
} else{
	$redirectTo = USER_REGISTRATION_PAGE;
}
				
?>
<section >
	 <div class="container">
	 <div class="mid_section">
	 <div class="row">
          <div class="col-12 col-sm-6 col-md-6 order-sm-last get_button_center">
          	<?php if(is_user_logged_in()){ ?>
          	<a href="<?php echo $redirectTo; ?>" class="get_button">Get Started</a>
          <?php } else {
          	?>
          	<a href="#userRegistrationModal" data-toggle="modal" class="get_button">Get Started</a>
          	<?php
          } ?>
          </div>
		   <div class="col-12 col-sm-6 col-md-6 order-sm-first">
		   <div class="pick_block">
		   <div class="pick_left">1</div>
		   <div class="pick_right">Pick an Assessment</div>
		   <div class="clearfix"></div>
		   </div>
		   <div class="pick_block">
		   <div class="pick_left">2</div>
		   <div class="pick_right">Create an Account</div>
		   <div class="clearfix"></div>
		   </div>
		   <div class="pick_block">
		   <div class="pick_left">3</div>
		   <div class="pick_right">Do an Online Interview</div>
		   <div class="clearfix"></div>
		   </div>
		   </div>
	 </div>
	 <div class="row justify-content-sm-end assessments">
          <div class="col-12 col-sm-6 col-md-6"><h2>Our Assessments</h2>
		  <ul>
		  <li>General Substance Abuse</li>
          <li>DUI Alcohol/DUID Drug</li>
          <li>Employer required Substance Abuse</li>
          <li>DOT Substance Abuse</li>
          <li>Child Custody/ Divorce Substance Abuse</li>
		  </ul>
		  </div>
	 </div>
	 </div>
	 </div>
	 </section>
	 
<?php
get_footer();
