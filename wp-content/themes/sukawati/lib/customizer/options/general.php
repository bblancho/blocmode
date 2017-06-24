<?php

global $wp_customize;

$webfonts    = sukawati_get_googlefont();
$font_family = $webfonts['fonts_list'];

/*** General Settings **/
new Sukawati_Customizer_Framework(
    array(
        'name'          => 'jeg_option_general',
        'title'         => 'General Options',
        'priority'      => 1,
        'description'   => ''
    ),
    array(

        array(
            'type'      => 'color',
            'name'      => 'text_color',
            'title'     => 'Base Text Colors',
            'transport' => 'refresh',
            'default'   => '#333333',
        ),
        array(
            'type'      => 'color',
            'name'      => 'link_color',
            'title'     => 'Link Color',
            'transport' => 'refresh',
            'default'   => '#b99d5b',
        ),
        array(
            'type'      => 'color',
            'name'      => 'link_hover_color',
            'title'     => 'Link Hover Color',
            'transport' => 'refresh',
            'default'   => '#000000',
        ),
        array(
            'type'      => 'color',
            'name'      => 'accent_color',
            'title'     => 'Accent Color',
            'transport' => 'refresh',
            'default'   => '#b99d5b',
        ),
), $wp_customize);