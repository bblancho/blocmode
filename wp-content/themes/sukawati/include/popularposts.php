<?php

$popularposts_count = vp_metabox('jeg_popularpost.jeg_popularposts_options.0.count', 10);
$popularposts_column = vp_metabox('jeg_popularpost.jeg_popularposts_options.0.column', 4);
$popularposts_autoplay = vp_metabox('jeg_popularpost.jeg_popularposts_options.0.autoplay', 0);
$popularposts_delay = vp_metabox('jeg_popularpost.jeg_popularposts_options.0.delay', 5);

$disableoverlay = vp_metabox('jeg_popularpost.disable_overlay_title') ? "disableoverlay" : "";

if ( function_exists( 'wpp_get_mostpopular' ) ) : ?>

<!-- Popular Post -->
<div id="popular-post" class="<?php echo esc_html($disableoverlay); ?>">
    <div class="container">
        <h2 class="line-heading">
            <span><?php esc_html_e('Popular Post', 'sukawati') ?></span>
        </h2>

        <?php
            $popular_template = '
                <div class="item">
                    <div class="feature-holder clearfix">{thumb}</div>
                    <div class="popular-excerpt">
                        <div class="content-meta">
                            <span class="meta-category">{category}</span>
                        </div>
                        <h3>{title}</h3>
                    </div>
                </div>';

            $popular_posts = wpp_get_mostpopular(array(
                'range' => 'monthly',
                'limit' => $popularposts_count,
                'post_type' => 'post',
                'thumbnail_width' => '380',
                'thumbnail_height' => '304',
                'wpp_start' => '<div id="popular-slider" class="owl-carousel owl-theme">',
                'stats_category' => 1,
                'wpp_end'   => '</div>',
                'post_html' => $popular_template
            ));
        ?>

    </div>
</div>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function() {
            $("#popular-slider").owlCarousel({
                loop:true,
                nav:true,
                dots: false,
                navText: [ '', '' ],
                margin:20,
                autoplay:<?php echo esc_js( $popularposts_autoplay ? 'true' : 'false' ); ?>,
                autoplayTimeout:<?php echo esc_js( $popularposts_delay * 1000 ); ?>,
                autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:1
                    },
                    460:{
                        items:2
                    },
                    768:{
                        items:3
                    },
                    979:{
                        items:3
                    },
                    1199:{
                        items:<?php echo esc_js( $popularposts_column ) ?>,
                    }
                },
                rtl: <?php echo esc_js( is_rtl() ? "true" : "false" ); ?>
            });
        });
    })(jQuery);
</script>
<!-- /Popular Post -->
<?php endif; ?>