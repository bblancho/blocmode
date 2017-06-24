<?php
/*
 *
 */
?>
<div class="rit-quickview-mask"></div>
<div id="rit-quickview-lb" class="animated fadeIn woocommerce">
    <div class="wrap-top-single-product product">
        <a href="javascript:;" class="close-btn close-quickview" title="<?php esc_attr__('Close','ri-ione')?>"><i class="clever-icon-close"></i> </a>
        <div class="wrap-left-single-product">
            <?php
            /**
             * woocommerce_before_single_product_summary hook.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action('woocommerce_before_single_product_summary');
            ?>
        </div>
        <div class="summary entry-summary wrap-right-single-product">
            <?php
            rit_woo_catalog_mod();
            /**
             * woocommerce_single_product_summary hook.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             */
            do_action('woocommerce_single_product_summary');
            ?>
        </div><!-- .summary -->
    </div>
</div>