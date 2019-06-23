<?php
/*
 * Template Name: Contact Us Template
 * 
 */

get_header();
?>
<div class="main-title">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                $getPageImg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                $getPageImgPath = get_attached_file(get_post_thumbnail_id());
                ?>
                <div class="main-top-img">
                    <img src="<?php echo ($getPageImgPath) ? $getPageImg[0] : ASSET_URL . '/images/KalamundaPerfomersBanner.jpg'; ?>"/>
                </div>
                <h2><?php echo get_the_title(); ?></h2>
                <p><?php echo get_the_content(); ?></p>
                <?php
            endwhile;
        endif;
        ?>
    </div>
<div class="container">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="contact-top-sec">
                <h2>GET IN TOUCH</h2>
                <h6>Drop us a line or give us a ring, We love to hear about you.</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?php echo do_shortcode('[contact-form-7 id="29" title="Contact form 1"]'); ?>
        </div>
        <div class="col-sm-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3685.5163317008614!2d88.3497844145352!3d22.522323085208644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a027731f48e8c51%3A0xac55def2a9b6ef2c!2s111%2C+Sarat+Bose+Rd%2C+Dover+Terrace%2C+Kalighat%2C+Kolkata%2C+West+Bengal+700029!5e0!3m2!1sen!2sin!4v1532608948083" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            <div>
                Address: 111 Sarat Bose Road, Kolkata - 17<br>
                Phone: 98300 98300
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
