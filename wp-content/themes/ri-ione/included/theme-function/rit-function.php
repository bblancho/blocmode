<?php
/**
 * Custom functions  of Ri Ione theme
 */
// Function For RIT Theme
// Customize
require get_template_directory() . '/included/customize/customize.php';
require get_template_directory() . '/included/customize/customize-style.php';
//Metabox
require get_template_directory() . '/included/meta-boxes/meta-boxes.php';
// Include Widgets
require get_template_directory() . '/included/widgets/recent-post.php';
require get_template_directory() . '/included/widgets/about-me.php';
require get_template_directory() . '/included/widgets/img-hover.php';
require get_template_directory() . '/included/widgets/testimonials-widget.php';
require get_template_directory() . '/included/widgets/widget-social-icons.php';
//All functions control header layout
//header layout
if (!function_exists('rit_header_layout')) {
    function rit_header_layout()
    {
        $rit_header_layout = get_theme_mod('rit_header_layout', 'stack-center');
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'rit_header_layout', true) != '' && get_post_meta(get_the_ID(), 'rit_header_layout', true) != 'inherit') {
                $rit_header_layout = get_post_meta(get_the_ID(), 'rit_header_layout', true);
            }
        }
        return $rit_header_layout;
    }
}
//Header stick
if (!function_exists('rit_header_stick')) {
    function rit_header_stick()
    {
        $rit_sticky = '';
        if (get_theme_mod('rit_enable_sticky_header', '')) {
            $rit_sticky = 'sticker';
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'rit_enable_sticky_header', true) == '1') {
                $rit_sticky = 'sticker';
            }
        }
        return $rit_sticky;
    }
}
//Header transparent
if(!function_exists('rit_header_transparent')){
    function rit_header_transparent(){
        $rit_header_transparent = '';
        if (get_theme_mod('rit_enable_header_transparent', '')) {
            $rit_header_transparent = 'header-transparent';
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'rit_enable_header_transparent', true) == '1') {
                $rit_header_transparent = 'header-transparent';
            }
        }
        return $rit_header_transparent;
    }
}
//Header fullwidth
if(!function_exists('rit_header_fullwidth')){
    function rit_header_fullwidth(){
        $rit_header_fullwidth = '';
        if (get_theme_mod('rit_enable_header_fullwidth', '0')) {
            $rit_header_fullwidth = 'full-width';
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'rit_enable_header_fullwidth', true) == '1') {
                $rit_header_fullwidth = 'full-width';
            }
        }
        return $rit_header_fullwidth;
    }
}
//Header fullwidth
if(!function_exists('rit_enable_header_top')){
    function rit_enable_header_top(){
        $rit_header_top = false;
        if (get_theme_mod('rit_enable_top_header', '')) {
            $rit_header_top = true;
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'rit_enable_top_header', true) == '1') {
                $rit_header_top = true;
            }
        }
        return $rit_header_top;
    }
}
//Body full width
if(!function_exists('rit_fullwidth')){
    function rit_fullwidth(){
        $rit_fullwidth=get_theme_mod('rit_enable_page_full_width','')==1?true:false;
        if(is_page() || is_single()){
            if(get_post_meta(get_the_ID(),'rit_enable_page_full_width',true)==1){
                $rit_fullwidth=true;
            }
        }
        return $rit_fullwidth;
    }
}
//End functions control header layout
//Function control Footer
if(!function_exists('rit_top_footer')){
    function rit_top_footer(){
        $rit_top_footer=false;
        if(get_theme_mod('rit_disable_top_footer','')){
            $rit_top_footer=true;
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'rit_disable_top_footer', true) == '1') {
                $rit_top_footer = true;
            }
        }
        return $rit_top_footer;
    }
}
if(!function_exists('rit_main_footer')){
    function rit_main_footer(){
        $rit_main_footer=true;
        if(get_theme_mod('rit_disable_main_footer','')){
            $rit_main_footer=false;
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'rit_disable_main_footer', true) == '1') {
                $rit_main_footer = false;
            }
        }
        return $rit_main_footer;
    }
}
//End Function control Footer
// List Sidebar
if (!function_exists('rit_sidebar')) {
    function rit_sidebar()
    {
        global $wp_registered_sidebars;
        $sidebar_options = array();
        $sidebar_options['none'] =esc_html__('None','ri-ione');
        foreach ($wp_registered_sidebars as $sidebar) {
            $sidebar_options[$sidebar['id']] = $sidebar['name'];
        }
        return $sidebar_options;
    }
}
// Footer Sticky
if (!function_exists('rit_footer_sticky')) {
    function rit_footer_sticky()
    {
        $rit_stick_footer=get_theme_mod('rit_stick_footer','')=='1'?'footer-stick':'';
        if(is_page()||is_single()){
            $rit_stick_footer=get_post_meta(get_the_ID(),'rit_stick_footer',true)==1?'footer-stick':'';
        }
        return $rit_stick_footer;
    }
}

