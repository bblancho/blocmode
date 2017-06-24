<?php

global $wp_customize;

/*** Header Layout 4 **/
new Sukawati_Customizer_Framework(array(
    'name'          => 'jeg_option_mobile',
    'title'         => 'Mobile Menu',
    'priority'      => 9,
    'description'   => 'Customize color & style for mobile menu'
), array(

    array(
        'type'      => 'color',
        'name'      => 'mobile_menu_bg',
        'title'     => 'Menu Background',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'mobile_menu_toggle',
        'title'     => 'Menu Toggle Icon Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'mobile_menu_color',
        'title'     => 'Menu Text Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'mobile_menu_line',
        'title'     => 'Menu Border/Line Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'mobile_submenu_bg',
        'title'     => 'Submenu Background',
        'transport' => 'refresh',
        'default'   => null,
    ),

), $wp_customize);