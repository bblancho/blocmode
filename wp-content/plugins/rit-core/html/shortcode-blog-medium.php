<?php

$args = array(
    'post_type' => 'post',
    'posts_per_page' => ($atts['number'] > 0) ? $atts['number'] : get_option('posts_per_page')
);
if ($atts['cat'] != ''){
    $cats = explode(',', $atts['cat']);
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'portfolio_category',
            'field' => 'id',
            'terms' => $cats,
        )
    );
}
if ($atts['post_in'] != '')
    $args['post__in'] = explode(',', $atts['post_in']);
$args['paged'] = (rit_get_query_var('paged')) ? rit_get_query_var('paged') : 1;
$the_query = new WP_Query($args);
?>
<div class="<?php echo esc_attr('rit-blog-' . $atts['post_layout'] . '-layout'); ?>">
    <?php if ($the_query->have_posts()):
        while ($the_query->have_posts()): $the_query->the_post(); ?>

            <article class="rit-news-item" id="post-<?php the_ID(); ?>">
                <?php if (has_post_format(array('gallery', 'image', 'audio', 'video'))) {
                    echo '<div class="row">';
                } else {
                    if (get_the_post_thumbnail()) echo '<div class="row">';
                } ?>

                <?php echo rit_get_template_part('post-format/post', 'default', array('atts' => $atts)) ?>
                <div class="rit-news-info <?php
                if (has_post_format(array('gallery', 'image', 'audio', 'video'))) {
                    echo 'col-md-8 col-sm-6 col-xs-12';
                } else {
                    if (get_the_post_thumbnail()) echo 'col-md-8 col-sm-6 col-xs-12';
                }
                ?> ">
                    <h3 class="title-news"><a href="<?php the_permalink(); ?>"
                                              title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

                    <p class="info-post"><a class="author-link"
                                            href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                            rel="author">
                            <?php echo(get_the_author()); ?>
                        </a> / <?php echo get_the_date('F jS, Y'); ?>
                        /  <?php comments_number(esc_html__('0 Comment', 'rit-core-language'), esc_html__('1 Comment', 'rit-core-language'), esc_html__('% Comments', 'rit-core-language'));?></p>

                    <div class="description"><?php if($atts['output_type']!='no'){
                            if($atts['output_type']=='excerpt'){
                                echo rit_excerpt($atts['excerpt_lenght']);
                            }
                            else{
                                the_content();
                            }
                        } ?></div>
                </div>
                <?php if (has_post_format(array('gallery', 'image', 'audio', 'video'))) {
                    echo '</div>';
                } else {
                    if (get_the_post_thumbnail()) echo '</div>';
                } ?>
            </article>
            <?php
        endwhile;
        if (function_exists("rit_pagination")) :
            rit_pagination( 3, $the_query);
        endif;
    endif;
    wp_reset_postdata();
    ?>
</div>
