<?php

add_action('wp_enqueue_scripts', 'sukawati_init_style');
add_action('wp_enqueue_scripts', 'sukawati_init_fonts');
add_action('wp_enqueue_scripts', 'sukawati_init_script');
add_action('wp_enqueue_scripts', 'sukawati_init_fonts');

/* ------------------------------------------------------------------------- *
 *  Load CSS
/* ------------------------------------------------------------------------- */
function sukawati_init_style() {
    if(!sukawati_is_login_page()) {

        $templateurl = get_template_directory_uri();

        wp_enqueue_style('wp-mediaelement',       null, SUKAWATI_VERSION);
        wp_enqueue_style('fontawesome',     $templateurl .'/css/fontawesome/css/font-awesome.min.css', null, SUKAWATI_VERSION);
        wp_enqueue_style('flexslider',      $templateurl .'/css/flexslider/flexslider.css', null, SUKAWATI_VERSION);
        wp_enqueue_style('owlcarousel',     $templateurl .'/js/owl-carousel2/assets/owl.carousel.css', null, SUKAWATI_VERSION);
        wp_enqueue_style('owltheme',        $templateurl .'/js/owl-carousel2/assets/owl.theme.default.css', null, SUKAWATI_VERSION);
        wp_enqueue_style('jscrollpane',     $templateurl .'/css/jscrollpane/jquery.jscrollpane.css', null, SUKAWATI_VERSION);
        wp_enqueue_style('woocommerce',     $templateurl .'/css/woo.css', null, SUKAWATI_VERSION);

        wp_enqueue_style('sukawati-main-style',  get_stylesheet_uri() , null, SUKAWATI_VERSION);
        wp_enqueue_style('sukawati-responsive',  $templateurl .'/css/responsive.css', null, SUKAWATI_VERSION);

        $additionalcss = sukawati_customizer_style();
        wp_add_inline_style( 'sukawati-main-style',  $additionalcss);
    }
}

/* ------------------------------------------------------------------------- *
 *  Load Javascripts
/* ------------------------------------------------------------------------- */
function sukawati_init_script () {

    $templateurl = get_template_directory_uri();

    if(!sukawati_is_login_page()) {
        wp_enqueue_script( 'wp-mediaelement' );
        wp_enqueue_script( 'hoverintent', $templateurl .'/js/jquery.hoverIntent.js', null, SUKAWATI_VERSION, true);
        wp_enqueue_script( 'flexslider', $templateurl .'/js/jquery.flexslider-min.js', null, SUKAWATI_VERSION, true);
        wp_enqueue_script( 'owlcarousel', $templateurl .'/js/owl-carousel2/owl.carousel.js', null, SUKAWATI_VERSION, true);
        wp_enqueue_script( 'sticky-sidebar', $templateurl .'/js/theia-sticky-sidebar.js', null, SUKAWATI_VERSION, true);
        wp_enqueue_script( 'waypoints', $templateurl . '/js/waypoints.js', null, SUKAWATI_VERSION, true);
        wp_enqueue_script( 'jscrollpane', $templateurl . '/js/jquery.jscrollpane.min.js', null, SUKAWATI_VERSION, true);
        wp_enqueue_script( 'mousewheel', $templateurl . '/js/jquery.mousewheel.js', null, SUKAWATI_VERSION, true);
        wp_enqueue_script( 'sukawati-main' , $templateurl .'/js/main.js', null, SUKAWATI_VERSION, true);

        wp_enqueue_script( 'html5shiv',      $templateurl . '/js/html5shiv.js', null, SUKAWATI_VERSION, true );
        wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

        // Homepage
        if (is_page_template( 'template-home.php' ) || vp_option('joption.archives_content_layout') == 'masonry' ) {
            wp_enqueue_script( 'isotope', $templateurl . '/js/jquery.isotope.min.js', null, SUKAWATI_VERSION, true );
            wp_enqueue_script( 'imagesloaded', $templateurl . '/js/imagesloaded.pkgd.min.js', null, SUKAWATI_VERSION, true );
        }

        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

        wp_localize_script('sukawati-main', 'joption', sukawati_get_admin_js_option());
    }
}


function sukawati_get_admin_js_option() {
    $option = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    );
    $option['sticky'] = apply_filters('sukawati_sticky_header', vp_option('joption.sticky_menu'));
    $option['headerlayout'] = vp_option('joption.header_layout');
    $option['headerheight'] = get_theme_mod( 'header2_height' );
    return $option;
}


