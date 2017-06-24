(function($){
    "use strict";
    jQuery(document).ready(function(){
        $('.wrap-icon-cart, .mask-close, .close').live('click',function (e) {
            e.preventDefault();
            rit_CartVisible();
        })

    function rit_CartVisible() {
        $('body').toggleClass('cart-active');
    }
    if ( typeof wc_add_to_cart_params === 'undefined' ) {
        return false;
    }
    //Ajax Remove Cart ===================================
    $('.mini_cart_item .remove').live('click',function (event) {
        event.preventDefault();
        $('.wrap-mini-cart').addClass('loading');
        var $this = $(this);
        var product_id = $this.data('product_id');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: wc_add_to_cart_params.ajax_url,
            data: {
                action: "cart_remove_product",
                product_key: product_id
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log('AJAX Remove ' + errorThrown);
            },
            success: function (data) {
                var $cart = $('.wrap-mini-cart');
                $this.parents('.mini_cart_item').remove();
                if (data.cart_count == 0) {
                    $cart.find('.cart_list').html('<li class="empty">' + $cart.find('.rit-mini-cart').data('empty-cart') + '</li>');
                    $cart.find('.bottom-cart').remove();
                } else {
                    $cart.find('.total .woocommerce-Price-amount').replaceWith(data.cart_subtotal);
                }
                $('.total-cart').html(data.cart_subtotal);
                $('.top-cart-total span').html(data.cart_count);
                $('.sticky-cart .top-cart-total').html(data.cart_count);
                $('.wrap-mini-cart').removeClass('loading');
            }
        });
        return false;
    });

    //Ajax Add to Cart ===================================
    $(document).on('click', '.add_to_cart_button', function () {
        rit_CartVisible();
        $('.rit-drop-wrap').addClass('loading');
    });
    //Ajax Add to Cart Detail ===================================
    $(document).on('click', '.single_add_to_cart_button', function (event) {
        rit_CartVisible();
        $('.wrap-mini-cart').addClass('loading');
        $('.rit-quickview-mask').css('opacity','0');
        $('#rit-quickview-lb').css({'top':'calc(50% + 150px)','opacity':'0'});
        setTimeout(function () {
            $('#rit-quickview-lb').remove();
            $('.rit-quickview-mask').remove();
        },500);
        var $this = $(this);
        var $productForm = $this.closest('form');
        var data = {
            product_id: $productForm.find("button[name*='add-to-cart']").val(),
            product_variation_data: $productForm.serialize()
        };
        if (!data.product_id) {
            console.log('(Error): No product id found');
            return;
        }
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '?add-to-cart=' + data.product_id + '& ajax-add-to-cart=1',
            data: data.product_variation_data,
            cache: false,
            headers: {'cache-control': 'no-cache'},
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log('AJAX error - SubmitForm() - ' + errorThrown);
            },
            success: function (response) {
                var $response = $(response),
                    $shopNotices = $response.find('.woocommerce-message') // Shop notices
//                    Get replacement elements/values
                var fragments = {
                    '#top-cart .top-cart-total': $response.find('#top-cart .top-cart-total'), // Header menu cart count
                    '.sticky-cart .top-cart-total': $response.find('.sticky-cart .top-cart-total'), // Header menu cart count
                    '.total-cart': $response.find('.total-cart'), // Header menu cart count
                    '.woocommerce-message': $shopNotices,
                    '.wrap-mini-cart': $response.find('.wrap-mini-cart') // Widget panel mini cart
                };
                // Replace elements
                $.each(fragments, function (selector, $element) {
                    if ($element.length) {
                        $(selector).replaceWith($element);
                    }
                });
                $('.wrap-mini-cart').removeClass('loading');
            }
        });
        return false;
    });
})})(jQuery);