<?php

function sukawati_get_all_widget_list_plugin()
{
    $widgetlist = get_option(SUKAWATI_WIDGET_NAME) ? get_option(SUKAWATI_WIDGET_NAME) : array() ;
    $defaultwidget = array(
        SUKAWATI_SHOP_WIDGET,
        SUKAWATI_SIDEBAR_WIDGET,
        SUKAWATI_FOOTER_WIDGET_1,
        SUKAWATI_FOOTER_WIDGET_2,
        SUKAWATI_FOOTER_WIDGET_3,
        SUKAWATI_FOOTER_INSTAGRAM,
        SUKAWATI_FOOTER_SUBSCRIBE
    );
    return array_merge($defaultwidget, $widgetlist);
}

/*** Additional Widget **/
function sukawati_is_widget_page() {
    return in_array($GLOBALS['pagenow'], array('widgets.php'));
}

function sukawati_load_widget_script() {
    if(sukawati_is_widget_page()) {
        wp_enqueue_script('sukawati-widget-js', get_template_directory_uri() . '/admin/assets/js/widget.js', array('jquery'), null);
        wp_enqueue_style ('sukawati-fontawesome', get_template_directory_uri() . '/css/fontawesome/css/font-awesome.min.css', null, null);
        wp_enqueue_style ('sukawati-widget-css', get_template_directory_uri() . '/admin/assets/css/widget.css', null, null);
    }
}

function sukawati_additional_widget_button() {
    if(sukawati_is_widget_page()) {
        echo wp_kses("<a class='sidebarwidget add-new-h2'>" . 'Add or remove widget area' . "</a><div class='clearfix'></div>", array(
            'a' => array(
                'class' => true
            ),
            'div' => array(
                'class' => true
            ),
        ));
    }
}

function sukawati_save_widgetlist() {
    if(sukawati_is_widget_page()) {
        if(isset($_POST['modifwidget'])) {
            if(isset($_POST['widgetlist'])) {
                update_option(SUKAWATI_WIDGET_NAME, $_POST['widgetlist'] );
            } else {
                delete_option(SUKAWATI_WIDGET_NAME);
            }
        }
    }
}

function sukawati_populate_widget () {
    $widgetlist = get_option(SUKAWATI_WIDGET_NAME);
    $html = '';
    if( $widgetlist) {
        foreach($widgetlist as $widget) {
            $html .= "<li><span>" . $widget . "</span><input type='hidden' name='widgetlist[]' value='" . $widget . "'><div class='remove fa fa-ban'></div></li>";
        }
        return $html;
    }
}

function sukawati_widget_admin_page() {
    if(sukawati_is_widget_page()) {
        echo
            "<div class='widget-overlay'>
                <form method='POST'>
                    <div class='widget-overlay-wrapper'>
                        <h3>" . 'Edit widget Area'. "</h3>
                    <div class='close fa fa-times'></div>
                    <div class='widget-content-list'>
                        <div class='widget-content-wrapper'>
                            <h4>Widget Area List</h4>
                            <ul> " . sukawati_populate_widget() .  "</ul>
                        </div>
                        <div class='widget-confirm'>
                            <input type='button' class='addwidget' value='" .  'Create Widget Area' . "'>
                            <input type='submit' class='savewidget' style='background-color: #5CB85C;' value='" .  'Save Widget'  . "'>
                        </div>
                    </div>
                    <div class='widget-adding-content'>
                        <div class='widget-additional'>
                            <h4>" .  'Create Widget Area' . "</h4>
                            <input type='text' class='textwidgetconfirm' placeholder='" .  'Enter name of widget'  . "'>
                        </div>
                        <div class='widget-confirm'>
                            <input type='button' class='addwidgetconfirm' value='" .  'Add Widget'  . "'>
                        </div>
                    </div>
                </div>
                <input type='hidden' name='modifwidget' value='1'/>
                " . wp_nonce_field( 'edit-widgetlist' ) . "
            </form>
        </div>";
    }
}

/** register sidebar **/
if(!function_exists('sukawati_theme_register_widget')) {
    function sukawati_theme_register_widget($sidebars) {
        if($sidebars) {
            foreach($sidebars as $sidebar) {
                if ( $sidebar == SUKAWATI_FOOTER_WIDGET_1 ||  $sidebar == SUKAWATI_FOOTER_WIDGET_2 || $sidebar == SUKAWATI_FOOTER_WIDGET_3 || $sidebar == SUKAWATI_FOOTER_INSTAGRAM ) {
                    // footer widget
                    register_sidebar(array(
                        'name'          => $sidebar,
                        'id'            => sanitize_title($sidebar),
                        'before_widget' => '<div class="footerwidget %2$s" id="%1$s">',
                        'before_title'  => '<h3 class="footerwidget-title"><span>',
                        'after_title'   => '</span></h3>',
                        'after_widget'  => '</div>',
                    ));
                } elseif ( $sidebar == SUKAWATI_FOOTER_SUBSCRIBE ) {
                    // Subscribe Form widget
                    register_sidebar(array(
                        'name'          => $sidebar,
                        'id'            => sanitize_title($sidebar),
                        'before_widget' => '<div class="footersubscribe %2$s" id="%1$s">',
                        'before_title'  => '<h1 class="footersubscribe-title">',
                        'after_title'   => '</h1>',
                        'after_widget'  => '</div>',
                    ));
                } elseif( $sidebar == SUKAWATI_SHOP_WIDGET ) {
                    register_sidebar(array(
                        'name'          => SUKAWATI_SHOP_WIDGET,
                        'id'            => sanitize_title(SUKAWATI_SHOP_WIDGET),
                        'before_widget' => '<aside class="widget %2$s" id="%1$s">',
                        'before_title'  => '<h3 class="widget-title"><span>',
                        'after_title'   => '</span></h3>',
                        'after_widget'  => '</aside>',
                    ));
                } else {
                    // normal blog sidebar
                    register_sidebar(array(
                        'name'          => $sidebar,
                        'id'            => sanitize_title($sidebar),
                        'before_widget' => '<aside class="widget %2$s" id="%1$s">',
                        'before_title'  => '<h3 class="widget-title"><span>',
                        'after_title'   => '</span></h3>',
                        'after_widget'  => '</aside>',
                    ));
                }
            }
        }
    }
}

function sukawati_get_all_widget_list()
{
    $widgetlist = get_option(SUKAWATI_WIDGET_NAME) ? get_option(SUKAWATI_WIDGET_NAME) : array() ;
    $defaultwidget = array(
        SUKAWATI_SHOP_WIDGET,
        SUKAWATI_SIDEBAR_WIDGET,
        SUKAWATI_FOOTER_WIDGET_1,
        SUKAWATI_FOOTER_WIDGET_2,
        SUKAWATI_FOOTER_WIDGET_3,
        SUKAWATI_FOOTER_INSTAGRAM,
        SUKAWATI_FOOTER_SUBSCRIBE
    );
    return array_merge($defaultwidget, $widgetlist);
}

function sukawati_register_widget_list()
{
    $widgetlist = sukawati_get_all_widget_list();
    sukawati_theme_register_widget($widgetlist);
}

add_action('widgets_init', 'sukawati_register_widget_list');
add_action('widgets_admin_page', 'sukawati_additional_widget_button');
add_action('sidebar_admin_page', 'sukawati_widget_admin_page');
add_action('after_setup_theme', 'sukawati_save_widgetlist');
add_action('admin_enqueue_scripts', 'sukawati_load_widget_script');