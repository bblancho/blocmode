<?php

if ( has_category() ) :
    $categories = get_the_category();
    $category_ids = array();
    foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;

    $show_sidebar = vp_option('joption.single_show_sidebar', true);
    $posttotal = $show_sidebar ? 3 : 4;
    $grid = $show_sidebar ? "grid one-third" : " grid one-forth";

    $args = array(
        'category__in'        => $category_ids,
        'showposts'           => $posttotal,
        'ignore_sticky_posts' => 1,
        'post__not_in'        => array(get_the_ID()),
        'offset'              => 1
    );

    // The Query
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        ?>

        <div id="related-post">
            <div class="meta-article-header">
                <span><?php esc_html_e('Related Posts', 'sukawati') ?></span>
            </div>
            <div class="related-post-bottom">
            <?php
                $index = 0;
                while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    $index++;
                    if($index === $posttotal) $grid .= " last";
                    ?>
                    <div class="<?php echo esc_attr($grid); ?> item">
                        <?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
                            <div class="feature-holder">
                                <a href="<?php echo esc_url(get_permalink( get_the_ID() )); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'sukawati-popular-post' ) ?></a>
                            </div>
                        <?php else: ?>
                            <div class="feature-holder">
                                <a href="<?php echo esc_url(get_permalink( get_the_ID() )); ?>"><img src="<?php echo esc_url(get_template_directory_uri(). "/images/placeholder_thumb.png"); ?>" alt="<?php the_title(); ?>"></a>
                            </div>
                        <?php endif; ?>
                        <div class="related-excerpt">
                            <div class="content-meta">
                                <span class="meta-category"><?php the_category(', '); ?></span>
                            </div>
                            <h3><a href="<?php echo esc_url(get_permalink( $post->id )); ?>"><?php the_title(); ?></a></h3>
                            <!-- <i><?php echo esc_html__('On ', 'sukawati') . get_the_date(); ?></i> -->
                        </div>
                    </div>
                    <?php
                endwhile;
            ?>
                <div class="clear"></div>
            </div>

        </div>

    <?php
    endif;
    wp_reset_postdata();
endif;

?>