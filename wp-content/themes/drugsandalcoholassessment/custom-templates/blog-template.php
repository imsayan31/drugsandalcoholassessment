<?php
/*
 * Template Name: Blog Template
 * 
 */
get_header();

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$getStaffs = get_posts(['post_type' => 'post', 'posts_per_page' => 5, 'paged' => $paged]);
$getBlogQuery = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5, 'paged' => $paged]);
?>

<section class="content_sec">
    <div class="container">
    	<div class="row">
        	<div class="col-sm-12">
			 	<header class="entry-header">
					<h1 class="entry-title"><?php _e('Latest Blogs',THEME_TEXTDOMAIN); ?></h1>			
				</header>
	 	<div class="mid_section">
	 		<?php
				if (is_array($getStaffs) && count($getStaffs) > 0) {
					$countStaff = 1;
					foreach ($getStaffs as $eachStaff) {
						$getFeaturedImg = wp_get_attachment_image_src(get_post_thumbnail_id($eachStaff->ID), 'full');
						$getFeaturedImgPath = get_attached_file(get_post_thumbnail_id($eachStaff->ID));
						?>
						<div class="staff-dtls">
							<div class="row">
								<div class="col-sm-3">
									<div class="staff-img">
										<a href="<?php echo get_permalink($eachStaff->ID); ?>"><img src="<?php echo ($getFeaturedImgPath) ? $getFeaturedImg[0] : 'https://via.placeholder.com/300x240'; ?>" /></a>
									</div>
								</div>
								<div class="col-sm-9">
									<h3><a href="<?php echo get_permalink($eachStaff->ID); ?>"><?php echo $eachStaff->post_title; ?></a></h3>
									<p><?php echo (strlen(strip_tags(trim($eachStaff->post_content))) > 500) ? substr(strip_tags(trim($eachStaff->post_content)), 0, 500).'... <a href="'. get_permalink($eachStaff->ID).'">Read more</a>' : strip_tags(trim($eachStaff->post_content)); ?></p>
								</div>
							</div>
						</div>
						<?php						
					}

					?>
					<div class="navigation-blogs">
					<?php
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $getBlogQuery->max_num_pages,
						'type' => 'list',
						'next_text' => 'Next Page »',
						'prev_text' => '« Previous Page',
					) );
					?>
					</div>
					<?php
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
        </div>
	</div>
</section>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('span.current').css('color', '#f34746 !important');
		$('span.current').parent('li').addClass('active');
		$('span.current').parent('li').siblings('li').removeClass('active');
	});
</script>	 
<?php
get_footer();
