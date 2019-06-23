<?php
/*
 * Template Name: Customer Registration Template
 * 
 */
get_header();
if (is_user_logged_in()):
    wp_redirect(BASE_URL);
    exit;
endif;
?>
<div class="container">
    <header class="entry-header">
        <h2 class="entry-title"><?php echo get_the_title(); ?></h2>
    </header>
    <div class="row">
        <?php theme_template_part('user-registration/user-registration'); ?>
    </div>
</div>
<?php
get_footer();