// Merge google font
if (!function_exists('rit_merge_google_font')) {
    function rit_merge_google_font($font_array)
    {
        $fonts = array();
        foreach ($font_array as $font) {
            if (!isset($fonts[$font['family']])) {
                $fonts[$font['family']] = $font;
            } else {
                $fonts[$font['family']]['variants'] = array_merge($fonts[$font['family']]['variants'], $font['variants']);
                $fonts[$font['family']]['subsets'] = array_merge($fonts[$font['family']]['subsets'], $font['subsets']);
            }
        }
        return $fonts;
    }
}

// Get link google font
if (!function_exists('rit_create_google_font_url')) {
    function rit_create_google_font_url($font_array)
    {

        if (count($font_array) > 0) {

            $font_array = rit_merge_google_font($font_array);

            $base_url = '';
            $font_familys = array();
            $subsets = array();

            foreach ($font_array as $font) {
                if (isset($font['family'])) {
                    $font_familys[] = str_replace(' ', '+', $font['family']) . ':' . implode(',', array_unique($font['variants']));
                    $subsets = array_merge($subsets, array_unique($font['subsets']));
                }
            }
            if (count($font_familys) > 0) {
                $base_url .= implode('|', $font_familys);
            }
            if (count($subsets) > 0) {
                $base_url .= '&subset=' . implode(',', $subsets);
            }
            if ($base_url != '') {
                return '//fonts.googleapis.com/css?family=' . $base_url;
            }
        }
        return null;
    }
}
// Random ID
if (!function_exists('rit_random_ID')) {
    function rit_random_ID()
    {
        return uniqid();
    }
}
// Convert Color
if (!function_exists('rit_hex2rgba')) {
    /* Convert hexdec color string to rgb(a) string */
    function rit_hex2rgba($hex, $opacity = 1)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgba; // returns an array with the rgb values
    }
}

//Convert to rem
if(!function_exists('rit_px2rem')){
    function rit_px2rem($var){
        $var=$var/get_theme_mod('rit_body_font_size','15');
        return $var;
    }
}

