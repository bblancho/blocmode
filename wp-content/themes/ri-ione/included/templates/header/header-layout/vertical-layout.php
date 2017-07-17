<?php
/**
 * Menu center layout.
 * Template of Ri Ione
 * Ver: 1.0
 */
?>
<div class="wrap-header-block">
    <div class="content-header-block">
        <a id="menu-mobile-trigger" href="javascript:;"
           class="visible-sm visible-xs mobile-menu-icon canvas-icon">
            <span class="wrap-bar">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </span>
            <i class="clever-icon-close"></i>
        </a>
        <div class="main-header-sidebar">
            <div id="site-branding">
                <?php get_template_part('included/templates/logo'); ?>
            </div>
            <div id="main-navigation" class="primary-nav">
                <?php
                wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'primary'));
                ?>
            </div>
            <div class="bottom-main-header">
                <?php dynamic_sidebar('header-vertical'); ?>
            </div>
        </div>
        <div class="top-main-header-bar">
            <?php get_template_part('included/templates/right', 'header'); ?>
        </div>
    </div>
</div>