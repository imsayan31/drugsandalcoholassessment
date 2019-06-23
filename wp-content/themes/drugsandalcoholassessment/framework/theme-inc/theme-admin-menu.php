<?php
/*
 *  This  file contains all admin menus
 * 
 */

if (!function_exists('theme_admin_menu')) {

    function theme_admin_menu() {
        add_menu_page(get_bloginfo('name') . ' Settings', get_bloginfo('name') . ' Settings', 'manage_options', 'drugs-alcohol-site-settings', 'drugs_alcohol_site_settings_func');
        // add_menu_page('Subscribed Employers', 'Subscribed Employers', 'manage_options', 'subscribed-employers', 'subscribed_employers_func');
        // add_submenu_page('subscribed-employers', 'Details Of Subscription', '', 'manage_options', 'subscribed-employers-details', 'subscribed_employers_details_func');
    }

}

if (!function_exists('drugs_alcohol_site_settings_func')) {

    function drugs_alcohol_site_settings_func() {
        $get_stripe_secret_key = get_option('_stripe_secret_key');
        $get_stripe_public_key = get_option('_stripe_public_key');
        $get_official_phone_number = get_option('_official_phone_number');
        $get_facebook_url = get_option('_facebook_url');
        $get_twitter_url = get_option('_twitter_url');
        $get_instagram_url = get_option('_instagram_url');

        /* Payment Submit */
        if (isset($_POST['payment_settings_sbmt'])) {
            $stripe_secret_key = strip_tags(trim($_POST['stripe_secret_key']));
            $stripe_public_key = strip_tags(trim($_POST['stripe_public_key']));

            update_option('_stripe_secret_key', $stripe_secret_key);
            update_option('_stripe_public_key', $stripe_public_key);

            wp_redirect(admin_url() . 'admin.php?page=drugs-alcohol-site-settings');
            exit;
        }

        /* Social Submit */
        if (isset($_POST['social_settings_sbmt'])) {
            $official_phone_number = strip_tags(trim($_POST['official_phone_number']));
            $facebook_url = strip_tags(trim($_POST['facebook_url']));
            $twitter_url = strip_tags(trim($_POST['twitter_url']));
            $instagram_url = strip_tags(trim($_POST['instagram_url']));

            update_option('_official_phone_number', $official_phone_number);
            update_option('_facebook_url', $facebook_url);
            update_option('_twitter_url', $twitter_url);
            update_option('_instagram_url', $instagram_url);

            wp_redirect(admin_url() . 'admin.php?page=drugs-alcohol-site-settings');
            exit;
        }
        ?>
        <h2><?php _e('Payment Settings', THEME_TEXTDOMAIN); ?></h2>
        <div class="wrap">
            <form name="payment_settings_frm" action="<?php echo admin_url() . 'admin.php?page=drugs-alcohol-site-settings'; ?>" method="post">
                <table class="widefat">
                    <tbody>
                        <tr>
                            <td><strong><?php _e('Stripe Secret Key', THEME_TEXTDOMAIN); ?></strong></td>
                            <td><input type="text" name="stripe_secret_key" size="100" value="<?php echo ($get_stripe_secret_key) ? $get_stripe_secret_key : ''; ?>" autocomplete="off" placeholder="<?php _e('Stripe Secret Key', THEME_TEXTDOMAIN); ?>"/></td>
                        </tr>
                        <tr>
                            <td><strong><?php _e('Stripe Public Key', THEME_TEXTDOMAIN); ?></strong></td>
                            <td><input type="text" name="stripe_public_key"  size="100" value="<?php echo ($get_stripe_public_key) ? $get_stripe_public_key : ''; ?>"  autocomplete="off" placeholder="<?php _e('Stripe Public Key', THEME_TEXTDOMAIN); ?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" name="payment_settings_sbmt" class="button button-primary"><?php _e('Save', THEME_TEXTDOMAIN); ?></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <h2><?php _e('Social Settings', THEME_TEXTDOMAIN); ?></h2>
        <div class="wrap">
            <form name="social_settings_frm" action="<?php echo admin_url() . 'admin.php?page=drugs-alcohol-site-settings'; ?>" method="post">
                <table class="widefat">
                    <tbody>
                        <tr>
                            <td><strong><?php _e('Official Phone Number', THEME_TEXTDOMAIN); ?></strong></td>
                            <td><input type="text" name="official_phone_number" size="100" value="<?php echo ($get_official_phone_number) ? $get_official_phone_number : ''; ?>" autocomplete="off" placeholder="<?php _e('Official Phone Number', THEME_TEXTDOMAIN); ?>"/></td>
                        </tr>
                        <tr>
                            <td><strong><?php _e('Facebook URL', THEME_TEXTDOMAIN); ?></strong></td>
                            <td><input type="url" name="facebook_url" size="100" value="<?php echo ($get_facebook_url) ? $get_facebook_url : ''; ?>" autocomplete="off" placeholder="<?php _e('Facebook URL', THEME_TEXTDOMAIN); ?>"/></td>
                        </tr>
                        <tr>
                            <td><strong><?php _e('Twitter URL', THEME_TEXTDOMAIN); ?></strong></td>
                            <td><input type="url" name="twitter_url" size="100" value="<?php echo ($get_twitter_url) ? $get_twitter_url : ''; ?>" autocomplete="off" placeholder="<?php _e('Twitter URL', THEME_TEXTDOMAIN); ?>"/></td>
                        </tr>
                        <tr>
                            <td><strong><?php _e('Instagram URL', THEME_TEXTDOMAIN); ?></strong></td>
                            <td><input type="url" name="instagram_url" size="100" value="<?php echo ($get_instagram_url) ? $get_instagram_url : ''; ?>" autocomplete="off" placeholder="<?php _e('Instagram URL', THEME_TEXTDOMAIN); ?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" name="social_settings_sbmt" class="button button-primary"><?php _e('Save', THEME_TEXTDOMAIN); ?></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <?php
    }

}