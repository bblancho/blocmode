<?php

if (!function_exists('rit_shortcode_product_categories_banner')) {
    function rit_shortcode_product_categories_banner($atts)
    {

        $atts = shortcode_atts(
            array(
                'layout' => 'grid',
                'columns'=>'1',
                'col_width'=>'100',
                'style'=>'style-1',
                'gutter'=>'',
                'btn-style'=>'border',
                'list_content' => '',
                'el_class' => '',
            ), $atts);
        return rit_get_template_part('shortcode', 'product-categories-banner', array('atts' => $atts));
    }
}

add_shortcode('rit_product_categories_banner', 'rit_shortcode_product_categories_banner');

add_action('vc_before_init', 'rit_product_categories_banner_integrate_vc');
if (!(function_exists('rit_product_categories'))) {
    function rit_product_categories()
    {
        $categories = get_terms('product_cat');
        $results = array();
        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ){
            $data = array();
            foreach ( $categories as $term ) {
                $data['value'] = $term->slug;
                $data['label'] = $term->name;
                $results[] = $data;
            }
        }
        return $results;
    }
}
if (!function_exists('rit_product_categories_banner_integrate_vc')) {
    function rit_product_categories_banner_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Product Categories Banner', 'rit-core-language'),
                'base' => 'rit_product_categories_banner',
                'icon' => 'icon-rit',
                'category' => esc_html__('CleverSoft', 'rit-core-language'),
                'description' => esc_html__('List Product categories like banner', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Layout', 'rit-core-language'),
                        'std'=>'grid',
                        'value' => array(
                            esc_html__('Grid', 'rit-core-language' ) => 'grid',
                            esc_html__('Metro', 'rit-core-language' ) => 'metro',
                        ),
                        'param_name' => 'layout',
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Columns", 'rit-core-language'),
                        "param_name" => "columns",
                        'std' => '1',
                        "value" => array(
                            esc_html__('1', 'rit-core-language' ) => 1,
                            esc_html__('2', 'rit-core-language' ) => 2,
                            esc_html__('3', 'rit-core-language' ) => 3,
                            esc_html__('4', 'rit-core-language' ) => 4,
                            esc_html__('6', 'rit-core-language' ) => 6
                        ),
                        'dependency' => Array('element' => 'layout', 'value' => array('grid')),
                        'description' => esc_html__('Display post with the number of column', 'rit-core-language'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Columns width', 'rit-core-language' ),
                        'param_name' => 'col_width',
                        'std' => '100','dependency' => Array('element' => 'layout', 'value' => array('metro')),
                        'description' => esc_html__( 'Columns with of single row, help calculate columns and build layout Metro', 'rit-core-language' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Gutter', 'rit-core-language' ),
                        'param_name' => 'gutter',
                        'std' => '0','dependency' => Array('element' => 'layout', 'value' => array('metro')),
                        'description' => esc_html__( 'White space between item', 'rit-core-language' )
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Style", 'rit-core-language'),
                        "param_name" => "style",
                        'std' => 'style-1',
                        "value" => array(
                            esc_html__('Style 1', 'rit-core-language' ) => 'style-1',
                            esc_html__('Style 2', 'rit-core-language' ) => 'style-2',
                            esc_html__('Style 3', 'rit-core-language' ) => 'style-3',
                            esc_html__('Style 4', 'rit-core-language' ) => 'style-4',
                        ),
                        'description' => esc_html__('Style display', 'rit-core-language'),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Button Style", 'rit-core-language'),
                        "param_name" => "btn-style",
                        'std' => 'border',
                        "value" => array(
                            esc_html__('Default', 'rit-core-language' ) => 'default',
                            esc_html__('Border style', 'rit-core-language' ) => 'border',
                            esc_html__('Dark', 'rit-core-language' ) => 'dark',
                            esc_html__('Small Dark', 'rit-core-language' ) => 'small-dark',
                            esc_html__('Light', 'rit-core-language' ) => 'light',
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
                                "type" => "autocomplete",
                                'heading' => esc_html__('Product Category', 'rit-core-language'),
                                'param_name' => 'pro_cat',
                                'settings' => array(
                                    'multiple' => false,
                                    'sortable' => true,
                                    'min_length' => 0,
                                    'no_hide' => true, // In UI after select doesn't hide an select list
                                    'groups' => true, // In UI show results grouped by groups
                                    'unique_values' => true, // 0In UI show results except selected. NB! You should manually check values in backend
                                    'display_inline' => true, // In UI show results inline view
                                    'values' => rit_product_categories(),
                                ),
                            ),
                            array(
                                'type' => 'attach_image',
                                'value' => '',
                                'heading' => esc_html__('Image', 'rit-core-language'),
                                'param_name' => 'image',
                                'description' => esc_html__('If not set, it will get default value in Product Categories page', 'rit-core-language'),
                            ),
                            array(
                                'type' => 'checkbox',
                                'heading' => esc_html__('Show Count items', 'rit-core-language'),
                                'param_name' => 'show_count_items',
                                'std' => '0',
                                'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                            ),
                            array(
                                'type' => 'checkbox',
                                'heading' => esc_html__('Show Product Categories Title', 'rit-core-language'),
                                'param_name' => 'show_cat_title',
                                'std' => '0',
                                'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__( 'Product Categories Title', 'rit-core-language' ),
                                'param_name' => 'cat_title',
                                'dependency' => Array('element' => 'show_cat_title', 'value' => array('1')),
                                'description' => esc_html__('If not set, it will get default value in Product Categories page', 'rit-core-language'),
                            ),
                            array(
                                'type' => 'checkbox',
                                'heading' => esc_html__( 'Show Product Categories Description', 'rit-core-language' ),
                                'param_name' => 'show_cat_des',
                                'std' => '0',
                                'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                            ),
                            array(
                                'type' => 'textarea',
                                'heading' => esc_html__('Product Categories Description', 'rit-core-language' ),
                                'param_name' => 'cat_des',
                                'dependency' => Array('element' => 'show_cat_des', 'value' => array('1')),
                                'description' => esc_html__('If not set, it will get default value in Product Categories page', 'rit-core-language'),
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__( 'Text button', 'rit-core-language' ),
                                'param_name' => 'text_btn',
                                'description' => esc_html__('Leave it blank if don\'t want show it', 'rit-core-language'),
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