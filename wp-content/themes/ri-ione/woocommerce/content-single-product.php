<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}
$rit_class=rit_woo_layout_single();
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
if(rit_woo_enable_zoom()){
    wp_enqueue_style('zoomove');
    wp_enqueue_script('zoomove');
    $rit_class.=' '.'rit-product-zoom';
}
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="wrap-top-single-product <?php echo esc_attr($rit_class);?>">
<?php get_template_part('woocommerce/single-product/layout/'.rit_woo_layout_single(),'layout');?>
    </div>
    <?php
    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
</div>

<?php
wp_enqueue_script('slick');
do_action('woocommerce_after_single_product'); ?>
