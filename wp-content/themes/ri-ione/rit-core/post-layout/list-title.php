<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.0.3
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */
$class = 'rit-blog-item layout-item list-title-item';
?>
<article <?php echo post_class($class) ?>  <?php if ($atts['animation_type'] != '') { ?> data-animation="<?php echo esc_attr($atts['animation_type']) ?>"<?php } ?>>
    <div class="left-post">
        <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>">
            <span class="label-date"><?php echo esc_html(get_the_date('d')); ?></span>
            <span class="label-m"><?php echo esc_html(get_the_date('F')); ?></span>
            <?php
            the_post_thumbnail($atts['blog_img_size']); ?>
        </a>
    </div>
    <div class="rit-post-inner">
        <?php
        the_title(sprintf('<h3 class="entry-title title-post"><a href="%" title="%" rel="' . esc_html__('bookmark', 'ri-ione') . '">', esc_url(get_permalink()),get_the_title()), '</a></h3>'); ?>
    </div>
</article>