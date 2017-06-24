<?php

if (!function_exists('rit_shortcode_banner')) {
    function rit_shortcode_banner($atts)
    {

        $atts = shortcode_atts(
            array(
                'image' => '',
                'img_anm'=>'none',
                'img_align'=>'left',
                'cnt_align'=>'left',
                'link'=>'',
                'list_content'=>'',
                'el_class' => '',
            ), $atts);
        return rit_get_template_part('shortcode', 'banner', array('atts' => $atts));
    }
}

add_shortcode('rit_banner', 'rit_shortcode_banner');

add_action('vc_before_init', 'rit_banner_integrate_vc');
if (!function_exists('rit_banner_integrate_vc')) {
    function rit_banner_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Banner', 'rit-core-language'),
                'base' => 'rit_banner',
                'icon' => 'icon-rit',
                'category' => esc_html__('CleverSoft', 'rit-core-language'),
                'description' => esc_html__('Create banner ads for your site', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'rit-core-language' ),
                        'param_name' => 'image',
                        'description' => esc_html__( 'Image of banner', 'rit-core-language' )
                    ),
                    array(
                        "type" => 'rit_animation_type',
                        "heading" => esc_html__("Image Animation Type", 'rit-core-language'),
                        "param_name" => "img_anm",
                        "admin_label" => true,
                        'description' => esc_html__('Select animation type for image', 'rit-core-language'),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Image Align", 'rit-core-language'),
                        "param_name" => "img_align",
                        'std' => 'left',
                        "value" => array(
                            esc_html__('Left', 'rit-core-language' ) => 'left',
                            esc_html__('Right', 'rit-core-language' ) => 'right',
                        ),
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link', 'rit-core-language' ),
                        'param_name' => 'link',
                        'description' => esc_html__( 'Link of banner', 'rit-core-language' )
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Content align", 'rit-core-language'),
                        "param_name" => "cnt_align",
                        'std' => 'left',
                        "value" => array(
                            esc_html__('Left', 'rit-core-language' ) => 'left',
                            esc_html__('Right', 'rit-core-language' ) => 'right',
                        ),
                    ),
                    array(
                        "type" => "param_group",
                        "heading" => esc_html__("Content", 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'list_content',
                        'description' => esc_html__('Click to show more options, and starting add content.', 'rit-core-language'),
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                "type" => "dropdown",
                                "heading" => esc_html__("Style", 'rit-core-language'),
                                "param_name" => "style",
                                'std' => 'heading',
                                "value" => array(
                                    esc_html__('Heading', 'rit-core-language' ) => 'heading',
                                    esc_html__('Content', 'rit-core-language' ) => 'content',
                                    esc_html__('Button', 'rit-core-language' ) => 'button',
                                ),
                            ),
                            array(
                                'type' => 'textarea',
                                'heading' => esc_html__('Text', 'rit-core-language' ),
                                'param_name' => 'text_val',
                                'description' => esc_html__('', 'rit-core-language'),
                            ),
                            array(
                                "type" => 'rit_animation_type',
                                "heading" => esc_html__("Animation Type", 'rit-core-language'),
                                "param_name" => "text_anm",
                                'description' => esc_html__('Select animation type', 'rit-core-language'),
                            ),
                            array(
                                "type" => "dropdown",
                                "heading" => esc_html__("Button Style", 'rit-core-language'),
                                "param_name" => "btn-style",
                                'std' => 'border',
                                'dependency' => Array('element' => 'style', 'value' => array('button')),
                                "value" => array(
                                    esc_html__('Border style', 'rit-core-language' ) => 'border',
                                    esc_html__('Dark', 'rit-core-language' ) => 'dark',
                                    esc_html__('Small Dark', 'rit-core-language' ) => 'small-dark',
                                    esc_html__('Light', 'rit-core-language' ) => 'light',
                                ),
                            ),
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Extra class name', 'rit-core-language' ),
                        'param_name' => 'el_class',
                        'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language' )
                    )
                )
            )
        );
    }
}