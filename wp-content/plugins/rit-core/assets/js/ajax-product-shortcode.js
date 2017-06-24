(function ($) {
    "use strict";
    jQuery(document).ready(function () {
        var wrap = $('.rit-products-wrap');
        //Search Function
        $('.rit-products-wrap .rit_search_button').live('click', function () {
            var search = $(this).prev().val();
            var search_button = $(this);
            $.ajax({
                url: wrap.data('url'),
                data: {action: 'rit_ajax_product_filter', rit_search: search},
                type: 'POST',
            }).success(function (response) {
                search_button.parent().next().html(response);
            });
        });
        wrap.find('.rit-ajax-load a, .rit-remove-attribute').on('click',function (e) {
            e.preventDefault();
            var $this = $(this);
            wrap=$this.parents('.rit-products-wrap');
            wrap.addClass('loading');
            var link = $this.attr('href');
            var title = $this.attr('title');
            var data = wrap.data('args');
            data['action'] = 'rit_ajax_product_filter';
            if ($this.hasClass('rit-product-attribute')) {
                if (typeof data['product_attribute'] == 'object'&&!$this.hasClass('active')) {
                    data['product_attribute'].push($this.data('value'));
                    data['attribute_value'].push($this.data('attribute_value'));
                } else {
                    data['product_attribute'] = [];
                    data['attribute_value'] = [];
                }
            } else {
                data[$this.data('type')] = $this.data('value');
            }
            data['paged'] = 1;
            if ($this.data('type') == 'product_cat') {
                data['product_attribute'] = [];
                data['attribute_value'] = [];
                data['product_tag'] = '';
                data['filter_categories'] =$this.data('value');
                data['show'] = '';
            }
            if ($this.data('type') == 'rit-reset-filter') {
                data['product_attribute'] = [];
                data['attribute_value'] = [];
                data['product_tag'] = '';
                data['filter_categories'] =wrap.data('categories');
                data['show'] = '';
                data['price_filter'] = 0;
                $('.wrap-content-product-filter ').find('.active').removeClass('active');
            }

            if ($this.data('type') == 'rit-remove-attr') {
                var product_attribute = $this.next().data('value');
                var attribute_value = $this.next().data('attribute_value');
                var index = data['attribute_value'].indexOf(attribute_value);
                if (index > -1) {
                    data['attribute_value'].splice(index, 1);
                    data['product_attribute'].splice(index, 1);
                }
            }

            if ($this.data('type') == 'rit-remove-price') {
                data['price_filter'] = 0;
            }
            var keyword = $('input[name="s"]').val();
            if (keyword != '') {
                data['s'] = keyword;
            }
            if($this.hasClass('active') && $this.data('type') != 'rit-reset-filter'){
                if($this.data('type') == 'product_cat'){
                    data['filter_categories'] =wrap.data('categories');
                    $this.parents('.rit-list-product-category').find('li:first-child a').addClass('active');
                }else{
                    data[$this.data('type')] ='';
                }
                $this.removeClass('active');
            }else{
                $this.parents('.rit-ajax-load ').find('.active').removeClass('active');
                $this.addClass('active');
            }
            wrap.data('original',data);
            wrap.data('args',data);
            $.ajax({
                url: wrap.data('url'),
                data: data,
                type: 'POST',
            }).success(function (response) {
                var products= $(response).find('.products');
                wrap.find('.products').html(products.html());

                if(!products.find('.product')[0]){
                    wrap.find('.products').html('<h3 class="products-emt">'+wrap.data('empty')+'</h3>')
                }
                if(wrap.find('.rit_ajax_load_more_button')[0]) {
                    if ($(response).find('.rit_ajax_load_more_button').data('maxpage') == data['paged']) {
                        wrap.find('.rit_ajax_load_more_button').addClass('disable').html(wrap.find('.rit_ajax_load_more_button').data('empty'));
                    } else {
                        wrap.find('.rit_ajax_load_more_button').data('maxpage',$(response).find('.rit_ajax_load_more_button').data('maxpage'));
                    }
                    if(!$(response).find('.rit_ajax_load_more_button')[0]){
                        wrap.find('.rit_ajax_load_more_button').addClass('disable').html(wrap.find('.rit_ajax_load_more_button').data('empty'));
                    }
                    else{
                        wrap.find('.rit_ajax_load_more_button').removeClass('disable').html($(response).find('.rit_ajax_load_more_button').html());
                    }
                }
                wrap.removeClass('loading');
            })
        })
        //Ajax loadmore
        $('.rit-products-wrap .rit_ajax_load_more_button').live('click', function (e) {
            e.preventDefault();
            if (!$(this).hasClass('disable')) {
                var base = $(this).parents('.rit-products-wrap');
                var wrap = base;
                var data = base.data('args');
                $(this).addClass('rit-loading');
                var max_page = $(this).data('maxpage');
                if (data['paged'] < max_page) {
                    data['action'] = 'rit_ajax_product_filter';
                    data['paged'] = parseInt(data['paged']) + parseInt(1);
                    $.ajax({
                        url: $(this).attr('href'),
                        data: data,
                        type: 'POST',
                    }).success(function (response) {
                        wrap.find('.products').append($(response).find('.products').html());
                        if (max_page == data['paged']) {
                            wrap.find('.rit_ajax_load_more_button').addClass('disable').html(wrap.find('.rit_ajax_load_more_button').data('empty'));
                        } else {
                            wrap.find('.rit_ajax_load_more_button').show();
                        }
                        wrap.find('.rit_ajax_load_more_button').removeClass('rit-loading');
                    })
                }
            }
        });
        $('.header-product-filter .toogle-filter').on('click',function () {
            $('.content-product-filter').slideToggle();
        })
    });
})(jQuery);