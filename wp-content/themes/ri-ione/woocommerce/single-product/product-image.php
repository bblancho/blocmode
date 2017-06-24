<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.0.2
 */

if (!defined('ABSPATH')) {
    exit;
}

global $post, $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = get_post_thumbnail_id($post->ID);
$full_size_image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$placeholder = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--' . $placeholder,
    'woocommerce-product-gallery--columns-' . absint($columns),
    'images',
));
?>
<div class="wrap-single-image">
    <?php
    if (rit_woo_layout_single() == 'horizontal-gallery' || rit_woo_layout_single() == 'vertical-gallery') {
        do_action('rit_woocommerce_show_product_sale_flash');
        get_template_part('/woocommerce/single-product/sale-count', 'down');
    }
    ?>
    <ul class="wrap-single-carousel woocommerce-product-gallery__wrapper">
        <?php
        $attributes = array(
            'title' => $image_title,
            'data-src' => $full_size_image[0],
            'data-large_image' => $full_size_image[0],
            'data-large_image_width' => $full_size_image[1],
            'data-large_image_height' => $full_size_image[2],
        );

        if (has_post_thumbnail()) {
            $html = '<li class="woocommerce-product-gallery__image"><a href="' . esc_url($full_size_image[0]) . '"  class="woocommerce-main-image zoom" data-zoo-image="' . esc_attr($full_size_image[0]) . '">';
            $html .= get_the_post_thumbnail($post->ID, 'shop_single', $attributes);
            $html .= '</a></li>';
        } else {
            $html = sprintf('<li class="woocommerce-product-gallery__image--placeholder"><img src="%s" alt="%s" class="woocommerce-main-image" /></li>', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'woocommerce'));
        }

        echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id($post->ID));
        $attachment_ids = $product->get_gallery_image_ids();

        if ($attachment_ids) {
            foreach ($attachment_ids as $attachment_id) {
                $full_size_image = wp_get_attachment_image_src($attachment_id, 'full');
                $thumbnail = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
                $thumbnail_post = get_post($attachment_id);
                $image_title = $thumbnail_post->post_content;

                $attributes = array(
                    'title' => $image_title,
                    'data-src' => $full_size_image[0],
                    'data-large_image' => $full_size_image[0],
                    'data-large_image_width' => $full_size_image[1],
                    'data-large_image_height' => $full_size_image[2],
                );
                $html = '<li class="woocommerce-product-gallery__image"><a href="'.$full_size_image[0].'" data-zoo-image="'.$full_size_image[0].'" class="woocommerce-main-image zoom" title="'.$image_title.'">';
                $html .= wp_get_attachment_image($attachment_id, 'shop_single', false, $attributes);
                $html .= '</a></li>';
                echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $attachment_id);
            }
        }
        ?>
    </ul>
</div>