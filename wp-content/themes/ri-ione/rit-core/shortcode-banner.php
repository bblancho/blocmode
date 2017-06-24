<?php
$rit_wrap_class = $atts['el_class'];
$rit_content = vc_param_group_parse_atts($atts['list_content']);
$rit_start_link = $rit_end_link = '';
$rit_allow_tag = array(
    'a' => array(
        'href' => array(),
        'target' => array(),
        'rel' => array(),
        'title' => array()
    ),
    'br'=>array()
);
if (isset($atts['link']) && $atts['link'] != '') {
    $rit_link = vc_build_link($atts['link']);
    $rit_start_link = '<a href="' . $rit_link['url'] . '" title="' . $rit_link['title'] . '" target="' . $rit_link['target'] . '" rel="' . $rit_link['rel'] . '">';
    $rit_end_link = '</a>';
}
wp_enqueue_style('animations');
?>
<div class="wrap_shortcode_banner <?php echo esc_attr($rit_wrap_class) ?>">
    <div class="row">
        <div class="wrap-content-shortcode-banner">
        <?php
        if ($atts['image'] != '') {
            ?>
            <div
                class="col-xs-12 col-sm-6 <?php echo esc_attr($atts['img_align'] == 'left' ? 'pull-left' : 'pull-right') ?>">
                <?php
                echo wp_kses($rit_start_link, $rit_allow_tag);
                echo wp_get_attachment_image($atts['image'], 'full', "", array("data-animation" => $atts['img_anm']));
                echo wp_kses($rit_end_link, $rit_allow_tag);
                ?>
            </div>
            <?php
        }
        ?>
        <div class="col-xs-12 col-sm-6 wrap-content <?php echo esc_attr($atts['cnt_align'])?>">
            <?php foreach ($rit_content as $rit_item) {
                if ($rit_item['style'] == 'heading') {
                    ?>
                    <h5 class="heading" data-animation="<?php echo esc_attr($rit_item['text_anm']) ?>">
                        <?php echo esc_html($rit_item['text_val']); ?>
                    </h5>
                    <?php
                } elseif ($rit_item['style'] == 'content') {
                    ?>
                    <div class="content" data-animation="<?php echo esc_attr($rit_item['text_anm']) ?>">
                        <?php echo ent2ncr($rit_item['text_val']); ?>
                    </div>
                    <?php
                } else {
                    if (isset($atts['link']) && $atts['link'] != '') {
                        $rit_link = vc_build_link($atts['link']); ?>
                    <a href="<?php echo esc_url($rit_link['url']) ?>"
                       data-animation="<?php echo esc_attr($rit_item['text_anm']) ?>"
                       class="btn <?php echo esc_attr($rit_item['btn-style']) ?>"
                       title="<?php echo esc_attr($rit_link['title']) ?>"
                       target="<?php echo esc_attr($rit_link['target']) ?>"
                       rel="<?php echo esc_attr($rit_link['rel']) ?>">
                        <?php echo esc_html($rit_item['text_val']); ?>
                        </a><?php
                    } else {
                        ?>
                        <a href="#" class="btn <?php echo esc_attr($rit_item['btn-style']) ?>"
                           data-animation="<?php echo esc_attr($rit_item['text_anm']) ?>">
                            <?php echo esc_html($rit_item['text_val']); ?>
                        </a>
                        <?php
                    }
                }
                ?>

            <?php } ?>
        </div>
        </div>
    </div>
</div>
