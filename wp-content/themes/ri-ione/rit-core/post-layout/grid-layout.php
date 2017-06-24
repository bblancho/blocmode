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
$class = 'rit-blog-item layout-item ';
switch ($atts['columns']) {
    case '2':
        $class .= "col-xs-12 col-sm-6";
        break;
    case '3':
        $class .= "col-xs-12 col-sm-4";
        break;
    case '4':
        $class .= "col-xs-12 col-sm-3";
        break;
    case '5':
        $class .= "col-xs-12 col-sm-1-5";
        break;
    case '6':
        $class .= "col-xs-12 col-sm-2";
        break;
    default:
        $class .= "col-xs-12 col-sm-12";
        break;
}
?>
<article <?php echo post_class($class) ?>  <?php if ($atts['animation_type'] != '') { ?> data-animation="<?php echo esc_attr($atts['animation_type']) ?>"<?php } ?>>

    <?php echo rit_get_template_part('post-layout/media', 'block', array('atts' => $atts));?>
    <div class="rit-post-inner">
        <?php if($atts['layout']!='grid-no-thumb'){?>  <div class="header-post"><?php } ?>
            <?php if ($atts['post_info']) { ?>
                <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
            <?php }
            the_title(sprintf('<h3 class="entry-title title-post"><a href="%s" rel="' . esc_html__('bookmark', 'ri-ione') . '">', esc_url(get_permalink())), '</a></h3>'); ?>
            <?php if($atts['layout']!='grid-no-thumb'){?>  </div><?php } ?>
        <?php
        if ($atts['output_type'] != 'no') {
            ?>
            <div class="entry-content">
                <?php
                if ($atts['output_type'] == 'excerpt') {
                    echo rit_excerpt($atts['excerpt_length']);
                } else {
                    the_content();
                }
                ?>
            </div>
            <?php
        }
        if ($atts['view_more'] == 'yes') {
            ?>
            <p class="readmore">
                <a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_html__('Read more', 'ri-ione'); ?></a>
            </p>
        <?php } ?>
    </div>
</article>