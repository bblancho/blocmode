<?php

global $wp_customize;

/*** Footer Options **/
new Sukawati_Customizer_Framework(array(
    'name'          => 'jeg_option_footer',
    'title'         => 'Footer',
    'priority'      => 11,
    'description'   => ''
), array(

    array(
        'type'      => 'color',
        'name'      => 'footer_bg',
        'title'     => 'Footer Background',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'footer_text_color',
        'title'     => 'Footer Text Color',
        'transport' => 'refresh',
        'default'   => null,
    ),

    array(
        'type'      => 'color',
        'name'      => 'footer_gototop_bg',
        'title'     => 'Goto Top Background',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'footer_gototop_text',
        'title'     => 'Goto Top Icon Color',
        'transport' => 'refresh',
        'default'   => null,
    ),

), $wp_customize);