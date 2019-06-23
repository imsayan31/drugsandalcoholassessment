<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

	<div class="col-sm-9 top_nav">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="topnavholder">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainmenu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse customnav" id="mainmenu">
                        <?php $left_options = array(
                         'menu'            => 'Header Menu',
                         'echo'            => true,
                         'menu_class'      => 'nav navbar-nav',
                         'fallback_cb'     => 'wp_page_menu',
                         'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                         'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                         'walker'            => new wp_bootstrap_navwalker()
                         );
                         wp_nav_menu( $left_options );
                        ?>
                        
                    </div>
                </div>
            </div>
        </nav>
    </div>
