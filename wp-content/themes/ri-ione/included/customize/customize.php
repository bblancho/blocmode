<?php
// Customize
if (class_exists('RIT_Customize')) {
    function rit_customize()
    {
        $rit_customize = RIT_Customize::getInstance();

        $customizers = array(
            'title_tagline' => array(
                'title' => esc_html__('Site Identity', 'ri-ione'),
                'description' => '',
                'priority' => 0,
                'settings' => array(
                    'rit_heading_logo' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Logo Options', 'ri-ione'),
                        'priority' => 10,
                    ),
                    'rit_logo' => array(
                        'class' => 'image',
                        'label' => esc_html__('Logo', 'ri-ione'),
                        'description' => wp_kses(__('Upload Logo Image. <strong>NOTE: Please resize logo before upload. Recommend: height of logo should 80px</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 10
                    ),
                    'rit_stick_logo' => array(
                        'class' => 'image',
                        'label' => esc_html__('Stick Logo', 'ri-ione'),
                        'description' => esc_html__('Stick Logo for header Logo Stack center. Recommend: height of logo should 60px', 'ri-ione'),
                        'priority' => 10
                    ),
                    'rit_logo_top_spacing' => array(
                        'type' => 'number',
                        'label' => esc_html__('Logo Top spacing', 'ri-ione'),
                        'description' => esc_html__('Fill Logo Top spacing. Note: without (px)', 'ri-ione'),
                        'priority' => 15,
                        'params' => array(
                            'default' => '32',
                        ),
                    ),
                    'rit_logo_bottom_spacing' => array(
                        'type' => 'number',
                        'label' => esc_html__('Logo Bottom spacing', 'ri-ione'),
                        'description' => esc_html__('Fill Logo Bottom spacing. Note: without (px)', 'ri-ione'),
                        'priority' => 16,
                        'params' => array(
                            'default' => '0',
                        ),
                    ),

                )
            ),
            'rit_new_section_general' => array(
                'title' => esc_html__('General Options', 'ri-ione'),
                'description' => '',
                'priority' => 21,
                'settings' => array(
                    'rit_heading_page' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Page Size Options', 'ri-ione'),
                        'priority' => 1,
                    ),
                    'rit_enable_page_full_width' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable Page Full Width', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '',
                        ),
                    ),

                    'rit_enable_large_width' => array(
                        'type' => 'number',
                        'label' => esc_html__('Page Max Width', 'ri-ione'),
                        'priority' => 2,
                        'description' => esc_html__('Max width layout of page. If not set, it will apply default value is 1170', 'ri-ione'),
                        'params' => array(
                            'default' => '1170',
                        ),
                        'dependency' => array('rit_enable_page_full_width' => '')
                    ),
                    'rit_heading_page_style' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Custom Css/js', 'ri-ione'),
                        'priority' => 6,
                    ),
                    'rit_custom_css' => array(
                        'type' => 'textarea',
                        'label' => esc_html__('Custom CSS', 'ri-ione'),
                        'priority' => 6
                    ),
                    'rit_custom_js' => array(
                        'type' => 'textarea',
                        'label' => esc_html__('Custom JS', 'ri-ione'),
                        'priority' => 7
                    ),
                )
            ),
            'rit_new_section_export_import' => array(
                'title' => esc_html(__('Export/Import', 'ri-ione')),
                'priority' => 100,
                'settings' => array(
                    'rit-setting' => array(
                        'class' => 'cei',
                        'priority' => 2
                    )
                ),
            ),
            'rit_new_section_sidebar_meta' => array(
                'title' => esc_html(__('Sidebar Options', 'ri-ione')),
                'description' => '',
                'priority' => 24,
                'settings' => array(
                    'rit_default_sidebar' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Default Sidebar Config', 'ri-ione')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'no-sidebar' => esc_html(__('No Sidebar', 'ri-ione')),
                            'left-sidebar' => esc_html(__('Left Sidebar', 'ri-ione')),
                            'right-sidebar' => esc_html(__('Right Sidebar', 'ri-ione')),
                            'both-sidebar' => esc_html(__('Both Sidebar', 'ri-ione'))
                        ),
                        'params' => array(
                            'default' => 'right-sidebar',
                        ),
                    ),
                    'rit_default_left_sidebar' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Default Left Sidebar', 'ri-ione')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => rit_sidebar(),
                        'params' => array(
                            'default' => 'sidebar-1',
                        ),
                    ),
                    'rit_default_right_sidebar' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Default Right Sidebar', 'ri-ione')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => rit_sidebar(),
                        'params' => array(
                            'default' => 'sidebar-1',
                        ),
                    ),
                    'rit_heading_popup' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Popup widget options', 'ri-ione'),
                        'priority' => 1,
                    ),
                    'rit_enable_popup' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable widget Popup', 'ri-ione'),
                        'description' => esc_html__('If check Popup widget will work.', 'ri-ione'),
                        'priority' => 1,
                        'default'=>1
                    ),
                    'rit_enable_popup_mobile' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable widget Popup on Mobile', 'ri-ione'),
                        'description' => esc_html__('If check Popup widget will work on Mobile.', 'ri-ione'),
                        'priority' => 1,
                        'default'=>1
                    ),
                    'rit_popup_bg' => array(
                        'class' => 'image',
                        'label' => esc_html__('Popup background', 'ri-ione'),
                        'description' => esc_html__('Background of widget.', 'ri-ione'),
                        'priority' => 1
                    ),
                    'rit_popup_bg_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Popup background color', 'ri-ione'),
                        'description' => esc_html__('Background color of widget.', 'ri-ione'),
                        'priority' => 1
                    ),
                    'rit_popup_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Popup Height', 'ri-ione'),
                        'description' => esc_html__('Height of popup.', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '740',
                        ),
                    ),
                    'rit_popup_width' => array(
                        'type' => 'number',
                        'label' => esc_html__('Popup Width', 'ri-ione'),
                        'description' => esc_html__('Width of popup.', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '600',
                        ),
                    ),
                )
            ),
            'rit_header' => array(
                'title' => esc_html__('Header Options', 'ri-ione'),
                'description' => '',
                'priority' => 22,
                'settings' => array(
                    'rit_enable_top_header' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable Top Header', 'ri-ione'),
                        'description' => esc_html__('Check this option if want top header display at all page.', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_header_layout' => array(
                        'class' => 'image_selector',
                        'label' => esc_html__('Header Layout', 'ri-ione'),
                        'description' => '',
                        'priority' => 1,
                        'choices' => array(
                            'menu-right' => esc_url(get_template_directory_uri() . '/images/layout/menu-right.png'),
                            'menu-center' => esc_url(get_template_directory_uri() . '/images/layout/menu-center.png'),
                            'stack-center' => esc_url(get_template_directory_uri() . '/images/layout/stack-center.png'),
                            'stack-center-2' => esc_url(get_template_directory_uri() . '/images/layout/stack-center-2.png'),
                            'logo-center' => esc_url(get_template_directory_uri() . '/images/layout/logo-center.png'),
                            'vertical' => esc_url(get_template_directory_uri() . '/images/layout/vertical.png'),
                        ),
                        'params' => array(
                            'default' => 'stack-center',
                        ),
                    ),
                    'rit_enable_header_absolute' => array(
                        'class' => 'toggle',
                        'label' => esc_html__('Enable Header Transparency', 'ri-ione'),
                        'description' => esc_html__('Header will be override slider and content.', 'ri-ione'),
                        'priority' => 1
                    ),
                    'rit_heading_header_size' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Header Size Options', 'ri-ione'),
                        'priority' => 2,
                    ),
                    'rit_enable_header_fullwidth' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('100% Header Width', 'ri-ione'),
                        'description' => esc_html__('Check this box to set the header to 100% of the browser width. Uncheck to follow the site width.', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '0',
                        ),
                    ),
                    'rit_header_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Header Height', 'ri-ione'),
                        'description' => wp_kses(__('The height of <strong>"Header"</strong>. <strong>Note: without (px)</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 9,
                        'params' => array(
                            'default' => '120',
                        ),
                    ),
                    'rit_header_sticky_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Header Sticky Height', 'ri-ione'),
                        'description' => esc_html__('The height of Header when sticky', 'ri-ione'),
                        'priority' => 9,
                        'params' => array(
                            'default' => '80',
                        ),
                    ),
                    'rit_header_mobile_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Header Mobile Height', 'ri-ione'),
                        'description' => esc_html__('The height of Header in mobile', 'ri-ione'),
                        'priority' => 9,
                        'params' => array(
                            'default' => '80',
                        ),
                    ),
                    'rit_enable_sticky_header' => array(
                        'class' => 'toggle',
                        'label' => esc_html__('Enable Sticky Header', 'ri-ione'),
                        'description' => esc_html__('Header always on top', 'ri-ione'),
                        'priority' => 10,
                        'params' => array(
                            'default' => '1',
                        ),
                    ),
                )),
            'rit_new_section_footer' => array(
                'title' => esc_html__('Footer Options', 'ri-ione'),
                'description' => '',
                'priority' => 23,
                'settings' => array(
                    'rit_stick_footer' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable Sticky Footer', 'ri-ione'),
                        'description' => esc_html__('If check, footer always on bottom', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_disable_top_footer' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable Top Footer', 'ri-ione'),
                        'description' => esc_html__('If check, top footer will be show', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_disable_main_footer' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Disable Main Footer', 'ri-ione'),
                        'description' => '',
                        'priority' => 0,
                    ),
                    'rit_footer_layout' => array(
                        'class' => 'image_selector',
                        'label' => esc_html__('Footer Layout', 'ri-ione'),
                        'description' => '',
                        'priority' => 1,
                        'choices' => array(
                            'default' => esc_url(get_template_directory_uri() . '/images/layout/footer-style1.png'),
                            'one-line' => esc_url(get_template_directory_uri() . '/images/layout/footer-style2.png'),
                            'simple' => esc_url(get_template_directory_uri() . '/images/layout/footer-style3.png'),
                                                    ),
                        'params' => array(
                            'default' => 'default',
                        ),
                    ),
                    'rit_enable_copyright' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable Copyright', 'ri-ione'),
                        'description' => '',
                        'priority' => 2,
                        'params' => array(
                            'default' => '1',
                        ),
                    ),
                    'rit_copyright_text' => array(
                        'type' => 'textarea',
                        'label' => esc_html__('Footer Copyright Text', 'ri-ione'),
                        'description' => '',
                        'priority' => 3
                    ),
                )
            ),
            'rit_blog_options' => array(
                'title' => esc_html__('Blog Options', 'ri-ione'),
                'description' => '',
                'priority' => 25,
                'settings' => array(
                    'rit_heading_default_layout' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Category page layout', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_default_post_col' => array(
                        'type' => 'select',
                        'label' => esc_html__('Columns', 'ri-ione'),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            '1' => esc_html__('1 Columns', 'ri-ione'),
                            '2' => esc_html__('2 Columns', 'ri-ione'),
                            '3' => esc_html__('3 Columns', 'ri-ione'),
                            '4' => esc_html__('4 Columns', 'ri-ione'),
                            '5' => esc_html__('5 Columns', 'ri-ione'),
                            '6' => esc_html__('6 Columns', 'ri-ione'),
                        ),
                        'params' => array(
                            'default' => '1',
                        )
                    ),
                    'rit_excerpt_length' => array(
                        'type' => 'number',
                        'label' => esc_html__('Excerpt Length', 'ri-ione'),
                        'description' => '',
                        'priority' => 0,
                        'params' => array(
                            'default' => '40',
                        )
                    ),
                    'rit_default_img_size' => array(
                        'type' => 'select',
                        'label' => esc_html__('Image size', 'ri-ione'),
                        'description' => esc_html__('Select image size display in categories page, archive page, for display better and loading faster', 'ri-ione'),
                        'priority' => 0,
                        'choices' => array(
                            'thumbnail' => esc_html__('Thumbnail', 'ri-ione'),
                            'medium' => esc_html__('Medium', 'ri-ione'),
                            'large' => esc_html__('Large', 'ri-ione'),
                            'full' => esc_html__('Original', 'ri-ione'),
                            'custom' => esc_html__('Custom size', 'ri-ione'),
                        ),
                        'params' => array(
                            'default' => 'medium',
                        ),
                    ),
                    'rit_default_img_custom_size_width' => array(
                        'type' => 'number',
                        'label' => esc_html__('Image Width', 'ri-ione'),
                        'description' => '',
                        'priority' => 0,
                        'params' => array(
                            'default' => '370',
                        ),
                        'dependency' => array('rit_default_img_size' => 'custom')
                    ),
                    'rit_default_img_custom_size_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Image Height', 'ri-ione'),
                        'description' => '',
                        'priority' => 0,
                        'params' => array(
                            'default' => '210',
                        ),
                        'dependency' => array('rit_default_img_size' => 'custom')
                    ),
                    'rit_hide_readmore' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide Read more', 'ri-ione'),
                        'description' => esc_html__('Check this box to hide read more button.', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_heading_default_detail_blog' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Detail post options', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_author_info' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide Author info', 'ri-ione'),
                        'description' => esc_html__('Check this box to hide the author info box on the detail page.', 'ri-ione'),
                        'priority' => 1,
                    ),
                    'rit_social_sharing' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide Social Sharing', 'ri-ione'),
                        'description' => esc_html__('Check this box to hide social sharing icons on the detail page.', 'ri-ione'),
                        'priority' => 1,
                    ),
                    'rit_related_articles' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide related articles', 'ri-ione'),
                        'description' => esc_html__('Check this box to hide related articles on the detail page.', 'ri-ione'),
                        'priority' => 1,
                    ),
                )),
            'rit_woo_custom' => array(
                'title' => esc_html__('Shop Page Options', 'ri-ione'),
                'priority' => 0,
                'panel' => 'rit_woo_panel',
                'settings' => array(
                    'rit_woo_slider_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Slider Cover', 'ri-ione'),
                        'priority' => 0
                    ),
                    'rit_woo_slider_cover' => array(
                        'type' => 'text',
                        'label' => esc_html__('Slider Cover Shortcode', 'ri-ione'),
                        'description' => esc_html__('Slider Cover Shortcode for shop page', 'ri-ione'),
                        'priority' => 0
                    ),
                    'rit_woo_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Layout Options', 'ri-ione'),
                        'priority' => 0
                    ),
                    'rit_woo_catalog_mod' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable Catalog Mode', 'ri-ione'),
                        'description' => esc_html__('Hide Cart Icon, Add to cart button at all page.', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_woo_hide_cart' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide cart', 'ri-ione'),
                        'description' => esc_html__('Hide cart button in shop page', 'ri-ione'),
                        'priority' => 0,
                        'dependency' => array('rit_woo_catalog_mod' => array(''))
                    ),
                    'rit_woo_hide_quickview' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Disable Quick View', 'ri-ione'),
                        'description' => esc_html__('If check, quick view will be disable', 'ri-ione'),
                        'priority' => 0,
                        'dependency' => array('rit_woo_catalog_mod' => array(''))
                    ),
                    'rit_woo_hide_stock_label' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide Stock Label', 'ri-ione'),
                        'description' => esc_html__('If check, Stock status label will hide', 'ri-ione'),
                        'priority' => 0,
                        'dependency' => array('rit_woo_catalog_mod' => array(''))
                    ),
                    'rit_woo_layout' => array(
                        'type' => 'select',
                        'label' => esc_html__('Default product Layout', 'ri-ione'),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'grid' => esc_html__('Grid', 'ri-ione'),
                            'list' => esc_html__('List', 'ri-ione')
                        ),
                        'params' => array(
                            'default' => 'grid',
                        ),
                    ),
                    'rit_woo_col_min_width' => array(
                        'type' => 'number',
                        'label' => esc_html__('Columns min width', 'ri-ione'),
                        'description' => esc_html__('Min width of column, help make smart layout.', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '170',
                        ),
                    ),
                    'rit_number_products_display' => array(
                        'type' => 'number',
                        'label' => esc_html__('Default number products display', 'ri-ione'),
                        'description' => '',
                        'priority' => 1,
                        'params' => array(
                            'default' => '12',
                        ),
                    ),
                    'rit_woo_heading_sidebar' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Sidebar Options', 'ri-ione'),
                        'priority' => 2
                    ),
                    'rit_woo_sidebar_option' => array(
                        'class' => 'image_selector',
                        'label' => esc_html__('Sidebar Layout Options', 'ri-ione'),
                        'description' => '',
                        'priority' => 3,
                        'choices' => array(
                            'no-sidebar' => esc_url(get_template_directory_uri() . '/images/layout/no-sidebar.png'),
                            'left-sidebar' => esc_url(get_template_directory_uri() . '/images/layout/left-sidebar.png'),
                            'right-sidebar' => esc_url(get_template_directory_uri() . '/images/layout/right-sidebar.png'),
                        ),
                        'params' => array(
                            'default' => 'left-sidebar',
                        ),
                    ),
                    'rit_woo_sidebar' => array(
                        'type' => 'select',
                        'label' => esc_html__('Product Sidebar', 'ri-ione'),
                        'description' => '',
                        'priority' => 3,
                        'choices' => rit_sidebar(),
                        'params' => array(
                            'default' => 'sidebar-2',
                        ),
                        'dependency' => array('rit_woo_sidebar_option' => array('right-sidebar', 'left-sidebar'))
                    ),
                )
            ),
            'rit_woo_detail_custom' => array(
                'title' => esc_html__('Single Product Options', 'ri-ione'),
                'priority' => 1,
                'panel' => 'rit_woo_panel',
                'settings' => array(
                    'rit_woo_single_layout_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Layout', 'ri-ione'),
                        'priority' => 1
                    ),
                    'rit_woo_layout_single' => array(
                        'type' => 'select',
                        'label' => esc_html__('Layout Single Product', 'ri-ione'),
                        'description' => '',
                        'priority' => 1,
                        'choices' => array(
                            'vertical-gallery' =>esc_html__('Vertical Gallery','ri-ione'),
                            'horizontal-gallery' =>esc_html__('Horizontal Gallery','ri-ione'),
                            'carousel' =>esc_html__('Carousel','ri-ione'),
                            'sticky' =>esc_html__('Sticky','ri-ione'),
                        ),
                        'params' => array(
                            'default' => 'horizontal-gallery',
                        ),
                    ),
                    'rit_woo_disable_zoom' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Disable Zoom', 'ri-ione'),
                        'description' => esc_html__('Disable zoom feature if you don\'t use it', 'ri-ione'),
                        'priority' => 1,
                    ),
                    'rit_woo_single_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Related Products Options', 'ri-ione'),
                        'priority' => 2
                    ),
                    'rit_enable_slider_related_product' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable slider related products', 'ri-ione'),
                        'description' => esc_html__('Related product block display like carousel', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '',
                        ),
                    ),
                    'rit_woo_col_related_min_width' => array(
                        'type' => 'number',
                        'label' => esc_html__('Columns min width', 'ri-ione'),
                        'description' => esc_html__('Min width of product related item', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '250',
                        ),
                        'dependency' => array('rit_enable_slider_related_product' => '')
                    ),
                    'rit_woo_col_related' => array(
                        'type' => 'number',
                        'label' => esc_html__('Columns product related', 'ri-ione'),
                        'description' => esc_html__('', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '4',
                        ),
                        'dependency' => array('rit_enable_slider_related_product' => '1')
                    ),
                    'rit_woo_related_display' => array(
                        'type' => 'number',
                        'label' => esc_html__('Number products related', 'ri-ione'),
                        'description' => esc_html__('Total products related display', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '4',
                        ),
                    ),
                )),
            'rit_new_section_font_family' => array(
                'title' => esc_html(__('Font Family Options', 'ri-ione')),
                'panel' => 'rit_font_panel',
                'description' => '',
                'priority' => 1,
                'settings' => array(
                    'rit_body_font_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Body Font', 'ri-ione')),
                        'priority' => 0
                    ),
                    'rit_body_font_select' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Body Font', 'ri-ione')),
                        'description' => '',
                        'priority' => 1,
                        'choices' => array(
                            'standard' => esc_html(__('Standard', 'ri-ione')),
                            'google' => esc_html(__('Google', 'ri-ione'))
                        ),
                        'params' => array(
                            'default' => 'google',
                        ),
                    ),
                    'rit_body_font_standard' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Body Standard Font', 'ri-ione')),
                        'description' => '',
                        'priority' => 2,
                        'choices' => array(
                            'Arial' => esc_html(__('Arial', 'ri-ione')),
                            'Courier New' => esc_html(__('Courier New', 'ri-ione')),
                            'Georgia' => esc_html(__('Georgia', 'ri-ione')),
                            'Helvetica' => esc_html(__('Helvetica', 'ri-ione')),
                            'Lucida Sans' => esc_html(__('Lucida Sans', 'ri-ione')),
                            'Lucida Sans Unicode' => esc_html(__('Lucida Sans Unicode', 'ri-ione')),
                            'Myriad Pro' => esc_html(__('Myriad Pro', 'ri-ione')),
                            'Palatino Linotype' => esc_html(__('Palatino Linotype', 'ri-ione')),
                            'Tahoma' => esc_html(__('Tahoma', 'ri-ione')),
                            'Times New Roman' => esc_html(__('Times New Roman', 'ri-ione')),
                            'Trebuchet MS' => esc_html(__('Trebuchet MS', 'ri-ione')),
                            'Verdana' => esc_html(__('Verdana', 'ri-ione'))
                        ),
                        'params' => array(
                            'default' => 'Arial',
                        ),
                        'dependency' => array('rit_body_font_select' => 'standard')
                    ),
                    'rit_body_font_google' => array(
                        'class' => 'googlefont',
                        'label' => esc_html(__('Body Google Font', 'ri-ione')),
                        'description' => '',
                        'priority' => 3,
                        'params' => array(
                            'default' => json_encode(array('family' => 'Roboto', 'variants' => array('400', '500'), 'subsets' => array('latin'))),
                        ),
                        'dependency' => array('rit_body_font_select' => 'google')
                    ),
                    'rit_heading_font_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Main Font', 'ri-ione')),
                        'description' => 'Font for tag heading (h1 - h6), special tag, button...',
                        'priority' => 8
                    ),
                    'rit_heading_font_select' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Main Font', 'ri-ione')),
                        'description' => '',
                        'priority' => 9,
                        'choices' => array(
                            'standard' => esc_html(__('Standard', 'ri-ione')),
                            'google' => esc_html(__('Google', 'ri-ione'))
                        ),
                        'params' => array(
                            'default' => 'google',
                        ),
                    ),
                    'rit_heading_font_standard' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Main Standard Font', 'ri-ione')),
                        'description' => '',
                        'priority' => 10,
                        'choices' => array(
                            'Arial' => esc_html(__('Arial', 'ri-ione')),
                            'Courier New' => esc_html(__('Courier New', 'ri-ione')),
                            'Georgia' => esc_html(__('Georgia', 'ri-ione')),
                            'Helvetica' => esc_html(__('Helvetica', 'ri-ione')),
                            'Lucida Sans' => esc_html(__('Lucida Sans', 'ri-ione')),
                            'Lucida Sans Unicode' => esc_html(__('Lucida Sans Unicode', 'ri-ione')),
                            'Myriad Pro' => esc_html(__('Myriad Pro', 'ri-ione')),
                            'Palatino Linotype' => esc_html(__('Palatino Linotype', 'ri-ione')),
                            'Tahoma' => esc_html(__('Tahoma', 'ri-ione')),
                            'Times New Roman' => esc_html(__('Times New Roman', 'ri-ione')),
                            'Trebuchet MS' => esc_html(__('Trebuchet MS', 'ri-ione')),
                            'Verdana' => esc_html(__('Verdana', 'ri-ione'))
                        ),
                        'params' => array(
                            'default' => 'Arial',
                        ),
                        'dependency' => array('rit_heading_font_select' => 'standard')
                    ),
                    'rit_heading_font_google' => array(
                        'class' => 'googlefont',
                        'label' => esc_html(__('Main Google Font', 'ri-ione')),
                        'description' => '',
                        'priority' => 11,
                        'params' => array(
                            'default' => json_encode(array('family' => 'Roboto', 'variants' => array('400', '500'), 'subsets' => array('latin'))),
                        ),
                        'dependency' => array('rit_heading_font_select' => 'google')
                    )
                )
            ),
            'rit_new_section_font_size' => array(
                'title' => esc_html__('Font Size Options', 'ri-ione'),
                'panel' => 'rit_font_panel',
                'description' => '',
                'priority' => 4,
                'settings' => array(
                    'rit_fontsize_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('General', 'ri-ione')),
                        'priority' => 0
                    ),
                    'rit_body_font_size' => array(
                        'type' => 'number',
                        'label' => esc_html__('Body Font Size', 'ri-ione'),
                        'description' => wp_kses(__('Font size of body. <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 1,
                        'params' => array(
                            'default' => '15',
                        )
                    ),
                    'rit_body_mobile_font_size' => array(
                        'type' => 'number',
                        'label' => esc_html__('Body Font Size on Mobile', 'ri-ione'),
                        'description' => wp_kses(__('Font size of body on Mobile/Table devices. <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 1,
                        'params' => array(
                            'default' => '15',
                        )
                    ),
                    'rit_body_line_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Body Font Line Height', 'ri-ione'),
                        'description' => wp_kses(__('Line Height font of body. <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 2,
                        'params' => array(
                            'default' => '24',
                        )
                    ),
                    'rit_menu_font_size' => array(
                        'type' => 'number',
                        'label' => esc_html__('Menu Font Size', 'ri-ione'),
                        'description' => wp_kses(__('Font size of font of body. <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 3,
                        'params' => array(
                            'default' => '12',
                        )
                    ),
                    'rit_font_size_block' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Block Title', 'ri-ione'),
                        'description' => esc_html__('Font size of title block, display in home page', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '14',
                        )
                    ),
                    'rit_font_size_title_widget' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Title Widget', 'ri-ione'),
                        'description' => esc_html__('Font size of title widget, and title block of single post.', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '12',
                        )
                    ),
                    'rit_font_size_woo' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Font Size Of Woocommerce', 'ri-ione'),
                        'priority' => 4
                    ),
                    'rit_font_size_woo_title_widget' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Title Widget of Woo Page', 'ri-ione'),
                        'description' => esc_html__('Font size of title widget on woocommerce page.', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '16',
                        )
                    ),
                    'rit_font_size_woo_title' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Product name', 'ri-ione'),
                        'description' => esc_html__('Font size of product name in shop page, grid/list layout.', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '13',
                        )
                    ),
                    'rit_font_size_woo_title_detail' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Single Product name', 'ri-ione'),
                        'description' => esc_html__('Font size of product name in Detail product/quick view.', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '30',
                        )
                    ),
                    'rit_font_size_woo_price' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Price of Product', 'ri-ione'),
                        'description' => esc_html__('Font size of price in shop page, grid/list layout.', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '15',
                        )
                    ),
                    'rit_font_size_woo_single_price' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Price of Product', 'ri-ione'),
                        'description' => esc_html__('Font size of price in shop page, grid/list layout.', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '22',
                        )
                    ),
                    'rit_font_size_post' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Font Size Of Post', 'ri-ione')),
                        'priority' => 4
                    ),
                    'rit_font_size_post_title' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of title post', 'ri-ione'),
                        'description' => esc_html__('Font size of title post in category, archive, page and recent post', 'ri-ione'),
                        'priority' => 5,
                        'params' => array(
                            'default' => '24',
                        )
                    ),
                    'rit_font_size_single_post_title' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of title single post.', 'ri-ione'),
                        'description' => esc_html__('Font size title single post', 'ri-ione'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '36',
                        )
                    ),
                    'rit_font_size_post_sidebar' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of title post sidebar.', 'ri-ione'),
                        'description' => esc_html__('Font size title of post at sidebar and related', 'ri-ione'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '15',
                        )
                    ),
                    'rit_font_heading_footer_size' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Font Size Footer', 'ri-ione'),
                        'priority' => 6
                    ),
                    'rit_font_size_title_widget_footer' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Title Widget Footer', 'ri-ione'),
                        'description' => esc_html__('Font size of title widget in footer.', 'ri-ione'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '12',
                        )
                    ),
                    'rit_font_size_footer' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Footer', 'ri-ione'),
                        'description' => esc_html__('Font size of footer.', 'ri-ione'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '12',
                        )
                    ),
                    'rit_font_heading_size' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Font Size Heading', 'ri-ione')),
                        'priority' => 7
                    ),
                    'rit_font_size_h1' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h1', 'ri-ione'),
                        'description' => wp_kses(__('Fontsize of tag "h1". <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 8,
                        'params' => array(
                            'default' => '36',
                        )
                    ),
                    'rit_font_size_h2' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h2', 'ri-ione'),
                        'description' => wp_kses(__('Fontsize of tag "h2". <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 9,
                        'params' => array(
                            'default' => '30',
                        )
                    ),
                    'rit_font_size_h3' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h3', 'ri-ione'),
                        'description' => wp_kses(__('Fontsize of tag "h3". <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 10,
                        'params' => array(
                            'default' => '26',
                        )
                    ),
                    'rit_font_size_h4' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h4', 'ri-ione'),
                        'description' => wp_kses(__('Fontsize of tag "h4". <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 11,
                        'params' => array(
                            'default' => '24',
                        )
                    ),
                    'rit_font_size_h5' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h5', 'ri-ione'),
                        'description' => wp_kses(__('Fontsize of tag "h5". <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 12,
                        'params' => array(
                            'default' => '21',
                        )
                    ),
                    'rit_font_size_h6' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h6', 'ri-ione'),
                        'description' => wp_kses(__('Fontsize of tag "h6". <strong>Note: Excluding "px" after value</strong>', 'ri-ione'), array('strong' => array())),
                        'priority' => 13,
                        'params' => array(
                            'default' => '18',
                        )
                    ),
                )
            ),
            'rit_new_section_color_general' => array(
                'title' => esc_html__('General Color', 'ri-ione'),
                'description' => '',
                'priority' => 3,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_enable_dark_style' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable Dark style', 'ri-ione'),
                        'description' => esc_html__('If check, dark style will be use, and override some color options.', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_primary_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Primary Color', 'ri-ione'),
                        'description' => esc_html__('Color use some special location.', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_sec_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Second Color', 'ri-ione'),
                        'description' => esc_html__('Color use some special location.', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#7d7d7d',
                        ),
                    ),
                    'rit_accent_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Accent Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                    'rit_sec_accent_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Second Accent Color', 'ri-ione'),
                        'priority' => 1,
                        'description' => esc_html__('Apply at some special block, like Post information of single post.', 'ri-ione'),
                        'params' => array(
                            'default' => '#acacac',
                        ),
                    ),
                    'rit_border_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Border Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#ebebeb',
                        ),
                    )
                )),
            'rit_button_color_general' => array(
                'title' => esc_html__('Button Color Options', 'ri-ione'),
                'description' => '',
                'priority' => 4,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_button_color_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Button Default Options', 'ri-ione'),
                        'priority' => 1
                    ),
                    'rit_button_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color Button', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_button_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color Button Hover', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_button_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Button', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                    'rit_button_bg_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Button Hover', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_light_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Button Light style', 'ri-ione'),
                        'priority' => 1
                    ),
                    'rit_button_light_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_light_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color Hover', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_button_light_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#ebebeb',
                        ),
                    ),
                    'rit_button_light_bg_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Hover', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_loadmore_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Button Load More style', 'ri-ione'),
                        'priority' => 1
                    ),
                    'rit_button_loadmore_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_loadmore_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color Hover', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_button_loadmore_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#ebebeb',
                        ),
                    ),
                    'rit_button_loadmore_bg_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Hover', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                )),
            'rit_new_section_color_header' => array(
                'title' => esc_html__('Header', 'ri-ione'),
                'description' => '',
                'priority' => 5,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_header_color_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Header color', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_header_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Color', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_header_bg_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Background Opacity', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '0',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                    ),
                    'rit_header_text_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text color', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#acacac',
                        ),
                    ),
                    'rit_header_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link color', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_header_link_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Hover color', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                    'rit_header_border_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Border Color', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#ebebeb',
                        )
                    ),
                    'rit_header_border_color_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Border Opacity', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '1',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        )
                    ),
                    'rit_header_top_color_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Top header color', 'ri-ione'),
                        'priority' => 1,
                    ),
                    'rit_header_top_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_header_top_bg_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Background Opacity', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '1',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                    ),
                    'rit_header_top_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#acacac',
                        ),
                    ), 'rit_header_top_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#acacac',
                        ),
                    ), 'rit_header_top_link_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Color Hover', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_header_main_color_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Main header color', 'ri-ione'),
                        'priority' => 2
                    ),
                    'rit_header_main_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '',
                        ),
                    ),
                    'rit_header_main_bg_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Background Opacity', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '0',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                    ),
                    'rit_header_main_inner_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Inner Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '',
                        ),
                    ),
                    'rit_header_main_inner_bg_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Background Inner Opacity', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '0',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                    ),
                    'rit_header_sticky_color_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Sticky header color', 'ri-ione'),
                        'priority' => 3
                    ),
                    'rit_header_sticky_background_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Sticky Color', 'ri-ione'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_header_sticky_background_color_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Background Sticky Opacity', 'ri-ione'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '1',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                    ),
                )
            ),
            'rit_new_section_color_body' => array(
                'title' => esc_html__('Body', 'ri-ione'),
                'description' => '',
                'priority' => 6,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_body_bg_image' => array(
                        'class' => 'image',
                        'label' => esc_html__('Body Background Image', 'ri-ione'),
                        'description' => '',
                        'priority' => 0
                    ),
                    'rit_body_bg_repeat' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Background Repeat', 'ri-ione')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'no-repeat' => esc_html(__('no-repeat', 'ri-ione')),
                            'repeat' => esc_html(__('repeat', 'ri-ione')),
                            'repeat-x' => esc_html(__('repeat-x', 'ri-ione')),
                            'repeat-y' => esc_html(__('repeat-y', 'ri-ione'))
                        ),
                        'params' => array(
                            'default' => 'repeat',
                        ),
                    ),
                    'rit_body_bg_size' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Background Size', 'ri-ione')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'contain' => esc_html(__('contain', 'ri-ione')),
                            'auto' => esc_html(__('auto', 'ri-ione')),
                            'cover' => esc_html(__('cover', 'ri-ione'))
                        ),
                        'params' => array(
                            'default' => 'auto',
                        ),
                    ),
                    'rit_body_bg_attachment' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Background Attachment', 'ri-ione')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'local' => esc_html(__('local', 'ri-ione')),
                            'fixed' => esc_html(__('fixed', 'ri-ione')),
                            'scroll' => esc_html(__('scroll', 'ri-ione'))
                        ),
                        'params' => array(
                            'default' => 'scroll',
                        ),
                    ),
                    'rit_body_bg_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Body Background Color', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#ffffff',
                        ),
                    ),
                    'rit_body_text_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#454545',
                        ),
                    ),
                    'rit_body_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#454545',
                        ),
                    ),
                    'rit_body_link_hover_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Hover Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                    'rit_body_h1_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H1 Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h2_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H2 Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h3_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H3 Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h4_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H4 Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h5_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H5 Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h6_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H6 Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    )
                )
            ),
            'rit_wrap_color_blog' => array(
                'title' => esc_html__('Blog', 'ri-ione'),
                'description' => '',
                'priority' => 7,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_color_blog_title' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color title', 'ri-ione'),
                        'description' => esc_html__('Apply for blog page, except detail page', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_blog_title_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color title hover', 'ri-ione'),
                        'description' => esc_html__('Apply for blog page, except detail page', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                    'rit_color_blog_title_detail' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color Title Detail', 'ri-ione'),
                        'description' => esc_html__('Apply for detail blog page', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_blog_date_post' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color Date Post', 'ri-ione'),
                        'description' => esc_html__('Apply for blog', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                )),
            'rit_wrap_color_woo' => array(
                'title' => esc_html__('Woocommerce', 'ri-ione'),
                'description' => '',
                'priority' => 7,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_heading_shop_general' => array(
                        'class' => 'heading',
                        'label' => esc_html__('General Options', 'ri-ione'),
                        'priority' => 0,
                    ),
                    'rit_color_woo_sale' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color Sale label', 'ri-ione'),
                        'description' => esc_html__('Apply all page', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_woo_sale_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Sale label', 'ri-ione'),
                        'description' => esc_html__('Apply all page', 'ri-ione'),
                        'priority' =>0,
                        'params' => array(
                            'default' => '#fff',
                        )
                    ),
                    'rit_color_woo_qv' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color Quick view', 'ri-ione'),
                        'description' => esc_html__('Apply all page', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#fff',
                        )
                    ),
                    'rit_color_woo_qv_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Quick view', 'ri-ione'),
                        'description' => esc_html__('Apply all page', 'ri-ione'),
                        'priority' =>0,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                    'rit_color_woo_qv_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color Quick view hover', 'ri-ione'),
                        'description' => esc_html__('Apply all page', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#fff',
                        )
                    ),
                    'rit_color_woo_qv_bg_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Quick view hover', 'ri-ione'),
                        'description' => esc_html__('Apply all page', 'ri-ione'),
                        'priority' =>0,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_woo_addcart' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color Add to Cart', 'ri-ione'),
                        'description' => esc_html__('Color of add to cart button. Apply all page', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#fff',
                        )
                    ),
                    'rit_color_woo_addcart_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Add to Cart', 'ri-ione'),
                        'description' => esc_html__('Background of add to cart button. Apply all page', 'ri-ione'),
                        'priority' =>0,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                    'rit_color_woo_addcart_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color Add to Cart hover', 'ri-ione'),
                        'description' => esc_html__('Color of add to cart button when hover. Apply all page', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#fff',
                        )
                    ),
                    'rit_color_woo_addcart_bg_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Add to Cart hover', 'ri-ione'),
                        'description' => esc_html__('Background of add to cart button when hover. Apply all page', 'ri-ione'),
                        'priority' =>0,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_heading_shop_page' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Shop page', 'ri-ione'),
                        'priority' => 1,
                    ),
                    'rit_color_woo_title' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color title', 'ri-ione'),
                        'description' => esc_html__('Apply for shop page', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#7d7d7d',
                        )
                    ),
                    'rit_color_woo_title_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color title hover', 'ri-ione'),
                        'description' => esc_html__('Apply for blog page, except detail page', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                    'rit_color_woo_price' => array(
                        'class' => 'color',
                        'label' => esc_html__('Price Color', 'ri-ione'),
                        'description' => esc_html__('Color of price', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_woo_regular_price' => array(
                        'class' => 'color',
                        'label' => esc_html__('Regular price color', 'ri-ione'),
                        'description' => esc_html__('Apply for  shop page', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_woo_sale_price' => array(
                        'class' => 'color',
                        'label' => esc_html__('Sale Price Color', 'ri-ione'),
                        'description' => esc_html__('Apply for shop page', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                    'rit_color_woo_label_lowstock' => array(
                        'class' => 'color',
                        'label' => esc_html__('Low stock label color', 'ri-ione'),
                        'description' => esc_html__('Apply for shop page', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        )
                    ),
                    'rit_color_woo_label_lowstock_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Low stock label background', 'ri-ione'),
                        'description' => esc_html__('Apply for shop page', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                    'rit_color_woo_label_outstock' => array(
                        'class' => 'color',
                        'label' => esc_html__('Out of stock label color', 'ri-ione'),
                        'description' => esc_html__('Apply for shop page', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        )
                    ),
                    'rit_color_woo_label_outstock_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Out of stock label background', 'ri-ione'),
                        'description' => esc_html__('Apply for shop page', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#f39580',
                        )
                    ),
                    'rit_heading_single_product' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Single Product', 'ri-ione'),
                        'priority' => 2,
                    ),
                    'rit_color_woo_title_detail' => array(
                        'class' => 'color',
                        'label' => esc_html__('Product name', 'ri-ione'),
                        'description' => esc_html__('Apply for product name of Single Product', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_woo_bg_single' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background product block', 'ri-ione'),
                        'description' => esc_html__('Background for Single Product block', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '##F5F5F5',
                        )
                    ),
                    'rit_color_woo_single_price' => array(
                        'class' => 'color',
                        'label' => esc_html__('Price Color', 'ri-ione'),
                        'description' => esc_html__('Color of price', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_woo_single_regular_price' => array(
                        'class' => 'color',
                        'label' => esc_html__('Regular price color', 'ri-ione'),
                        'description' => esc_html__('Apply for single product', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#7d7d7d',
                        )
                    ),
                    'rit_color_woo_single_sale_price' => array(
                        'class' => 'color',
                        'label' => esc_html__('Sale Price Color', 'ri-ione'),
                        'description' => esc_html__('Apply for single product', 'ri-ione'),
                        'priority' =>2,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_woo_single_label_lowstock' => array(
                        'class' => 'color',
                        'label' => esc_html__('Stock label color', 'ri-ione'),
                        'description' => esc_html__('Apply for single product', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                    'rit_color_woo_single_label_lowstock_border' => array(
                        'class' => 'color',
                        'label' => esc_html__('Stock label border', 'ri-ione'),
                        'description' => esc_html__('Apply for single product', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#c7b299',
                        )
                    ),
                    'rit_color_woo_single_label_outstock' => array(
                        'class' => 'color',
                        'label' => esc_html__('Out stock label color', 'ri-ione'),
                        'description' => esc_html__('Apply for single product', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#f39580',
                        )
                    ),
                    'rit_color_woo_single_label_outstock_border' => array(
                        'class' => 'color',
                        'label' => esc_html__('Out stock label border', 'ri-ione'),
                        'description' => esc_html__('Apply for single product', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#f39580',
                        )
                    ),
                    )),
            'rit_new_section_color_navigation' => array(
                'title' => esc_html__('Navigation', 'ri-ione'),
                'description' => esc_html__('Not apply if you use Mega menu or use Menu transparent style. If you use Mega menu, please change it in Mega menu plugin options.', 'ri-ione'),
                'priority' => 9,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_nav_bg_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Background Color', 'ri-ione'),
                        'priority' => 0,
                        'params' => array(
                            'default' => 'transparent',
                        ),
                    ),
                    'rit_nav_text_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Text Color', 'ri-ione'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_nav_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Link Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_nav_link_hover_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Link Hover Color', 'ri-ione'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                    'rit_nav_sub_bg_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Drop Down Background Color', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_nav_sub_bg_color_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Drop Down Background Color Hover', 'ri-ione'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_nav_sub_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Drop Down Link Color', 'ri-ione'),
                        'priority' => 5,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_nav_sub_link_hover_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Drop Down Link Hover Color', 'ri-ione'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                )
            ),
            'rit_new_section_color_footer' => array(
                'title' => esc_html__('Footer', 'ri-ione'),
                'description' => '',
                'priority' => 11,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_heading_footer_top' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Top Footer Color', 'ri-ione'),
                        'priority' => 2,
                    ),
                    'rit_footer_top_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_footer_top_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#7d7d7d',
                        ),
                    ),
                    'rit_footer_top_link' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#7d7d7d',
                        ),
                    ),
                    'rit_footer_top_link_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Hover Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                    'rit_heading_footer_center' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Main Footer Color', 'ri-ione'),
                        'priority' => 2,
                    ),
                    'rit_footer_center_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_footer_title_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Title Widget Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_footer_center_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#7d7d7d',
                        ),
                    ),
                    'rit_footer_center_link' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#7d7d7d',
                        ),
                    ),
                    'rit_footer_center_link_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Hover Color', 'ri-ione'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                    'rit_heading_footer_bottom' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Bottom Footer Color', 'ri-ione'),
                        'priority' => 3,
                    ),
                    'rit_footer_bottom_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Color', 'ri-ione'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),

                    'rit_footer_bottom_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color', 'ri-ione'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '#7d7d7d',
                        ),
                    ),
                    'rit_footer_bottom_link' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Color', 'ri-ione'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '#7d7d7d',
                        ),
                    ),
                    'rit_footer_bottom_link_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Hover Color', 'ri-ione'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '#c7b299',
                        ),
                    ),
                )
            ),
        );
        $panel = array(
            'color_panel' => array(
                'title' => esc_html__('Color Options', 'ri-ione'),
                'description' => '',
                'priority' => 29,
            ),
            'rit_woo_panel' => array(
                'title' => esc_html__('Woocommerce Options', 'ri-ione'),
                'description' => '',
                'priority' => 26,
            ),
            'rit_font_panel' => array(
                'title' => esc_html__('Fonts Options', 'ri-ione'),
                'description' => '',
                'priority' => 28,
            ),
        );
        $rit_customize->add_customize($customizers);
        $rit_customize->add_panel($panel);
        $rit_customize->rit_register_theme_customizer();
    }

    add_action('customize_register', 'rit_customize', 11);
}