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

if (!function_exists('rit_shortcode_countdown')) {
    function rit_shortcode_countdown($atts)
    {
        $atts = shortcode_atts(array(
            'date' => '0',
            'hour' => '0',
            'min' => '0',
            'sec' => '0',
            'link' => '0',
            'el_class' => ''
        ), $atts);
        return rit_get_template_part('shortcode', 'countdown', array('atts' => $atts));
    }
}
add_shortcode('countdown', 'rit_shortcode_countdown');

add_action('vc_before_init', 'rit_countdown_integrate_vc');

if (!function_exists('rit_countdown_integrate_vc')) {
    function rit_countdown_integrate_vc()
    {
        vc_map(array(
            'name' => esc_html__('RIT CountDown', 'rit-core-language'),
            'base' => 'countdown',
            'category' => esc_html__('CleverSoft', 'rit-core-language'),
            'icon' => 'rit-countdown',
            "params" => array(
                array(
                    'type' => 'rit_datepicker',
                    'heading' => esc_html__('Date', 'rit-core-language'),
                    'param_name' => 'date',
                    'admin_panel' => true,
                    'description' => esc_html__('Enter only number. Date End countdown', 'rit-core-language')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Hour', 'rit-core-language'),
                    'param_name' => 'hour',
                    'std'=>0,
                    'admin_panel' => true,
                    'description' => esc_html__('Hour End countdown', 'rit-core-language')
                ), array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Minutes', 'rit-core-language'),
                    'param_name' => 'min',
                    'std'=>0,
                    'admin_panel' => true,
                    'description' => esc_html__('Minutes End countdown', 'rit-core-language')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Second', 'rit-core-language'),
                    'param_name' => 'sec',
                    'std'=>0,
                    'admin_panel' => true,
                    'description' => esc_html__('Second End countdown', 'rit-core-language')
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__('Link', 'rit-core-language'),
                    'param_name' => 'link',
                    'edit_field_class' => 'vc_col-xs-6',
                    'description' => esc_html__('Apply only number.', 'rit-core-language')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'rit-core-language'),
                    'param_name' => 'el_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language')
                )
            )
        ));
    }
}
