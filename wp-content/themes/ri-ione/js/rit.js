/**
 * Js for Ri-Ione theme
 * @since ri-ione 1.0
 */
(function ($) {
    'use strict';
    jQuery(document).ready(function () {
        rit_product_carousel();
        rit_Animation();
        rit_MobileNav();
        rit_WoocommerceLayout();
        rit_CartQuantity();
        rit_VaritionImg();
        rit_stickyproduct();
        $('.search-trigger').on('click', function () {
            $(this).toggleClass('active');
            $('#rit-header').toggleClass('search-active');
            if ($('#rit-header.search-active')[0]) {
                $('.header-search-block input').focus();
            }
        });
        $('.mask-sidebar, .close-sidebar').on('click', function () {
            $('.disable-sidebar').removeClass('disable-sidebar');
            $('.sidebar-control>a').removeClass('active');
        });
        $('.sidebar-control>a').on('click', function () {
            if ($('.woo-page.disable-sidebar')[0]) {
                if ($(window).width() > 769) {
                    setCookie('sidebar-status', false);
                }
                $('.woo-page').removeClass('disable-sidebar');
            } else {
                $('.woo-page').addClass('disable-sidebar');
                if ($(window).width() > 769) {
                    setCookie('sidebar-status', true);
                }
            }
            $('.sidebar-control>a').toggleClass('active');
            if ($(window).width() > 769) {
                setTimeout(function () {
                    jQuery('.products').rit_layoutWoocommerce();
                }, 400);
                setTimeout(function () {
                    jQuery('.products').isotope();
                }, 1000);
            }
        });

        $('.vc_tta-panel-body .woocommerce').each(function () {
            $(this).parents('.vc_tta-panel').css('height', $(this).height())
        });

        // ---------------------------------------- //
        // BACK TO TOP --------------------------- //
        // ---------------------------------------- //
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#back-to-top').addClass('show');
            } else {
                jQuery('#back-to-top').removeClass('show');
            }
            if ($('#wpadminbar')[0] && $(window).width() > 768) {
                $('#sticker-sticky-wrapper.is-sticky').find('#sticker').css('top', $('#wpadminbar').height());
            }
        });
        jQuery('#back-to-top').click(function (e) {
            e.preventDefault();
            jQuery('html, body').animate({
                scrollTop: 0
            }, 1000);
            return false;
        });
        $(window).resize(function () {
            //Stick menu for different menu
            var sticky_height = $('.sticker').height();
            $('.sticker').on('sticky-end', function () {
                $(this).parent().height(sticky_height);
            });
            if ($(window).width() < 769) {
                jQuery(".sticker").unstick();
                jQuery('#rit-header .wrap-header-block').sticky({zIndex: '3'});
                $('#top-product-page').sticky({
                    zIndex: '2',
                    topSpacing: $('#rit-header .wrap-header-block').outerHeight()
                });
            } else {
                jQuery('#rit-header .wrap-header-block').unstick();
                $('#top-product-page').unstick();
                if ($('#wpadminbar')[0]) {
                    jQuery(".sticker").sticky({zIndex: '3', topSpacing: $('#wpadminbar').height()});
                } else {
                    jQuery(".sticker").sticky({zIndex: '3'});
                }
            }
            //Clear cookie sidebar in mobile
            if ($(window).width() < 769) {
                if ($('.woo-page')[0]) {
                    setCookie('sidebar-status', '');
                    $('.disable-sidebar').removeClass('disable-sidebar');
                    $('.woo-sidebar').css('margin', '0');
                }
                $('#main-footer, #top-footer').slideUp();
            } else {
                $('#main-footer, #top-footer').slideDown();
            }
            //Sidebar toogle
            if ($('#primary').offset().left < 290) {
                $('.woo-page.sidebar-onscreen').removeClass('sidebar-onscreen');
            }
            else {
                $('.woo-page:not(.sidebar-onscreen)').addClass('sidebar-onscreen');
            }
        }).resize();
        $('.footer-view').on('click', function () {
            var text = $(this).html();
            $(this).text($(this).data('text'));
            $(this).data('text', text);
            $('#main-footer, #top-footer').slideToggle();
        });
        //Carousel js
        jQuery(".post-content .gallery").each(function () {
            var wrapcaroul = jQuery(this);
            var cols = jQuery(this).attr('class').match(/gallery-columns-(.*)/)[1].split(' ')[0];
            wrapcaroul.slick({
                slidesToShow: cols,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                autoplay: true,
                prevArrow: '<span class="rit-carousel-btn prev-item"><i class="clever-icon-arrow-left"></i></span>',
                nextArrow: '<span class="rit-carousel-btn next-item "><i class="clever-icon-arrow-right"></i></span>',
                autoplaySpeed: 4000,
                rtl: $('body.rtl')[0] ? true : false
            });
        })
        jQuery(".post-slider").each(function () {
            var wrapcaroul = jQuery(this);
            wrapcaroul.slick({
                infinite: false,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                autoplay: true,
                prevArrow: '<span class="rit-carousel-btn prev-item"><i class="clever-icon-arrow-left"></i></span>',
                nextArrow: '<span class="rit-carousel-btn next-item "><i class="clever-icon-arrow-right"></i></span>',
                autoplaySpeed: 4000,
                rtl: $('body.rtl')[0] ? true : false
            });
        })
        jQuery(".ri-ione-carousel").each(function () {
            var data = JSON.parse(jQuery(this).attr('data-config'));
            var item = data['item'];
            var pag = false;
            if (data['pagination'] != undefined && data['pagination'] == 'true') {
                pag = true;
            }
            var nav = false;
            if (data['navigation'] != undefined && data['navigation'] == 'true') {
                nav = true;
            }
            var wrap = data['wrap'] != undefined ? data['wrap'] : '';
            var wrapcaroul = wrap != '' ? jQuery(this).find(wrap) : jQuery(this);
            wrapcaroul.slick({
                slidesToShow: item,
                slidesToScroll: item > 5 ? Math.round(item / 2) : 1,
                arrows: nav,
                dots: pag,
                autoplay: true,
                prevArrow: '<span class="rit-carousel-btn prev-item"><i class="clever-icon-arrow-left"></i></span>',
                nextArrow: '<span class="rit-carousel-btn next-item "><i class="clever-icon-arrow-right"></i></span>',
                autoplaySpeed: 5000, rtl: $('body.rtl')[0] ? true : false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: item > 4 ? 4 : item,
                            slidesToScroll: item > 4 ? 2 : 1
                        }
                    }, {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    }
                ]
            });
        })
        rit_fixBodyHeight();
        //Auto typing js
        if ($('.rit-auto-typing')[0]) {
            $('.rit-auto-typing').each(function () {
                $(this).find(".content-auto-typing").typed({
                    strings: $(this).data('text'),
                    typeSpeed: $(this).data('speed'),
                    startDelay: $(this).data('delay'),
                    showCursor: $(this).data('cursor') != '' ? true : false,
                });
            });
        }
        //End Auto typing js
        jQuery('.layout-control').live("click", function () {
            jQuery('.layout-control.active').removeClass('active');
            jQuery(this).addClass('active');
            var layout;
            if (jQuery(this).hasClass('list-layout')) {
                layout = 'list';
                jQuery('.products').removeClass('grid').addClass('list');
            } else {
                layout = 'grid';
                jQuery('.products').removeClass('list').addClass('grid');
            }
            jQuery('.products:not(.rit-carousel-product)').rit_layoutWoocommerce();
            setCookie('product-layout', layout);
            setTimeout(function () {
                $('.products').isotope();
            }, 400)
        });
        /*Woocommerce*/
        $('.btn-show-register').on('click', function (e) {
            e.preventDefault();
            $('.login.form').slideUp();
            $('.register.form').slideDown();
        });
        $('.btn-show-login').on('click', function (e) {
            e.preventDefault();
            $('.login.form').slideDown();
            $('.register.form').slideUp();
        });
        $('.woocommerce-main-image').on('click',function (e) {
            e.preventDefault();
        });
        //Ajax change layout
        jQuery('.wrap-product-page, .rit-wrap-products-sc').bind('DOMNodeInserted DOMNodeRemoved', function (event) {
            if (!$(this).find('.products-carousel')[0]) {
                jQuery('.products:not(.products-carousel)').rit_layoutWoocommerce();
                jQuery('.products:not(.products-carousel)').isotope('reloadItems');
            }
            rit_lazyImg();
        });
        //Popup
        $('.mask-popup:not(.deactive), .close-popup:not(.deactive)').on('click',function () {
            if($('#rit-cookie-popup:checked')[0]){
                setCookie('rit-cookie-popup','1');
            }
            $('.mask-popup, #rit-popup').addClass('deactive');
        });
        //Cookie
        function setCookie(cname, cvalue) {
            document.cookie = cname + "=" + cvalue + "; ";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        //Parallax js
        if ($('.rit-parallax-box.in-nav')[0]) {
            var rit_nav = '';
            var i = 0;
            $('.rit-parallax-box.in-nav').each(function () {
                rit_nav += '<li><a href="#' + $(this).attr('id') + '" class="rit-parallax-nav-item" title="' + $(this).data('title') + '"><span>' + $(this).data('title') + '</span></a></li>';
            });
            rit_nav = '<ul class="rit-parallax-nav">' + rit_nav + '</ul>';
            $('.page-content').append(rit_nav);
            $('.rit-parallax-nav li:first-child a').addClass('active');
        }
        $('.rit-parallax-nav a:not(.active)').live('click', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top - $('#rit-header').outerHeight(true)
            }, 500);
            $('.rit-parallax-nav a.active').removeClass('active');
            $(this).addClass('active');
        });
        //product lightbox
        $('.woocommerce-main-image').on('click', function (e) {
            e.preventDefault();
            var pswpElement = $('.pswp')[0],
                items = $(this).ritgetGalleryItems(),
                c_index = $(this).index();
            if ($(this).hasClass('slick-slide')) {
                c_index = $(this).index() - 1
            };
            var options = {
                index: c_index,
                shareEl: false,
                closeOnScroll: false,
                history: false,
                hideAnimationDuration: 0,
                showAnimationDuration: 0
            };
            // Initializes and opens PhotoSwipe.
            var photoswipe = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
            photoswipe.init();
        });
    });
    $(window).on('load', function () {
        //Lazy load imgs
        rit_lazyImg();
        if (!$('body.single-product')[0]) {
            $('.products-carousel').each(function () {
                var top = ($(this).find('.wrap-product-thumb').height() + 30) / 2;
                $(this).find('.rit-carousel-btn').css('top', top + 'px');
            });
        }
        //Product Zoom feature
        if ($('.rit-product-zoom')[0]) {
            $('.rit-product-zoom .wrap-single-carousel .woocommerce-main-image').ZooMove();
        }
        $(window).resize(function () {
                //Fix position menu
                var window_w = $(window).width();
                $('.pos-left').removeClass('pos-left');
                $('#main-navigation .children, #main-navigation .sub-menu').each(function () {
                    if (window_w < parseInt($(this).offset()['left'] + $(this).width())) {
                        $(this).addClass('pos-left');
                    }
                });
                $('.grid-no-thumb').find('.rit-blog-item').height('auto');
                $('.grid-no-thumb').each(function () {
                    var max_h = 0;
                    $(this).find('.rit-blog-item').each(function () {
                        if (max_h < $(this).outerHeight(true)) {
                            max_h = $(this).outerHeight(true)
                        }
                    });
                    $(this).find('.rit-blog-item').outerHeight(max_h);
                });
                $('.vertical .mega-menu-megamenu >ul').css('max-width', $(window).width() - $('.wrap-header.vertical').width());
                $('.one-line .mega-menu-megamenu >ul').css('width', $(window).width() - 30);
                if ($('.one-line.menu-right')[0]) {
                    if ($('body.rtl')[0]) {
                        $('.one-line .mega-menu-megamenu >ul').css('left', -$('#right-header').outerWidth(true));
                    }
                    else {
                        $('.one-line .mega-menu-megamenu >ul').css('right', -$('#right-header').outerWidth(true));
                    }
                }
                //For Megamenu item
                $('.mega-menu-megamenu >ul>li').height('auto');
                $('.mega-menu-megamenu >ul').each(function () {
                    var max_h = 0;
                    $(this).children('.mega-menu-item-type-custom').each(function () {
                        if (max_h < $(this).outerHeight(true)) {
                            max_h = $(this).outerHeight(true)
                        }
                    });
                    $(this).children('.mega-menu-item-type-custom').outerHeight(max_h);
                });
                //Horizontal gallery
                if ($('.wrap-top-single-product')[0]) {
                    if ($(window).width() < 768) {
                        $('.wrap-top-single-product.sticky .wrap-single-carousel').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            swipe: true,
                            rtl: $('body.rtl')[0] ? true : false,
                            prevArrow: '<span class="rit-carousel-btn prev-item"><i class="fa fa-angle-left"></i></span>',
                            nextArrow: '<span class="rit-carousel-btn next-item "><i class="fa fa-angle-right"></i></span>',
                        });
                    } else {
                        $('.wrap-top-single-product.sticky .wrap-single-carousel.slick-slider').slick('destroy');
                    }
                }
            }
        ).resize();
    });
    //Lazy Img Config
    function rit_lazyImg() {
        if ($("img.lazy-img")[0]) {
            $("img.lazy-img:not(.loaded)").parent().addClass('loading');
            $("img.lazy-img:not(.loaded)").lazyload({
                effect: 'fadeIn',
                threshold: $(window).height(),
                load: function () {
                    $(this).parent().removeClass('loading');
                    $(this).addClass('loaded');
                }
            });
        }
    }

    function rit_fixBodyHeight() {
        $(window).resize(function () {
            var window_height = $(window).height();
            var header_height, footer_height;
            header_height = $('#rit-header').outerHeight(true);
            footer_height = $('#footer-page').outerHeight(true);
            $('#main-page').css('min-height', parseInt(window_height - footer_height - header_height) + 'px');
            if ($('.footer-stick')[0]) {
                $('.wrap-main-page').css('margin-bottom', footer_height + 'px');
            }
            $('.rit-parallax-box.on-screen').css('height', parseInt(window_height - footer_height - header_height) + 'px');
            $('.rit-parallax-box.full-screen').css('height', window_height + 'px');
        }).resize();
    }

    function rit_Animation() {
        $('[data-animation]').each(function () {
            $(this).css('opacity', '0');
            var classitem;
            if ($(this).rit_ActiveScreen()) {
                classitem = $(this).attr('data-animation');
                $(this).addClass(' animated ' + classitem);
                $(this).css('opacity', '1');
            }
        })
        jQuery(window).bind("scroll", function () {
            $('[data-animation]').each(function () {
                var classitem;
                if ($(this).rit_ActiveScreen()) {
                    classitem = $(this).attr('data-animation');
                    $(this).addClass(' animated ' + classitem);
                    $(this).css('opacity', '1');
                }
            });
        })
    }

    function rit_MobileNav() {
        $('.wrap-mobile-nav li:has("ul")>a').after('<span class="triggernav"><i class="clever-icon-plus"></i></span>');
        rit_toggleMobileNav('.triggernav');
        $(window).resize(function () {
            if ($(window).width() < 769) {
                $('.wrap-mobile-nav').height($(window).height() - $('.wrap-header-block').outerHeight(true))
            }
        }).resize();
        $('#menu-mobile-trigger').live('click', function () {
            $(this).toggleClass('active');
            $('.wrap-mobile-nav').toggleClass('active');
            $('body').toggleClass('menu-active');
            if ($('body.menu-active')[0]) {
                $('.wrap-mobile-nav').css('top', $('.wrap-header-block').outerHeight(true))
            } else {
                $('.wrap-mobile-nav').css('top', '-30%');
            }
        });
    }

    function rit_toggleMobileNav(trigger) {
        $('.wrap-mobile-nav li ul').slideUp();
        $(trigger).on("click", function () {
            $(this).toggleClass('active');
            $(this).next().slideToggle();
            if (!$(this).hasClass('active')) {
                $(this).next().find('ul').slideUp();
                $(this).next().find('.triggernav').removeClass('active');
            }
        });
    }

    jQuery.fn.extend({
        rit_ActiveScreen: function () {
            var itemtop, windowH, scrolltop;
            itemtop = $(this).offset().top;
            windowH = $(window).height();
            scrolltop = $(window).scrollTop();
            if (itemtop < scrolltop + windowH * 0.9) {
                return true;
            }
            else {
                return false;
            }
        },
        //Smart layout of woocommerce
        rit_layoutWoocommerce: function () {
            if (jQuery(this)[0] && $(this).not('.products-carousel')[0]) {
                jQuery(this).each(function () {
                    var col;
                    var $this = jQuery(this);
                    var wrap_w = $this.outerWidth();
                    var res = '';
                    if ($this.find('.lazy-img')[0]) {
                        res = $this.find('.lazy-img').parent().data('resolution');
                    }
                    if ($this.hasClass('grid')) {
                        if (jQuery(window).width() > 361) {
                            var item_w = jQuery(this).find('.product').data('width');
                            col = Math.floor(wrap_w / item_w);
                        } else {
                            col = 2;
                        }
                        var col_w = wrap_w / col;
                        $this.find('.product').outerWidth(col_w - 0.5);
                        if (res != '') {
                            var w = $this.find('.product').width();
                            $this.find('.lazy-img').parent().outerWidth(w).height(w / res);
                        }
                    }
                    if ($this.hasClass('list')) {
                        $this.find('.product').outerWidth(wrap_w);
                        if (res != '') {
                            var w = $this.find('.product').width() * 0.25;
                            $this.find('.lazy-img').parent().outerWidth(w).height(w / res);
                        }
                    }
                    $this.isotope({
                        layoutMode: 'fitRows',
                        masonry: {
                            columns: col
                        }
                    });
                })
            }
        },
        ritgetGalleryItems: function () {
            var $slides = this.parent().find('.woocommerce-main-image:not(.slick-cloned)'),
                items = [];
            if ($slides.length > 0) {
                $slides.each(function (i, el) {
                    var img = $(el).find('img'),
                        large_image_src = img.attr('data-large_image'),
                        large_image_w = img.attr('data-large_image_width'),
                        large_image_h = img.attr('data-large_image_height'),
                        item = {
                            src: large_image_src,
                            w: large_image_w,
                            h: large_image_h,
                            title: img.attr('title')
                        };
                    items.push(item);
                });
            }

            return items;
        }
    });
    //Woocommerce layoutjs
    function rit_WoocommerceLayout() {
        $(window).resize(function () {
            $('.products:not(.products-carousel)').rit_layoutWoocommerce();
        }).resize();
    }

    //Quickview js
    //Quickview --------------------------------------------------------------------------------------------------//
    $('.quick-view.btn').live('click', function (e) {
        e.preventDefault();
        var load_product_id = $(this).attr('data-product_id');
        var data = {action: 'rit_quickview', product_id: load_product_id};
        $(this).parent().addClass('loading');
        var $this = $(this);
        $.ajax({
            url: ajaxurl,
            data: data,
            type: "POST",
            success: function (response) {
                $('body').append(response);
                $this.parent().removeClass('loading');
                rit_qv_gal();
                setTimeout(function () {
                    $('#rit-quickview-lb,.rit-quickview-mask').css('opacity', '1');
                }, 10)
            }
        });
    });
    $('.rit-quickview-mask, .close-quickview').live('click', function () {
        rit_remove_qv_lb();
    });
    function rit_remove_qv_lb() {
        $('.rit-quickview-mask').css('opacity', '0');
        $('#rit-quickview-lb').css({'top': 'calc(50% + 150px)', 'opacity': '0'});
        setTimeout(function () {
            $('#rit-quickview-lb').remove();
            $('.rit-quickview-mask').remove();
        }, 500)
    }

    function rit_qv_gal() {
        if ($('#rit-quickview-lb .wrap-top-single-product .wrap-single-carousel')[0]) {
            $('#rit-quickview-lb .wrap-top-single-product .wrap-single-carousel').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                rtl: $('body.rtl')[0] ? true : false,
                swipe: true,
                prevArrow: '<span class="rit-carousel-btn prev-item"><i class="fa fa-angle-left"></i></span>',
                nextArrow: '<span class="rit-carousel-btn next-item "><i class="fa fa-angle-right"></i></span>',
            });
        }
    }

    //CartQuantity for single product
    function rit_CartQuantity() {
        jQuery('.quantity .qty-nav').live("click", function () {
            var parent = jQuery(this).parents('.quantity').find('input.qty');
            var val = parseInt(parent.val());
            if ($(this).hasClass('increase')) {
                parent.val(val + 1);
            }
            else {
                if (val > 1) {
                    parent.val(val - 1);
                }
            }
            parent.trigger('change');
        });
    }

    //VaritionImg
    function rit_VaritionImg() {
        var orginal_image = $('.list-thumbnails li.active img').attr('src');
        var orginal_alt = $('.list-thumbnails li.active img').attr('alt');
        jQuery("form.variations_form").on("show_variation", function (event, variation) {
            if (variation.image_link != '') {
                var newimg = variation.image.full_src;
                jQuery('.slick-current .woocommerce-main-image img').attr('src', newimg);
                jQuery('.slick-current .woocommerce-main-image img').attr('srcset', newimg);
                jQuery('.slick-current .woocommerce-main-image').attr('href', newimg);
                $('.slick-current .woocommerce-main-image .zoo-img').css('background-image','url('+newimg+')');
            } else {
                jQuery('.slick-current .woocommerce-main-image img').attr('src', orginal_image);
                jQuery('.slick-current .woocommerce-main-image img').attr('srcset', orginal_image);
                jQuery('.slick-current .woocommerce-main-image').attr('href', orginal_image);
                $('.slick-current .woocommerce-main-image .zoo-img').css('background-image','url('+orginal_image+')');
            }
        });
    }

    function rit_product_carousel() {
        //Carousel Gallery
        if ($('.wrap-top-single-product')[0]) {
            $('.wrap-top-single-product.carousel .wrap-single-carousel').slick({
                slidesToScroll: 1,
                slidesToShow: 3,
                centerMode: true,
                rtl: $('body.rtl')[0] ? true : false,
                autoplay: true,
                autoplaySpeed: 5000,
                prevArrow: '<span class="rit-carousel-btn prev-item"><i class="fa fa-angle-left"></i></span>',
                nextArrow: '<span class="rit-carousel-btn next-item "><i class="fa fa-angle-right"></i></span>',
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
            //Horizontal gallery
            $('.wrap-top-single-product.vertical-gallery .wrap-single-carousel, .wrap-top-single-product.horizontal-gallery .wrap-single-carousel').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                swipe: true,
                rtl: $('body.rtl')[0] ? true : false,
                asNavFor: '.wrap-top-single-product .wrap-thumbs-gal',
                prevArrow: '<span class="rit-carousel-btn prev-item"><i class="fa fa-angle-left"></i></span>',
                nextArrow: '<span class="rit-carousel-btn next-item "><i class="fa fa-angle-right"></i></span>',
            });
        }
        if ($('.wrap-top-single-product.vertical-gallery')[0]) {
            // var thumb_h = $('.wrap-top-single-product .wrap-single-image').height();
            // thumb_h = thumb_h > 60 ? thumb_h : 'auto';
            // $('.wrap-top-single-product .wrap-thumbs-gal').height(thumb_h);
            if ($('.wrap-top-single-product .wrap-thumbs-gal')[0]) {
                // var thumbs = $('.wrap-top-single-product .wrap-thumbs-gal');
                $('.wrap-top-single-product .wrap-thumbs-gal').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    vertical: true,
                    verticalSwiping: true,
                    focusOnSelect: true,
                    asNavFor: '.wrap-top-single-product .wrap-single-carousel',
                    prevArrow: '<span class="rit-carousel-btn vertical-btn prev-item"><i class="fa fa-angle-up"></i></span>',
                    nextArrow: '<span class="rit-carousel-btn  vertical-btn next-item "><i class="fa fa-angle-down"></i></span>',
                });
            }
        }
        if ($('.wrap-top-single-product.horizontal-gallery .wrap-thumbs-gal')[0]) {
            $('.wrap-top-single-product.horizontal-gallery .wrap-thumbs-gal').slick({
                focusOnSelect: true,
                slidesToScroll: 1,
                slidesToShow: 4,
                swipe: true,
                speed: 300,
                asNavFor: '.wrap-top-single-product .wrap-single-carousel',
                prevArrow: '<span class="rit-carousel-btn prev-item"><i class="fa fa-angle-left"></i></span>',
                nextArrow: '<span class="rit-carousel-btn   next-item "><i class="fa fa-angle-right"></i></span>',
            });
        }
    }

    //Sticky Product
    function rit_stickyproduct() {
        if ($('.wrap-top-single-product.sticky')[0]) {
            jQuery(window).resize(function () {
                if (jQuery(window).width() > 769) {
                    var wrappH, itemH, maxMove, item, stickH;
                    wrappH = $('.wrap-top-single-product.sticky .wrap-product-sticky').outerHeight(true);
                    itemH = $('.content-right-single-product').outerHeight(true);
                    maxMove = wrappH - itemH;
                    $('.wrap-right-single-product').data('maxMove', maxMove);
                    stickH = 0;
                    if ($('.sticky-wrapper')[0]) {
                        stickH = $('.sticky-wrapper').height();
                    }
                    var wrapptoTop = $('.wrap-top-single-product.sticky .wrap-product-sticky').offset().top - stickH;
                    jQuery(window).bind("scroll", function () {
                        var toTop;
                        item = $('.wrap-right-single-product');
                        maxMove = item.data('maxMove');
                        toTop = $(window).scrollTop() - wrapptoTop;
                        if (toTop > 0 && toTop <= maxMove) {
                            item.css('padding-top', toTop + 'px');
                        }
                        if ($(window).scrollTop() < wrapptoTop) {
                            item.css('padding-top', 0 + 'px');
                        }
                        if (toTop > maxMove) {
                            item.css('padding-top', maxMove + 'px');
                        }
                    });
                }
            }).resize();
        }
    }
})
(jQuery)