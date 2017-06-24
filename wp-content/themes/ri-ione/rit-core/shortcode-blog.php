<?php
$wrapID = 'shortcode_blog_' . rit_random_ID();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => ($atts['number'] > 0) ? $atts['number'] : get_option('posts_per_page')
);
if ($atts['cat'] != '') {
    if ($atts['parent']) {
        $args['category_name'] = $atts['cat'];
    } else {
        $catid = array();
        foreach (explode(',', $atts['cat']) as $catslug) {
            $catid[] .= get_category_by_slug($catslug)->term_id;
        }
        $args['category__in'] = $catid;
    }
}
if ($atts['post_in'] != ''){
    $args['post__in'] = explode(",",$atts['post_in']);
}
if (!isset($atts['paged'])) {
    $args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
} else {
    $args['paged'] = $atts['paged'];
}
$the_query = new WP_Query($args);
$layout = $atts['layout'];
$wrapClass = $atts['el_class'].' '.$atts['layout'];
$atts['enable_border']!='yes'?$wrapClass.=' '.'no-border':'';
$wrapClass .= ' rit-blog-shortcode';
if ($atts['animation_type'] != '' && $atts['animation_type'] != 'none') {
    wp_enqueue_style('animations');
}
?>
<div id="<?php echo esc_attr($wrapID); ?>" class="<?php echo esc_attr($wrapClass) ?>">
    <?php
    if ($atts['title'] != '') {
        ?>
        <h3 class="title-block"><?php echo esc_html($atts['title']) ?> </h3>
        <?php
    }
    if ($the_query->have_posts()):
        ?>
        <div class="wrap-rit-blog <?php if($atts['layout']!='list-title'){echo esc_attr('layout-' . $atts['columns'] . '-col row');}else{echo esc_attr('list-title');}
        ?>">
            <?php
            while ($the_query->have_posts()): $the_query->the_post();
                if($atts['layout']!='list-title'){
                    echo rit_get_template_part('post-layout/grid', 'layout', array('atts' => $atts));
                }else{
                    echo rit_get_template_part('post-layout/list', 'title', array('atts' => $atts));
                }
            endwhile;
            ?>
        </div>
            <?php
            //paging
            if ($atts['pagination'] == 'standard') :
                ?>
                <div class="wrap-pagination">
                        <div class="rit-pagination-left pull-left primary-font default-pagination"><?php
                            previous_posts_link(__('<i class="fa fa-angle-double-left" aria-hidden="true"></i> NEWER POST ', 'ri-ione'), $the_query->max_num_pages);
                            ?>
                        </div>
                        <div class="rit-pagination-right pull-right primary-font default-pagination">
                            <?php
                            next_posts_link(__('OLDER POST <i class="fa fa-angle-double-right" aria-hidden="true"></i>', 'ri-ione'), $the_query->max_num_pages);
                            ?>
                        </div>
                </div>
                <?php
            elseif ($atts['pagination'] == 'ajax'):
                //file name shortcode - Attributes of shortcode - Query shortcode - Wrap block - Wrap content - Isotope true/false
                rit_ajax_load_more(basename(__FILE__, ".php"), $atts, $the_query, '.rit-blog-shortcode', '.wrap-rit-blog', false);
            elseif ($atts['pagination'] == 'infinite-scroll'):
                //Query shortcode - Wrap block - shortcode item - Isotope true/false
                rit_infinity_scroll($the_query, '#' . $wrapID, '.rit-blog-item', false);
            endif;
        //end paging
    endif;
    wp_reset_postdata();
    ?>
</div>
