<?php
/**
 * Horizontal Gallery Layout
 * For Single Product
 * @since ri-ione 1.0.3
 */
?>
<div class="container">
    <div class="wrap-woo-breadcrumb">
        <?php
        do_action('rit_woocommerce_breadcrumb');
        get_template_part('included/templates/woocommerce/single-product', 'navigation');
        ?>
    </div>
</div>
    <?php
    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary');
    ?>
<div class="summary entry-summary wrap-right-single-product">

    <?php
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