// -------------------- Register Sidebar --------------------- //
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => esc_html__('Widget Area', 'ri-ione'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'ri-ione'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar 2', 'ri-ione'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add widgets here to appear in your sidebar 2.', 'ri-ione'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Top Left Header', 'ri-ione'),
        'id' => 'top-left-header',
        'description' => esc_html__('Add widgets here to appear at top left header.', 'ri-ione'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));    register_sidebar(array(
        'name' => esc_html__('Top Right Header', 'ri-ione'),
        'id' => 'top-right-header',
        'description' => esc_html__('Add widgets here to appear at top right header.', 'ri-ione'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));register_sidebar(array(
        'name' => esc_html__('Header Vertical', 'ri-ione'),
        'id' => 'header-vertical',
        'description' => esc_html__('Add widgets here to appear at header vertical.', 'ri-ione'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Top Footer', 'ri-ione'),
        'id' => 'top-footer',
        'description' => esc_html(__('Add widgets here to appear at top footer.', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-footer-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 1', 'ri-ione'),
        'id' => 'main-footer-1',
        'description' => esc_html(__('Add widgets here to appear at main footer 1.', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-footer-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 2', 'ri-ione'),
        'id' => 'main-footer-2',
        'description' => esc_html(__('Add widgets here to appear at main footer 2.', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-footer-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 3', 'ri-ione'),
        'id' => 'main-footer-3',
        'description' => esc_html(__('Add widgets here to appear at main footer 3.', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-footer-title">',
        'after_title' => '</h3>',
    ));    register_sidebar(array(
        'name' => esc_html__('Main Footer 4', 'ri-ione'),
        'id' => 'main-footer-4',
        'description' => esc_html(__('Add widgets here to appear at main footer 4.', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-footer-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Bottom Footer', 'ri-ione'),
        'id' => 'bottom-footer',
        'description' => esc_html(__('Add widgets here to appear at bottom footer.', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Left Bottom Footer for Footer Style 2', 'ri-ione'),
        'id' => 'left-bottom-footer',
        'description' => esc_html(__('Add widgets here to appear at left bottom footer. Work with footer style 2', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Right Bottom Footer for Footer Style 2', 'ri-ione'),
        'id' => 'right-bottom-footer',
        'description' => esc_html(__('Add widgets here to appear at right bottom footer. Work with footer style 2', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer for footer style 3', 'ri-ione'),
        'id' => 'main-footer-simple',
        'description' => esc_html(__('Add widgets here to appear at main footer of style 3.', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-footer-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Bottom Footer for footer style 3', 'ri-ione'),
        'id' => 'bottom-footer-simple',
        'description' => esc_html(__('Add widgets here to appear at bottom footer of style 3.', 'ri-ione')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Popup Widget', 'ri-ione'),
        'id' => 'popup_widget',
        'description' => esc_html__('Add widgets here to appear at popup widget when page load. All control of this widget you can find at Customize -> Sidebar Options', 'ri-ione'),
        'before_widget' => '<div id="%1$s" class="popup-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
}
/* COMMENTS */
if (!function_exists('rit__custom_comments')) {
    function rit__custom_comments($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $depth;
        ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix') ?>>
        <div class="comment-wrap clearfix">
            <div class="comment-avatar">
                <?php if (function_exists('get_avatar')) {
                    echo wp_kses(get_avatar($comment, '50'), array('img' => array('class' => array(), 'width' => array(), 'height' => array(), 'alt' => array(), 'src' => array())));
                } ?>
            </div>
            <div class="comment-content">
                <div class="comment-meta">
                    <?php
                    printf('<h6 class="author-name">%1$s</h6>',
                        get_comment_author_link()
                    );
                    echo '<span class="date-post">' . esc_html(get_comment_date('M, j, Y', get_comment_ID())) . '</span>';
                    ?>
                </div>
                <?php if ($comment->comment_approved == '0') wp_kses(__("\t\t\t\t\t<span class='unapproved'>" . esc_html__('Your comment is awaiting moderation.', 'ri-ione') . "</span>\n", 'ri-ione'), array('span' => array('class' => array()))); ?>
                <div class="comment-body">
                    <?php comment_text() ?>
                </div>
                <div class="comment-meta-actions">
                    <?php
                    edit_comment_link(esc_html(__('Edit', 'ri-ione')), '<span class="edit-link">', '</span>');
                    ?>
                    <?php if ($args['type'] == 'all' || get_comment_type() == 'comment') :
                        comment_reply_link(array_merge($args, array(
                            'reply_text' => esc_html(__('Reply', 'ri-ione')),
                            'login_text' => esc_html(__('Log in to reply.', 'ri-ione')),
                            'depth' => $depth,
                            'before' => '<span class="comment-reply">',
                            'after' => '</span>'
                        )));
                    endif; ?>
                </div>
            </div>
        </div>
    <?php }
}
// Add Edit Style
if (!function_exists("rit_add_editor_styles")) {
    function rit_add_editor_styles()
    {
        add_editor_style('css/editor-style.css');
    }
}
add_action('admin_init', 'rit_add_editor_styles');
/**
 * Load media files needed for Uploader
 */
add_action( 'admin_enqueue_scripts', 'rit_load_wp_media_files' );
if (!function_exists('rit_load_wp_media_files')) {
    function rit_load_wp_media_files()
    {
        wp_enqueue_media();
    }
}
/**
 * Include the TGM_Plugin_Activation class.
 */
require get_template_directory() . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'ri_ione_register_required_plugins');

/**
 * Register the required plugins for this theme.
 */
if(!function_exists('ri_ione_register_required_plugins')) {
    function ri_ione_register_required_plugins()
    {
        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(

            // This is an example of how to include a plugin pre-packaged with a theme.
            array(
                'name' => esc_html__('River Theme core', 'ri-ione'),
                'slug' => 'rit-core',
                'source' => get_template_directory() . '/lib/plugin/rit-core.zip',
                'required' => true,
            ),

            array(
                'name' => esc_html__('Revolution Slider', 'ri-ione'),
                'slug' => 'revslider',
                'source' => get_template_directory() . '/lib/plugin/revslider.zip',
                'required' => true,
                'version' => '5.4.3'
            ),

            array(
                'name' => esc_html__('Visual Composer', 'ri-ione'),
                'slug' => 'js-composer',
                'source' => get_template_directory() . '/lib/plugin/js_composer.zip',
                'required' => true,
                'version' => '5.1.1'
            ),
            array(
                'name' => esc_html__('Woocommerce', 'ri-ione'),
                'slug' => 'woocommerce',
                'required' => true,
            ),
            array(
                'name' => esc_html__('Woocommerce product filter', 'ri-ione'),
                'slug' => 'prdctfltr',
                'source' => get_template_directory() . '/lib/plugin/woocommerce-product-filter.zip',
                'required' => true,
                'version' => '6.1.1'
            ),
            array(
                'name' => esc_html__('Meta Box', 'ri-ione'),
                'slug' => 'meta-box',
                'required' => true,
            ),
            array(
                'name' => esc_html__('Contact Form 7', 'ri-ione'),
                'slug' => 'contact-form-7',
                'required' => false,
            ),
            array(
                'name' => esc_html__('Clever Mega Menu', 'ri-ione'),
                'slug' => 'clever-mega-menu',
                'source' => get_template_directory() . '/lib/plugin/clever-mega-menu.zip',
                'required' => false,
                'version' => '1.0.3'
            ),

            array(
                'name' => esc_html__('Newsletter', 'ri-ione'),
                'slug' => 'newsletter',
                'required' => false,
            ),
            array(
                'name' => esc_html__('Instagram Feed', 'ri-ione'),
                'slug' => 'instagram-feed',
                'required' => false,
            ),
            array(
                'name' => esc_html__('WP User Avatar', 'ri-ione'),
                'slug' => 'wp-user-avatar',
                'required' => false,
            ), array(
                'name' => esc_html__('YITH WooCommerce Wishlist', 'ri-ione'),
                'slug' => 'yith-woocommerce-wishlist',
                'required' => false,
            ), array(
                'name' => esc_html__('YITH WooCommerce Ajax Search', 'ri-ione'),
                'slug' => 'yith-woocommerce-ajax-search',
                'required' => false,
            )
        );
        $config = array(
            'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu' => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug' => 'themes.php',            // Parent menu slug.
            'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices' => true,                    // Show admin notices or not.
            'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message' => '',                      // Message to output right before the plugins table.
            'strings' => array(
                'page_title' => esc_html(__('Install Required Plugins', 'ri-ione')),
                'menu_title' => esc_html(__('Install Plugins', 'ri-ione')),
                'installing' => esc_html(__('Installing Plugin: %s', 'ri-ione')), // %s = plugin name.
                'oops' => esc_html(__('Something went wrong with the plugin API.', 'ri-ione')),
                'notice_can_install_required' => _n_noop(
                    'This theme requires the following plugin: %1$s.',
                    'This theme requires the following plugins: %1$s.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'notice_can_install_recommended' => _n_noop(
                    'This theme recommends the following plugin: %1$s.',
                    'This theme recommends the following plugins: %1$s.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'notice_cannot_install' => _n_noop(
                    'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'notice_ask_to_update' => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'notice_ask_to_update_maybe' => _n_noop(
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'notice_cannot_update' => _n_noop(
                    'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'notice_can_activate_required' => _n_noop(
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'notice_cannot_activate' => _n_noop(
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                    'ri-ione'
                ), // %1$s = plugin name(s).
                'install_link' => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'ri-ione'
                ),
                'update_link' => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'ri-ione'
                ),
                'activate_link' => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'ri-ione'
                ),
                'return' => esc_html(__('Return to Required Plugins Installer', 'ri-ione')),
                'plugin_activated' => esc_html(__('Plugin activated successfully.', 'ri-ione')),
                'activated_successfully' => esc_html(__('The following plugin was activated successfully:', 'ri-ione')),
                'plugin_already_active' => esc_html(__('No action taken. Plugin %1$s was already active.', 'ri-ione')),  // %1$s = plugin name(s).
                'plugin_needs_higher_version' => esc_html(__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'ri-ione')),  // %1$s = plugin name(s).
                'complete' => esc_html(__('All plugins installed and activated successfully. %1$s', 'ri-ione')), // %s = dashboard link.
                'contact_admin' => esc_html(__('Please contact the administrator of this site for help.', 'ri-ione')),
                'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa($plugins, $config);

    }
}