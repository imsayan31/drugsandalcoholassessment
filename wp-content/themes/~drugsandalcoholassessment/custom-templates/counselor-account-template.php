<?php
/*
 * Template Name: Counselor Account Template
 * 
 */
get_header();
if (!is_user_logged_in()):
    wp_redirect(BASE_URL);
    exit;
endif;
?>
<div class="container">
    <header class="entry-header">
        <h2 class="entry-title"><?php echo get_the_title(); ?></h2>
    </header>
    <div class="row">
        <div class="col-sm-12">
            <?php theme_template_part('user-account/counselor-account'); ?>
        </div>
    </div>
</div>
<?php
get_footer();
