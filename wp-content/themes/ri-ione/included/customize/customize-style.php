<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function rit_customizer_css()
{ ?>
    <style type="text/css">
        /*Load and add font*/
        <?php
            $font_body = $font_heading = '';
            if(get_theme_mod('rit_body_font_select', 'google') == 'google' || get_theme_mod('rit_heading_font_select', 'google') == 'google'){
                $google_body_default = array('family' => 'Roboto', 'variants' => array('300','400','500'), 'subsets' => array('latin'));
                $google_heading_default = array('family' => 'Roboto', 'variants' => array('400','500'), 'subsets' => array('latin'));
                $google_body = json_decode(get_theme_mod('rit_body_font_google', json_encode($google_body_default)), true);
                $google_heading = json_decode(get_theme_mod('rit_heading_font_google', json_encode($google_heading_default)), true);
                $font_array = array(
                    'rit_body_font_google' => $google_body,
                    'rit_heading_font_google' => $google_heading,
                );
                wp_enqueue_style('rit-google-font', rit_create_google_font_url($font_array));
            }
            if(get_theme_mod('rit_body_font_select', 'google') == 'standard'){
                $font_body = get_theme_mod('rit_body_font_standard', 'Arial');
            } else {
                if(isset($google_body['family'])){
                    $font_body = $google_body['family'];
                }
            }
            if(get_theme_mod('rit_heading_font_select', 'google') == 'standard'){
                $font_heading = get_theme_mod('rit_heading_font_standard', 'Arial');
            } else {
                if(isset($google_heading['family'])){
                    $font_heading = $google_heading['family'];
                }
            }
            $rit_body_fsize=get_theme_mod('rit_body_font_size','15');
           $rit_accent_color= get_theme_mod('rit_accent_color','#c7b299');
           $bg_button=get_theme_mod('rit_button_bg','#c7b299');
           if(is_page()&&get_post_meta(get_the_ID(),'rit_accent_color',true)!=''){
           $rit_accent_color=get_post_meta(get_the_ID(),'rit_accent_color',true);
           $bg_button=get_post_meta(get_the_ID(),'rit_accent_color',true);
        }
     ?>
        body, .body-font {
            font-family: "<?php echo esc_attr($font_body); ?>", sans-serif;
            font-size: <?php echo esc_attr($rit_body_fsize);?>px;
            line-height: <?php echo esc_attr(get_theme_mod('rit_body_line_height','24')/$rit_body_fsize);?>;
            -webkit-font-smoothing: antialiased;
        }

        #main-navigation, .primary-font, h1, h2, h3, h4, h5, h6, .title, .readmore, .btn, button, .button, input[type="button"], input[type="submit"] {
            font-family: "<?php echo esc_attr($font_heading); ?>", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        @media (max-width: 769px) {
            body, .body-font {
                font-size: <?php echo esc_attr(get_theme_mod('rit_body_mobile_font_size','15'));?>px;
            }
        }

        #main-navigation > div > ul > li > a, #main-navigation > div > ul a {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_menu_font_size',12)));?>rem
        }

        .title-block-page, .wc-bacs-bank-details-heading {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_block',14)));?>rem
        }

        .widget-title, .title-block {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_title_widget',12)));?>rem
        }

        .widget-footer-title {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_title_widget_footer',12)));?>rem
        }

        .rit-post-inner .title-post {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_post_title',24)));?>rem
        }

        .title-detail {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_single_post_title',36)));?>rem
        }

        .rit-posts-widget li .title-post, .widget .title-post, .post-related .title-post, .post-pagination a {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_post_sidebar',15)));?>rem
        }

        .footer-block {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_footer',12)));?>rem
        }

        h1 {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_h1',36)));?>rem;
            color: <?php echo esc_attr(get_theme_mod('rit_body_h1_color','#252525'));?>
        }

        h2 {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_h2',30)));?>rem;
            color: <?php echo esc_attr(get_theme_mod('rit_body_h2_color','#252525'));?>
        }

        h3 {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_h3',26)));?>rem;
            color: <?php echo esc_attr(get_theme_mod('rit_body_h3_color','#252525'));?>
        }

        h4 {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_h4',24)));?>rem;
            color: <?php echo esc_attr(get_theme_mod('rit_body_h4_color','#252525'));?>
        }

        h5 {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_h5',21)));?>rem;
            color: <?php echo esc_attr(get_theme_mod('rit_body_h5_color','#252525'));?>
        }

        h6 {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_h6',18)));?>rem;
            color: <?php echo esc_attr(get_theme_mod('rit_body_h6_color','#252525'));?>
        }

        .woo-sidebar .widget-title {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_woo_title_widget',15)));?>rem
        }

        .woocommerce div.product .wrap-right-single-product .product_title {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_woo_title_detail',30)));?>rem
        }

        .woocommerce ul.products li.product .wrap-product-text > h3.product-name {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_woo_title',13)));?>rem
        }

        .woocommerce ul.products li.product .price {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_woo_price',15)));?>rem
        }

        .woocommerce div.product p.price, .woocommerce div.product span.price {
            font-size: <?php echo esc_attr(rit_px2rem(get_theme_mod('rit_font_size_woo_single_price',22)));?>rem
        }

        /* End font, font size options*/
        /*Color*/
        #rit-header.vertical .ipt::-webkit-input-placeholder, #rit-header.vertical .ipt:-moz-placeholder, #rit-header.vertical .ipt::-moz-placeholder, #rit-header.vertical .ipt:-ms-input-placeholder, #rit-header.vertical .ipt,
        #rit-header.vertical .bottom-main-header .RITSocialWidget a, .layout-control-block li a, .woocommerce nav.woocommerce-pagination ul.page-numbers li .page-numbers, .wrap-left-single-product .wrap-single-image .rit-countdown .countdown-block .countdown-times > div,
        .woo-custom-share .social-icons li a, .rit-woo-tabs .tabs li.active, .rit-woo-tabs .tabs li:hover, .rit-woo-tabs #tab-additional_information table.shop_attributes th, .woocommerce .product_meta, .woocommerce #comments > h5 span,
        .woocommerce #reviews #comments ol.commentlist li .meta > strong, .woocommerce #review_form_wrapper h3#reply-title, .woocommerce #review_form_wrapper .comment-form label,
        div.pp_woocommerce .pp_content_container .pp_expand, div.pp_woocommerce .pp_content_container .pp_contract, div.pp_woocommerce .pp_content_container .pp_close,
        div.pp_woocommerce .pp_content_container .pp_expand:before, div.pp_woocommerce .pp_content_container .pp_contract:before, div.pp_woocommerce .pp_content_container .pp_close:before, .close-btn, .woocommerce table.shop_table th,
        .woocommerce-cart .shop_table .label-row, .woocommerce-checkout .shop_table .label-row, .woocommerce-cart .shipping-cal .shipping-calculator-button, .woocommerce-checkout .shipping-cal .shipping-calculator-button,
        .woocommerce-cart .woocommerce .wc-proceed-to-checkout .button:not(.checkout-button), .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .button:not(.checkout-button),
        .wrap-coupon label, .woocommerce .checkout_coupon label, #order-step li.step, .woocommerce .woocommerce-info .showcoupon, .woocommerce-account .woocommerce-MyAccount-navigation ul li, .countdown-times > div,
        .list-title-item .left-post .label-date, .wrap-content-product-filter ul:not(.rit-list-product-tag) a:hover, .wrap-content-product-filter ul:not(.rit-list-product-tag) a.active, .rit-demo-box .circus-box {
            color: <?php echo esc_attr(get_theme_mod('rit_primary_color','#252525'));?>;
        }

        .caption, .newsletter-widget form .newsletter-email, .entry-content, .woocommerce-result-count, .woocommerce-ordering .orderby, .prdctfltr_checkboxes > label,
        .prdctfltr_checkboxes .prdctfltr_count, .woocommerce .wrap-woo-breadcrumb .woocommerce-breadcrumb, .single-product-navigation .product-link-btn, .single-product-navigation .product-title, .woocommerce div.product .wrap-right-single-product .woocommerce-review-link,
        .woocommerce div.product .wrap-right-single-product .short-description, .rit-woo-tabs .tabs li, .woocommerce .product_meta > span a, .woocommerce .product_meta > span span, .products-carousel .rit-carousel-btn,
        .mini_cart_item .cart-detail, .mini_cart_item .cart-detail .qty, .mini_cart_item .right-mini-cart-item .remove, .woocommerce .shop_table .product-remove .remove, .wrap-content-product-filter ul:not(.rit-list-product-tag) a,
        .rit-demo-box .description {
            color: <?php echo esc_attr(get_theme_mod('rit_sec_color','#7d7d7d'));?>;
        }

        .dark-style .vc_tta-tabs.vc_tta-color-white.vc_tta-style-flat .vc_tta-tabs-container .vc_tta-tabs-list .vc_active a span,
        .dark-style .vc_tta-tabs.vc_tta-color-white.vc_tta-style-flat .vc_tta-tabs-container .vc_tta-tabs-list li:hover a span,
        .dark-style .wrap-coupon label, .dark-style .woocommerce .checkout_coupon label, .dark-style .woocommerce .global-login-form label,
        .dark-style h1,
        .dark-style h2,
        .dark-style h3,
        .dark-style h4,
        .dark-style h5,
        .dark-style h6,
        .dark-style .amount,
        .dark-style .title-detail,
        .dark-style blockquote::before, .dark-style .quote::before, q::before,
        .dark-style a:hover,
        .dark-style .title-post a:hover,
        .dark-style .post-date,
        .dark-style.woocommerce .product_meta > span,
        .dark-style.woocommerce .related .title-block span,
        .dark-style .rit-woo-tabs .tabs li.active, .dark-style .rit-woo-tabs .tabs li:hover,
        .dark-style.woocommerce .product p.price ins .amount, .dark-style.woocommerce .product span.price ins .amount,
        .dark-style.woocommerce ul.products li.product .wrap-product-text > h3.product-name:hover,
        .dark-style .woocommerce ul.products li.product .wrap-product-text > h3.product-name:hover,
        .dark-style #top-header #top-right-header ul li:hover > a, .dark-style .widget-footer-title,
        .dark-style #rit-header a:not(.button):hover, .dark-style #rit-header.vertical .top-main-header-bar a:not(.button):hover,
        .dark-style #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item:hover > a.mega-menu-link,
        .dark-style.woocommerce ul.products li.product .wrap-product-text > h3.product-name:hover a,
        .dark-style .woocommerce .product p.price ins .amount, .dark-style .woocommerce .product span.price ins .amount, .dark-style .woocommerce .product span.price ins .amount,
        .dark-style .woo-sidebar .widget-title, .dark-style .widget-footer-title,
        .grid-no-thumb.style-2 .post-date, .grid-no-thumb.style-2 .readmore a:hover,
        .stack-center-2 .wrap-icon-cart .total-cart, .stack-center-2 .wrap-icon-cart .total-cart .amount, .wrap_shortcode_pc_banner.style-3 h5.total-item,
        .list-icon .search > a:hover > i, .page .vc_tta-color-grey.vc_tta-style-flat .vc_tta-tab.vc_active > a, .page .vc_tta-color-grey.vc_tta-style-flat .vc_tta-tab > a:hover,
        .wrap-product-thumb .yith-wcwl-wishlistaddedbrowse, .wrap-product-thumb .yith-wcwl-wishlistexistsbrowse, .wrap-product-thumb .rit-custom-wishlist-btn:hover,
        .post-content a:not(.wrap-post-thumbnail), .wrap-icon-cart:hover i,
        .widget a:hover, .widget_recent_entries li a:hover, .widget_recent_comments li a:hover, .widget_archive li a:hover, .widget_categories li a:hover, .widget_meta li a:hover,
        .rit-widget-social-icon.icon li:hover, #bottom-footer a:hover, #footer-page.one-line .left-bottom-footer a,
        #footer-page.simple #bottom-footer .widget .rit-widget-social-icon a:hover, #footer-page.simple #bottom-footer a, .readmore a, .default-pagination:hover,
        .layout-control-block li a.active, .layout-control-block li a:hover, .woocommerce ul.products li.product .wrap-product-text > h3.product-name:hover,
        .woocommerce ul.products li.product.product-category .wrap-product-text > a > h3:hover, .wrap-product-thumb .yith-wcwl-wishlistaddedbrowse, .wrap-product-thumb .yith-wcwl-wishlistexistsbrowse, .wrap-product-thumb .rit-custom-wishlist-btn:hover,
        .woo-sidebar .prdctfltr_woocommerce_ordering .prdctfltr_reset label:hover, .woocommerce .wrap-woo-breadcrumb .woocommerce-breadcrumb a:hover, .single-product-navigation .product-link-btn:hover,
        .single-product-navigation .product-title:hover, .woocommerce div.product .wrap-right-single-product .woocommerce-review-link:hover,
        .woocommerce div.product .wrap-right-single-product .rit-custom-wishlist-block .rit-custom-wishlist-btn:hover, .woocommerce div.product .wrap-right-single-product .variations a:hover,
        .woo-custom-share .social-icons li a:hover, .woo-custom-share .social-icons li a:hover, .woocommerce .product_meta > span a:hover, .woocommerce #review_form_wrapper .comment-form a:hover,
        .mini_cart_item .right-mini-cart-item .remove:hover, .woocommerce-cart .shipping-cal .shipping-calculator-button:hover, .woocommerce-checkout .shipping-cal .shipping-calculator-button:hover,
        .woocommerce .shop_table .product-remove .remove:hover, #footer-page.one-line #copyright a:hover,
        #order-step li.step.active, .woocommerce .woocommerce-info:before, .woocommerce .woocommerce-info .showcoupon:hover, .rit-list-product-tag li a,
        .wrap-content-shortcode-banner .heading, .list-title-item:hover a, .rit-list-product-category li a.active, .title-demo-box, .rit-wrap-popup .widget-title {
            color: <?php echo esc_attr($rit_accent_color);?>;
        }

        .tnp-widget input.tnp-submit,
        .rit-demo-box:hover .circus-box,
        .login .btn-show-register:hover, .register .btn-show-login:hover,
        .rit-parallax-nav span, .rit-parallax-nav a,
        .dark-style .vc_tta.vc_tta-accordion.vc_tta-color-white .vc_tta-panels .vc_tta-panel:hover .vc_tta-panel-heading, .dark-style .vc_tta.vc_tta-accordion.vc_tta-color-white .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading,
        .dark-style .btn.light:hover,
        .dark-style .btn.border:hover,
        .dark-style .btn.dark:hover,
        .dark-style .btn.small-dark:hover,
        .dark-style .bottom-cart .buttons .button,
        .dark-style .btn.btn-submit, .dark-style .wpcf7-form .wpcf7-submit,
        .dark-style .header-post .post-date::before,
        .dark-style.woocommerce div.product .wrap-right-single-product .cart .button, .dark-style.woocommerce ul.products li.product .added_to_cart, .dark-style .added_to_cart,
        .dark-style .rit-woo-tabs .tabs li::before,
        .dark-style .main-footer-block .newsletter-submit,
        #back-to-top, #rit-header .header-cart, div.pp_woocommerce .pp_content_container .pp_loaderIcon:before, div.pp_woocommerce .pp_content_container .pp_loaderIcon:after, .rit-mini-cart:before, .rit-mini-cart:after,
        .woocommerce .processing:before, .woocommerce .processing:after, .woocommerce .woocommerce-checkout-payment .place-order .button, .rit-wrap-products-sc .slick-dots li.slick-active button:after,
        .rit-loading:before, .rit-loading:after, .top-cart-total, .post-content ul > li:before, .post-content a:not(.wrap-post-thumbnail):after, .post-content a:not(.wrap-post-thumbnail):before,
        .tagcloud a:hover, #comments-list .comment-meta-actions a:hover, .page-numbers li span, .inpost-pagination a:hover, .inpost-pagination > .pagination > span, .wrap-social-icon a:hover,
        .rit-widget-social-icon.both a:hover i, #footer-page.simple #main-footer .widget_newsletterwidget .newsletter-widget form .newsletter-submit:hover,
        .woocommerce ul.products li.product .newsletter-submit, .woocommerce ul.products li.product #respond input#submit, .woocommerce #respond ul.products li.product input#submit, .woocommerce ul.products li.product button.button, .woocommerce ul.products li.product input.button,
        .woocommerce ul.products li.product .btn.loading:before, .woocommerce ul.products li.product .loading.newsletter-submit:before, .woocommerce ul.products li.product #respond input.loading#submit:before, .woocommerce #respond ul.products li.product input.loading#submit:before, .woocommerce ul.products li.product a.loading.button:before, .woocommerce ul.products li.product button.loading.button:before, .woocommerce ul.products li.product input.loading.button:before, .woocommerce ul.products li.product .btn.loading:after, .woocommerce ul.products li.product .loading.newsletter-submit:after, .woocommerce ul.products li.product #respond input.loading#submit:after, .woocommerce #respond ul.products li.product input.loading#submit:after, .woocommerce ul.products li.product a.loading.button:after, .woocommerce ul.products li.product button.loading.button:after, .woocommerce ul.products li.product input.loading.button:after, .woocommerce ul.products li.product .added_to_cart.loading:before, .woocommerce ul.products li.product .added_to_cart.loading:after,
        .woocommerce ul.products li.product .wrap-product-thumb.loading > a:not(.btn):not(.newsletter-submit):before, .woocommerce ul.products li.product .wrap-product-thumb.loading > a:not(.btn):not(.newsletter-submit):after,
        .woocommerce nav.woocommerce-pagination ul.page-numbers li span.page-numbers.current, .woocommerce nav.woocommerce-pagination ul.page-numbers li a.page-numbers:hover,
        .woo-sidebar .pf_rngstyle_html5 .irs .irs-single, .rit-list-product-tag li a.active, .rit-list-product-tag li a:hover,
        .woo-sidebar .pf_rngstyle_html5 .irs .irs-bar, .widget-area .prdctfltr_wc.prdctfltr_square .prdctfltr_filter label.prdctfltr_active > span::before, .widget-area .prdctfltr_wc.prdctfltr_square .prdctfltr_filter label:hover > span::before,
        .woocommerce div.product .wrap-right-single-product .cart .button, .woocommerce .quantity .qty-nav:hover, .btn, .newsletter-submit, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .button, .search-submit, button, input[type="submit"], input[type="button"] {
            background-color: <?php echo esc_attr($rit_accent_color);?>;
        }

        .rit-demo-box:hover .circus-box {
            box-shadow: 0 0 8px <?php echo esc_attr($rit_accent_color);?>;
        }

        #sbi_images .sbi_photo_wrap a:hover,
        .woo-sidebar .pf_rngstyle_html5 .irs .irs-slider,
        .dark-style .vc_tta-tabs.vc_tta-color-white.vc_tta-style-flat .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active,
        .dark-style .vc_tta-tabs.vc_tta-color-white.vc_tta-style-flat .vc_tta-tabs-container .vc_tta-tabs-list li:hover,
        .rit-list-product-tag li a,
        .tagcloud a, .btn.border, .border.newsletter-submit, .woocommerce #respond input.border#submit, .woocommerce a.border.button, .woocommerce button.border.button, .woocommerce input.border.button, .button.border, .search-submit.border, button.border, input[type="submit"].border, input[type="button"].border, .added_to_cart.border,
        .inpost-pagination > .pagination > span, .inpost-pagination a, .widget-area .prdctfltr_wc.prdctfltr_square .prdctfltr_filter label.prdctfltr_active > span::before, .widget-area .prdctfltr_wc.prdctfltr_square .prdctfltr_filter label:hover > span::before {
            border-color: <?php echo esc_attr($rit_accent_color);?>;
        }

        #comments-list .date-post, .rit-widget-social-icon.icon li, .site-description, #rit-header.vertical .bottom-main-header .widget_text,
        .social-icons a, .post-pagination span {
            border-color: <?php echo esc_attr(get_theme_mod('rit_sec_accent_color','#acacac'));?>;
        }

        .about-post li a, .total-cmt a, .products-emt {
            color: <?php echo esc_attr(get_theme_mod('rit_sec_accent_color','#acacac'));?>;
        }

        .single-section, .post-author, .title-block span, #comments-list li, #footer-page.simple #main-footer .widget_newsletterwidget .newsletter-widget form .newsletter-email,
        .rit-post-inner, #top-product-page, .woocommerce nav.woocommerce-pagination, .woo-sidebar .prdctfltr_woocommerce_ordering .prdctfltr_reset,
        .woocommerce div.product .wrap-right-single-product .variations select, .woocommerce .quantity, .woocommerce .quantity .qty,
        .rit-woo-tabs, .woocommerce #reviews #comments ol.commentlist li, .bottom-cart .total, .mini_cart_item,
        .mini_cart_item .cart-detail .qty, .woocommerce-cart .shop_table > li, .woocommerce-checkout .shop_table > li, .woocommerce-cart .shipping-cal .shipping-calculator-form select, .woocommerce-checkout .shipping-cal .shipping-calculator-form select,
        .woocommerce table.shop_table.order_details tfoot th, .woocommerce table.shop_table.order_details tfoot td, .woocommerce-account .woocommerce-MyAccount-navigation ul li,
        .list-title-item, .woocommerce.border-style .products.grid, .woocommerce.border-style .products.grid .product,
        .grid-no-thumb, .grid-no-thumb .rit-blog-item, .wpcf7-form .wpcf7-textarea, .wpcf7-form .wpcf7-text, table tbody th, table tbody td,
        .text-field, .newsletter-email, input[type="text"], input[type="search"], input[type="password"], textarea, input[type="email"], input[type="tel"],
        #rit-header.stack-center, #rit-header.vertical .top-main-header-bar, #rit-header.vertical .main-header-sidebar, .is-sticky .wrap-header-block,
        #mobile-nav > div > ul li {
            border-color: <?php echo esc_attr(get_theme_mod('rit_border_color','#ebebeb'));?>;
        }

        .woocommerce-cart .woocommerce .wc-proceed-to-checkout .checkout-button.button, .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .checkout-button.button,
        .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
        .btn, .newsletter-submit, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .button, .search-submit, button, input[type="submit"], input[type="button"], .added_to_cart {
            background-color: <?php echo esc_attr($bg_button);?>;
            color: <?php echo esc_attr(get_theme_mod('rit_button_color','#fff'));?>;
        }

        .woocommerce div.product .wrap-right-single-product .cart .button:hover, .woocommerce-cart .woocommerce .wc-proceed-to-checkout .checkout-button.button:hover, .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .checkout-button.button:hover,
        .btn:hover, .newsletter-submit:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .button:hover, .search-submit:hover, button:hover, input[type="submit"]:hover, input[type="button"]:hover, .added_to_cart:hover {
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_bg_hover','#252525'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_button_color_hover','#fff'));?>;
        }

        .bottom-cart .buttons .button:not(.checkout) {
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_light_bg','#ebebeb'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_button_light_color','#252525'));?>;
        }

        .bottom-cart .buttons .button:not(.checkout):hover, .bottom-cart .buttons .button.wc-forward:hover {
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_light_bg_hover','#252525'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_button_light_hover','#fff'));?>;
        }

        .rit-ajax-load-more .ajax-func, .rit-wrapper-products-shortcode .rit_ajax_load_more_button {
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_loadmore_bg','#ebebeb'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_button_loadmore_color','#252525'));?>;
        }

        .rit-ajax-load-more .ajax-func:hover, .rit-wrapper-products-shortcode .rit_ajax_load_more_button:hover {
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_loadmore_bg_hover','#252525'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_button_loadmore_hover','#fff'));?>;
        }

        <?php
        $rit_main_link_color=get_theme_mod('rit_nav_link_color','#252525');
