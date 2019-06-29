<?php

/*
 *  This  file contains all custom post type and taxonomy registrations
 * 
 */

if (!function_exists('theme_core_setup')) {

    function theme_core_setup() {
        theme_register_post_type(THEME_PREFIX . 'mail_template', 'mail-template', 'Mail Template', 'dashicons-email-alt', ['title', 'editor']);
        
        theme_register_post_type(THEME_PREFIX . 'product', 'product', 'Product', 'dashicons-category', ['title', 'editor']);
        theme_register_taxonomy(THEME_PREFIX . 'state', THEME_PREFIX . 'product', 'state', 'State');
        theme_register_taxonomy(THEME_PREFIX . 'zipcode', THEME_PREFIX . 'product', 'zipcode', 'Zipcode');
        theme_register_taxonomy(THEME_PREFIX . 'extra_cost', THEME_PREFIX . 'product', 'extra-cost', 'Extra Cost');

        theme_register_post_type(THEME_PREFIX . 'survey_question', 'survey-question', 'Survey Question', 'dashicons-microphone', ['title']);

        theme_register_post_type(THEME_PREFIX . 'assessment', 'assessment-data', 'Assessment', 'dashicons-editor-ol', ['title']);

        theme_register_post_type(THEME_PREFIX . 'staff', 'staff-member', 'Staff', 'dashicons-groups', ['title', 'editor', 'thumbnail']);

        theme_register_post_type(THEME_PREFIX . 'coupon', 'coupon', 'Coupon', 'dashicons-slides', ['title', 'editor']);
        theme_register_post_type(THEME_PREFIX . 'testimonial', 'testimonial', 'Testimonial', 'dashicons-format-quote', ['title', 'editor']);
        //theme_register_taxonomy(THEME_PREFIX . 'status', THEME_PREFIX . 'assessment', 'status', 'Status');
    }

}

if (!function_exists('theme_register_post_type')) {

    function theme_register_post_type($post_type, $slug, $display_name, $icon, $supports = []) {

        $lastChar = substr($display_name, -1);

        if ($lastChar == 's') {
            $plural_display_name = 'es';
        } else if ($lastChar == 'y') {
            $strLen = strlen($display_name);
            $display_name = substr_replace($display_name, 'ies', ($strLen - 1));
            $plural_display_name = '';
        } else {
            $plural_display_name = 's';
        }

        $labels = array(
            'name' => _x($display_name . $plural_display_name, 'post type general name', THEME_TEXTDOMAIN),
            'singular_name' => _x($display_name, 'post type singular name', THEME_TEXTDOMAIN),
            'menu_name' => _x($display_name, 'admin menu', THEME_TEXTDOMAIN),
            'name_admin_bar' => _x($display_name, 'add new on admin bar', THEME_TEXTDOMAIN),
            'add_new' => _x('Add New', strtolower($display_name), THEME_TEXTDOMAIN),
            'add_new_item' => __('Add New ' . $display_name, THEME_TEXTDOMAIN),
            'new_item' => __('New ' . $display_name, THEME_TEXTDOMAIN),
            'edit_item' => __('Edit ' . $display_name, THEME_TEXTDOMAIN),
            'view_item' => __('View ' . $display_name, THEME_TEXTDOMAIN),
            'all_items' => __('All ' . $display_name . $plural_display_name, THEME_TEXTDOMAIN),
            'search_items' => __('Search ' . $display_name . $plural_display_name, THEME_TEXTDOMAIN),
            'parent_item_colon' => __('Parent ' . $display_name . $plural_display_name . ':', THEME_TEXTDOMAIN),
            'not_found' => __('No ' . $display_name . $plural_display_name . ' found.', THEME_TEXTDOMAIN),
            'not_found_in_trash' => __('No ' . $display_name . $plural_display_name . ' found in Trash.', THEME_TEXTDOMAIN)
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Description.', THEME_TEXTDOMAIN),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $slug),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'menu_icon' => $icon,
            'supports' => $supports
                //array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
        );

        register_post_type($post_type, $args);
    }

}

if (!function_exists('theme_register_taxonomy')) {

    function theme_register_taxonomy($taxonomy, $post_type, $slug, $display_name) {

        $lastChar = substr($display_name, -1);

        if ($lastChar == 's') {
            $plural_display_name = 'es';
        } else if ($lastChar == 'y') {
            $strLen = strlen($display_name);
            $display_name = substr_replace($display_name, 'ies', ($strLen - 1));
            $plural_display_name = '';
        } else {
            $plural_display_name = 's';
        }

        $labels = array(
            'name' => _x($display_name . $plural_display_name, 'taxonomy general name', THEME_TEXTDOMAIN),
            'singular_name' => _x($display_name, 'taxonomy singular name', THEME_TEXTDOMAIN),
            'search_items' => __('Search ' . $display_name . $plural_display_name, THEME_TEXTDOMAIN),
            'all_items' => __('All ' . $display_name . $plural_display_name, THEME_TEXTDOMAIN),
            'parent_item' => __('Parent ' . $display_name, THEME_TEXTDOMAIN),
            'parent_item_colon' => __('Parent ' . $display_name . ':', THEME_TEXTDOMAIN),
            'edit_item' => __('Edit ' . $display_name, THEME_TEXTDOMAIN),
            'update_item' => __('Update ' . $display_name, THEME_TEXTDOMAIN),
            'add_new_item' => __('Add New ' . $display_name, THEME_TEXTDOMAIN),
            'new_item_name' => __('New ' . $display_name . ' Name', THEME_TEXTDOMAIN),
            'menu_name' => __($display_name, THEME_TEXTDOMAIN),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_menu' => true,
            //'show_tagcloud' => false,
            'show_admin_column' => false,
            //'meta_box_cb' => false,
            'query_var' => true,
            'rewrite' => array('slug' => $slug),
        );

        if($taxonomy == THEME_PREFIX . 'state' || $taxonomy == THEME_PREFIX . 'zipcode' || THEME_PREFIX . 'extra_cost'){
            $args['meta_box_cb'] = false;
        }

        register_taxonomy($taxonomy, $post_type, $args);
    }

}