<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<?php
$get_official_phone_number = get_option('_official_phone_number');
 ?>
<div class="custom-header">

<div class="container">
	<div class="row">
		<div class="col-sm-5">
			<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
		</div>
		<div class="col-sm-7 top_button">
			<?php if(is_user_logged_in()): ?>
				<?php
				$GeneralThemeObject = new GeneralTheme();
				$userDetails = $GeneralThemeObject->user_details();

				if($userDetails->data['role'] == 'customer'){
					$redirectTo = CUSTOMER_ACCOUNT_PAGE;
				} else if($userDetails->data['role'] == 'counselor'){
					$redirectTo = COUNSELLOR_ACCOUNT_PAGE;
				}
				?>
				<a href="<?php echo $redirectTo; ?>">My Account</a>
				<a href="<?php echo wp_logout_url(BASE_URL); ?>">Log Out</a>
			<?php else: ?>
				<a href="#userRegistrationChooseModal" data-toggle="modal">Create Account</a>
				<a href="#userLoginModal" data-toggle="modal">Sign In</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="mobile-phone-view">
		<span><a href="tel:<?php echo $get_official_phone_number; ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo ($get_official_phone_number) ? $get_official_phone_number : '1 (833) 573-7658'; ?></a></span>
	</div>
</div>
		

	

</div><!-- .custom-header -->
