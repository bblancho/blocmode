<?php

/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */
$rit_sidebar = get_theme_mod('rit_woo_sidebar', 'sidebar-1');?>
<aside id="woo-sidebar-left" class="woo-sidebar widget-area col-xs-12 col-sm-3" role="complementary">
    <a href="javascript:;" class="close-btn close-sidebar" title="<?php esc_attr__('Close','ri-ione')?>"><i class="clever-icon-close"></i> </a>
    <div class="content-woo-sidebar">
        <?php dynamic_sidebar($rit_sidebar); ?>
    </div>
</aside><!-- .widget-area -->
