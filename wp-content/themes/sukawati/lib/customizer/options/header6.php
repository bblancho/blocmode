<?php

global $wp_customize;

/*** Header Layout 1 **/
new Sukawati_Customizer_Framework(array(
    'name'          => 'jeg_option_header6',
    'title'         => 'Header - Layout 6',
    'priority'      => 8,
    'description'   => 'Customize color & style for Header Layout 6'
), array(

    array(
        'type'      => 'slider',
        'name'      => 'header6_line_height',
        'title'     => 'Header Line Height',
        'transport' => 'refresh',
        'default'   => 225,
        'min'       => 100,
        'max'       => 500,
        'step'      => 5
    ),

    array(
        'type'      => 'color',
        'name'      => 'header6_bg',
        'title'     => 'Header Background',
        'transport' => 'refresh',
        'default'   => null,
    ),

    array(
        'type'      => 'color',
        'name'      => 'header6_menubar_bg',
        'title'     => 'Menubar Background',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_menubar_border',
        'title'     => 'Menubar Border Color',
        'transport' => 'refresh',
        'default'   => null,
    ),

    array(
        'type'      => 'subtitle',
        'name'      => 'header6_menu_title',
        'title'     => 'Menu',
        'description' => 'Top menu color options.'
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_menu_color',
        'title'     => 'Menu Text Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_menu_hover_color',
        'title'     => 'Menu Hover Text Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_menu_hover_bg',
        'title'     => 'Menu Hover Background',
        'transport' => 'refresh',
        'default'   => null,
    ),


    array(
        'type'      => 'subtitle',
        'name'      => 'header6_submenu_title',
        'title'     => 'Sub Menu',
        'description' => 'Sub menu color options.'
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_submenu_bg',
        'title'     => 'Sub Menu Background',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_submenu_line',
        'title'     => 'Sub Menu Line Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_submenu_color',
        'title'     => 'Sub Menu Text Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_submenu_hover_color',
        'title'     => 'Sub Menu Hover Text Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_submenu_hover_bg',
        'title'     => 'Sub Menu Hover Background',
        'transport' => 'refresh',
        'default'   => null,
    ),

    array(
        'type'      => 'subtitle',
        'name'      => 'header6_social_title',
        'title'     => 'Social Icon',
        'description' => 'Top social icon color options.'
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_social_color',
        'title'     => 'Social Icon Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_social_hover_color',
        'title'     => 'Social Icon Hover Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_social_hover_bg',
        'title'     => 'Social Icon Hover Background',
        'transport' => 'refresh',
        'default'   => null,
    ),


    array(
        'type'      => 'subtitle',
        'name'      => 'header6_search_bar',
        'title'     => 'Search Bar',
        'description' => 'Search bar color options.'
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_search_text_color',
        'title'     => 'Search text color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_search_bg_color',
        'title'     => 'Search background color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_search_border_color',
        'title'     => 'Search border color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_search_border_hover_color',
        'title'     => 'Search border hover color',
        'transport' => 'refresh',
        'default'   => null,
    ),


    array(
        'type'      => 'subtitle',
        'name'      => 'header6_cart',
        'title'     => 'Cart Icon',
        'description' => 'Top cart icon color options.'
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_cart_color',
        'title'     => 'Cart Icon Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_cart_background_color',
        'title'     => 'Cart Icon Background Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'header6_cart_border',
        'title'     => 'Social Cart Border Color',
        'transport' => 'refresh',
        'default'   => null,
    ),



), $wp_customize);