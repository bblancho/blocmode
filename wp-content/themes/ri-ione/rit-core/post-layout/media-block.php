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
$imgsize=$atts['blog_img_size'];
if (has_post_format('gallery')) : ?>
    <?php $images = get_post_meta(get_the_ID(), '_format_gallery_images', true); ?>
    <?php if ($images) :
        wp_register_style('slick');
        wp_register_style('slick-theme');
        wp_enqueue_script('slick');
        ?>
        <div class="post-image  wrap-media">
            <ul class="post-slider">
                <?php foreach ($images as $image) : ?>
                    <?php $the_image = wp_get_attachment_image_src($image, $imgsize); ?>
                    <?php $the_caption = get_post_field('post_excerpt', $image); ?>
                    <li><img src="<?php echo esc_url($the_image[0]); ?>"
                             <?php if ($the_caption) : ?>title="<?php esc_attr($the_caption); ?>"<?php endif; ?> />
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
<?php elseif (has_post_format('video')) : ?>
    <div class="post-image wrap-media">
        <?php $sp_video = get_post_meta(get_the_ID(), '_format_video_embed', true); ?>
        <?php if (wp_oembed_get($sp_video)) : ?>
            <?php echo wp_oembed_get($sp_video); ?>
        <?php else : ?>
            <?php echo ent2ncr($sp_video); ?>
        <?php endif; ?>
    </div>
<?php elseif (has_post_format('audio')) : ?>
    <div class="post-image audio wrap-media">
        <?php $sp_audio = get_post_meta(get_the_ID(), '_format_audio_embed', true); ?>
        <?php if (wp_oembed_get($sp_audio)) : ?>
            <?php echo wp_oembed_get($sp_audio); ?>
        <?php else : ?>
            <?php echo ent2ncr($sp_audio); ?>
        <?php endif; ?>
    </div>
<?php else :
    $rit_img = get_post_thumbnail_id(get_the_ID());
    $rit_attachments = get_attached_file($rit_img);
    if (has_post_thumbnail() && $rit_attachments) :
        $rit_item = wp_get_attachment_image_src($rit_img, $imgsize);
        $rit_img_url = $rit_item[0];
        $rit_width = $rit_item[1];
        $rit_height = $rit_item[2];
        $rit_img_title = get_the_title($rit_img);
        ?>
        <div class="post-image  wrap-media">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/placeholder.gif"
                     height="<?php echo esc_attr($rit_height) ?>" width="<?php echo esc_attr($rit_width) ?>"
                     class="lazy-img" data-original="<?php echo esc_attr($rit_img_url) ?>"
                     alt="<?php echo esc_attr($rit_img_title); ?>"/>
            </a>
        </div>
        <?php
    endif;
endif;