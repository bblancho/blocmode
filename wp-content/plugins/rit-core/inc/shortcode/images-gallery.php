<?php

if (!function_exists('rit_shortcode_images_gallery')) {
    function rit_shortcode_images_gallery($atts)
    {
        $atts = shortcode_atts(
            array(
                'title' => '',
                'font_icon' => '',
                'columns' => '3',
                'images' => '',
                'el_class' => ''
            ), $atts);
        return rit_get_template_part('shortcode', 'images-gallery', array('atts' => $atts));
    }
}

add_shortcode('rit_images_gallery', 'rit_shortcode_images_gallery');

add_action('vc_before_init', 'rit_images_gallery_integrate_vc');

if (!function_exists('rit_images_gallery_integrate_vc')) {
    function rit_images_gallery_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Image Gallery', 'rit-core-language'),
                'base' => 'rit_images_gallery',
                'icon' => 'icon-rit',
                'category' => esc_html__('CleverSoft', 'rit-core-language'),
                'description' => esc_html__('Show Image Gallery', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Columns', 'rit-core-language'),
                        'description' => esc_html__('Number columns of layout', 'rit-core-language'),
                        'std' => '3',
                        'param_name' => 'columns',
                    ),
                    array(
                        "type" => "param_group",
                        "heading" => esc_html__("Images", 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'images',
                        'description' => esc_html__('Click to show more options, and starting add content.', 'rit-core-language'),
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type' => 'attach_image',
                                'heading' => esc_html__('Image', 'rit-core-language'),
                                'value' => '',
                                'param_name' => 'image',
                            ),
                            array(
                                'type' => 'vc_link',
                                'heading' => esc_html__( 'Link', 'rit-core-language' ),
                                'param_name' => 'link',
                                'description' => esc_html__( 'Link of Image', 'rit-core-language' )
                            ),
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Extra class name', 'rit-core-language'),
                        'param_name' => 'el_class',
                        'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language')
                    )
                    )
                )
            );
    }
}