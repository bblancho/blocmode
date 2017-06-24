<?php

if (!function_exists('rit_shortcode_parallax_box')) {
	function rit_shortcode_parallax_box($atts, $content=null)
	{

		$atts = shortcode_atts(
			array(
				'add_nav'=>'',
				'title_nav'=>'',
				'img_bg'=>'',
				'speed'=>'0.2',
				'layout'=>'normal'
			), $atts);
		return rit_get_template_part('shortcode', 'parallax-box', array('atts' => $atts,'content'=>$content));
	}
}

add_shortcode('rit_parallax_box', 'rit_shortcode_parallax_box');

add_action('vc_before_init', 'rit_shortcode_parallax_box_integrate_vc');

if (!function_exists('rit_shortcode_parallax_box_integrate_vc')) {
	function rit_shortcode_parallax_box_integrate_vc()
	{
		vc_map(
			array(
				'name' => esc_html__('RIT Parallax Box', 'rit-core-language'),
				'base' => 'rit_parallax_box',
				'icon' => 'fa fa-object-group',
				'is_container' => true,
				'js_view'      => 'VcColumnView',
				'category' => esc_html__('CleverSoft', 'rit-core-language'),
				'description' => esc_html__('Box demo. Display feature of themes, with images or icons', 'rit-core-language'),
				'params' => array(
					array(
						'type' => 'checkbox',
						'heading' => esc_html__("Add to Parallax navigation", 'rit-core-language'),
						'param_name' => 'add_nav',
						'std' => '',
						'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'rit-core-language'),
						"param_name" => "title_nav",
						'dependency' => Array('element' => 'add_nav', 'value' => array('1')),
						"description" => esc_html__("Title display at navigation.", 'rit-core-language'),
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__('Image Background', 'rit-core-language'),
						'std' => '',
						'param_name' => 'img_bg',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Speed', 'rit-core-language'),
						'std' => '0.2',
						'param_name' => 'speed',
						'description' => esc_html__('Accept value form 0.1 to 1', 'rit-core-language'),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout", 'rit-core-language'),
						"param_name" => "layout",
						'std' => 'normal',
						"value" => array(
							esc_html__('Normal', 'rit-core-language' ) => 'normal',
							esc_html__('On Screen', 'rit-core-language' ) => 'on-screen',
							esc_html__('Full Screen', 'rit-core-language' ) => 'full-screen',
						)
					),
				)
			)
		);
	}
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Rit_Parallax_Box extends WPBakeryShortCodesContainer {
	}
}