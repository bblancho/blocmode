<?php
$rit_layout = $atts['layout'];

$rit_width = $atts['col_width'];
$class_item = '';
if ($rit_layout == 'grid') {
    switch ($atts['columns']) {
        case'1':
            $class_item = 'col-xs-12';
            break;
        case'2':
            $class_item = 'col-xs-12 col-sm-6';
            break;
        case'3':
            $class_item = 'col-xs-12 col-sm-4';
            break;
        case'4':
            $class_item = 'col-xs-12 col-sm-3';
            break;
        case'6':
            $class_item = 'col-xs-12 col-sm-2';
            break;
    }

}
if($rit_layout=='metro'){
    wp_enqueue_script('isotope');
    wp_enqueue_script('rit-banner-metro');
}
$wrap_class = $rit_layout . ' ' . $atts['style'].' '.$atts['el_class'];
$rit_content = vc_param_group_parse_atts($atts['list_content']);
?>
<?php if($rit_layout=='metro'&&$atts['gutter']!=0){?><div style="margin:0 -<?php echo esc_attr($atts['gutter']/2 + 1)?>px" ><?php }?>
<div class="wrap_shortcode_pc_banner <?php echo esc_attr($wrap_class) ?>"<?php if($rit_layout=='metro'){?>data-width="<?php echo $atts['col_width'];?>"<?php }?>>
    <?php if ($rit_layout == 'grid'){ ?>
    <div class="row"><?php } ?>
        <?php foreach ($rit_content as $item) { ?>
            <div class="rit_pc_banner_item <?php echo esc_attr($class_item) ?>" <?php if($rit_layout=='metro'&&$atts['gutter']!=0){?>style="padding:<?php echo esc_attr($atts['gutter']/2)?>px" <?php }?>>
                <div class="wrap-pc-banner-content">
                <?php
                $rit_cat = get_term_by('slug', $item['pro_cat'], 'product_cat');
                if (!empty($rit_cat) && !is_wp_error($rit_cat)) {
                    $rit_cat_link = get_category_link($rit_cat->term_id);
                    $rit_img_id = $item['image'] != '' ? $item['image'] : get_woocommerce_term_meta($rit_cat->term_id, 'thumbnail_id', true);
                    ?>
                    <a href="<?php echo esc_url($rit_cat_link) ?>" title="<?php echo esc_attr($rit_cat->name) ?>">
                        <?php
                        if ($rit_img_id != '') {
                            echo wp_get_attachment_image($rit_img_id, 'single');
                        }
                        $rit_cat_title = '';
                        if (isset($item['show_cat_title'])) {
                            $rit_cat_title = isset($item['cat_title']) ? $item['cat_title'] : $rit_cat->name;
                        }
                        $rit_cat_des = '';
                        if (isset($item['show_cat_des'])) {
                            $rit_cat_des = isset($item['cat_des']) ? $item['cat_des'] : $rit_cat->description;
                        }
                        $rit_total_item = '';
                        if (isset($item['show_count_items'])) {
                            $rit_total_item = $rit_cat->count;
                        }
                        ?>
                    </a>
                    <div class="wrap_text_pc_banner">
                        <?php
                        if ($rit_cat_title != '') {
                            ?>
                            <h3 class="cat-name">
                                <a href="<?php echo esc_url($rit_cat_link) ?>"
                                   title="<?php echo esc_attr($rit_cat_title) ?>">
                                    <?php echo esc_html($rit_cat_title); ?>
                                </a>
                            </h3>
                            <?php
                        }
                        if ($rit_cat_des != '') {
                            ?>
                            <div class="cat-des">
                                <?php echo ent2ncr($rit_cat_des); ?>
                            </div>
                            <?php
                        }
                        if ($rit_total_item != '') {
                            ?>
                            <h5 class="total-item">
                                <?php if ($rit_total_item < 10 && $rit_total_item > 0) {
                                    esc_html_e('0', 'ri-ione');
                                }
                                echo esc_html($rit_total_item);
                                if ($rit_total_item > 1) {
                                    esc_html_e(' Items', 'ri-ione');
                                } else {
                                    esc_html_e(' Item', 'ri-ione');
                                } ?>
                            </h5>
                            <?php
                        }
                        if (isset($item['text_btn'])) {
                            ?>
                            <a href="<?php echo esc_url($rit_cat_link) ?>" class="btn<?php echo esc_attr(' '.$atts['btn-style']) ?>"
                               title="<?php echo esc_attr($item['text_btn']) ?>">
                                <?php echo esc_html($item['text_btn']); ?>
                            </a>
                            <?php
                        }
                        ?>
                    </div>

                    <?php
                }
                ?>
                </div>
            </div>
        <?php }
        if ($rit_layout == 'grid'){ ?></div><?php } ?>
</div>
<?php if($rit_layout=='metro'&&$atts['gutter']!=0){?></div><?php }?>