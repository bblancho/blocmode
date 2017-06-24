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
    data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
    data-empty="<?php echo esc_attr__('No Product Found','ri-ione'); ?>"
>
    <?php

    if ($atts['show_filter']) { ?>
        <div class="header-product-filter">
            <?php
            //enable search
            if (isset($atts['show_search'])) { ?>
                <label><input type="text" name="s" placeholder="Product Search"><input class="rit_search_button"
                                                                                       type="button"
                                                                                       value="Search"></label>
                <div class="rit_search_result"></div>
            <form style="display: none" role="search" method="get" class="woocommerce-product-search"
                  action="<?php echo esc_url(home_url('/')); ?>">
                <label class="screen-reader-text"
                       for="s"><?php echo esc_html__('Search for:', 'ri-ione'); ?></label>
                <input type="search" class="search-field"
                       placeholder="<?php echo esc_attr_x('Search Products&hellip;', 'placeholder', 'ri-ione'); ?>"
                       value="<?php echo esc_attr(get_search_query()); ?>" name="s"
                       title="<?php echo esc_attr_x('Search for:', 'label', 'ri-ione'); ?>"/>
                <input type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'ri-ione'); ?>"/>
                <input type="hidden" name="post_type" value="product"/>
                </form><?php
            }
            //list category
            if ($atts['filter_categories'] != '') {
                $product_categories = explode(',', $atts['filter_categories']); ?>
                <ul class="rit-ajax-load rit-list-product-category">
                <li><a data-type="rit-reset-filter" class="active"
                       href="<?php echo esc_url(rit_current_url()); ?>"><?php echo esc_html__('All', 'ri-ione') ?></a>
                </li>
                <?php foreach ($product_categories as $product_cat_slug) {
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
                ?></ul><?php
            }
            //end of list category
            //reset filter
            if ($atts['filter_tags'] != '' || $atts['show_featured_filter'] || $atts['filter_attributes'] != '' || ($atts['show_price_filter'] && intval($atts['price_filter_level']) > 0)) {
                ?>
                <a href="javascript:;" class="toogle-filter btn"
                   title="<?php echo esc_attr__('Filter', 'ri-ione') ?>"><?php echo esc_html__('Filter', 'ri-ione') ?></a>
            <?php } ?>
        </div>
        <?php
        $i = 0;
        if ($atts['filter_tags'] != '') {
            $i++;
        }
        if ($atts['show_featured_filter']) {
            $i++;
        }
        $atts['filter_attributes'] != '' ? $i++ : '';
        if ($atts['show_price_filter'] && intval($atts['price_filter_level']) > 0) {
            $i++;
        }
        if ($atts['filter_tags'] != '' || $atts['show_featured_filter'] || $atts['filter_attributes'] != '' || ($atts['show_price_filter'] && intval($atts['price_filter_level']) > 0)) { ?>
            <div class="content-product-filter ">
                <div class="wrap-content-product-filter <?php echo esc_attr('layout-' . $i . '-columns'); ?>">
                    <div class="rit-ajax-load"><a data-type="rit-reset-filter"
                                                  href="<?php echo esc_url(rit_current_url()); ?>"><?php echo esc_html__('Reset Filter', 'ri-ione') ?></a>
                    </div>
                    <?php
                    //end reset filter
                    //list featured filter
                    if ($atts['show_featured_filter']) {
                        $filter_arrs = array(
                            esc_html__('All', 'ri-ione') => 'all',
                            esc_html__('Featured product', 'ri-ione') => 'featured',
                            esc_html__('Onsale product', 'ri-ione') => 'onsale',
                            esc_html__('Best Selling', 'ri-ione') => 'best-selling',
                            esc_html__('Latest product', 'ri-ione') => 'latest',
                            esc_html__('Top rate product', 'ri-ione') => 'toprate ',
                            esc_html__('Sort by price: low to high', 'ri-ione') => 'price',
                            esc_html__('Sort by price: high to low', 'ri-ione') => 'price-desc',
                        );
                        ?>
                        <div class="filter-block">
                            <h5 class="title-filter-block">
                                <?php echo esc_html__('Asset type', 'ri-ione') ?>
                            </h5>
                            <ul class="rit-ajax-load rit-list-filter">
                                <?php
                                foreach ($filter_arrs as $key => $value) {
                                    $selected = '';
                                    if (isset($atts['show']) && $atts['show'] == $value) {
                                        $selected = 'rit-selected';
                                    } ?>
                                    <li><a class="<?php echo esc_attr($selected) ?>"
                                           data-type="show"
                                           data-value="<?php echo esc_attr($value) ?>"
                                           href="" title="<?php echo esc_attr($key) ?>"><?php echo esc_attr($key) ?></a>
                                    </li><?php

                                }
                                ?></ul>
                        </div>
                        <?php
                    }
                    //end list tags
                    //Filter price
                    if ($atts['show_price_filter'] && intval($atts['price_filter_level']) > 0) { ?>
                        <div class="filter-block">
                            <h5 class="title-filter-block">
                                <?php echo esc_html__('Price', 'ri-ione') ?>
                            </h5>
                            <ul class="rit-ajax-load rit-price-filter">
                                <?php
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
                                    ?>
                                    <li><?php echo ent2ncr($removed) ?><a class="<?php echo esc_html($selected) ?>"
                                                                          data-type="price_filter"
                                                                          data-value="<?php echo esc_html($i) ?>"
                                                                          href=""
                                                                          title="<?php echo esc_html($key) ?>"><?php echo esc_html($price_text) ?></a>
                                    </li>
                                    <?php
                                } ?>
                            </ul>
                        </div>
                        <?php
                    }

                    //End filter price


                    //list product_attributes
                    if ($atts['filter_attributes'] != '') { ?>

                        <?php
                        $product_attribute_taxonomies = explode(',', $atts['filter_attributes']);
                        if (count($product_attribute_taxonomies) > 0) {
                            foreach ($product_attribute_taxonomies as $product_attribute_taxonomie_slug) {

                                global $wpdb;

                                $attribute_taxonomies = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies where attribute_name='" . $product_attribute_taxonomie_slug . "'");

                                if (isset($attribute_taxonomies[0])) {
                                    $product_attribute_taxonomie = $attribute_taxonomies[0];
                                    //$product_terms = get_terms( 'pa_'.$product_attribute_taxonomie->attribute_name, 'hide_empty=0' );
                                    $product_terms = get_terms('pa_' . $product_attribute_taxonomie->attribute_name);
                                    if (count($product_terms) > 0) { ?>
                                        <div class="filter-block">
                                            <h5 class="title-filter-block"><?php echo esc_html($product_attribute_taxonomie->attribute_label) ?></h5>
                                            <ul class="rit-ajax-load rit-product-attribute-filter">
                                                <?php foreach ($product_terms as $product_term) {

                                                    $selected = '';
                                                    $removed = '';
                                                    if (isset($atts['wc_attr']['tax_query']) && count($atts['wc_attr']['tax_query']) > 0) {
                                                        foreach ($atts['wc_attr']['tax_query'] as $tax_query) {
                                                            if ($tax_query['taxonomy'] == $product_term->taxonomy && $tax_query['terms'] == $product_term->slug) {
                                                                $selected = 'rit-selected';
                                                                $removed = '<span data-type="rit-remove-attr" class="rit-remove-attribute"><i class="fa fa-times"></i></span>';
                                                            }
                                                        }

                                                    } ?>
                                                    <li><?php echo ent2ncr($removed) ?><a
                                                    class="rit-product-attribute <?php echo esc_attr($selected) ?>"
                                                    data-type="product_attribute"
                                                    data-attribute_value="<?php echo esc_attr($product_term->slug); ?>"
                                                    data-value="<?php echo esc_attr($product_term->taxonomy); ?>"
                                                    title="<?php echo esc_attr($product_term->name); ?>"><?php echo esc_html($product_term->name); ?></a>
                                                    </li><?php
                                                } ?></ul>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        } ?>
                        <?php
                    }
                    //end list product_attributes
                    //list tags
                    if ($atts['filter_tags'] != '') {
                        $product_tags = explode(',', $atts['filter_tags']);
                        ?>
                        <div class="filter-block">
                            <h5 class="title-filter-block">
                                <?php echo esc_html__('Tags', 'ri-ione') ?>
                            </h5>
                            <ul class="rit-ajax-load rit-list-product-tag">
                                <?php foreach ($product_tags as $product_tag_slug) {
                                    $selected = '';
                                    $product_tag = get_term_by('slug', $product_tag_slug, 'product_tag');
                                    if (isset($atts['wc_attr']['product_tag']) && $atts['wc_attr']['product_tag'] == $product_tag->slug) {
                                        $selected = 'rit-selected';
                                    } ?>
                                    <li><a class="<?php echo esc_attr($selected) ?>"
                                           data-type="product_tag"
                                           data-value="<?php echo esc_attr($product_tag->slug) ?>"
                                           title="<?php echo esc_attr($product_tag->name) ?> "><?php echo esc_html($product_tag->name) ?></a>
                                    </li><?php
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                    //end if list tag
                    ?>
                </div>
            </div>
        <?php }
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
            endif;
            ?>
            <?php
        endif;
        if ($atts['show_filter']||$atts['loadmore']) {
            wp_enqueue_script('rit-ajax-shortcode-product');
        }
        ?>
    </div>
    <?php
    wp_enqueue_style('slick');
    wp_enqueue_style('slick-theme');
    wp_enqueue_script('slick');
    wp_reset_postdata();
    wp_reset_query();
    ?>
</div>