<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
	<?php the_custom_logo(); ?>
	<div class="site-branding-text">
    	<?php /*?><?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) :
		?>
        <h1 class="logoTxt"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $description; ?></a></h1>
        <h2 class="logoTagline"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
		<?php endif; ?><?php */?>

		<?php if ( ( twentyseventeen_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'twentyseventeen' ); ?></span></a>
	<?php endif; ?>


	</div>
