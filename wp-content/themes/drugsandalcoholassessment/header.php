<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Court-ordered alcohol assessment,drug addiction assessment,DUI Assessment. 50 states online." />
<meta name="keywords" content="alcohol assessment, alcohol drug evaluation,court ordered assessment, DUI, DWI, DUI and DWI" />
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<?php
$get_facebook_url = get_option('_facebook_url');
$get_twitter_url = get_option('_twitter_url');
$get_instagram_url = get_option('_instagram_url');
?>

<body <?php body_class(); ?>>
    
    <div id="full-site-loader" style="display: none;"></div>

<?php if(is_front_page()): ?>
    <!-- Offer Div -->
    <div class="offer-sec">
        <img src="<?php echo THEME_URL.'/assets/images/10_Off.png'; ?>" alt="Offer Section">
    </div>
    <div class="another-offer-sec">
        <img src="<?php echo THEME_URL.'/assets/images/payment_options.png'; ?>" alt="Offer Section">
    </div>
    <!-- End of Offer Div -->
<?php endif; ?>
    
	
    <!-- Start Header Section ==================================================-->
    <header class="clearfix">
        	<div class="container">
            	<div class="row">
                	<div class="header_top_sec">
                		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>
                    </div>
                    
                    <?php if ( has_nav_menu( 'top' ) ) : ?>
                    <div class="header_bottom_sec">
                            <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
                            
                            <div class="col-sm-3 top_social">
                                <a href="<?php echo $get_twitter_url; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                                <a href="<?php echo $get_instagram_url; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="<?php echo $get_facebook_url; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                	<?php endif; ?>
                    
            	</div>
        	</div>
        </div>
        <!-- Header Top Sec -->
    </header>
	<!-- End Header Section ==================================================-->
	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div class="single-featured-image-header">';
		echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>
