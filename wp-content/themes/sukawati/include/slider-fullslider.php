<?php

    $post_count = vp_metabox('jeg_slider.slider_post_count', 5);
    $post_categories = vp_metabox('jeg_slider.slider_filter_categories', array());
    $post_tags = vp_metabox('jeg_slider.slider_filter_tags', array());

    $slider_animation = vp_metabox('jeg_slider.jeg_slider_fullslider_options.0.animation', 'slide');
    $slider_delay = vp_metabox('jeg_slider.jeg_slider_fullslider_options.0.delay', 7);
    $slider_autoplay = vp_metabox('jeg_slider.jeg_slider_fullslider_options.0.autoplay', false);

    $statement = array(
        'posts_per_page'    => $post_count,
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

    // The Loop
    if ( $query->have_posts() ) :
?>

    <!-- Slider: Fullslider -->
    <div id="slider" class="fullslider">
        <div class="container">
            <div class="flexslider">
                <ul class="slides">
                <?php while ( $query->have_posts() ) : $query->the_post(); if (has_post_thumbnail()) : ?>
                    <li>
                        <article>
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'sukawati-fullslider' ); ?></a>
                            <div class="slider-excerpt">
                                <span class="meta-category"><?php the_category(', '); ?></span>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </div>
                        </article>
                    </li>
                <?php endif; endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function(){
                $('.fullslider .flexslider').flexslider({
                    animation: '<?php echo esc_js($slider_animation) ?>',
                    slideshow: <?php echo esc_js($slider_autoplay) ?>,
                    slideshowSpeed: <?php echo esc_js( $slider_delay * 1000 ) ?>,
                    startAt: 0,  // later variable sliderCount for starting in the middle
                    controlNav: false,
                    mousewheel: false,
                    prevText: "",
                    nextText: "",
                    start: function (slider) {
                        $('.fullslider .flex-active-slide .slider-excerpt').addClass('show-excerpt');
                    },
                    before: function (slider) {
                        $('.fullslider .flex-active-slide .slider-excerpt').removeClass('show-excerpt');
                    },
                    after: function (slider) {
                        $('.fullslider .flex-active-slide .slider-excerpt').addClass('show-excerpt');
                    }
                });
            });
        })(jQuery);
    </script>
    <!-- Slider: Fullslider ended -->

<?php
    else:
        // no posts found
    endif;

    remove_filter('excerpt_length', 'sukawati_slider_excerpt_longer');
    remove_filter('excerpt_more', 'sukawati_slider_latest_more');

    /* Restore original Post Data */
    wp_reset_postdata();
?>