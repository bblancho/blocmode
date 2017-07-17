<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.0.3
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */
add_filter('rwmb_meta_boxes', 'ri_ione_add_meta_box_options');
function ri_ione_add_meta_box_options()
{
    $prefix = "rit_";
    $meta_boxes = array();
    //All page
    $meta_boxes[] = array(
        'id' => $prefix.'layout_single_heading',
        'title' => esc_html__('Layout Single Product', 'ri-ione'),
        'pages' => array('product'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'name' => esc_html__('Sidebar Options', 'ri-ione'),
                'id' => $prefix."woo_layout_single",
                'type' => 'select',
                'options' => array(
                    'inherit' => 'Inherit',
                    'horizontal-gallery' =>esc_html__('Horizontal Gallery','ri-ione'),
                    'vertical-gallery' =>esc_html__('Vertical Gallery','ri-ione'),
                    'carousel' =>esc_html__('Carousel','ri-ione'),
                    'sticky' =>esc_html__('Sticky','ri-ione')
                ),
                'std' => 'inherit',
                'desc' => esc_html__('Choose Options Sidebar.', 'ri-ione')
            ),
            ));
    $meta_boxes[] = array(
        'id' => 'title_meta_box',
        'title' => esc_html__('Layout Options', 'ri-ione'),
        'pages' => array('page','post'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'name' => esc_html__('Logo page', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_logo_stt",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Logo for page', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_logo_page",
                'type' => 'image_advanced',
                'max_file_uploads' => 1
            ),
            array(
                'name' => esc_html__('Hide site Tag line.', 'ri-ione'),
                'id' => "rit_hide_tag_line",
                'type' => 'checkbox',
            ),
            array(
                'name' => esc_html__('Header height', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_header_height",
                'type' => 'number',
                'attributes' => array(
                    'min' => 0,
                )
            ),
            array(
                'name' => esc_html__('Header sticky height', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_header_sticky_height",
                'type' => 'number',
                'attributes' => array(
                    'min' => 0,
                )
            ),
            array(
                'name' => esc_html__('Title Options', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_heading_title",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Disable Title', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_disable_title",
                'std' => '0',
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Page Layout', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_body_heading",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Enable Page Full width.', 'ri-ione'),
                'id' => "rit_enable_page_full_width",
                'type' => 'checkbox',
            ),
            array(
                'name' => esc_html__('Page Max Width', 'ri-ione'),
                'desc' => esc_html__('Accept only number. If not set, it will follow customize config.', 'ri-ione'),
                'id' => "rit_enable_large_width",
                'type' => 'number'
            ),
            array(
                'name' => esc_html__('Header Options', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_heading_header",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Enable top header.', 'ri-ione'),
                'id' => "rit_enable_top_header",
                'type' => 'checkbox',
            ),
            array(
                'name' => esc_html__('Enable header sticky.', 'ri-ione'),
                'id' => "rit_enable_sticky_header",
                'type' => 'checkbox',
            ),
            array(
                'name' => esc_html__('Header Layout', 'ri-ione'),
                'id' => "rit_header_layout",
                'type' => 'image_select',
                'options' => array(
                    'inherit' => esc_url(get_template_directory_uri() . '/images/layout/inherit.png'),
                    'menu-right' => esc_url(get_template_directory_uri() . '/images/layout/menu-right.png'),
                    'menu-center' => esc_url(get_template_directory_uri() . '/images/layout/menu-center.png'),
                    'stack-center' => esc_url(get_template_directory_uri() . '/images/layout/stack-center.png'),
                    'stack-center-2' => esc_url(get_template_directory_uri() . '/images/layout/stack-center-2.png'),
                    'logo-center' => esc_url(get_template_directory_uri() . '/images/layout/logo-center.png'),
                    'vertical' => esc_url(get_template_directory_uri() . '/images/layout/vertical.png'),
                ),
                'std' => 'inherit',
                'desc' => esc_html__('Choose Options Header Layout. If set Inherit, it follow option of customize', 'ri-ione')
            ),
            array(
                'name' => esc_html__('Enable Header Transparency', 'ri-ione'),
                'id' => "rit_enable_header_transparent",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, header will be use transparent style.', 'ri-ione')
            ),
            array(
                'name' => esc_html__('100% Header Width', 'ri-ione'),
                'id' => "rit_enable_header_fullwidth",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('Check this box to set the header to 100% of the browser width. Uncheck to follow the site width.', 'ri-ione')
            ),
            array(
                'name' => esc_html__('Footer Options', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_heading_footer",
                'type' => 'heading',
                'class'=>'clear',
            ),
            array(
                'name' => esc_html__('Enable Footer sticky', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_stick_footer",
                'type' => 'checkbox',
                'desc' => esc_html__('Footer always on bottom.', 'ri-ione')
            ),
            array(
                'name' => esc_html__('Enable top footer', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_disable_top_footer",
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Disable main footer', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_disable_main_footer",
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Footer Layout', 'ri-ione'),
                'id' => "rit_footer_layout",
                'type' => 'image_select',
                'options' => array(
                    'inherit' =>esc_url(get_template_directory_uri() . '/images/layout/inherit.png'),
                    'default' => esc_url(get_template_directory_uri() . '/images/layout/footer-style1.png'),
                    'one-line' => esc_url(get_template_directory_uri() . '/images/layout/footer-style2.png'),
                    'simple' => esc_url(get_template_directory_uri() . '/images/layout/footer-style3.png'),
                ),
                'std' => 'inherit',
                'desc' => esc_html__('Choose Footer Layout.', 'ri-ione')
            ),
        )
    );
    $meta_boxes[] = array(
        'id' => 'post_meta_box',
        'title' => esc_html__('Post Meta', 'ri-ione'),
        'pages' => array('testimonial'),
        'context' => 'normal',
        'fields' => array(
            array(
                'name' => esc_html__('Author avatar', 'ri-ione'),
                'desc' => esc_html__('Author avatar display in frontend', 'ri-ione'),
                'id' => "rit_author_img",
                'type' => 'image_advanced',
                'max_file_uploads' => 1
            ),
            array(
                'name' => esc_html__('Author name', 'ri-ione'),
                'desc' => esc_html__('Author name display in frontend', 'ri-ione'),
                'id' => "rit_author",
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Author description', 'ri-ione'),
                'desc' => esc_html__('Author description display in frontend', 'ri-ione'),
                'id' => "rit_author_des",
                'type' => 'text',
            ),
        ));
    $meta_boxes[] = array(
        'id' => 'rit_heading_color',
        'title' => esc_html__('Color Options', 'ri-ione'),
        'pages' => array('page'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'name' => esc_html__('Preset style', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_heading_page_preset",
                'type' => 'heading',
            ),
            array(
                'name' => esc_html__('Active Dark Style', 'ri-ione'),
                'id' => "rit_enable_dark_style",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, all value custom color & background will be override. Page will switch to use dark style', 'ri-ione')
            ),
            array(
                'name' => esc_html__('Page Color & Background', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_heading_page_color",
                'type' => 'heading',
            ),
            array(
                'name' => esc_html__('Page Accent Color', 'ri-ione'),
                'id' => "rit_accent_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Page background', 'ri-ione'),
                'desc' => esc_html__('Background Image for page', 'ri-ione'),
                'id' => "rit_page_bg",
                'type' => 'image_advanced',
                'max_file_uploads' => 1
            ),
            array(
                'name' => esc_html__('Page Background Color', 'ri-ione'),
                'id' => "rit_page_bg_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Header Color & Background', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_heading_header_color",
                'type' => 'heading',
            ),
            array(
                'name' => esc_html__('Active Custom color & background header', 'ri-ione'),
                'id' => "rit_enable_header_color",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, all value custom color & background will be accept', 'ri-ione')
            ),
            array(
                'name' => esc_html__('Header Color', 'ri-ione'),
                'desc' => esc_html__('Color of text in header', 'ri-ione'),
                'id' => "rit_header_color",
                'type' => 'color',
                'std' => '#252525',
            ),
            array(
                'name' => esc_html__('Header Color Hover', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_header_color_hover",
                'type' => 'color',
                'std' => '#252525',
            ),
            array(
                'name' => esc_html__('Header Background', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_custom_bg_header",
                'type' => 'color',
                'std' => '#fff',
            ),
            array(
                'name' => esc_html__('Header Background Opacity', 'ri-ione'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-ione'),
                'id' => "rit_custom_bg_header_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Header sticky Background', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_bg_sticky_header",
                'type' => 'color',
                'std' => '#fff',
            ),
            array(
                'name' => esc_html__('Header Sticky Background Opacity', 'ri-ione'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-ione'),
                'id' => "rit_bg_sticky_header_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Header Border Color', 'ri-ione'),
                'id' => "rit_header_border_color",
                'type' => 'color',
                'std' => '#f5f5f5',
            ),
            array(
                'name' => esc_html__('Header Border Color', 'ri-ione'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-ione'),
                'id' => "rit_header_border_color_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
//            array(
//                'name' => esc_html__('Primary Menu Color & Background', 'ri-ione'),
//                'desc' => esc_html__('', 'ri-ione'),
//                'id' => "rit_heading_pri_menu_color",
//                'type' => 'heading',
//            ),
//            array(
//                'name' => esc_html__('Background', 'ri-ione'),
//                'id' => "rit_menu_bg",
//                'type' => 'color',
//                'std' => '',
//            ),
//            array(
//                'name' => esc_html__('Color', 'ri-ione'),
//                'id' => "rit_menu_color",
//                'desc' => esc_html__('Apply only for First level of menu', 'ri-ione'),
//                'type' => 'color',
//                'std' => '',
//            ),
            array(
                'name' => esc_html__('Footer Color', 'ri-ione'),
                'desc' => esc_html__('', 'ri-ione'),
                'id' => "rit_heading_footer_color",
                'type' => 'heading',
                'class'=>'clear',
            ),
            array(
                'name' => esc_html__('Active Custom color & background footer', 'ri-ione'),
                'id' => "rit_enable_footer_color",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, all value custom color & background will be accept', 'ri-ione')
            ),
            array(
                'name' => esc_html__('Footer Background', 'ri-ione'),
                'id' => "rit_footer_bg_color",
                'type' => 'color',
                'std' => '#f5f5f5',
            ),
            array(
                'name' => esc_html__('Footer Background Opacity', 'ri-ione'),
                'desc' => esc_html__('Controls the opacity for the footer. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-ione'),
                'id' => "rit_footer_bg_color_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Footer Title Color', 'ri-ione'),
                'id' => "rit_footer_title_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Footer Color', 'ri-ione'),
                'id' => "rit_footer_color",
                'type' => 'color',
                'std' => '#f5f5f5',
            ),
            array(
                'name' => esc_html__('Footer Link Color', 'ri-ione'),
                'id' => "rit_footer_link_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Footer Link Color Hover', 'ri-ione'),
                'id' => "rit_footer_link_color_hover",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Footer Bottom Border Color', 'ri-ione'),
                'id' => "rit_footer_bt_border_color",
                'type' => 'color',
                'std' => '#f5f5f5',
            ),
            array(
                'name' => esc_html__('Footer Bottom Border Opacity', 'ri-ione'),
                'desc' => esc_html__('Controls the opacity for the footer. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-ione'),
                'id' => "rit_footer_bt_border_color_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
        ));
    $meta_boxes[] = array(
        'id' => 'rit_heading_sidebar',
        'title' => esc_html__('Sidebar Options', 'ri-ione'),
        'pages' => array('post'),
        'context' => 'side',
        'fields' => array(
            array(
                'name' => esc_html__('Sidebar Options', 'ri-ione'),
                'id' => "rit_sidebar_options",
                'type' => 'select',
                'options' => array(
                    'inherit' => 'Inherit',
                    'no-sidebar' => 'No Sidebar',
                    'left-sidebar' => 'Left Sidebar',
                    'right-sidebar' => 'Right Sidebar',
                    'both-sidebar' => 'Both Sidebar'
                ),
                'std' => 'inherit',
                'desc' => esc_html__('Choose Options Sidebar.', 'ri-ione')
            ),
            array(
                'name' => esc_html__('Left Sidebar', 'ri-ione'),
                'id' => "rit_left_sidebar",
                'type' => 'sidebars',
            ),
            array(
                'name' => esc_html__('Right Sidebar', 'ri-ione'),
                'id' => "rit_right_sidebar",
                'type' => 'sidebars',
            ),
        ));
    return $meta_boxes;
}


get_template_part(ABSPATH . 'wp-admin/includes/plugin.php');


if (is_plugin_active('meta-box/meta-box.php')) {
    get_template_part('included/meta-boxes/field/sidebars');
}

