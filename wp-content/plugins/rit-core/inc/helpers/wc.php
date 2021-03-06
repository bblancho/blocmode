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
function rit_product_label($product = null, $post = null){

    if($product == null){
        global $product;
    }

    if($post == null){
        global $post;
    }
    $stock_status = get_post_meta($post->ID, '_stock_status',true);
    if ($stock_status == 'outofstock') {

        echo '<span class="out-of-stock-badge">' . esc_html__( 'Out of Stock', 'rit-core-language' ) . '</span>';

    } else if ($product->is_on_sale()) {

        echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.esc_html__( 'Sale!', 'woocommerce' ).'</span>', $post, $product);
    } else if (!$product->get_price()) {

        echo '<span class="free-badge">' . esc_html__( 'Free', 'rit-core-language' ) . '</span>';

    } else {

        $postdate 		= get_the_time( 'Y-m-d' );			// Post date
        $postdatestamp 	= strtotime( $postdate );			// Timestamped post date
        $newness 		= 7; 	// Newness in days

        if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
            echo '<span class="wc-new-badge">' . esc_html__( 'New', 'rit-core-language' ) . '</span>';
        }

    }
}



if(!function_exists('rit_ajax_product_filter')){

    function rit_ajax_product_filter(){
        
        global $wpdb;

        $atts = array(
            //'title' => '',
            'post_type' => $_POST['post_type'],
            'pagination' => $_POST['pagination'],
            'column' => $_POST['column'],
            'posts_per_page' => $_POST['posts_per_page'],
            'products_type' => $_POST['products_type'],
            'products_img_size' => $_POST['products_img_size'],
            'paged' => $_POST['paged'],
            'ignore_sticky_posts' => $_POST['ignore_sticky_posts'],
            'show' => $_POST['show'],
            'orderby' => $_POST['orderby'],
            'col_width' => $_POST['col_width'],
            'element_custom_class' => $_POST['element_custom_class'],
            'padding_bottom_module' => $_POST['padding_bottom_module'],
            'filter_attributes' => $_POST['filter_attributes'],
            'filter_tags' => $_POST['filter_tags'],
            'filter_categories' => $_POST['filter_categories'],
            'show_filter' => $_POST['show_filter'],
            'show_featured_filter' => $_POST['show_featured_filter'],
            'show_price_filter'=> $_POST['show_price_filter'],
            'price_filter_level'=> $_POST['price_filter_level'],
            'price_filter_range' => $_POST['price_filter_range'],
            'loadmore' => $_POST['loadmore']
        );



        $wc_attr = array(
            'post_type' => 'product',
            'posts_per_page' => $atts['posts_per_page'],
            'paged' => $atts['paged'],
            'orderby' => $atts['orderby'],
            'ignore_sticky_posts' => $atts['ignore_sticky_posts'],
        );

        $meta_query = WC()->query->get_meta_query();
        $tax_query = array();

        if(isset($_POST['show'])){


            if ($atts['show'] == 'featured') {

                $meta_query[] = array(
                    'key' => '_featured',
                    'value' => 'yes'
                );

            } elseif ($atts['show'] == 'onsale') {

                $product_ids_on_sale = wc_get_product_ids_on_sale();

                $wc_attr['post__in'] = $product_ids_on_sale;

            } elseif ($atts['show'] == 'best-selling') {

                $wc_attr['meta_key'] = 'total_sales';
    
            } elseif ($atts['show'] == 'latest'){

                $wc_attr['orderby'] = 'date';
                
                $wc_attr['order'] = 'DESC';

            } elseif ($atts['show'] == 'toprate'){

                add_filter('posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses'));

            } elseif ($atts['show'] == 'price'){

                $wc_attr['orderby']  = "meta_value_num {$wpdb->posts}.ID";
                $wc_attr['order']    = 'ASC';
                $wc_attr['meta_key'] = '_price';

            } elseif ($atts['show'] == 'price-desc'){

                $wc_attr['orderby']  = "meta_value_num {$wpdb->posts}.ID";
                $wc_attr['order']    = 'DESC';
                $wc_attr['meta_key'] = '_price';

            }

        }


        if(isset($_POST['product_attribute']) && isset($_POST['attribute_value'])){
            if(is_array($_POST['product_attribute'])){
                foreach ($_POST['product_attribute'] as $key => $value) {
                    $tax_query[] = array(
                    'taxonomy' => $value,
                    'terms' => $_POST['attribute_value'][$key],
                    'field'         => 'slug',
                    'operator'      => 'IN'
                );
                }
            }else {
                $tax_query[] = array(
                    'taxonomy' => $_POST['product_attribute'],
                    'terms' => $_POST['attribute_value'],
                    'field'         => 'slug',
                    'operator'      => 'IN'
                );

            }
        }

        if(isset($_POST['filter_categories'])){
            $wc_attr['product_cat'] = $_POST['filter_categories'];
        }

        if(isset($_POST['product_tag'])){
            $wc_attr['product_tag'] = $_POST['product_tag'];
        }

        if(isset($_POST['price_filter']) && $_POST['price_filter'] > 0 ){

            $min = (intval($_POST['price_filter']) - 1)*intval($_POST['price_filter_range']);
            $max = intval($_POST['price_filter'])*intval($_POST['price_filter_range']);
            $meta_query[] = array(
                                'key' => '_price',
                                'value' => array($min, $max),
                                'compare' => 'BETWEEN',
                                'type' => 'NUMERIC'
                            );
        }

        if(isset($_POST['s']) && $_POST['s'] != '' ){
            $wc_attr['s'] = $_POST['s'];
        }

        $wc_attr['tax_query'] = $tax_query;
        $wc_attr['meta_query'] = $meta_query;

        $atts['wc_attr'] = $wc_attr;

        echo rit_get_template_part('shortcode', 'product', array('atts' => $atts));
        
    }

    add_action('wp_ajax_rit_ajax_product_filter', 'rit_ajax_product_filter');
    add_action( 'wp_ajax_nopriv_rit_ajax_product_filter', 'rit_ajax_product_filter' );
}