//            if(is_page()){
//            if(get_post_meta(get_the_ID(),'rit_menu_bg',true)!=''){
//            ?>
        /*        #mega-menu-wrap-primary, #main-navigation {*/
        /*            background: */
        <?php //echo esc_attr(get_post_meta(get_the_ID(),'rit_menu_bg',true));?> /*;*/
        /*        }*/
        /**/
        /*        */
        <?php
        //            }
        //            if(get_post_meta(get_the_ID(),'rit_menu_color',true)!=''){
        //            $rit_main_link_color=get_post_meta(get_the_ID(),'rit_menu_color',true);
        //            ?>
        /*        #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link {*/
        /*            color: */
        <?php //echo esc_attr($rit_main_link_color);?>
        /*        }*/
        /**/
        /*        */
        <?php
        //}
        //        }
            if(is_page()&&get_post_meta(get_the_ID(),'rit_enable_header_color',true)!=''&&get_post_meta(get_the_ID(),'rit_enable_header_color',true)!='0'){
                ?>

        #rit-header.stack-center, #top-header,
        #rit-header, #rit-header.vertical .top-main-header-bar, #rit-header.one-line .wrap-header-block .content-header-block {
            background-color: <?php echo esc_attr(rit_hex2rgba(get_post_meta(get_the_ID(),'rit_custom_bg_header',true),get_post_meta(get_the_ID(),'rit_custom_bg_header_opc',true)));?>;
            color: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_header_color',true));?>;
        }

        #top-header .textwidget, #top-right-header ul li a {
            color: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_header_color',true));?>;
        }

        #top-right-header ul li:hover > a,
        #rit-header a:not(.button):hover, #rit-header.vertical .top-main-header-bar a:not(.button):hover {
            color: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_header_color_hover',true));?>;
        }

        #rit-header .is-sticky > .sticker {
            background-color: <?php echo esc_attr(rit_hex2rgba(get_post_meta(get_the_ID(),'rit_bg_sticky_header',true),get_post_meta(get_the_ID(),'rit_bg_sticky_header_opc',true)));?>;
        }

        #rit-header, #rit-header.full-width.one-line, #rit-header.stack-center-2 #top-header {
            border-color: <?php echo esc_attr(rit_hex2rgba(get_post_meta(get_the_ID(),'rit_header_border_color',true),get_post_meta(get_the_ID(),'rit_header_border_color_opc',true)));?>;
        }

        <?php
    }
    else{
    ?>
        #top-header {
            background-color: <?php echo esc_attr(rit_hex2rgba(get_theme_mod('rit_header_top_bg','#252525'),get_theme_mod('rit_header_top_bg_opc','1')));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_header_top_color','#acacac'));?>;
        }

        #rit-header #top-header a {
            color: <?php echo esc_attr(get_theme_mod('rit_header_top_link_color','#acacac'));?>;
        }

        #rit-header #top-header a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_header_top_link_hover','#fff'));?>;
        }

        #rit-header, #rit-header.vertical .top-main-header-bar {
            background-color: <?php echo esc_attr(rit_hex2rgba(get_theme_mod('rit_header_bg','#fff'),get_theme_mod('rit_header_bg_opc','0')));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_header_text_color','#acacac'));?>;
        }

        #rit-header.vertical .ipt {
            color: <?php echo esc_attr(get_theme_mod('rit_header_text_color','#acacac'));?>;
        }

        #rit-header a:not(.button), #rit-header.vertical .bottom-main-header .RITSocialWidget a {
            color: <?php echo esc_attr(get_theme_mod('rit_header_link_color','#252525'));?>;
        }

        #rit-header a:not(.button):hover, #rit-header.vertical .bottom-main-header .RITSocialWidget a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_header_link_hover','#c7b299'));?>;
        }

        #rit-header .is-sticky > .sticker {
            background-color: <?php echo esc_attr(rit_hex2rgba(get_theme_mod('rit_header_sticky_background_color','#fff'),get_theme_mod('rit_header_sticky_background_color_opc','1')));?>;
        }

        @media (min-width: 769px) {
            .one-line .wrap-header-block, .stack-center .wrap-header-block, #rit-header.vertical .main-header-sidebar {
                background-color: <?php echo esc_attr(rit_hex2rgba(get_theme_mod('rit_header_main_bg','#fff'),get_theme_mod('rit_header_main_bg_opc','0')));?>;
            }

            .one-line .wrap-header-block .content-header-block, .stack-center .wrap-header-block .site-branding .container {
                background-color: <?php echo esc_attr(rit_hex2rgba(get_theme_mod('rit_header_main_inner_bg','#fff'),get_theme_mod('rit_header_main_inner_bg_opc','0')));?>;
            }
        }

        <?php
        }
        ?>
        <?php
        if(get_theme_mod('header_image','')!=''){?>
        #rit-header {
            background: url('<?php echo esc_url(get_theme_mod('header_image','')) ?>') center center/cover no-repeat;
        }

        <?php }
        ?>
        .title-post a {
            color: <?php echo esc_attr(get_theme_mod('rit_color_blog_title','#252525')) ?>
        }

        .title-post a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_color_blog_title_hover','#c7b299')) ?>
        }

        .title-detail {
            color: <?php echo esc_attr(get_theme_mod('rit_color_blog_title_detail','#252525')) ?>
        }

        .header-post .post-date::before {
            background: <?php echo esc_attr(get_theme_mod('rit_color_blog_date_post','#c7b299')) ?>;
        }

        .post-date {
            color: <?php echo esc_attr(get_theme_mod('rit_color_blog_date_post','#c7b299')) ?>;
        }

        #main-navigation {
            background: <?php echo esc_attr(get_theme_mod('rit_nav_bg_color','transparent')) ?>;
            color: <?php echo esc_attr(get_theme_mod('rit_nav_text_color','#252525')) ?>;
        }

        #main-navigation > div:not(.cmm-container) > ul > li > a {
            color: <?php echo esc_attr($rit_main_link_color) ?>;
        }

        #main-navigation > div:not(.cmm-container) > ul > li:hover > a {
            color: <?php echo esc_attr(get_theme_mod('rit_nav_link_hover_color','#c7b299')) ?>;
        }

        #main-navigation > div:not(.cmm-container) > ul ul li {
            background: <?php echo esc_attr(get_theme_mod('rit_nav_sub_bg_color','#fff')) ?>;
        }

        #main-navigation > div:not(.cmm-container) > ul ul li:hover {
            background: <?php echo esc_attr(get_theme_mod('rit_nav_sub_bg_color_hover','#fff')) ?>;
        }

        #main-navigation > div:not(.cmm-container) > ul ul a {
            color: <?php echo esc_attr(get_theme_mod('rit_nav_sub_link_color','#252525')) ?>;
        }

        #main-navigation > div:not(.cmm-container) > ul ul li:hover > a {
            color: <?php echo esc_attr(get_theme_mod('rit_nav_sub_link_hover_color','#c7b299')) ?>;
        }

        /*End Color*/
        /*Header height*/
        <?php if(is_page()||is_single()){
        if(get_post_meta(get_the_ID(),'rit_header_height',true)!=''){
        ?>
        #rit-header.one-line .wrap-header-block .content-header-block {
            height: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_header_height',true))?>px
        }

        #rit-header.one-line .sticky-wrapper:not(.is-sticky) {
            height: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_header_height',true))?>px !important;
        }

        #rit-header.one-line .is-sticky .wrap-header-block.sticker .content-header-block {
            height: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_header_sticky_height',true))?>px
        }

        #rit-header.one-line .sticky-wrapper.is-sticky {
            height: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_header_sticky_height',true))?>px !important;
        }

        <?php } }?>
        /*End Header height*/
        /*Page bg*/
        <?php
        if(rit_fullwidth()){ ?>
        .container {
            width: 100% !important;
            padding: 0 15px;
        }

        <?php
        }else{
         if(get_post_meta(get_the_ID(),'rit_enable_large_width',true)!=''&& (is_page()||is_single())){
        ?>
        .container {
            width: 100%;
            max-width: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_enable_large_width',true))?>px;
        }

        <?php
        }
        else{
        ?>
        .container {
            width: 100%;
            max-width: <?php echo esc_attr(get_theme_mod('rit_enable_large_width','1170'))?>px;
        }

        <?php
        }
        }
           if(get_theme_mod('rit_body_bg_image','')!=''){
        ?>
        body {
            background: url('<?php echo esc_attr(get_theme_mod('rit_body_bg_image',''));?>') <?php echo esc_attr(get_theme_mod('rit_page_bg_repeat').'/'.get_theme_mod('rit_page_bg_size').' '.get_theme_mod('rit_page_bg_attachment'))?>;
        }

        <?php
        }
        if(get_theme_mod('rit_body_bg_color','')!=''){?>
        body {
            background-color: <?php echo esc_attr(get_theme_mod('rit_body_bg_color',''));?>
        }
        <?php
        }
    if(is_page()||is_single()){
    if(get_post_meta(get_the_ID(),'rit_page_bg',true)!=''){
    $bg_url=wp_get_attachment_image_src(get_post_meta(get_the_ID(),'rit_page_bg',true),'full');
    ?>
        body.page, body.single {
            background: url('<?php echo esc_url($bg_url[0]) ?>') top center repeat-y;
        }

        <?php }
            if(get_post_meta(get_the_ID(),'rit_page_bg_color',true)!=''){?>
        body.page, body.single {
            background-color: <?php echo esc_url(get_post_meta(get_the_ID(),'rit_page_bg_color',true)) ?>;
        }

        <?php
       }
    }
        ?>
        body {
            color: <?php echo esc_attr(get_theme_mod('rit_body_text_color','#454545'));?>
        }

        a {
            color: <?php echo esc_attr(get_theme_mod('rit_body_link_color','#454545'));?>
        }

        a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_body_link_hover_color','#c7b299'));?>
        }

        /*Woocommerce*/
        .woocommerce span.onsale {
            background: <?php echo esc_attr(get_theme_mod('rit_color_woo_sale_bg','#fff'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_sale','#252525'));?>;
        }

        .woocommerce input.quick-view.button {
            background: <?php echo esc_attr(get_theme_mod('rit_color_woo_qv_bg','#c7b299'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_qv','#fff'));?>;
        }

        .woocommerce input.quick-view.button:hover {
            background: <?php echo esc_attr(get_theme_mod('rit_color_woo_qv_bg_hover','#252525'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_qv_hover','#fff'));?>;
        }

        .woocommerce div.product .wrap-right-single-product .cart .button,
        .woocommerce ul.products li.product .added_to_cart, .added_to_cart,
        .woocommerce ul.products li.product a.button.btn {
            background: <?php echo esc_attr(get_theme_mod('rit_color_woo_addcart_bg','#c7b299'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_addcart','#fff'));?>;
        }

        .woocommerce div.product .wrap-right-single-product .cart .button:hover,
        .woocommerce ul.products li.product .added_to_cart:hover, .added_to_cart:hover {
            background: <?php echo esc_attr(get_theme_mod('rit_color_woo_addcart_bg_hover','#252525'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_addcart_hover','#fff'));?>;
        }

        /*Shop*/
        .woocommerce ul.products li.product .wrap-product-text > h3.product-name {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_title','#7d7d7d'));?>;
        }

        .woocommerce ul.products li.product .wrap-product-text > h3.product-name:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_title_hover','#c7b299'));?>;
        }

        .woocommerce .product p.price .amount, .woocommerce .product span.price .amount {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_price','#252525'));?>;
        }

        .woocommerce .product p.price del, .woocommerce .product span.price del {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_regular_price','#252525'));?>;
        }

        .woocommerce ul.products li.product .price ins {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_sale_price','#c7b299'));?>;
        }

        .low-stock-label {
            background-color: <?php echo esc_attr(get_theme_mod('rit_color_woo_label_lowstock_bg','#c7b299'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_label_lowstock','#fff'));?>;
        }

        .out-stock-label {
            background-color: <?php echo esc_attr(get_theme_mod('rit_color_woo_label_outstock_bg','#f39580'));?>;
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_label_outstock','#fff'));?>;
        }

        /*Single product*/
        .woocommerce div.product .wrap-right-single-product .product_title {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_title_detail','#252525'));?>;
        }

        .wrap-top-single-product {
            background: <?php echo esc_attr(get_theme_mod('rit_color_woo_bg_single','#f5f5f5'));?>;
        }

        .woocommerce div.product .wrap-right-single-product .price {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_single_price','#252525'));?>;
        }

        .woocommerce div.product .wrap-right-single-product .price del > .amount, .woocommerce div.product .wrap-right-single-product .price del {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_single_regular_price','#7d7d7d'));?>;
        }

        .woocommerce div.product .wrap-right-single-product .price > .amount, .woocommerce div.product .wrap-right-single-product .price ins > .amount, .woocommerce div.product .wrap-right-single-product .price ins {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_single_regular_price','#252525'));?>;
        }

        .woocommerce div.product .wrap-right-single-product .stock.in-stock {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_single_label_lowstock','#c7b299'));?>;
            border-color: <?php echo esc_attr(get_theme_mod('rit_color_woo_single_label_lowstock_border','#c7b299'));?>;
        }

        .woocommerce div.product .wrap-right-single-product .stock.out-of-stock {
            color: <?php echo esc_attr(get_theme_mod('rit_color_woo_single_label_outstock','#f39580'));?>;
            border-color: <?php echo esc_attr(get_theme_mod('rit_color_woo_single_label_outstock_border','#f39580'));?>;
        }

        /*End Woocommerce*/
        /*End Page bg*/
        /*Footer Bg*/
        <?php if(is_page()&&get_post_meta(get_the_ID(),'rit_enable_footer_color',true)=='1'){?>
        #footer-page {
            background: <?php echo esc_attr(rit_hex2rgba(get_post_meta(get_the_ID(),'rit_footer_bg_color',true),get_post_meta(get_the_ID(),'rit_footer_bg_color_opc',true))) ?>;
        }

        .main-footer-disable.default #copyright, .main-footer-disable.default .widget, #footer-page.one-line, #footer-page.one-line .footer-block, #footer-page.one-line .rit-widget-social-icon.icon li, #footer-page.one-line #copyright a {
            color: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_footer_color',true));?>
        }

        .main-footer-disable.default #bottom-footer .container::before, .wrap-main-footer::after {
            background: <?php echo esc_attr(rit_hex2rgba(get_post_meta(get_the_ID(),'rit_footer_bt_border_color',true),get_post_meta(get_the_ID(),'rit_footer_bt_border_color_opc',true))) ?>;
        }

        <?php
        if(get_post_meta(get_the_ID(),'rit_footer_link_color',true)!=''){
        ?>
        #main-footer a, #main-footer .widget li a, #top-footer a, #bottom-footer a, #copyright a, .bottom-footer-block a {
            color: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_footer_link_color',true));?>;
        }

        .rit-widget-social-icon.both i {
            color: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_footer_link_color',true));?>;
            background: none;
        }

        <?php
        }
        if(get_post_meta(get_the_ID(),'rit_footer_link_color_hover',true)!=''){
        ?>
        #main-footer a:hover, #main-footer .widget li a:hover, #top-footer a:hover, #bottom-footer a:hover, #copyright a:hover, .bottom-footer-block a:hover {
            color: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_footer_link_color_hover',true));?>;
        }

        .rit-widget-social-icon.both a:hover i {
            color: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_footer_link_color_hover',true));?>;
            background: none;
        }

        <?php
        }
        }else{
        ?>
        #main-footer {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_center_color','#7d7d7d'));?>;
            background: <?php echo esc_attr(get_theme_mod('rit_footer_center_bg','#fff'));?>;
        }

        #main-footer a, #main-footer .widget li a {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_center_link','#7d7d7d'));?>;
        }

        #main-footer a:hover, #main-footer .widget li a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_center_link_hover','#c7b299'));?>;
        }

        #top-footer {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_top_color','#7d7d7d'));?>;
            background: <?php echo esc_attr(get_theme_mod('rit_footer_top_bg','#fff'));?>;
        }

        #top-footer a {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_top_link','#7d7d7d'));?>;
        }

        #top-footer a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_top_link_hover','#c7b299'));?>;
        }

        #bottom-footer {
            background: <?php echo esc_attr(get_theme_mod('rit_footer_bottom_bg','#fff'));?>;
        }

        #bottom-footer, #copyright, #bottom-footer .textwidget {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_bottom_color','#7d7d7d'));?>;
        }

        #bottom-footer a, #copyright a, .bottom-footer-block a {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_bottom_color','#7d7d7d'));?>;
        }

        #bottom-footer a:hover, #copyright a:hover, .bottom-footer-block a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_bottom_link_hover','#c7b299'));?>;
        }

        <?php
        }

        $rit_title_footer_color=get_theme_mod('rit_footer_title_color','#252525');
        if(is_page()&&get_post_meta(get_the_ID(),'rit_enable_footer_color',true)=='1'&&get_post_meta(get_the_ID(),'rit_footer_title_color',true)!=''){
            $rit_title_footer_color=get_post_meta(get_the_ID(),'rit_footer_title_color',true);
        }
        ?>
        .widget-footer-title {
            color: <?php echo esc_attr($rit_title_footer_color)?>
        }

        <?php
        if(get_theme_mod('rit_enable_popup','1')==1){
            ?>
        #rit-popup {
            background: url('<?php echo esc_url(get_theme_mod('rit_popup_bg',''))?>') top center no-repeat <?php echo esc_url(get_theme_mod('rit_popup_bg_color','#fff'))?>;
            height: <?php echo esc_attr(get_theme_mod('rit_popup_height','740'))?>px;
            width: <?php echo esc_attr(get_theme_mod('rit_popup_width','600'))?>px;
        }

        <?php
    }
        ?>
        /*End Footer Bg*/
        <?php if(get_theme_mod( 'rit_custom_css' )) : ?>
        <?php echo get_theme_mod( 'rit_custom_css' ); ?>
        <?php endif; ?>

    </style>
    <?php
}

add_action('wp_head', 'rit_customizer_css');