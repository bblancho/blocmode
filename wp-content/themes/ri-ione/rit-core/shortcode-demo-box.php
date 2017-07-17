<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     3.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2016 Zootemplate
 * @license     GPL v2
 */
?>
<div class="rit-demo-box <?php echo esc_attr($atts['type'] . 'style ' . $atts['el_class']) ?>"
     data-animation="<?php echo esc_attr($atts['animation_type']) ?>">
    <?php if ($atts['type'] == 'text'): ?>
        <div class="rit-header-demo-box">
            <?php if ($atts['icon'] != '' || $atts['custom_icon'] != '') { ?>
                <i class="circus-box <?php echo esc_attr($atts['icon'] != '' ? $atts['icon'] : $atts['custom_icon']) ?>"></i>
            <?php } ?>
            <?php if ($atts['title'] != '') { ?>
                <h3 class="title-demo-box">
                    <?php echo esc_html($atts['title']) ?>
                </h3>
            <?php } ?>
        </div>
        <?php if ($atts['description'] != '') { ?>
            <div class="description">
                <?php echo esc_html($atts['description']) ?>
            </div>
        <?php } ?>
    <?php else: ?>
        <div class="rit-wrap-img">

            <?php if ($atts['coming_label'] == '') {
                if ($atts['text_link'] != '') {
                    ?>
                    <div
                        class="mask primary-font <?php echo esc_attr($atts['coming_label'] != '' ? 'coming-soon' : '') ?>"
                        style="background:<?php echo esc_attr($atts['mask_color']); ?>">
                        <a href="<?php echo esc_url($atts['link']); ?>" class="btn btn-view"
                           title="<?php echo esc_attr($atts['title']) ?>">
                            <?php echo($atts['text_link'] != '' ? esc_html($atts['text_link']) : esc_html__('View Demo', 'ri-ione')); ?>
                        </a>
                    </div>
                <?php }
            } else { ?>
                <div class="mask primary-font <?php echo esc_attr($atts['coming_label'] != '' ? 'coming-soon' : '') ?>"
                     style="background:<?php echo esc_attr($atts['mask_color']); ?>">
                    <span>
                <?php
                echo esc_html__('Coming soon', 'ri-ione');
                ?>
                </span>
                </div>
                <?php
            } ?>

            <?php if ($atts['hot_label'] != '') { ?><span
                class="circus-box primary-font hot-label"><?php echo esc_html__('Hot', 'ri-ione'); ?></span>
            <?php }
            if ($atts['new_label'] != '') { ?><span
                class="circus-box primary-font new-label"><?php echo esc_html__('New', 'ri-ione'); ?></span>
            <?php } ?><a href="<?php echo esc_url($atts['link']); ?>"
                         title="<?php echo esc_attr($atts['title']) ?>"><?php echo wp_get_attachment_image($atts['image'], 'full'); ?>
            </a>
        </div>
        <?php if ($atts['title'] != '') { ?>
            <h3 class="title-demo-box">
                <a href="<?php echo esc_url($atts['link']); ?>" title="<?php echo esc_attr($atts['title']) ?>">
                    <?php echo esc_html($atts['title']) ?>
                </a>
            </h3>
        <?php } ?>
    <?php endif; ?>
</div>
