<?php
/*
 * Template Name: About Us Template
 * 
 */

get_header();
?>

<div class="container">

    <!-- First Stanza -->
    <div class="row">
        <div class="col-sm-3">

        </div>
        <div class="col-sm-3">
            <div class="about-page-heading">
                <h2><?php echo $getFirstStanzaTitle; ?></h2>
                <p><?php echo ($getFirstStanzaContent) ? $getFirstStanzaContent : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'; ?></p>
            </div>
        </div>
        <div class="col-sm-3">

        </div>
        <div class="col-sm-3">
            
        </div>
    </div>
    <!-- End of First Stanza -->

</div>

<?php
get_footer();
