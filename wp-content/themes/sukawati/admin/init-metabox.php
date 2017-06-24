<?php

/*****
 * Page Metabox
 *****/
function sukawati_pagemetabox_setup()
{
    new VP_Metabox(get_template_directory() . '/admin/metabox/page/slider.php');
    new VP_Metabox(get_template_directory() . '/admin/metabox/page/landingbanner.php');
    new VP_Metabox(get_template_directory() . '/admin/metabox/page/popularpost.php');
    new VP_Metabox(get_template_directory() . '/admin/metabox/page/blogcontent.php');
    new VP_Metabox(get_template_directory() . '/admin/metabox/page/sidebar.php');
    require_once(get_template_directory() . '/admin/metabox/gallery.php');
}
add_action('after_setup_theme', 'sukawati_pagemetabox_setup');

function sukawati_load_additional_script_for_page() {
    $screen = get_current_screen();
    if($screen->post_type === 'page' && is_admin()) {
        wp_enqueue_script('sukawati-page-metabox', get_template_directory_uri() . '/admin/assets/js/pagemetabox.js', array('jquery'), null);

        $option = array();
        $option['pagetemplate'] = sukawati_get_current_page_template_name();
        wp_localize_script('jeg-page-metabox', 'jpageoption', $option);

        wp_enqueue_style ('sukawati-blog-css', get_template_directory_uri() . '/admin/assets/css/pagemetabox.css', null, null);
    }
}
add_action('current_screen', 'sukawati_load_additional_script_for_page');

/** Load Metabox CSS **/
function sukawati_load_additional_style() {
    if(is_admin()) {
        wp_enqueue_style ('sukawati-global-css', get_template_directory_uri() . '/admin/assets/css/global.css', null, null);
    }
}
add_action('current_screen', 'sukawati_load_additional_style');