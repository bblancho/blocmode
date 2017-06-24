<?php

$post_categories = vp_metabox('jeg_slider.slider_filter_categories', array());
$post_tags = vp_metabox('jeg_slider.slider_filter_tags', array());

$slider_animation = vp_metabox('jeg_slider.jeg_slider_fullslider_options.0.animation', 'slide');
$slider_delay = vp_metabox('jeg_slider.jeg_slider_fullslider_options.0.delay', 7);
$slider_autoplay = vp_metabox('jeg_slider.jeg_slider_fullslider_options.0.autoplay', false);

$statement = array(
    'posts_per_page'    => vp_metabox('jeg_slider.slider_post_count', 5),
    'meta_key'          => '_thumbnail_id',
);

if(!empty($post_categories) && implode("", $post_categories) != "") $statement['category__in'] = $post_categories;
if(!empty($post_tags) && implode("", $post_tags) !="") $statement['tag__in'] = $post_tags;

if(isset($statement['category__in'])) {
    foreach($statement['category__in'] as $key => $value) {
        $term = get_the_category_by_ID($value);
        if( !$term ) unset($statement['category__in'][$key]);
    }
}

$query = new WP_Query($statement);

add_filter('excerpt_length', 'sukawati_slider_excerpt_longer');
add_filter('excerpt_more', 'sukawati_slider_latest_more');

$thumbwidth = vp_metabox('jeg_slider.slider_featured_width', 2);
$thumbsize = 'sukawati-new-feature-2';
if($thumbwidth == 2) {
    $thumbsize = 'sukawati-new-feature-1';
}

// The Loop
if ( $query->have_posts() ) :
    ?>
    <div class="featuredcontent" id="slider">
        <div class="container">
            <div id="featured-slider" class="sliderwrap owl-carousel owl-theme">
                <?php while ( $query->have_posts() ) : $query->the_post();  ?>
                    <article class="column item">
                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( $thumbsize ); ?></a>
                        <div class="slider-excerpt">
                            <div class="slider-featured-content">
                                <div class="content-meta">
                                    <span class="meta-category"><?php the_category(', '); ?></span>
                                    <span class="meta-date"><?php the_date();  ?></span>
                                </div>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </div>
                            <div class="content-author">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ) ?>
                                <h5><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php echo esc_html(sukawati_get_author_name()); ?></a></h5>
                            </div>
                        </div>

                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php
else:
    // no posts found
endif;

remove_filter('excerpt_length', 'sukawati_slider_excerpt_longer');
remove_filter('excerpt_more', 'sukawati_slider_latest_more');

/* Restore original Post Data */
wp_reset_postdata();
?>

<script type="text/javascript">
    (function ($) {
        $(document).ready(function() {
            $("#featured-slider").owlCarousel({
                loop:false,
                nav:true,
                dots: false,
                navText: [ '', '' ],
                margin:20,
                responsive:{
                    0:{
                        items:1
                    },
                    460:{
                        items:2
                    },
                    979:{
                        items:2
                    },
                    1199:{
                        items:<?php echo esc_js($thumbwidth); ?>,
                    }
                },
                rtl: <?php echo esc_js( is_rtl() ? "true" : "false" ); ?>
            });
        });
    })(jQuery);
</script>
