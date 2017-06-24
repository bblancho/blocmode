<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) :
$posts_per_page=get_theme_mod('rit_woo_related_display','4');
$woocommerce_loop['name']    = 'related';
$rit_class='';
$rit_json_config='';
if(get_theme_mod('rit_enable_slider_related_product','')==1){
	$rit_class='ri-ione-carousel products-carousel';
	$rit_json_config='{"item":"'.get_theme_mod('rit_woo_col_related','4').'","wrap":"ul.products","navigation":"true"}';
}
    ?>

	<div class="related <?php echo esc_attr($rit_class)?>" <?php if($rit_class!='')
	{?>data-config='<?php echo esc_attr($rit_json_config)?>'<?php }
	?>>
		<h3 class="title-block"><span><?php _e( 'Related Products', 'woocommerce' ); ?></span></h3>
		<div class="container">
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product-related' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
