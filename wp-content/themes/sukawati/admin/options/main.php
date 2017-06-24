<?php

return array(
    'title' =>  'Sukawati' ,
    'logo' => '',
    'menus' => array(
        array(
            'title' =>  'General' ,
            'name' => 'generalsetting',
            'icon' => 'font-awesome:fa-dashboard',
            'menus' => array(

                array(
                    'title' => 'Logo',
                    'name' => 'logo',
                    'icon' => 'font-awesome:fa-image',
                    'controls' => array(
                        array(
                            'type' => 'upload',
                            'name' => 'logo',
                            'label' =>  'Logo' ,
                            'description' => 'Upload image for site logo',
                            'default' => get_template_directory_uri() .'/images/logo.png'
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'logo_retina',
                            'label' =>  'Logo Retina' ,
                            'description' => 'Upload image for site logo retina version',
                            'default' => get_template_directory_uri() .'/images/logo@2x.png'
                        ),

                        array(
                            'type' => 'upload',
                            'name' => 'logo_mobile',
                            'label' =>  'Mobile Logo' ,
                            'description' => 'Upload image for mobile version logo',
                            'default' => get_template_directory_uri() .'/images/logo.png'
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'logo_mobile_retina',
                            'label' =>  'Mobile Logo Retina' ,
                            'description' => 'Upload image for retina version of mobile logo',
                            'default' => get_template_directory_uri() .'/images/logo@2x.png'
                        ),

                    ),
                ),

                array(
                    'title' =>  'Layout' ,
                    'name' => 'layout_title',
                    'icon' => 'font-awesome:fa-trello',
                    'controls' => array(

                        array(
                            'type' => 'toggle',
                            'name' => 'sticky_menu',
                            'label' =>  'Enable Sticky Menu' ,
                            'description' =>  'enable sticky menu by turn this option on',
                        ),

                        array(
                            'type'              => 'radioimage',
                            'name'              => 'page_layout',
                            'label'             => 'Page Layout',
                            'description'       => 'Select page layout',
                            'item_max_width'    => '200',
                            'item_max_height'   => '150',
                            'items' => array(
                                array(
                                    'value' => 'boxed',
                                    'label' => 'Boxed - Wrap content inside a frame',
                                    'img' => get_template_directory_uri() . '/admin/assets/img/layout_boxed.png',
                                ),
                                array(
                                    'value' => 'full',
                                    'label' => 'Full width - Frameless content',
                                    'img' => get_template_directory_uri() . '/admin/assets/img/layout_full.png',
                                ),
                            ),
                            'default' => 'full',
                        ),

                        array(
                            'type'              => 'radioimage',
                            'name'              => 'header_layout',
                            'label'             => 'Header Layout',
                            'description'       => 'Select one header layout from 4 of these options',
                            'item_max_width'    => '540',
                            'item_max_height'   => '134',
                            'items' => array(
                                array(
                                    'value' => '1',
                                    'label' => 'Layout 1 - Navigation Top, Logo Big Centered',
                                    'img' => get_template_directory_uri() . '/admin/assets/img/header1.png',
                                ),
                                array(
                                    'value' => '2',
                                    'label' => 'Layout 2 - Navigation Right, Logo Left',
                                    'img' => get_template_directory_uri() . '/admin/assets/img/header2.png',
                                ),
                                array(
                                    'value' => '3',
                                    'label' => 'Layout 3 - Navigation Bottom, Logo Big Centered',
                                    'img' => get_template_directory_uri() . '/admin/assets/img/header3.png',
                                ),
                                array(
                                    'value' => '4',
                                    'label' => 'Layout 4 - Navigation Bottom, Logo Left with Ads',
                                    'img' => get_template_directory_uri() . '/admin/assets/img/header4.png',
                                ),
                                array(
                                    'value' => '5',
                                    'label' => 'Layout 5 - Navigation Top, Logo Left with Ads',
                                    'img' => get_template_directory_uri() . '/admin/assets/img/header5.png',
                                ),
                                array(
                                    'value' => '6',
                                    'label' => 'Layout 6 - Centered Navigation Bottom with centered logo',
                                    'img' => get_template_directory_uri() . '/admin/assets/img/header6.png',
                                ),
                            ),
                            'default' => array('1'),
                        ),
                    )
                ),

                array(
                    'title' =>  'Social Icon' ,
                    'name' => 'social_icon',
                    'icon' => 'font-awesome:fa-twitter',
                    'controls' => array(
                        array(
                            'type' => 'section',
                            'title' =>  'Social Account Profile' ,
                            'name' => 'social_icon_title',
                            'description' =>  'Insert your social account username to show on navigation bar' ,
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_facebook',
                                    'label' =>  'Facebook',
                                    'default' => 'http://fb.me/jegtheme'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_twitter',
                                    'label' =>  'Twitter',
                                    'default' => 'http://twitter.com/jegtheme'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_linkedin',
                                    'label' =>  'Linkedin'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_googleplus',
                                    'label' =>  'Google Plus',
                                    'default' => 'https://www.google.com/'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_pinterest',
                                    'label' =>  'Pinterest',
                                    'default' => 'https://www.pinterest.com/jegtheme/'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_behance',
                                    'label' =>  'Behance',
                                    'default' => 'https://www.behance.net/'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_github',
                                    'label' =>  'Github'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_flickr',
                                    'label' =>  'Flickr'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_tumblr',
                                    'label' =>  'Tumblr'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_dribbble',
                                    'label' =>  'Dribbble',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_soundcloud',
                                    'label' =>  'Soundcloud'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_lastfm',
                                    'label' =>  'Fastfm'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_instagram',
                                    'label' =>  'Instagram'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_vimeo',
                                    'label' =>  'Vimeo'
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'social_youtube',
                                    'label' =>  'Youtube'
                                ),
                            )
                        ),
                    )
                ),

                array(
                    'title' => 'Sidefeed',
                    'name' => 'sidefeed',
                    'icon' => 'font-awesome:fa-newspaper-o',
                    'controls' => array(
                        
                        array(
                            'type' => 'slider',
                            'name' => 'sidefeed_post_number',
                            'label' => 'Number post to show per load',
                            'min' => '1',
                            'max' => '15',
                            'step' => '1',
                            'default' => '6',
                        ),

                    ),
                ),

                array(
                    'title' =>  'Footer Settings' ,
                    'name' => 'footer_settings',
                    'icon' => 'font-awesome:fa-copyright',
                    'controls' => array(

                        array(
                            'type' => 'toggle',
                            'name' => 'show_subscribe_footer',
                            'label' =>  'Show Subscribe on Footer' ,
                            'description' =>  'Display the Footer Subscribe Form widget area.',
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_footer_widget',
                            'label' =>  'Show Footer Widget' ,
                            'description' => 'Display the Footer widget area',
                            'default' => true
                        ),

                        array(
                            'type' => 'textarea',
                            'name' => 'footer_text',
                            'label' =>  'Footer Text',
                            'description' => 'Display copyright information or etc.',
                            'default' => '&copy; Jegtheme 2015. Brands are the property of their respective owners.'
                        ),
                    )
                ),


            )
        ),

        // Single Post
        array(
            'title' =>  'Post Settings' ,
            'name' => 'posts',
            'icon' => 'font-awesome:fa-edit',
            'controls' => array(


                array(
                    'type' => 'section',
                    'title' =>  'General Post Option' ,
                    'name' => 'post_option',
                    'fields' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'single_show_postmeta',
                            'label' =>  'Show Post Meta' ,
                            'description' =>  'Show post meta info such as categories & date',
                            'default' => 1,
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'single_show_socials',
                            'label' =>  'Show Socials Share' ,
                            'description' =>  'Show social media icon to share',
                            'default' => 1,
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'single_show_tags',
                            'label' =>  'Show Post Tags' ,
                            'description' =>  '',
                            'default' => 1,
                        ),



                        array(
                            'type' => 'toggle',
                            'name' => 'single_show_authorbox',
                            'label' =>  'Show Author Box' ,
                            'description' =>  'Display author information bellow post',
                            'default' => 1,
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'single_disable_comment',
                            'label' =>  'Disable Comment' ,
                            'description' =>  'Globally disable comment for single post',
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'single_show_sidebar',
                            'label' => 'Show Sidebar',
                            'description' => 'Display sidebar that contains widgets',
                            'default' => 1,
                        ),

                        array(
                            'type' => 'select',
                            'name' => 'single_sidebar_name',
                            'label' => 'Sidebar Widget',
                            'description' => 'Select widget for Sidebar',
                            'default' => '{{first}}',
                            'items' => array(
                                'data' => array(
                                    array(
                                        'source' => 'function',
                                        'value'  => 'sukawati_plugin_get_sidebar',
                                    ),
                                ),
                            ),
                            'dependency' => array(
                                'field'    => 'single_show_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                    )),

                array(
                    'type' => 'section',
                    'title' =>  'Show / Hide Related Content' ,
                    'name' => 'related_post',
                    'fields' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_related_post',
                            'label' => 'Show Related Post in Article',
                            'description' => 'show related post inside article on every post',
                            'default' => '0',
                        ),
                        array(
                            'type' => 'slider',
                            'name' => 'related_post_number',
                            'label' => 'Related News Post Number',
                            'min' => '1',
                            'max' => '10',
                            'step' => '1',
                            'default' => '5',
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'hide_related_post_bottom',
                            'label' => 'Hide Related Post on bottom of post',
                            'description' => 'hide related post on bottom of article',
                            'default' => '0',
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'hide_next_prev_post',
                            'label' => 'Hide Next and Prev Post',
                            'description' => 'hide next previous post',
                            'default' => '0',
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'single_show_popuppost',
                            'label' =>  'Show Popup Post' ,
                            'description' =>  'Show popup box contains related post link',
                            'default' => 1,
                        ),
                    )
                ),


            )
        ),

        // Page
        array(
            'title' => 'Page Settings' ,
            'name' => 'pages',
            'icon' => 'font-awesome:fa-file-text-o',
            'controls' => array(

                array(
                    'type' => 'toggle',
                    'name' => 'page_disable_comment',
                    'label' =>  'Disable Comment' ,
                    'description' =>  'Globally disable comment for all pages',
                ),

                array(
                    'type' => 'toggle',
                    'name' => 'page_show_sidebar',
                    'label' => 'Show Sidebar',
                    'description' => 'Display sidebar that contains widgets',
                    'default' => 1,
                ),

                array(
                    'type' => 'select',
                    'name' => 'page_sidebar_name',
                    'label' => 'Sidebar Widget',
                    'description' => 'Select widget for Sidebar',
                    'default' => '{{first}}',
                    'items' => array(
                        'data' => array(
                            array(
                                'source' => 'function',
                                'value'  => 'sukawati_plugin_get_sidebar',
                            ),
                        ),
                    ),
                    'dependency' => array(
                        'field'    => 'page_show_sidebar',
                        'function' => 'vp_dep_boolean',
                    ),
                ),
            )
        ),

        // Archive
        array(
            'title' =>  'Archive Settings' ,
            'name' => 'archives',
            'icon' => 'font-awesome:fa-tags',
            'controls' => array(
                array(
                    'type' => 'radiobutton',
                    'name' => 'archives_content_layout',
                    'label' => 'Content Layout',
                    'description' => 'Select content layout',
                    'items' => array(
                        array(
                            'value' => 'normal',
                            'label' => 'Normal',
                        ),
                        array(
                            'value' => 'masonry',
                            'label' => 'Masonry',
                        ),
                    ),
                    'default' => array('normal')
                ),

                array(
                    'type' => 'radiobutton',
                    'name' => 'archives_content_type',
                    'label' =>  'Content Type' ,
                    'description' =>  'Select type of content to display' ,
                    'items' => array(
                        array(
                            'value' => 'excerpt',
                            'label' =>  'Summary (excerpt)' ,
                        ),
                        array(
                            'value' => 'full',
                            'label' =>  'Full' ,
                        ),
                    ),
                    'default' => array('excerpt'),
                    'dependency' => array(
                        'field'    => 'archives_content_layout',
                        'function' => 'sukawati_content_normal',
                    ),
                ),

                array(
                    'type' => 'radiobutton',
                    'name' => 'paging_type',
                    'label' => 'Blog Pagination Type',
                    'description' => 'select your blog paging type',
                    'items' => array(
                        array(
                            'value' => 'number',
                            'label' => 'Paging with number',
                        ),
                        array(
                            'value' => 'normal',
                            'label' => 'Old WordPress Paging',
                        ),
                    ),
                    'default' => array('number')
                ),

                array(
                    'type' => 'toggle',
                    'name' => 'archives_show_readmore',
                    'label' =>  'Show Readmore Button' ,
                    'description' =>  'Show post meta information',
                ),



                array(
                    'type' => 'toggle',
                    'name' => 'archives_show_postmeta',
                    'label' =>  'Show Post Meta Top' ,
                    'description' =>  'Show post meta info such as categories & date',
                    'default' => 1,
                ),

                array(
                    'type' => 'toggle',
                    'name' => 'archives_show_postmetabottom',
                    'label' =>  'Show Post Meta Bottom' ,
                    'description' =>  'Show post meta bottom of post such as author, social share, comment count',
                    'default' => 1,
                ),

                array(
                    'type' => 'toggle',
                    'name' => 'archives_show_sidebar',
                    'label' => 'Show Sidebar',
                    'description' => 'Display sidebar that contains widgets',
                    'default' => 1,
                ),

                array(
                    'type' => 'select',
                    'name' => 'archives_sidebar_name',
                    'label' => 'Sidebar Widget',
                    'description' => 'Select widget for Sidebar',
                    'default' => '{{first}}',
                    'items' => array(
                        'data' => array(
                            array(
                                'source' => 'function',
                                'value'  => 'sukawati_plugin_get_sidebar',
                            ),
                        ),
                    ),
                    'dependency' => array(
                        'field'    => 'archives_show_sidebar',
                        'function' => 'vp_dep_boolean',
                    ),
                ),
            )
        ),

        array(
            'title' =>  'Adverstisement' ,
            'name' => 'ads',
            'icon' => 'font-awesome:fa-money',
            'menus' => array(
                array(
                    'title' =>  'Header Ads' ,
                    'name' => 'ads_options_title',
                    'icon' => 'font-awesome:fa-star',
                    'controls' => array(
                        array(
                            'type' => 'select',
                            'name' => 'header_ads_type',
                            'label' =>  'Chose your Adverstisement type' ,
                            'description' =>  'You can use static image or Google Adsense.' ,
                            'items' => array(
                                array(
                                    'value' => 'image',
                                    'label' =>  'Static Image' ,
                                ),
                                array(
                                    'value' => 'adsense',
                                    'label' =>  'Google Adsense' ,
                                ),
                            ),
                            'default' => array('image'),
                        ),
                        array(
                            'type' => 'section',
                            'title' =>  'Static Image Ads' ,
                            'name' => 'header_ads_image_title',
                            'description' =>  'Header Ads will be appear on Header Layout 4 & 5' ,
                            'dependency' => array(
                                'field'    => 'header_ads_type',
                                'function' => 'sukawati_ads_type_image',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'upload',
                                    'name' => 'header_ads_image',
                                    'label' =>  'Ads Image' ,
                                    'description' => 'Upload image with size 728x90 pixel',
                                    'default' => get_template_directory_uri() .'/images/ads_header.png',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'header_ads_url',
                                    'label' =>  'Link URL',
                                    'default' => '#'
                                ),
                            )
                        ),

                        array(
                            'type' => 'section',
                            'title' =>  'Google Adsense' ,
                            'name' => 'header_ads_adsense_title',
                            'description' =>  'Header Ads will be appear on Header Layout 4 & 5' ,
                            'dependency' => array(
                                'field'    => 'header_ads_type',
                                'function' => 'sukawati_ads_type_adsense',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'top_menu_ads_google_publisher',
                                    'label' =>  'Publisher ID',
                                    'description' => 'data-ad-client / google_ad_client content',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'top_menu_ads_google_id',
                                    'label' =>  'Ads Slot ID',
                                    'description' => 'data-ad-slot / google_ad_slot content',
                                ),
                                array(
                                    'type' => 'select',
                                    'name' => 'top_menu_ads_google_desktop',
                                    'label' => 'Desktop Ads Size',
                                    'description' => 'Choose ad size to show on desktop, recommended to use auto instead',
                                    'items' => sukawati_get_ads_size(),
                                    'default' => array('auto'),
                                ),
                                array(
                                    'type' => 'select',
                                    'name' => 'top_menu_ads_google_tab',
                                    'label' => 'Tab Ads Size',
                                    'description' => 'Choose ad size to show on tablet, recommended to use auto instead',
                                    'items' => sukawati_get_ads_size(),
                                    'default' => array('auto'),
                                ),
                                array(
                                    'type' => 'select',
                                    'name' => 'top_menu_ads_google_phone',
                                    'label' => 'Phone Ads Size',
                                    'description' => 'Choose ad size to show on phone, recommended to use auto instead',
                                    'items' => sukawati_get_ads_size(),
                                    'default' => array('auto'),
                                ),
                            )
                        ),


                    )
                ),

            )
        ),

        // Advanced
        array(
            'title' =>  'Advanced Settings' ,
            'name' => 'advanced',
            'icon' => 'font-awesome:fa-code',
            'controls' => array(
                array(
                    'type' => 'codeeditor',
                    'name' => 'custom_css',
                    'label' =>  'Custom CSS' ,
                    'description' =>  'Put your custom css right here.' ,
                    'theme' => 'github',
                    'mode' => 'css',
                ),
            )
        ),

        array(
            'title' =>  'WooCommerce' ,
            'name' => 'woocommerce',
            'icon' => 'font-awesome:fa-shopping-cart',
            'controls' => array(
                array(
                    'type' => 'slider',
                    'name' => 'woocommerce_item_perpage',
                    'label' => 'Number item per page for woocommerce page',
                    'min' => '1',
                    'max' => '40',
                    'step' => '1',
                    'default' => '12',
                ),
            )
        ),

        array(
            'title' =>  'Import Dummy Data' ,
            'name' => 'import',
            'icon' => 'font-awesome:fa-cloud-download',
            'menus' => array(
                array(
                    'title' =>  'Import Content' ,
                    'name' => 'support',
                    'icon' => 'font-awesome:fa-question-circle',
                    'controls' => array(
                        array(
                            'type' => 'notebox',
                            'name' => 'import_data',
                            'label' =>  'Import Content' ,
                            'description' =>  'Please visit this page to import dummy data <a href="' . get_admin_url() . "themes.php?page=sukawati_import_content" . '" target="_blank">Import Dummy Data Sukawati</a>' ,
                            'status' => 'success',
                        ),
                    )
                )
            ),
        ),

        array(
            'title' =>  'Support' ,
            'name' => 'support',
            'icon' => 'font-awesome:fa-life-bouy',
            'menus' => array(
                array(
                    'title' =>  'Any Questions?' ,
                    'name' => 'support',
                    'icon' => 'font-awesome:fa-question-circle',
                    'controls' => array(

                        array(
                            'type' => 'notebox',
                            'name' => 'support_request',
                            'label' =>  'How to requesting support' ,
                            'description' =>  'If you have question related with this themes, please dont hesitate to contact us via email: <a href="mailto:support@jegtheme.com" target="_blank">Jeghteme Support</a>' ,
                            'status' => 'info',
                        ),
                    )
                ),
            )
        )

    )
);