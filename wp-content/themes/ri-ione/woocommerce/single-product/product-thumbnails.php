<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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
 * @version     3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids ) {
	?>
	<div class="wrap-thumbs-gal"><?php
		if (has_post_thumbnail()) {
			$attachment_count = count($product->get_gallery_image_ids());
			$props = wc_get_product_attachment_props(get_post_thumbnail_id(), $post);
			$image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_thumbnail'), array(
				'title' => $props['title'],
				'alt' => $props['alt'],
			));
			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="javascript:;" class="product-thumb-gal" title="%s">%s</a>',
					esc_attr($props['caption']),
					$image
				),
				$post->ID
			);
		} else {
			echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), __('Placeholder', 'woocommerce')), $post->ID);
		}
		foreach ( $attachment_ids as $attachment_id ) {
            $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
            $thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
            $image_title     = get_post_field( 'post_excerpt', $attachment_id );

            $attributes = array(
                'title'                   => $image_title,
                'data-src'                => $full_size_image[0],
                'data-large_image'        => $full_size_image[0],
                'data-large_image_width'  => $full_size_image[1],
                'data-large_image_height' => $full_size_image[2],
            );

            $html  = '<a href="javascript:;" class="product-thumb-gal">';
            $html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
            $html .= '</a>';
            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
		}

	?></div>
	<?php
}
