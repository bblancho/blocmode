<?php
    global $show_sidebar;
?>
<div class="post-container">
    <div class="main-post">
        <div class="post-result">
            <?php if ( is_page_template( 'template-home.php' ) ) : ?>
                <div class="post-line-heading"></div>
            <?php endif; ?>

            <div class="blog-masonry-wrapper">
                <div class="isotopewrapper">
                <?php
                    // The Loop
                    if ( have_posts() ) :

                        while ( have_posts() ) : the_post();
                            get_template_part( 'content-masonry' );
                        endwhile;

                    endif;
                ?>
                </div>
            </div>

            <?php
                // Pagination
                if(vp_option('joption.paging_type', 'number') === 'number')
                {
                    sukawati_pagination();
                } else {
                    sukawati_pagination_nomal();
                }
            ?>

            <script type="text/javascript">
                (function ($) {
                    $(document).ready(function() {
                        var element = $(".blog-masonry-wrapper");
                        var container = $(element).find('.isotopewrapper');

                        var get_blog_column_number = function() {
                            var ww = $(container).width();
                            if (ww < 480) return 1;
                            if (ww < 800) return 2;
                            return 3;
                        };

                        var blog_resize = function() {
                            $(container).addClass('no-transition');

                            var elepadding = $(element).css('padding-left').replace("px", "");
                            var blognumber = get_blog_column_number();
                            var wrapperwidth = $(element).width() - elepadding;
                            var itemwidth = Math.floor(wrapperwidth / blognumber) - 1;

                            $(".article-masonry-container", container).width(itemwidth);
                            $(container).removeClass('no-transition');
                        };

                        var initialize_blog = function() {
                            blog_resize();

                            $(container).isotope({
                                itemSelector: ".article-masonry-container",
                                masonry: {
                                    columnWidth: 1
                                }
                            });

                            $(container).imagesLoaded(function() {
                                $(container).isotope('layout');
                            });

                            setInterval(function () {
                                $(container).isotope('layout');
                                console.log('relayout');
                            }, 2000);

                            $(window).bind('resize', function(){
                                $(container).isotope('layout');
                            });
                        };

                        $(window).bind("resize load", function () {
                            blog_resize();
                        });

                        initialize_blog();
                    });
                })(jQuery);
            </script>
        </div>
    </div>

    <?php if ($show_sidebar) get_sidebar() ?>

    <div class="clear"></div>
</div>