/* ------------------------------------------------------------------------- *
 *  Fonts Customizer
/* ------------------------------------------------------------------------- */

// url example : https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Playfair+Display:400normal,italic
function sukawati_init_fonts() {
    $fonts = sukawati_get_mods_fonts();

    foreach ( $fonts as $key => $font ) {
        if ( $fonts[$key] === 'default' || empty($fonts[ $key ]) ) {
            unset( $fonts[ $key ] );
            continue;
        }
        $fonts[ $key ] = $fonts[ $key ] . ":400,400italic,700";
    }


    $fullfonturl = add_query_arg( array(
        'family' =>  implode('%7C', $fonts),
        'subset' => urlencode( 'latin,latin-ext' ),
    ) , "//fonts.googleapis.com/css" );
    wp_enqueue_style ('sukawati_font', $fullfonturl , null, null);
}

function sukawati_cuztomize_fonts() {
    $fonts = sukawati_get_mods_fonts(); ?>

    <?php if( $fonts['body'] != 'default' && !empty($fonts['body']) ) : ?>
    /*** Global Font ***/
        body, input, textarea, button, select, label {
            font-family: '<?php echo esc_attr( $fonts['body'] ) ?>';
        }
    <?php endif; ?>

    <?php if( $fonts['heading'] != 'default' && !empty($fonts['heading']) ) : ?>
    /*** Heading ***/
        article .content-title, .meta-article-header, .widget h1.widget-title, .footerwidget-title h3, .entry h1, .entry h2, .entry h3, .entry h4, .entry h5, .entry h6, .line-heading, h1, h2, h3, h4, h5,h6, .entry blockquote,
        #search-overlay .searchform #s {
            font-family: '<?php echo esc_attr( $fonts['heading'] ) ?>';
        }
    <?php endif; ?>

    <?php if( $fonts['menu'] != 'default' && !empty($fonts['menu']) ) : ?>
    /*** Menu ***/
        #heading .navigation, #heading .mobile-menu, .content-meta, .content-meta-bottom, .fullslider .slider-excerpt .meta-category,  .paging span, .paging a,
        .related .content span, .category-header span,
        .paging .nav-normal span,
        .highlightslider .readmore
        {
            font-family: '<?php echo esc_attr( $fonts['menu'] ) ?>';
        }
    <?php endif;
}

function sukawati_get_fontweight( $fontweightstyle ) {
    $fontweight = '400';
    $fontstyle  = 'normal';

    if ( $fontweightstyle == 'regular' ) {
        $fontweight = '400';
    } elseif ( $fontweightstyle == 'italic' ) {
        $fontweight = '400';
        $fontstyle  = 'italic';
    } elseif ( strpos( $fontweightstyle, 'italic' ) ) {
        $fontweight = str_replace( 'italic', '', $fontweightstyle );
        $fontstyle  = 'italic';
    } ?>

    font-weight: <?php echo esc_attr( $fontweight ) ?>;
    font-style: <?php echo esc_attr( $fontstyle ) ?>;

    <?php
}

function sukawati_get_mods_fonts() {

    $fonts = array(
        'body' => get_theme_mod( 'font_family_body' ),
        'heading' => get_theme_mod( 'font_family_heading' ),
        'menu' => get_theme_mod( 'font_family_menu' ),
    );


    if( $fonts['body'] === 'default' || empty($fonts['body']) ) $fonts['body'] = 'Raleway';
    if( $fonts['heading'] === 'default' || empty($fonts['heading'])) $fonts['heading'] = 'Playfair Display';
    if( $fonts['menu'] === 'default' || empty($fonts['menu']))  $fonts['menu'] = 'Montserrat';


    return $fonts;
}

