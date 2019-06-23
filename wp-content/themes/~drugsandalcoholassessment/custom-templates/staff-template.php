<?php
/*
 * Template Name: Staff Template
 * 
 */
get_header();
$getStaffs = get_posts(['post_type' => THEME_PREFIX.'staff', 'posts_per_page' => -1]);
?>

<section>
	 <div class="container">
	 	<header class="entry-header">
			<h1 class="entry-title"><?php _e('Staff',THEME_TEXTDOMAIN); ?></h1>			
		</header>
	 	<div class="mid_section">
	 		<?php
				if (is_array($getStaffs) && count($getStaffs) > 0) {
					$countStaff = 1;
					foreach ($getStaffs as $eachStaff) {
						$getFeaturedImg = wp_get_attachment_image_src(get_post_thumbnail_id($eachStaff->ID), 'full');
						$getFeaturedImgPath = get_attached_file(get_post_thumbnail_id($eachStaff->ID));
						if($countStaff % 2 == 0 ){
							?>
						<div class="staff-dtls">
							<div class="row">
								<div class="col-sm-9">
									<h3><?php echo $eachStaff->post_title; ?></h3>
									<p><?php echo $eachStaff->post_content; ?></p>
								</div>
							<div class="col-sm-3">
								<div class="staff-img">
									<img src="<?php echo ($getFeaturedImgPath) ? $getFeaturedImg[0] : 'https://via.placeholder.com/188x255'; ?>" />
								</div>
							</div>
						</div>
						</div>
						<?php
						} else {
							?>
						<div class="staff-dtls">
							<div class="row">
								<div class="col-sm-3">
									<div class="staff-img">
										<img src="<?php echo ($getFeaturedImgPath) ? $getFeaturedImg[0] : 'https://via.placeholder.com/188x255'; ?>" />
									</div>
								</div>
								<div class="col-sm-9">
									<h3><?php echo $eachStaff->post_title; ?></h3>
									<p><?php echo $eachStaff->post_content; ?></p>
								</div>
							</div>
						</div>
<?php 						}
						
						$countStaff++;
						
					}
				} else {
				?>
					<div class="row">
						<div class="col-sm-12">
							<div class="alert alert-danger"><?php _e('No staff available right now.',THEME_TEXTDOMAIN); ?></div>
						</div>
					</div>
				<?php
				}
	 		 ?>
	 	</div>
	</div>
</section>
	 
<?php
get_footer();
