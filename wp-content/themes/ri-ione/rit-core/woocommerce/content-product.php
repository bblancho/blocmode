<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php post_class('product'); ?> data-width="<?php echo esc_attr($atts['col_width']) ?>">
    <div class="wrap-product-thumb">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action('woocommerce_before_shop_loop_item');
        if ($atts['products_type'] != 'products_carousel') {
            do_action('rit_woocommerce_show_product_loop_sale_flash');
            $rit_img = get_post_thumbnail_id(get_the_ID());
            $rit_attachments = get_attached_file($rit_img);
            if (has_post_thumbnail() && $rit_attachments) :
                $rit_item = wp_get_attachment_image_src($rit_img, $atts['products_img_size']);
                $rit_img_url = $rit_item[0];
                $rit_width = $rit_item[1];
                $rit_height = $rit_item[2];
                $resolution = $rit_width / $rit_height;
                $rit_img_title = get_the_title($rit_img);
                ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
                   data-resolution="<?php echo esc_attr($resolution) ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/placeholder.gif"
                         height="<?php echo esc_attr($rit_height) ?>" width="<?php echo esc_attr($rit_width) ?>"
                         class="lazy-img" data-original="<?php echo esc_attr($rit_img_url) ?>"
                         alt="<?php echo esc_attr($rit_img_title); ?>"/>
                </a>
                <?php
            endif;
        }
        else{
            do_action('rit_woocommerce_show_product_loop_sale_flash');
            $rit_img = get_post_thumbnail_id(get_the_ID());
            $rit_attachments = get_attached_file($rit_img);
            if (has_post_thumbnail() && $rit_attachments) :
                ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php echo wp_get_attachment_image($rit_img, $atts['products_img_size']);?>
                </a>
                <?php
            endif;
        }
        if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
        }
        if(rit_woo_enable_stocklabel()) {
            if (!$product->is_in_stock()) {
                ?>
                <span class="out-stock-label stock-label"><?php esc_html_e('Out of Stock', 'ri-ione'); ?></span>
                <?php
            } else {
                if (get_option('woocommerce_notify_low_stock_amount') > $product->get_stock_quantity() && $product->get_stock_quantity()) {
                    ?>
                    <span class="low-stock-label stock-label"><?php esc_html_e('Low Stock', 'ri-ione'); ?></span>
                    <?php
                }
            }
        }
        if(rit_woo_enable_quickview()){
            ?>
            <a data-product_id="<?php echo esc_attr(get_the_ID()); ?>" class="btn quick-view"
               href="javascript:;">
                <?php echo esc_html__('Quick View', 'ri-ione'); ?>
            </a>
        <?php }?>
    </div>
    <div class="wrap-product-text">
        <h3 class="product-name"><a href="<?php the_permalink(); ?>"
                                    title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
        <?php
        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action('woocommerce_after_shop_loop_item_title');
        ?>
        <div class="product-description">
            <?php echo apply_filters('woocommerce_short_description', get_the_excerpt()) ?>
        </div>
        <?php
        if (get_theme_mod('rit_woo_hide_cart', '0') != '1') {
            /**
             * woocommerce_after_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action('woocommerce_after_shop_loop_item');
        }
        ?>
    </div>
</li>
