<?php
/**
 * The template for displaying product content related within loops
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
<li <?php post_class(); ?> data-width="<?php echo esc_attr(get_theme_mod('rit_woo_col_related_min_width', '250')) ?>">
    <div class="wrap-product-thumb">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action('woocommerce_before_shop_loop_item');
        /**
         * woocommerce_before_shop_loop_item_title hook
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action('woocommerce_before_shop_loop_item_title');
        if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
        }
        if(rit_woo_enable_stocklabel()) {
            if (!$product->is_in_stock()) {
                ?>
                <span class="out-stock-label stock-label"><?php esc_html_e('Out of Stock', 'ri-ione'); ?></span>
                <?php
            } else {
                if (get_option('woocommerce_notify_low_stock_amount') > $product->get_stock_quantity()) {
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
