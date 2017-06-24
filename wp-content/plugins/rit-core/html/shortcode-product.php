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
if (!isset($_POST['show'])) {
    echo '<input name="rit-filter-page-baseurl" type="hidden" value="' . rit_current_url() . '">';
}
$varid = mt_rand();
?>
<div
    class="woocommerce rit-products-wrap rit-products-wrap_<?php echo esc_attr($varid); ?> <?php echo esc_attr($atts['element_custom_class']) ?>"
    data-args='<?php
    //shortcode agurgument
    if (!isset($_POST['show'])) {
        $init_atts = $atts;
        unset($init_atts['wc_attr']);
        echo json_encode($init_atts);
    } else {
        echo json_encode($_POST);
    }
    ?>'
    data-categories="<?php echo esc_attr($atts['filter_categories']); ?>"
    data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
    <?php
    if ($atts['show_filter']) {
        //enable search
        if ($atts['show_search']) {?>
            <label><input type="text" name="s" placeholder="Product Search"><input class="rit_search_button" type="button" value="Search"></label>
            <div class="rit_search_result"></div>
            <form style="display: none"  role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                    <label class="screen-reader-text" for="s"><?php echo esc_html__('Search for:', 'rit-core-language');?></label>
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search Products&hellip;', 'placeholder', 'rit-core-language');?>" value="<?php echo esc_attr(get_search_query());?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', 'rit-core-language');?>" />
                    <input type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'rit-core-language');?>" />
                    <input type="hidden" name="post_type" value="product" />
                 </form><?php
        }
        //list category
        if ($atts['filter_categories'] != '') {
            $product_categories = explode(',', $atts['filter_categories']);
            echo '<ul class="rit-ajax-load rit-list-product-category">';
            foreach ($product_categories as $product_cat_slug) {
                $product_cat = get_term_by('slug', $product_cat_slug, 'product_cat');
                $selected = '';
                if (isset($atts['wc_attr']['product_cat']) && $atts['wc_attr']['product_cat'] == $product_cat->slug) {
                    $selected = 'rit-selected';
                }
                echo '<li><a class="' . esc_attr($selected) . '" 
                            data-type="product_cat" data-value="' . esc_attr($product_cat->slug) . '" 
                            href="' . esc_url(get_term_link($product_cat->slug, 'product_cat')) . '" 
                            title="' . esc_attr($product_cat->name) . '">' . esc_html($product_cat->name) . '</a></li>';

            }

            echo '</ul>';
        }
        //end of list category
        //list tags
        if ($atts['filter_tags'] != '') {
            $product_tags = explode(',', $atts['filter_tags']);
            echo '<ul class="rit-ajax-load rit-list-product-tag">';
            foreach ($product_tags as $product_tag_slug) {
                $selected = '';
                $product_tag = get_term_by('slug', $product_tag_slug, 'product_tag');
                if (isset($atts['wc_attr']['product_tag']) && $atts['wc_attr']['product_tag'] == $product_tag->slug) {
                    $selected = 'rit-selected';
                }
                echo '<li><a class="' . esc_attr($selected) . '"  
                            data-type="product_tag" 
                            data-value="' . esc_attr($product_tag->slug) . '" 
                            title="' . esc_attr($product_tag->name) . '">' . esc_html($product_tag->name) . '</a></li>';

            }

            echo '</ul>';
        }
        //end if list tag
        //list featured filter
        if ($atts['show_featured_filter']) {
            $filter_arrs = array(
                esc_html__('All', 'rit-core-language') => 'all',
                esc_html__('Featured product', 'rit-core-language') => 'featured',
                esc_html__('Onsale product', 'rit-core-language') => 'onsale',
                esc_html__('Best Selling', 'rit-core-language') => 'best-selling',
                esc_html__('Latest product', 'rit-core-language') => 'latest',
                esc_html__('Top rate product', 'rit-core-language') => 'toprate ',
                esc_html__('Sort by price: low to high', 'rit-core-language') => 'price',
                esc_html__('Sort by price: high to low', 'rit-core-language') => 'price-desc',
            );
            echo '<ul class="rit-ajax-load rit-list-filter">';
            foreach ($filter_arrs as $key => $value) {
                $selected = '';
                if (isset($atts['show']) && $atts['show'] == $value) {
                    $selected = 'rit-selected';
                }
                echo '<li><a  class="' . esc_attr($selected) . '" 
                            data-type="show" 
                            data-value="' . esc_attr($value) . '" 
                            href="" title="' . esc_attr($key) . '">' . esc_html($key) . '</a></li>';

            }
            echo '</ul>';
        }
        //end list tags
        //Filter price
        if ($atts['show_price_filter'] && intval($atts['price_filter_level']) > 0) {
            echo '<ul class="rit-ajax-load rit-price-filter">';

            $price_format = get_woocommerce_price_format();
            $price_currency = get_woocommerce_currency();

            for ($i = 1; $i <= intval($atts['price_filter_level']); $i++) {
                $min = ($i - 1) * intval($atts['price_filter_range']);
                $max = $i * intval($atts['price_filter_range']);

                $min_price = sprintf($price_format, wc_format_decimal($min, 2), $price_currency);
                $max_price = sprintf($price_format, wc_format_decimal($max, 2), $price_currency);

                $price_text = $min_price . ' - ' . $max_price;
                if ($i == intval($atts['price_filter_level'])) {
                    $price_text = $min_price . '+';
                }

                $selected = '';
                $removed = '';
                if (isset($_POST['price_filter']) && $_POST['price_filter'] == $i) {
                    $selected = 'rit-selected';
                    $removed = '<span data-type="rit-remove-price" class="rit-remove-attribute"><i class="fa fa-times"></i></span>';
                }
                echo '<li>' . $removed . '<a  class="' . esc_attr($selected) . '" 
                            data-type="price_filter" 
                            data-value="' . esc_attr($i) . '" 
                            href="" title="' . esc_attr($key) . '">' . esc_html($price_text) . '</a></li>';

            }
            echo '</ul>';
        }

        //End filter price


        //list product_attributes
        if ($atts['filter_attributes'] != '') {
            $product_attribute_taxonomies = explode(',', $atts['filter_attributes']);
            if (count($product_attribute_taxonomies) > 0) {
                foreach ($product_attribute_taxonomies as $product_attribute_taxonomie_slug) {
                    global $wpdb;
                    $attribute_taxonomies = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies where attribute_name='" . $product_attribute_taxonomie_slug . "'");
                    if (isset($attribute_taxonomies[0])) {
                        $product_attribute_taxonomie = $attribute_taxonomies[0];
                        //$product_terms = get_terms( 'pa_'.$product_attribute_taxonomie->attribute_name, 'hide_empty=0' );  
                        $product_terms = get_terms('pa_' . $product_attribute_taxonomie->attribute_name);
                        if (count($product_terms) > 0) {
                            echo '<h3>' . esc_html($product_attribute_taxonomie->attribute_label) . '</h3>';
                            echo '<ul class="rit-ajax-load rit-product-attribute-filter">';
                            foreach ($product_terms as $product_term) {

                                $selected = '';
                                $removed = '';
                                if (isset($atts['wc_attr']['tax_query']) && count($atts['wc_attr']['tax_query']) > 0) {
                                    foreach ($atts['wc_attr']['tax_query'] as $tax_query) {
                                        if ($tax_query['taxonomy'] == $product_term->taxonomy && $tax_query['terms'] == $product_term->slug) {
                                            $selected = 'rit-selected';
                                            $removed = '<span data-type="rit-remove-attr" class="rit-remove-attribute"><i class="fa fa-times"></i></span>';
                                        }
                                    }

                                }
                                echo '<li>' . $removed . '<a class="rit-product-attribute ' . esc_attr($selected) . '" 
                                            data-type="product_attribute" 
                                            data-attribute_value="' . esc_attr($product_term->slug) . '" 
                                            data-value="' . esc_attr($product_term->taxonomy) . '" 
                                            title="' . esc_attr($product_term->name) . '">' . esc_html($product_term->name) . '</a></li>';
                            }
                            echo '</ul>';
                        }
                    }
                }
            }
        }
        //end list product_attributes
        //reset filter
        echo '<div class="rit-ajax-load"><a data-type="rit-reset-filter" href="' . rit_current_url() . '">' . esc_html__('Reset Filter', 'rit-core-language') . '</a></div>';
        //end reset filter
    }
    $class = ''; ?>
    <div class="rit-wrapper-products-shortcode">
        <?php
        $rit_wrap_class = "rit-wrap-products-sc";
        if ($atts['products_type'] == 'products_list') {
            $class .= 'list';
        } else {
            $class .= 'grid';
        }
        if ($atts['products_type'] == 'products_carousel') {
            $class .= ' products-carousel';
            $rit_wrap_class .= ' ri-ione-carousel';
            $rit_pag = $atts['show_pag'] != '' ? 'true' : 'false';
            $rit_nav = $atts['show_nav'] != '' ? 'true' : 'false';
            $rit_json_config = '{"item":"' . $atts['column'] . '","wrap":"ul.products","pagination":"' . $rit_pag . '","navigation":"' . $rit_nav . '"}';
            wp_enqueue_style('slick');
            wp_enqueue_style('slick-theme');
            wp_enqueue_script('slick');
        } else {
            wp_enqueue_script('isotope');
        }
        $product_query = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $atts['wc_attr']));
        $product_query->query($atts['wc_attr']);
        remove_filter('posts_clauses', array('WC_Shortcodes', 'order_by_rating_post_clauses'));
        ?>
        <?php if (isset($atts['title']) && $atts['title'] != '') { ?>
            <h3 class="title-block-page"><span><?php echo esc_html($atts['title']) ?></span></h3>
        <?php } ?>
        <div class="<?php echo esc_attr($rit_wrap_class) ?>"
             <?php if ($atts['products_type'] == 'products_carousel'){ ?>data-config='<?php echo esc_attr($rit_json_config) ?>'<?php } ?>>
            <ul class="products <?php echo esc_attr($class) ?>">
                <?php while ($product_query->have_posts()) {
                    $product_query->the_post();
                    global $product;
                    echo rit_get_template_part('woocommerce/content', 'product', array('atts' => $atts));
                }
                ?>
            </ul>
        </div>
        <?php
        if (!isset($_POST['ajax'])):
            if ($atts['loadmore'] && $product_query->max_num_pages > $atts['wc_attr']['paged']):?>
                <a class="rit_ajax_load_more_button btn" href="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
                   title="<?php esc_attr_e('Load more', 'ri-ione') ?>"
                   data-empty="<?php esc_attr_e('No more Load', 'ri-ione') ?>"
                   data-maxpage='<?php echo esc_attr($product_query->max_num_pages); ?>'
                ><?php esc_html_e('Load more products', 'ri-ione'); ?></a>
                <?php
                wp_enqueue_script('rit-ajax-shortcode-product');
        endif; ?>
        <?php endif; ?>
    </div>
    <?php
    wp_reset_postdata();
    wp_reset_query();
    ?>
</div>