<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

	$get_official_phone_number = get_option('_official_phone_number');
    $get_facebook_url = get_option('_facebook_url');
    $get_twitter_url = get_option('_twitter_url');
    $get_instagram_url = get_option('_instagram_url');

?>

		<footer>
     		<div class="container">
       			<div class="row">
	   				<div class="col-sm-6">
                    	<p class="">
	   					<a href="javascript:void(0);"><img src="<?php echo ASSET_URL.'/images/BBB.png'; ?>" style="width: 100px;margin-top: -25px;"/></a>
                        </p>
	   				</div>
	   				<div class="col-sm-6">
                    	<p class="copyrightTxt">
	   					<a href="tel:<?php echo $get_official_phone_number; ?>"><?php echo ($get_official_phone_number) ? $get_official_phone_number : '1 (833) 573-7658'; ?></a>
                        </p>
	   				</div>
         		</div>
       		</div>
    	</footer>

<!-- Loading all modals -->

<?php //require_once 'user-new-survey-popup.php'; ?>
<?php theme_template_part('user-registration/user-registration-popup'); ?>
<?php theme_template_part('user-registration/user-registration-choose-popup'); ?>
<?php theme_template_part('user-login/user-login-popup'); ?>
<?php theme_template_part('user-forgot-password/user-forgot-password-popup'); ?>
<?php theme_template_part('user-reset-password/user-reset-password-popup'); ?>
<?php theme_template_part('user-pickup-assessment/user-pickup-assessment-popup'); ?>
<?php theme_template_part('user-assessment-survey-qusetions/user-assessment-servey-questions-answers-popup'); ?>
<?php theme_template_part('user-phone-assessment/user-phone-assessment-popup'); ?>
<?php theme_template_part('user-claim-assessment/user-claim-assessment-popup'); ?>
<?php theme_template_part('user-phone-assessment/user-view-assessment-survey-popup'); ?>

<!-- End of Loading all modals -->

<?php wp_footer(); ?>

</body>
</html>
