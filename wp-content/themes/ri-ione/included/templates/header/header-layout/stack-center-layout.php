<?php
/**
 * Menu stack center layout.
 * Template of Ri Ione
 * Ver: 1.0
 */
$rit_sticky = rit_header_stick();
?>
<div class="wrap-header-block">
    <a id="menu-mobile-trigger" href="javascript:;"
       class="visible-sm visible-xs mobile-menu-icon canvas-icon">
            <span class="wrap-bar">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </span>
        <i class="clever-icon-close"></i>
    </a>
    <div id="site-branding">
        <div class="container">
            <?php get_template_part('included/templates/logo'); ?>
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
            <?php get_template_part('included/templates/right', 'header'); ?>
        </div>
    </div>
</div>