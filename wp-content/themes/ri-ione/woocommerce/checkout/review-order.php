<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<ul class="shop_table woocommerce-checkout-review-order-table">

<li class="header-col">
			<div class="product-name label-row"><?php _e( 'Product', 'woocommerce' ); ?></div>
			<div class="product-total  content-row"><?php _e( 'Total', 'woocommerce' ); ?></div>
</li>

		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					<li class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<div class="product-name label-row">
							<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
							<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
							<?php echo WC()->cart->get_item_data( $cart_item ); ?>
						</div>
						<div class="product-total content-row">
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</div>
					</li>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>

		<li class="cart-subtotal">
			<div class="label-row"><?php _e( 'Subtotal', 'woocommerce' ); ?></div>
			<div class="content-row"><?php wc_cart_totals_subtotal_html(); ?></div>
		</li>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<li class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<div class="label-row"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
				<div class="content-row"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
			</li>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<li class="fee">
				<div class="label-row"><?php echo esc_html( $fee->name ); ?></div>
				<div class="content-row"><?php wc_cart_totals_fee_html( $fee ); ?></div>
			</li>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<li class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<div class="label-row"><?php echo esc_html( $tax->label ); ?></div>
						<div class="content-row"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
					</li>
				<?php endforeach; ?>
			<?php else : ?>
				<li class="tax-total">
					<div class="label-row"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
					<div class="content-row"><?php wc_cart_totals_taxes_total_html(); ?></div>
				</li>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<li class="order-total">
			<div class="label-row"><?php _e( 'Total', 'woocommerce' ); ?></div>
			<div class="content-row"><?php wc_cart_totals_order_total_html(); ?></div>
		</li>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
</ul>