/* ------------------------------------------------------------------------- *
 *  Customizer Style
/* ------------------------------------------------------------------------- */
function sukawati_customizer_style() {
    ob_start();
    ?>
    <?php if ( get_theme_mod( 'text_color' ) ) { ?>body {color: <?php echo esc_html(get_theme_mod( 'text_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'link_color' ) ) { ?>a {color: <?php echo esc_html(get_theme_mod( 'link_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'link_hover_color' ) ) { ?>a:hover {color: <?php echo esc_html(get_theme_mod( 'link_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'accent_color' ) ) { ?>
        a,
        #popular-post .owl-controls .owl-buttons div:hover,
        .jeg-social-widget li a:hover,
        .widget_sukawati_about_me a,
        #related-post .content-meta a,
        .category-header h2,
        .paging a:hover, .paging .nav-older:hover span:after, .paging .nav-newer:hover span:before,
        .page-numbers.current,
        a.readmore:hover,
        .highlightslider .readmore:hover,
        #heading .mobile-menu a:hover, #heading .mobile-menu a:active
        {
            color: <?php echo esc_html(get_theme_mod( 'accent_color' )) ?>;
        }

        .fullslider .slider-excerpt h2:after,
        #popular-post .owl-controls .owl-buttons div:hover,
        a.readmore, .highlightslider .readmore,
        .flex-control-paging li a.flex-active, .flex-control-paging li a:hover,
        .widget .widget-title,
        input[type="submit"]:hover, button[type="submit"]:hover,
        .paging a:hover, .paging .nav-older:hover span:after, .paging .nav-newer:hover span:before
        {
            border-color: <?php echo esc_html(get_theme_mod( 'accent_color' )) ?>;
        }

        .content-separator, .content-separator:before, .content-separator:after,
        .highlightslider .slider-excerpt .line, .highlightslider .slider-excerpt .line:before, .highlightslider .slider-excerpt .line:after,
        .flex-control-paging li a.flex-active, .flex-control-paging li a:hover,
        .widget_tag_cloud a:hover,
        input[type="submit"]:hover, button[type="submit"]:hover,
        .commentlist .reply a:hover
        {
            background: <?php echo esc_html(get_theme_mod( 'accent_color' )) ?>;
        }

    <?php } ?>

    /***  HEADER LAYOUT 1  ***/
    #heading.first-nav .logo-wrapper a {padding: <?php echo esc_html(get_theme_mod( 'header1_logo_padding_top', 80 )) ?>px 0 <?php echo esc_html(get_theme_mod( 'header1_logo_padding_bottom', 60 )) ?>px}
    <?php if ( get_theme_mod( 'header1_bg' ) ) { ?>#heading.first-nav .logo-wrapper {background: <?php echo esc_html(get_theme_mod( 'header1_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header1_menubar_bg' ) ) { ?>#heading.first-nav .nav-wrapper {background: <?php echo esc_html(get_theme_mod( 'header1_menubar_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_menubar_border' ) ) { ?>#heading.first-nav .nav-wrapper {border-color: <?php echo esc_html(get_theme_mod( 'header1_menubar_border' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_menu_color' ) ) { ?>#heading.first-nav .navigation > ul > li > a {color: <?php echo esc_html(get_theme_mod( 'header1_menu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_menu_hover_color' ) ) { ?>#heading.first-nav .navigation > ul > li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header1_menu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_menu_hover_bg' ) ) { ?>#heading.first-nav .navigation > ul > li:hover {background: <?php echo esc_html(get_theme_mod( 'header1_menu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header1_submenu_bg' ) ) { ?>#heading.first-nav .navigation .sub-menu {background: <?php echo esc_html(get_theme_mod( 'header1_submenu_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_submenu_line' ) ) { ?>#heading.first-nav .navigation .sub-menu, #heading.first-nav .navigation .sub-menu li{border-color: <?php echo esc_html(get_theme_mod( 'header1_submenu_line' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_submenu_color' ) ) { ?>#heading.first-nav .navigation .sub-menu li a {color: <?php echo esc_html(get_theme_mod( 'header1_submenu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_submenu_hover_color' ) ) { ?>#heading.first-nav .navigation .sub-menu li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header1_submenu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_submenu_hover_bg' ) ) { ?>#heading.first-nav .navigation .sub-menu li:hover {background: <?php echo esc_html(get_theme_mod( 'header1_submenu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header1_search_color' ) ) { ?>#heading.first-nav .nav-search i {color: <?php echo esc_html(get_theme_mod( 'header1_search_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_search_bg' ) ) { ?>#heading.first-nav .nav-search {background: <?php echo esc_html(get_theme_mod( 'header1_search_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_search_border' ) ) { ?>#heading.first-nav .nav-search {border-color: <?php echo esc_html(get_theme_mod( 'header1_search_border' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header1_social_color' ) ) { ?>#heading.first-nav .nav-social li a {color: <?php echo esc_html(get_theme_mod( 'header1_social_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_social_hover_color' ) ) { ?>#heading.first-nav .nav-social li a:hover {color: <?php echo esc_html(get_theme_mod( 'header1_social_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_social_hover_bg' ) ) { ?>#heading.first-nav .nav-social li a:hover {background: <?php echo esc_html(get_theme_mod( 'header1_social_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header1_cart_color' ) ) { ?>#heading.first-nav .side-woocommerce .fa {color: <?php echo esc_html(get_theme_mod( 'header1_cart_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_cart_background_color' ) ) { ?>#heading.first-nav .side-woocommerce .fa {background: <?php echo esc_html(get_theme_mod( 'header1_cart_background_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header1_cart_border' ) ) { ?>#heading.first-nav .side-woocommerce {border-color: <?php echo esc_html(get_theme_mod( 'header1_cart_border' )) ?>;}<?php } ?>

    /***  HEADER LAYOUT 2  ***/
    <?php if ( get_theme_mod( 'header2_height' ) ) { ?>#heading.second-nav .navigation > ul > li, #heading.second-nav .navigation > ul > li > a, #heading.second-nav .logo-wrapper, #heading.second-nav .nav-search i, #heading.second-nav .mobile-navigation i, #heading.second-nav .sidefeed-toggle .fa, #heading.second-nav .side-woocommerce .fa {line-height: <?php echo esc_html(get_theme_mod( 'header2_height' )) ?>px;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_height' ) ) { ?>#heading.second-nav .mobile-menu { top: <?php echo esc_html(get_theme_mod( 'header2_height' )) ?>px; }<?php } ?>
    <?php if ( get_theme_mod( 'header2_bg' ) ) { ?>#heading.second-nav .nav-wrapper {background: <?php echo esc_html(get_theme_mod( 'header2_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_border' ) ) { ?>#heading.second-nav .nav-wrapper {border-color: <?php echo esc_html(get_theme_mod( 'header2_border' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header2_menu_color' ) ) { ?>#heading.second-nav .navigation > ul > li > a {color: <?php echo esc_html(get_theme_mod( 'header2_menu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_menu_hover_color' ) ) { ?>#heading.second-nav .navigation > ul > li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header2_menu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_menu_hover_bg' ) ) { ?>#heading.second-nav .navigation > ul > li:hover {background: <?php echo esc_html(get_theme_mod( 'header2_menu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header2_submenu_bg' ) ) { ?>#heading.second-nav .navigation .sub-menu {background: <?php echo esc_html(get_theme_mod( 'header2_submenu_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_submenu_line' ) ) { ?>#heading.second-nav .navigation .sub-menu,, #heading.second-nav .navigation .sub-menu li{border-color: <?php echo esc_html(get_theme_mod( 'header2_submenu_line' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_submenu_color' ) ) { ?>#heading.second-nav .navigation .sub-menu li a {color: <?php echo esc_html(get_theme_mod( 'header2_submenu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_submenu_hover_color' ) ) { ?>#heading.second-nav .navigation .sub-menu li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header2_submenu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_submenu_hover_bg' ) ) { ?>#heading.second-nav .navigation .sub-menu li:hover {background: <?php echo esc_html(get_theme_mod( 'header2_submenu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header2_search_color' ) ) { ?>#heading.second-nav .nav-search i {color: <?php echo esc_html(get_theme_mod( 'header2_search_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header2_cart_color' ) ) { ?>#heading.second-nav .side-woocommerce .fa {color: <?php echo esc_html(get_theme_mod( 'header2_cart_color' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header2_separator_border' ) ) { ?>#heading.second-nav .nav-search:before, #heading.second-nav .sidefeed-toggle:before, #heading.second-nav .side-woocommerce:before   {border-color: <?php echo esc_html(get_theme_mod( 'header2_separator_border' )) ?>;}<?php } ?>

    /***  HEADER LAYOUT 3  ***/
    #heading.third-nav .logo-wrapper {padding: <?php echo esc_html(get_theme_mod( 'header3_logo_padding_top', 80 )) ?>px 0 <?php echo esc_html(get_theme_mod( 'header3_logo_padding_bottom', 80 )) ?>px}
    <?php if ( get_theme_mod( 'header3_bg' ) ) { ?>#heading.third-nav .logo-wrapper {background: <?php echo esc_html(get_theme_mod( 'header3_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header3_menubar_bg' ) ) { ?>#heading.third-nav .nav-wrapper {background: <?php echo esc_html(get_theme_mod( 'header3_menubar_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_menubar_border' ) ) { ?>#heading.third-nav .nav-wrapper {border-color: <?php echo esc_html(get_theme_mod( 'header3_menubar_border' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_menu_color' ) ) { ?>#heading.third-nav .navigation > ul > li > a {color: <?php echo esc_html(get_theme_mod( 'header3_menu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_menu_hover_color' ) ) { ?>#heading.third-nav .navigation > ul > li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header3_menu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_menu_hover_bg' ) ) { ?>#heading.third-nav .navigation > ul > li:hover {background: <?php echo esc_html(get_theme_mod( 'header3_menu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header3_submenu_bg' ) ) { ?>#heading.third-nav .navigation .sub-menu {background: <?php echo esc_html(get_theme_mod( 'header3_submenu_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_submenu_line' ) ) { ?>#heading.third-nav .navigation .sub-menu, #heading.third-nav .navigation .sub-menu li{border-color: <?php echo esc_html(get_theme_mod( 'header3_submenu_line' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_submenu_color' ) ) { ?>#heading.third-nav .navigation .sub-menu li a {color: <?php echo esc_html(get_theme_mod( 'header3_submenu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_submenu_hover_color' ) ) { ?>#heading.third-nav .navigation .sub-menu li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header3_submenu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_submenu_hover_bg' ) ) { ?>#heading.third-nav .navigation .sub-menu li:hover {background: <?php echo esc_html(get_theme_mod( 'header3_submenu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header3_search_color' ) ) { ?>#heading.third-nav .nav-search i {color: <?php echo esc_html(get_theme_mod( 'header3_search_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_search_bg' ) ) { ?>#heading.third-nav .nav-search {background: <?php echo esc_html(get_theme_mod( 'header3_search_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_search_border' ) ) { ?>#heading.third-nav .nav-search {border-color: <?php echo esc_html(get_theme_mod( 'header3_search_border' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header3_cart_color' ) ) { ?>#heading.third-nav .side-woocommerce .fa {color: <?php echo esc_html(get_theme_mod( 'header3_cart_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_cart_background_color' ) ) { ?>#heading.third-nav .side-woocommerce .fa {background: <?php echo esc_html(get_theme_mod( 'header3_cart_background_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_cart_border' ) ) { ?>#heading.third-nav .side-woocommerce {border-color: <?php echo esc_html(get_theme_mod( 'header3_cart_border' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header3_social_color' ) ) { ?>#heading.third-nav .nav-social li a {color: <?php echo esc_html(get_theme_mod( 'header3_social_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_social_hover_color' ) ) { ?>#heading.third-nav .nav-social li a:hover {color: <?php echo esc_html(get_theme_mod( 'header3_social_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header3_social_hover_bg' ) ) { ?>#heading.third-nav .nav-social li a:hover {background: <?php echo esc_html(get_theme_mod( 'header3_social_hover_bg' )) ?>;}<?php } ?>

    /***  HEADER LAYOUT 4  ***/
    #heading.four-nav .logo-wrapper {padding: <?php echo esc_html(get_theme_mod( 'header4_logo_padding_top', 80 )) ?>px 0 <?php echo esc_html(get_theme_mod( 'header4_logo_padding_bottom', 80 )) ?>px}
    <?php if ( get_theme_mod( 'header4_bg' ) ) { ?>#heading.four-nav .nav-wrapper {background: <?php echo esc_html(get_theme_mod( 'header4_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header4_menubar_bg' ) ) { ?>#heading.four-nav .nav-wrapper {background: <?php echo esc_html(get_theme_mod( 'header4_menubar_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_menubar_border' ) ) { ?>#heading.four-nav .nav-wrapper {border-color: <?php echo esc_html(get_theme_mod( 'header4_menubar_border' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_menu_color' ) ) { ?>#heading.four-nav .navigation > ul > li > a {color: <?php echo esc_html(get_theme_mod( 'header4_menu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_menu_hover_color' ) ) { ?>#heading.four-nav .navigation > ul > li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header4_menu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_menu_hover_bg' ) ) { ?>#heading.four-nav .navigation > ul > li:hover {background: <?php echo esc_html(get_theme_mod( 'header4_menu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header4_submenu_bg' ) ) { ?>#heading.four-nav .navigation .sub-menu {background: <?php echo esc_html(get_theme_mod( 'header4_submenu_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_submenu_line' ) ) { ?>#heading.four-nav .navigation .sub-menu, #heading.four-nav .navigation .sub-menu li{border-color: <?php echo esc_html(get_theme_mod( 'header4_submenu_line' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_submenu_color' ) ) { ?>#heading.four-nav .navigation .sub-menu li a {color: <?php echo esc_html(get_theme_mod( 'header4_submenu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_submenu_hover_color' ) ) { ?>#heading.four-nav .navigation .sub-menu li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header4_submenu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_submenu_hover_bg' ) ) { ?>#heading.four-nav .navigation .sub-menu li:hover {background: <?php echo esc_html(get_theme_mod( 'header4_submenu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header4_search_color' ) ) { ?>#heading.four-nav .nav-search i {color: <?php echo esc_html(get_theme_mod( 'header4_search_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_search_bg' ) ) { ?>#heading.four-nav .nav-search {background: <?php echo esc_html(get_theme_mod( 'header4_search_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_search_border' ) ) { ?>#heading.four-nav .nav-search {border-color: <?php echo esc_html(get_theme_mod( 'header4_search_border' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header4_cart_color' ) ) { ?>#heading.four-nav .side-woocommerce .fa {color: <?php echo esc_html(get_theme_mod( 'header4_cart_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_cart_background_color' ) ) { ?>#heading.four-nav .side-woocommerce .fa {background: <?php echo esc_html(get_theme_mod( 'header4_cart_background_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_cart_border' ) ) { ?>#heading.four-nav .side-woocommerce {border-color: <?php echo esc_html(get_theme_mod( 'header4_cart_border' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header4_social_color' ) ) { ?>#heading.four-nav .nav-social li a {color: <?php echo esc_html(get_theme_mod( 'header4_social_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_social_hover_color' ) ) { ?>#heading.four-nav .nav-social li a:hover {color: <?php echo esc_html(get_theme_mod( 'header4_social_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header4_social_hover_bg' ) ) { ?>#heading.four-nav .nav-social li a:hover {background: <?php echo esc_html(get_theme_mod( 'header4_social_hover_bg' )) ?>;}<?php } ?>

    /***  HEADER LAYOUT 5  ***/
    #heading.fifth-nav .logo-wrapper {padding: <?php echo esc_html(get_theme_mod( 'header5_logo_padding_top', 80 )) ?>px 0 <?php echo esc_html(get_theme_mod( 'header5_logo_padding_bottom', 80 )) ?>px}
    <?php if ( get_theme_mod( 'header5_bg' ) ) { ?>#heading.fifth-nav .top-wrapper {background: <?php echo esc_html(get_theme_mod( 'header5_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header5_menubar_bg' ) ) { ?>#heading.fifth-nav .nav-wrapper {background: <?php echo esc_html(get_theme_mod( 'header5_menubar_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_menubar_border' ) ) { ?>#heading.fifth-nav .nav-wrapper {border-color: <?php echo esc_html(get_theme_mod( 'header5_menubar_border' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_menu_color' ) ) { ?>#heading.fifth-nav .navigation > ul > li > a {color: <?php echo esc_html(get_theme_mod( 'header5_menu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_menu_hover_color' ) ) { ?>#heading.fifth-nav .navigation > ul > li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header5_menu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_menu_hover_bg' ) ) { ?>#heading.fifth-nav .navigation > ul > li:hover {background: <?php echo esc_html(get_theme_mod( 'header5_menu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header5_submenu_bg' ) ) { ?>#heading.fifth-nav .navigation .sub-menu {background: <?php echo esc_html(get_theme_mod( 'header5_submenu_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_submenu_line' ) ) { ?>#heading.fifth-nav .navigation .sub-menu, #heading.fifth-nav .navigation .sub-menu li{border-color: <?php echo esc_html(get_theme_mod( 'header5_submenu_line' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_submenu_color' ) ) { ?>#heading.fifth-nav .navigation .sub-menu li a {color: <?php echo esc_html(get_theme_mod( 'header5_submenu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_submenu_hover_color' ) ) { ?>#heading.fifth-nav .navigation .sub-menu li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header5_submenu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_submenu_hover_bg' ) ) { ?>#heading.fifth-nav .navigation .sub-menu li:hover {background: <?php echo esc_html(get_theme_mod( 'header5_submenu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header5_search_color' ) ) { ?>#heading.fifth-nav .nav-search i {color: <?php echo esc_html(get_theme_mod( 'header5_search_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_search_bg' ) ) { ?>#heading.fifth-nav .nav-search {background: <?php echo esc_html(get_theme_mod( 'header5_search_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_search_border' ) ) { ?>#heading.fifth-nav .nav-search {border-color: <?php echo esc_html(get_theme_mod( 'header5_search_border' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header5_cart_color' ) ) { ?>#heading.fifth-nav .side-woocommerce .fa {color: <?php echo esc_html(get_theme_mod( 'header5_cart_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_cart_background_color' ) ) { ?>#heading.fifth-nav .side-woocommerce .fa {background: <?php echo esc_html(get_theme_mod( 'header5_cart_background_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_cart_border' ) ) { ?>#heading.fifth-nav .side-woocommerce {border-color: <?php echo esc_html(get_theme_mod( 'header5_cart_border' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header5_social_color' ) ) { ?>#heading.fifth-nav .nav-social li a {color: <?php echo esc_html(get_theme_mod( 'header5_social_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_social_hover_color' ) ) { ?>#heading.fifth-nav .nav-social li a:hover {color: <?php echo esc_html(get_theme_mod( 'header5_social_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header5_social_hover_bg' ) ) { ?>#heading.fifth-nav .nav-social li a:hover {background: <?php echo esc_html(get_theme_mod( 'header5_social_hover_bg' )) ?>;}<?php } ?>

    /***  HEADER LAYOUT 6  ***/
    <?php if ( get_theme_mod( 'header6_line_height' ) ) { ?> #heading.sixth-nav .nav-header .nav-social, #heading.sixth-nav .nav-header .nav-search, #heading.sixth-nav .nav-header .logo-wrapper { line-height: <?php echo esc_html(get_theme_mod( 'header6_line_height', 225 )) ?>px; } <?php } ?>

    <?php if ( get_theme_mod( 'header6_bg' ) ) { ?>#heading.sixth-nav .top-wrapper {background: <?php echo esc_html(get_theme_mod( 'header6_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_menubar_bg' ) ) { ?>#heading.sixth-nav .nav-wrapper {background: <?php echo esc_html(get_theme_mod( 'header6_menubar_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_menubar_border' ) ) { ?>#heading.sixth-nav .nav-wrapper {border-color: <?php echo esc_html(get_theme_mod( 'header6_menubar_border' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_menu_color' ) ) { ?>#heading.sixth-nav .navigation > ul > li > a {color: <?php echo esc_html(get_theme_mod( 'header6_menu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_menu_hover_color' ) ) { ?>#heading.sixth-nav .navigation > ul > li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header6_menu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_menu_hover_bg' ) ) { ?>#heading.sixth-nav .navigation > ul > li:hover {background: <?php echo esc_html(get_theme_mod( 'header6_menu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header6_submenu_bg' ) ) { ?>#heading.sixth-nav .navigation .sub-menu {background: <?php echo esc_html(get_theme_mod( 'header6_submenu_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_submenu_line' ) ) { ?>#heading.sixth-nav .navigation .sub-menu, #heading.sixth-nav .navigation .sub-menu li{border-color: <?php echo esc_html(get_theme_mod( 'header6_submenu_line' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_submenu_color' ) ) { ?>#heading.sixth-nav .navigation .sub-menu li a {color: <?php echo esc_html(get_theme_mod( 'header6_submenu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_submenu_hover_color' ) ) { ?>#heading.sixth-nav .navigation .sub-menu li:hover > a {color: <?php echo esc_html(get_theme_mod( 'header6_submenu_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_submenu_hover_bg' ) ) { ?>#heading.sixth-nav .navigation .sub-menu li:hover {background: <?php echo esc_html(get_theme_mod( 'header6_submenu_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header6_social_color' ) ) { ?>#heading.sixth-nav .nav-social li a {color: <?php echo esc_html(get_theme_mod( 'header6_social_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_social_hover_color' ) ) { ?>#heading.sixth-nav .nav-social li a:hover {color: <?php echo esc_html(get_theme_mod( 'header6_social_hover_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_social_hover_bg' ) ) { ?>#heading.sixth-nav .nav-social li a:hover {background: <?php echo esc_html(get_theme_mod( 'header6_social_hover_bg' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header6_search_text_color' ) ) { ?>#heading.sixth-nav .nav-search input {color: <?php echo esc_html(get_theme_mod( 'header6_search_text_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_search_bg_color' ) ) { ?>#heading.sixth-nav .nav-search input {background: <?php echo esc_html(get_theme_mod( 'header6_search_bg_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_search_border_color' ) ) { ?>#heading.sixth-nav .nav-search input {border: 1px solid <?php echo esc_html(get_theme_mod( 'header6_search_border_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_search_border_hover_color' ) ) { ?>#heading.sixth-nav .nav-search input:focus {border: 1px solid <?php echo esc_html(get_theme_mod( 'header6_search_border_hover_color' )) ?>;}<?php } ?>

    <?php if ( get_theme_mod( 'header6_cart_color' ) ) { ?>#heading.sixth-nav .side-woocommerce .fa {color: <?php echo esc_html(get_theme_mod( 'header6_cart_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_cart_background_color' ) ) { ?>#heading.sixth-nav .side-woocommerce .fa {background: <?php echo esc_html(get_theme_mod( 'header6_cart_background_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'header6_cart_border' ) ) { ?>#heading.sixth-nav .side-woocommerce {border-color: <?php echo esc_html(get_theme_mod( 'header6_cart_border' )) ?>;}<?php } ?>

    /***  MOBILE  ***/
    <?php if ( get_theme_mod( 'mobile_menu_bg' ) ) { ?>#heading .mobile-menu {background: <?php echo esc_html(get_theme_mod( 'mobile_menu_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'mobile_menu_toggle' ) ) { ?>#heading .mobile-navigation i {color: <?php echo esc_html(get_theme_mod( 'mobile_menu_toggle' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'mobile_menu_color' ) ) { ?>#heading .mobile-menu a {color: <?php echo esc_html(get_theme_mod( 'mobile_menu_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'mobile_submenu_bg' ) ) { ?>#heading .mobile-menu .sub-menu li {background: <?php echo esc_html(get_theme_mod( 'mobile_submenu_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'mobile_menu_line' ) ) { ?>#heading .mobile-menu a, #heading .mobile-menu {border-color: <?php echo esc_html(get_theme_mod( 'mobile_menu_line' )) ?>;}<?php } ?>

    /***  SIDEBAR  ***/
    <?php if ( get_theme_mod( 'sidebar_heading_color' ) ) { ?>.widget .widget-title {color: <?php echo esc_html(get_theme_mod( 'sidebar_heading_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'sidebar_heading_bg' ) ) { ?>.widget .widget-title {border-color: <?php echo esc_html(get_theme_mod( 'sidebar_heading_bg' )) ?>;}<?php } ?>

    /***  FOOTER  ***/
    <?php if ( get_theme_mod( 'footer_bg' ) ) { ?>.footer-bottom {background: <?php echo esc_html(get_theme_mod( 'footer_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'footer_text_color' ) ) { ?>#footer .social-copy {color: <?php echo esc_html(get_theme_mod( 'footer_text_color' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'footer_gototop_bg' ) ) { ?>.gototop {background: <?php echo esc_html(get_theme_mod( 'footer_gototop_bg' )) ?>;}<?php } ?>
    <?php if ( get_theme_mod( 'footer_gototop_text' ) ) { ?>.gototop {color: <?php echo esc_html(get_theme_mod( 'footer_gototop_text' )) ?>;}<?php } ?>

    /***  WEBSITE BACKGROUND  ***/
    <?php if( get_theme_mod('website_color_background') ) { ?>body { background-color: <?php echo esc_html(get_theme_mod('website_color_background')); ?>; }<?php } ?>
    <?php if( get_theme_mod('website_image_background') && vp_option('joption.page_layout', 'boxed') == 'boxed') {
        $backgroundimage = get_theme_mod('website_image_background');
        if(ctype_digit($backgroundimage) || is_int($backgroundimage)) {
            $backgroundimage = sukawati_get_image_src($backgroundimage, "full"); ?>

            body { background-image: url('<?php echo esc_html( $backgroundimage ); ?>'); }
            <?php if( get_theme_mod('website_background_repeat') ) { ?>body { background-repeat: <?php echo esc_html(get_theme_mod('website_background_repeat')); ?>; }<?php } ?>
            <?php if( get_theme_mod('website_background_fullscreen') ) { ?>
                body { background-attachment: fixed; -webkit-background-size: cover; -o-background-size: cover; -moz-background-size: cover; background-size: cover; }
            <?php } ?>

            body { background-position: <?php echo esc_html(get_theme_mod('website_background_vertical_position', 'center')); ?> <?php echo esc_html(get_theme_mod('website_background_horizontal_position', 'center')); ?>; }
            <?php
        }
    }
    ?>

    /***  CUSTOM FONTS  ***/
    <?php sukawati_cuztomize_fonts(); ?>

    /***  CUSTOM CSS  ***/
    <?php if( vp_option('joption.custom_css') ) { echo esc_html(vp_option('joption.custom_css')); }?>

    <?php
    return ob_get_clean();
}
