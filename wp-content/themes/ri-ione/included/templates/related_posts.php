<?php

$rit_categories = get_the_category(get_the_ID());

$rit_category_ids = array();

foreach ($rit_categories as $rit_category) $rit_category_ids[] = $rit_category->term_id;
$args = array(
    'post_type' => 'post',
    'post__not_in' => array(get_the_ID()),
    'showposts' => 3,
    'ignore_sticky_posts' => -1
);
$rit_related_query = new wp_query($args);
if ($rit_related_query->have_posts()) { ?>
    <div class="post-related">
        <h4 class="title-block"><span><?php esc_html_e('YOU MIGHT ALSO LIKE', 'ri-ione'); ?></span></h4>
        <div class="row">
            <?php while ($rit_related_query->have_posts()) {
                $rit_related_query->the_post(); ?>
                <div class="item-related col-sm-4">
                    <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="wrap-post-thumbnail"
                           title="<?php echo esc_attr(get_the_title()); ?>"><?php
                            the_post_thumbnail('medium');
                            ?>
                        </a>
                    <?php endif; ?>
                    <h3 class="title-post"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                    <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
                </div>
                <?php
            } ?>
        </div>
    </div>
<?php }
wp_reset_postdata();
?>