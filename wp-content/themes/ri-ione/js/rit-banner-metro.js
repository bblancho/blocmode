(function ($) {
    'use strict';
    $(window).load(function () {
        $(window).resize(function () {
            rit_bannerMetro();
        }).resize();
    });
    function rit_bannerMetro() {
            $('.wrap_shortcode_pc_banner.metro').each(function () {
                var $grid = $(this);
                var itemwidth = $grid.data('width');
                var layoutw=itemwidth;
                var data_w;
                var grid_w=$(window).width()>769 && $(window).width()<1170?1170:$grid.outerWidth();
                var t_col=Math.round(grid_w/itemwidth);
                if ($(window).width() > 768) {
                    layoutw=$grid.outerWidth()/t_col;
                    $grid.find('.rit_pc_banner_item').each(function () {
                        if (!$(this).data("w")) {
                            data_w = Math.round(jQuery(this).outerWidth(true) / itemwidth);
                            $(this).attr('data-w', data_w == 0 ? '1' : data_w);
                        }
                        $(this).outerWidth($(this).data("w") * layoutw);
                    });
                }
                else if($(window).width() <= 768 && $(window).width()>480){
                    $grid.find('.rit_pc_banner_item').width('');
                    layoutw=grid_w/2;
                    $grid.find('.rit_pc_banner_item').each(function () {
                       if($(this).outerWidth(true)<grid_w){
                           $(this).outerWidth((grid_w/2)-2)
                       }
                    })
                }else{
                    $grid.find('.rit_pc_banner_item').width('100%');
                    layoutw=grid_w;
                }
                setTimeout(function () {
                    $grid.isotope({
                            masonry: {
                                columnWidth: layoutw
                            }
                        }
                    );
                }, 500);
            })
        }
})(jQuery)