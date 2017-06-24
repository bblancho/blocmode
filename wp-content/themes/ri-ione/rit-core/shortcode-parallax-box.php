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
$rit_img_id=$atts['img_bg'];
$rit_img=wp_get_attachment_image_src($rit_img_id,'full');
if($rit_img) {
    ?>
    <div id="rit-parallax-<?php echo esc_attr(rit_random_ID()); ?>" class="rit-parallax-box <?php echo esc_attr($atts['layout'].($atts['add_nav']==1?' in-nav':'')); ?>" <?php if($atts['add_nav']==1){?> data-title="<?php echo esc_attr($atts['title_nav'])?>"<?php }?> data-parallax="scroll" data-image-src="<?php echo esc_url($rit_img[0])?>"
         data-speed="<?php echo esc_attr($atts['speed']) ?>">
<?php echo  do_shortcode( $content );?>
    </div>
    <?php
    wp_enqueue_script('parallax');
}