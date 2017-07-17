<?php
/**
 * Menu stack center 2 layout.
 * Template of Ri Ione
 * Ver: 1.0.5
 */
$rit_sticky = rit_header_stick();
?>
<div class="wrap-header-block">

    <div id="site-branding">
        <div class="container">
            <a id="menu-mobile-trigger" href="javascript:;"
               class="visible-sm visible-xs mobile-menu-icon canvas-icon">
            <span class="wrap-bar">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </span>
                <i class="clever-icon-close"></i>
            </a>
            <div class="wrap-logo">
                <?php get_template_part('included/templates/logo'); ?>
            </div>
            <?php get_template_part('included/templates/right', 'header'); ?>
        </div>
    </div>
    <div id="bottom-header" class=" <?php echo esc_attr($rit_sticky) ?>">
        <div class="container">
            <?php get_template_part('included/templates/sticky-logo'); ?>
            <div id="main-navigation" class="primary-nav">
                <?php
                wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'primary'));
                ?>
            </div>
            <?php if(!rit_woo_catalog_mod()){?>
            <div class="wrap-icon-cart sticky-cart">
                <a class="top-cart-icon" href="<?php echo WC()->cart->get_cart_url(); ?>"
                   title="<?php echo esc_html__('View your shopping cart', 'ri-ione') ?>"><i
                        class=" clever-icon-cart-6"></i></a>
                <span class="top-cart-total">
                    <?php echo esc_html(WC()->cart->get_cart_contents_count()) ?>
                </span>
            </div>
            <?php }?>
        </div>
    </div>
</div>