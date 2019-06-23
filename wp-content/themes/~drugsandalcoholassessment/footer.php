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

		</div><!-- #content -->

		<footer>
     		<div class="container">
	 			<div class="footer_block">
       				<div class="row">
	   					<div class="col-8">
	   						<a href="tel:<?php echo $get_official_phone_number; ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo ($get_official_phone_number) ? $get_official_phone_number : '1 (833) 573-7658'; ?></a>
	   					</div>
	   					<div class="col-4" style="text-align:right;">
	   						<a href="<?php echo $get_twitter_url; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
	  						<a href="<?php echo $get_instagram_url; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      						<a href="<?php echo $get_facebook_url; ?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
						</div>
         			</div>
		 		</div>
       		</div>
    	</footer>
		
	</div><!-- .site-content-contain -->
</div><!-- #page -->

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
