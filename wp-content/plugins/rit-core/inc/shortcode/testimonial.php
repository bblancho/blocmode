<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.0.2
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */

if (!function_exists('rit_shortcode_testimonial')) {
    function rit_shortcode_testimonial($atts)
    {
        $atts = shortcode_atts(array(
            'title' => '',
            'category' => '',
            'order_by' => 'date',
            'item_count' => '3',
            'output_type' => 'excerpt',
            'excerpt_length' => '20',
            'columns'=>'1',
            'style' => 'normal',
            'hide_avatar'=>'',
            'carousel_nav' => 'no',
            'carousel_pag' => 'no',
            'el_class' => '',
        ), $atts);

        return rit_get_template_part('shortcode', 'testimonial', array('atts' => $atts));
    }
}
add_shortcode('testimonial', 'rit_shortcode_testimonial');

add_action('vc_before_init', 'rit_testimonial_integrate_vc');

if (!function_exists('rit_testimonial_integrate_vc')) {
    function rit_testimonial_integrate_vc()
    {
        vc_map(array(
            "name" => esc_html__("RIT Testimonials", 'rit-core-language'),
            "base" => "testimonial",
            "class" => "",
            "icon" => "spb-icon-testimonial",
            "wrapper_class" => "clearfix",
            "controls" => "full",
            'category' => esc_html__('CleverSoft', 'rit-core-language'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title", 'rit-core-language'),
                    "param_name" => "title",
                    "value" => "",
                    "description" => esc_html__("Heading text. Leave it empty if not needed.", 'rit-core-language')
                ),
                array(
                    "type" => "rit_testimonial_categories",
                    "heading" => esc_html__("Testimonials category", 'rit-core-language'),
                    "param_name" => "category",
                    "description" => esc_html__("Choose the category for the testimonials.", 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Testimonials Order", 'rit-core-language'),
                    "param_name" => "order_by",
                    "value" => array(
                        esc_html__('Random', 'rit-core-language') => "rand",
                        esc_html__('Latest', 'rit-core-language') => "date"
                    ),
                    "description" => esc_html__("Choose the order of the testimonials.", 'rit-core-language')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Number of items", 'rit-core-language'),
                    "param_name" => "item_count",
                    "value" => "3",
                    "description" => esc_html__("The number of testimonials display. Leave blank to show ALL testimonials.", 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Content display", 'rit-core-language'),
                    "param_name" => "output_type",
                    'std' => 1,
                    "value" => array(
                        esc_html__('Excerpt', 'rit-core-language') => 'excerpt',
                        esc_html__('Full content', 'rit-core-language') => 'content',
                    ),
                    'description' => esc_html__('Select type of content', 'rit-core-language'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Excerpt lenght", 'rit-core-language'),
                    "param_name" => "excerpt_length",
                    'dependency' => Array('element' => 'output_type', 'value' => array('excerpt')),
                    "description" => esc_html__("Total character display of excerpt.", 'rit-core-language'),
                    "value" => '20'
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Testimonials Style", 'rit-core-language'),
                    "param_name" => "style",
                    "value" => array(
                        esc_html__('Normal', 'rit-core-language') => "normal",
                        esc_html__('Carousel', 'rit-core-language') => "carousel"
                    ),
                    'std' => 'normal',
                    'group'=> esc_html__('Style', 'rit-core-language'),
                    "description" => esc_html__("Choose style display.", 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Preset Style", 'rit-core-language'),
                    "param_name" => "preset_style",
                    "value" => array(
                        esc_html__('Default', 'rit-core-language') => "default",
                        esc_html__('Style 1', 'rit-core-language') => "style-1",
                    ),
                    'std' => 'default',
                    'group'=> esc_html__('Style', 'rit-core-language'),
                    "description" => esc_html__("Choose preset style display.", 'rit-core-language')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => esc_html__("Hide avatar author", 'rit-core-language'),
                    "param_name" => "hide_avatar",
                    'value' => array( esc_html__( 'Yes', 'rit-core-language' ) => 'true' ),
                    'group'=> esc_html__('Style', 'rit-core-language'),
                    "description" => esc_html__("Hide avatar author.", 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Columns", 'rit-core-language'),
                    "param_name" => "columns",
                    'group'=> esc_html__('Style', 'rit-core-language'),
                    'std' => '1',
                    "value" => array(
                        esc_html__('1', 'rit-core-language' ) => 1,
                        esc_html__('2', 'rit-core-language' ) => 2,
                        esc_html__('3', 'rit-core-language' ) => 3,
                        esc_html__('4', 'rit-core-language' ) => 4,
                        esc_html__('6', 'rit-core-language' ) => 6
                    ),
                    'description' => esc_html__('Display testimonial with the number of columns', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Carousel navigation", 'rit-core-language'),
                    "param_name" => "carousel_nav",
                    "value" => array(
                        esc_html__('Yes', 'rit-core-language') => "yes",
                        esc_html__('No', 'rit-core-language') => "no"
                    ),
                    'std' => 'no',
                    'group'=> esc_html__('Style', 'rit-core-language'),
                    "dependency" => Array('element' => 'style', 'value' => array('carousel')),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Carousel pagination", 'rit-core-language'),
                    "param_name" => "carousel_pag",
                    "value" => array(
                        esc_html__('Yes', 'rit-core-language') => "yes",
                        esc_html__('No', 'rit-core-language') => "no"
                    ),
                    'std' => 'no',
                    'group'=> esc_html__('Style', 'rit-core-language'),
                    "dependency" => Array('element' => 'style', 'value' => array('carousel')),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'rit-core-language'),
                    "param_name" => "el_class",
                    "value" => "",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'rit-core-language')
                )
            )
        ));
    }
}
