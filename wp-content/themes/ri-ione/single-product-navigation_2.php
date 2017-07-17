<?php
/**
 * Template single product navigation
 * Display Next/Previous Products
 * @since: ri-ione 1.0.0
 * @ver: 1.0.0
 */
$prev_product = get_previous_post(true, '', 'product_cat');
$next_product = get_next_post(true, '', 'product_cat');?>
<ul class="single-product-navigation">
<?php
if (!empty($prev_product)) :
    $prev_product_link = get_permalink($prev_product->ID);
    $prev_product_title = $prev_product->post_title;
    $_product = wc_get_product($prev_product->ID);
    ?>
    <li class="prev-product">
        <a href="<?php echo esc_url($prev_product_link); ?>" class="product-link-btn"
           title="<?php echo esc_attr($prev_product_title); ?>"><i
                class="clever-icon-line-triangle2"></i><span class="product-title"><?php echo esc_html($prev_product_title); ?></span></a>
        <div class="product-item">
            <?php if (get_the_post_thumbnail($prev_product->ID, 'thumbnail') != '') { ?>
                <a class="product-img" href="<?php echo esc_url($prev_product_link); ?>"
                   title="<?php echo esc_attr($prev_product_title); ?>">
                    <?php echo get_the_post_thumbnail($prev_product->ID, 'thumbnail'); ?>
                </a>
            <?php } ?>
            <div class="product-item-info">
                <h3 class="product-title">
                    <a href="<?php echo esc_url($prev_product_link); ?>"
                       title="<?php echo esc_attr($prev_product_title); ?>">
                        <?php echo esc_html($prev_product_title); ?>
                    </a>
                </h3>
                <?php if ($price_html = $_product->get_price_html()) : ?>
                    <p class="price"><?php echo $price_html; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </li>
<?php endif; ?>

<?php if (!empty($next_product)) :
    $next_product_link = get_permalink($next_product->ID);
    $next_product_title = $next_product->post_title;
    $_product = wc_get_product($next_product->ID);
    ?>
    <li class="next-product">
        <a class="product-link-btn" href="<?php echo esc_url($next_product_link); ?>"
           title="<?php echo esc_attr($next_product_title); ?>"><span class="product-title"><?php echo esc_html($next_product_title); ?></span><i class="clever-icon-line-triangle"></i></a>
        <div class="product-item">
            <?php if (get_the_post_thumbnail($next_product->ID, 'thumbnail') != '') { ?>
                <a class="product-img" href="<?php echo esc_url($next_product_link); ?>"
                   title="<?php echo esc_attr($next_product_title); ?>">
                    <?php echo get_the_post_thumbnail($next_product->ID, 'thumbnail'); ?>

                </a>
            <?php echo "voici mon produitss" ; } ?>
            <div class="product-item-info">
                <h3 class="product-title">
                    <a href="<?php echo esc_url($next_product_link); ?>"
                       title="<?php echo esc_attr($next_product_title); ?>">
                        <?php echo esc_html($next_product_title); ?>
                    </a>
                </h3>
                <?php if ($price_html = $_product->get_price_html()) : ?>
                    <p class="price"><?php echo $price_html; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </li>
<?php endif;
?></ul>
