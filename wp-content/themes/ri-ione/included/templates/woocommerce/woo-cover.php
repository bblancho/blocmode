<?php
/**
 * Template display cover image of Woocommerce Page
 * @since: ri-ione 1.0.0
 * @Ver: 1.0.0
 */
if (is_shop()) {
    if (get_theme_mod('rit_woo_slider_cover', '') != '') {
        ?>
        <div id="woo-cover-page">
            <?php echo do_shortcode(get_theme_mod('rit_woo_slider_cover')) ?>
        </div>
        <?php
    }
}
else{
    $text=$image='';
    if (is_product_category()) {
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $text = '<h3 class="cover-title">' . $cat->name . '</h3><div class="description">' . $cat->description . '</div>';
        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        if($image !=''){?>
            <div id="woo-cover-page" class="category-page">
                <?php
                if($image !=''){
                    echo '<img src="'.esc_url($image).'" alt="'.esc_attr($cat->name).'"/>';
                }
                if($text!=''){
                    echo '<div class="content-cat-thumb">'. $text.'</div>';
                }
                ?>
            </div>
            <?php
        }
    }
}
?>