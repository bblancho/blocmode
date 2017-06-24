<?php

$joptionglobal = null;
function sukawati_dashboard() {
    global $joptionglobal;

    locate_template(array('admin/data_sources.php'), true, true);
    $dashboard_option  = get_template_directory() . '/admin/options/main.php';
    $joptionglobal =
        new VP_Option(array(
            'is_dev_mode'           => false,
            'option_key'            => 'joption',
            'page_slug'             => 'sukawati_option',
            'template'              => $dashboard_option,
            'menu_page'             => array(
                'icon_url'          => get_template_directory_uri() . '/admin/assets/img/theme_icon.png',
                'position'          => 90
            ),
            'use_auto_group_naming' => true,
            'use_util_menu'         => true,
            'minimum_role'          => 'edit_theme_options',
            'layout'                => 'fixed',
            'page_title'            => 'Theme Options',
            'menu_label'            => 'Sukawati',
        ));
}
add_action('after_setup_theme', 'sukawati_dashboard');


/** Add Dashboard Menu **/
function sukawati_themeoptions_menu() {
    // customize
    add_theme_page("Import Dummy Data" , "Import Dummy Data" ,'edit_theme_options', 'sukawati_import_content' , 'sukawati_import_view');

}
add_action('admin_menu', 'sukawati_themeoptions_menu', 50);
