<?php

return array(
    'id'          => 'jeg_landingbanner',
    'types'       => array('page'),
    'title'       => 'Landing Banner Options',
    'priority'    => 'high',
    'template'    => array(

        // Popular Post
        array(
            'type' => 'toggle',
            'name' => 'show_landing_banner',
            'label' => 'Show Landing Banner',
            'description' => 'Landing banner carousel',
            'default' => 0,
        ),
        array(
            'type' => 'textbox',
            'name' => 'banner_title',
            'label' =>  'Banner Title' ,
            'dependency' => array(
                'field'    => 'show_landing_banner',
                'function' => 'vp_dep_boolean',
            ),
        ),
        array(
            'type'      => 'group',
            'repeating' => false,
            'length'    => 3,
            'name'      => 'jeg_landing_banner_option',
            'title'     => 'Landing Banner Options',
            'dependency' => array(
                'field'    => 'show_landing_banner',
                'function' => 'vp_dep_boolean',
            ),
            'fields'    => array(
                array(
                    'type' => 'imageupload',
                    'name' => 'banner_image',
                    'label' =>  'Banner image' ,
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'banner_alt_top',
                    'label' =>  'Banner top text',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'banner_title',
                    'label' =>  'Banner title',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'banner_alt_bottom',
                    'label' =>  'Banner bottomt ext',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'banner_url',
                    'label' =>  'Banner URL',
                ),
            )
        ),

    ),
);