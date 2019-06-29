<?php
/*
 * Template Name: Home Template
 * 
 */
get_header();
$GeneralThemeObject = new GeneralTheme();
$get_official_phone_number = get_option('_official_phone_number');
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
$getTestimonials = get_posts(['post_type' => THEME_PREFIX . 'testimonial', 'posts_per_page' => -1]);
?>

<section class="content_sec">
    <div class="container">
    	<div class="row">
            <div class="col-sm-5 home_con proccess_con col-xs-push-1">
                <?php if(is_user_logged_in()): ?>
                    <h2><a href="<?php echo $redirectTo; ?>" style="color: #fff;">Our Process</a></h2>
                <?php else: ?>
                    <h2><a href="#userRegistrationModal" data-toggle="modal" style="color: #fff;">Our Process</a></h2>
                <?php endif; ?>
                <ul>
                    <?php if(is_user_logged_in()): ?>
                        <li><span>1</span> <a href="<?php echo $redirectTo; ?>" style="color: #fff;">Go to Account</a></li>
                        <li><span>2</span> Pick an Assessment</li>
                        <li><span>3</span> Do an Online Interview</li>
                    <?php else: ?>
                        <li><span>1</span> Pick an Assessment</li>
                        <li><span>2</span> <a href="#userRegistrationModal" data-toggle="modal" style="color: #fff;">Create an Account</a></li>
                        <li><span>3</span> Do an Online Interview</li>
                    <?php endif; ?>
                    
                </ul>
                <!-- <div class="client-testimonials">
                    <div class="owl-carousel owl-theme">
                        <?php if(is_array($getTestimonials) && count($getTestimonials) > 0): ?>
                            <?php foreach($getTestimonials as $eachTestimonial): ?>
                                <div class="item">
                                    <blockquote>
                                        <?php echo $eachTestimonial->post_content; ?>
                                        <cite><?php echo $eachTestimonial->post_title; ?></cite>
                                    </blockquote>
                                </div> 
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div> -->
            </div>
            <div class="col-sm-5 home_con assessments_con col-xs-push-1">
                <h2><a href="<?php echo site_url().'/assessments'; ?>" style="color: #fff;">Our Assessments</a></h2>
                <ul>
                    <li><a href="<?php echo site_url().'/assessments'; ?>" style="color: #fff;"><img src="<?php echo ASSET_URL.'/images/bullet.png'; ?>" alt="Tick Mark"/>&nbsp; General Substance Abuse</a></li>
                    <li><a href="<?php echo site_url().'/assessments'; ?>" style="color: #fff;"><img src="<?php echo ASSET_URL.'/images/bullet.png'; ?>" alt="Tick Mark"/>&nbsp; Child Custody/Divorce Substance Abuse</a></li>
                    <li><a href="<?php echo site_url().'/assessments'; ?>" style="color: #fff;"><img src="<?php echo ASSET_URL.'/images/bullet.png'; ?>" alt="Tick Mark"/>&nbsp; DMV License Reinstatement Substance Abuse</a></li>
                    <li><a href="<?php echo site_url().'/assessments'; ?>" style="color: #fff;"><img src="<?php echo ASSET_URL.'/images/bullet.png'; ?>" alt="Tick Mark"/>&nbsp; Domestic Violence Substance Abuse</a></li>
                    <li><a href="<?php echo site_url().'/assessments'; ?>" style="color: #fff;"><img src="<?php echo ASSET_URL.'/images/bullet.png'; ?>" alt="Tick Mark"/>&nbsp; DUI Alcohol/DUID Drug Assessment</a></li>
                    <li><a href="<?php echo site_url().'/assessments'; ?>" style="color: #fff;"><img src="<?php echo ASSET_URL.'/images/bullet.png'; ?>" alt="Tick Mark"/>&nbsp; Employer Required Substance Abuse</a></li>
                    <li><a href="javascript:void(0);" class="tooltip-sec"><span class="hovering-text">We offer payment plans to fit your needs. Call for details.</span><img src="<?php echo ASSET_URL.'/images/credit_card.png'; ?>" alt="Credit Card"/>&nbsp; Payment Plans Available</a></li>
                    <li><a href="javascript:void(0);" class="tooltip-sec"><span class="hovering-text">We offer a 30 day money back guarantee.</span><img src="<?php echo ASSET_URL.'/images/money_back.png'; ?>" alt="Money Back"/>&nbsp; Money Back Guarantee!</a></li>
                </ul>
            </div>
            
            
            <div class="home_button_sec">
                <div class="col-sm-12">
                    <div class="get_button">
                        <?php if(is_user_logged_in()){ ?>
                            <a href="<?php echo $redirectTo; ?>" class="get_button">Get Started</a>
                            <a href="<?php echo $redirectTo; ?>" class="get_button">My Account</a>
                        <?php } else {
                        ?>
                        <a href="#userRegistrationModal" data-toggle="modal" class="get_button">Get Started</a>
                        <!-- <a href="#userRegistrationModal" data-toggle="modal">Create Account</a> -->
                        <a href="#userLoginModal" data-toggle="modal">Sign In</a>
                        <?php
              			} ?>
                        <!-- <a href="javascript:void(0);" class="get_button">Check My State Laws</a> -->
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
    
    
</section>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            autoplay:false,
            // autoWidth: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    });
</script>
<?php
get_footer();