if(!function_exists('rit_ajax_product_search')){
    function rit_ajax_product_search(){
        if(isset($_POST['rit_search'])){
            echo rit_get_template_part('shortcode', 'product-search', array('atts' => $atts));
        }
    }
    add_action('wp_ajax_rit_ajax_product_search', 'rit_ajax_product_search');
    add_action( 'wp_ajax_nopriv_rit_ajax_product_search', 'rit_ajax_product_search' );
}

// hook into wp pre_get_posts
add_action('pre_get_posts', 'rit_woo_search_pre_get_posts');

if(!function_exists('rit_woo_search_pre_get_posts')) {
    function rit_woo_search_pre_get_posts($q)
    {

        if (is_search()) {
            add_filter('posts_join', 'rit_search_post_join');
            add_filter('posts_where', 'rit_search_post_excerpt');
        }
    }
}

if(!function_exists('rit_search_post_join')) {
    function rit_search_post_join($join = '')
    {

        global $wp_the_query;

        // escape if not woocommerce searcg query
        if (empty($wp_the_query->query_vars['wc_query']) || empty($wp_the_query->query_vars['rit_search']))
            return $join;

        $join .= "INNER JOIN wp_postmeta AS ritmeta ON (wp_posts.ID = ritmeta.post_id)";
        return $join;
    }
}

if(!function_exists('rit_search_post_excerpt')) {
    function rit_search_post_excerpt($where = ''){

        global $wp_the_query;

        // escape if not woocommerce search query
        if (empty($wp_the_query->query_vars['wc_query']) || empty($wp_the_query->query_vars['rit_search']))
            return $where;

        $where = preg_replace("/post_title LIKE ('%[^%]+%')/", "post_title LIKE $1)
                    OR (ritmeta.meta_key = '_sku' AND CAST(ritmeta.meta_value AS CHAR) LIKE $1)
                    OR  (ritmeta.meta_key = '_author' AND CAST(ritmeta.meta_value AS CHAR) LIKE $1)
                    OR  (ritmeta.meta_key = '_publisher' AND CAST(ritmeta.meta_value AS CHAR) LIKE $1)
                    OR  (ritmeta.meta_key = '_format' AND CAST(ritmeta.meta_value AS CHAR) LIKE $1 ", $where);

        return $where;
    }
}