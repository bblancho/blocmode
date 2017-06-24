<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="wrap-price">

	<p class="price">
		<?php
		if(rit_woo_layout_single()=='carousel'||rit_woo_layout_single()=='sticky')
			do_action('rit_woocommerce_show_product_sale_flash');
		echo $product->get_price_html(); ?></p>
</div>
<?php
if(rit_woo_layout_single()=='carousel'||rit_woo_layout_single()=='sticky')
	get_template_part('/woocommerce/single-product/sale-count','down');