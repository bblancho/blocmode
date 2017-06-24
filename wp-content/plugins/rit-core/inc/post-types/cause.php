<?php

/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.3.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */

if (!class_exists('RIT_Custom_Post_Type_Cause')) {
    class RIT_Custom_Post_Type_Cause
    {
        public static function &getInstance()
        {
            static $instance;
            if (!isset($instance)) {
                $instance = new RIT_Custom_Post_Type_Cause();
            }
            return $instance;
        }

        public function __construct() {
            add_action('init', array($this, 'register_cause'));
            add_action('init', array($this, 'register_cause_category'));
            //add_filter( 'manage_edit-course_columns', array($this, 'rit_donate_form_columns') );
            //add_action( 'manage_posts_custom_column', array($this, 'rit_render_donate_form_columns'), 10, 2 );
            //flush_rewrite_rules();
        }

        public function register_cause()
        {
            $labels = array(
                'name' => esc_html__('Causes', 'rit-core-language'),
                'singular_name' => esc_html__('Cause', 'rit-core-language'),
                'add_new' => esc_html__('Add New', 'rit-core-language'),
                'add_new_item' => esc_html__('Add New Cause', 'rit-core-language'),
                'edit_item' => esc_html__('Edit Cause', 'rit-core-language'),
                'new_item' => esc_html__('New Cause', 'rit-core-language'),
                'view_item' => esc_html__('View Cause', 'rit-core-language'),
                'search_items' => esc_html__('Search Cause', 'rit-core-language'),
                'not_found' => esc_html__('No cause items have been added yet', 'rit-core-language'),
                'not_found_in_trash' => esc_html__('Nothing found in Trash', 'rit-core-language'),
                'parent_item_colon' => ''
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_nav_menus' => false,
                'menu_icon' => 'dashicons-format-image',
                'hierarchical' => false,
                'rewrite' => array(
                    'slug' => 'cause'
                ),
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'revisions'
                ),
                'has_archive' => true,
            );

            register_post_type('course', $args);
        }

        public function register_cause_category()
        {
            $args = array(
                "label" => esc_html__('Cause Categories', 'rit-core-language'),
                "singular_label" => esc_html__('Cause Category', 'rit-core-language'),
                'public' => true,
                'hierarchical' => true,
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'args' => array('orderby' => 'term_order'),
                'rewrite' => array(
                    'slug' => 'cause_category',
                    'with_front' => false,
                    'hierarchical' => true,
                ),
                'query_var' => true
            );
            register_taxonomy('course_category', 'course', $args);
        }


        public function rit_donate_form_columns( $defaults ) {
            //Standard columns
            $defaults['goal'] = esc_html__( 'Goal', 'rit-core-language' );
            return $defaults;
        }

        public function rit_render_donate_form_columns( $column_name, $post_id ) {

            if ( get_post_type( $post_id ) == 'transaction' ) {

                switch ( $column_name ) {
                    case 'goal':
                        echo get_post_meta( $post_id, 'rit_goal', true);
                        break;
                    case 'currency':
                        echo get_post_meta( $post_id, 'rit_c_code', true);
                        break;
                    case 'paypal':
                        echo get_post_meta( $post_id, 'rit_account', true);
                        break;

                }
            }
        }
    }

    RIT_Custom_Post_Type_Cause::getInstance();
}