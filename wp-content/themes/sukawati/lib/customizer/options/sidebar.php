<?php

global $wp_customize;

/*** Sidebar Options **/
new Sukawati_Customizer_Framework(array(
    'name'          => 'jeg_option_sidebar',
    'title'         => 'Sidebar',
    'priority'      => 10,
    'description'   => ''
), array(

    array(
        'type'      => 'color',
        'name'      => 'sidebar_heading_color',
        'title'     => 'Heading Color',
        'transport' => 'refresh',
        'default'   => null,
    ),
    array(
        'type'      => 'color',
        'name'      => 'sidebar_heading_bg',
        'title'     => 'Heading Line Color',
        'transport' => 'refresh',
        'default'   => null,
    ),

), $wp_customize);