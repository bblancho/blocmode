<?php
$rit_wrap_class = $atts['el_class'];
$rit_content = vc_param_group_parse_atts($atts['images']);
$rit_start_link = $rit_end_link = '';
$rit_allow_tag = array(
    'a' => array(
        'href' => array(),
        'target' => array(),
        'rel' => array(),
        'title' => array()
    ),
    'br' => array()
);
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
wp_enqueue_script('slick');
?>
<div class="wrap_shortcode_images_gallery ri-ione-carousel <?php echo esc_attr($rit_wrap_class) ?>" data-config='{"item":"<?php echo esc_attr($atts['columns'])?>"}'>
    <?php foreach ($rit_content as $rit_item) { ?>
        <div class="image_gallery_item"><?php
            if (isset($rit_item['link']) && $rit_item['link'] != '') {
                $rit_link = vc_build_link($rit_item['link']);
                $rit_start_link = '<a href="' . $rit_link['url'] . '" title="' . $rit_link['title'] . '" target="' . $rit_link['target'] . '" rel="' . $rit_link['rel'] . '">';
                $rit_end_link = '</a>';
            }
            echo wp_kses($rit_start_link, $rit_allow_tag);
            echo wp_get_attachment_image($rit_item['image'], 'full');
            echo wp_kses($rit_end_link, $rit_allow_tag);
            ?>
        </div>
    <?php } ?>
</div>
