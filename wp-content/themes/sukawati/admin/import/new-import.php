<?php

class Sukawati_Import
{
    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function __construct(){
        $this->hook();
    }

    public function hook()
    {
        add_action('wp_ajax_import_content'				, array(&$this, 'import_process'));
        add_action('wp_ajax_nopriv_import_content'		, array(&$this, 'import_process'));
    }

    public function import_process()
    {
        $type = $_REQUEST['type'];
        $demo = $_REQUEST['number'];

        if($type === 'content') {
            $this->import_content($demo);
        }

        if($type === 'setting') {
            $this->import_setting($demo);
        }

        exit;
    }

    public function import_content($id)
    {
        $importer_file = get_template_directory() . '/admin/import/data/data_'  . $id .  '.xml';
        $importer_error = false;

        defined( 'WP_LOAD_IMPORTERS' ) or define('WP_LOAD_IMPORTERS', true);
        require_once ABSPATH . 'wp-admin/includes/import.php';


        if ( !class_exists( 'WP_Importer' ) ) {
            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            if ( file_exists( $class_wp_importer ) ){
                require_once($class_wp_importer);
            }
            else {
                $importer_error = true;
            }
        }

        if ( !class_exists( 'WP_Import' ) ) {
            $class_wp_import = JEG_PLUGIN_DIR . '/importer/wordpress-importer.php';
            if ( file_exists( $class_wp_import ) ) {
                require_once($class_wp_import);
            }
            else {
                $importer_error = true;
            }
        }

        if($importer_error){
            die("Error in import");
        } else {
            if(!is_file( $importer_file )){
                echo esc_html("The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually ");
            }
            else {
                $this->prepare_import();

                ob_start();
                $wp_import = new WP_Import();
                $wp_import->fetch_attachments = true;
                $wp_import->import( $importer_file );
                ob_end_clean();
            }
        }
    }

    public function print_content()
    {
        $this->enqueue_script();
        get_template_part('admin/import/import-view');
    }

    public function enqueue_script()
    {
        wp_enqueue_style('sukawati-import-css', get_template_directory_uri() .'/css/import.css', null, SUKAWATI_VERSION);
        wp_enqueue_script( 'sukawati-import-js', get_template_directory_uri() .'/js/import.js', null, SUKAWATI_VERSION, true);

        $importdata = array();
        $importdata['adminurl'] = admin_url( 'admin-ajax.php' );
        wp_localize_script('sukawati-import-js', 'joption', $importdata);
    }



    public function prepare_import()
    {
        // prevent double menu
        $termarray = array();
        $termarray[0] = get_term_by('name','Primary Menu', 'nav_menu');
        $termarray[1] = get_term_by('name','Mobile Menu', 'nav_menu');

        foreach($termarray as $term) {
            if(is_object($term)) {
                wp_delete_nav_menu($term->term_id);
            }
        }
    }


    /************************
     * IMPORT SETTING
     ***********************/


    public function import_setting($id)
    {
        // setup widget
        $this->set_widget($id);

        // import admin panel setting
        $this->import_admin_setting($id);

        // set homepage
        $this->set_homepage($id);

        // set style
        $this->set_style($id);

        // setup menu
        $this->set_menu($id);

        // setup popular post (clicked)
        $this->setup_popular_post();

        // setup shop
        $this->set_shop();
    }


    /************************
     * SETUP SHOP
     ***********************/

    public function set_shop()
    {
        $options = array(
            'woocommerce_myaccount_page_id' => 'My Account',
            'woocommerce_cart_page_id' => 'Cart',
            'woocommerce_checkout_page_id' => 'Checkout',
            'woocommerce_shop_page_id' => 'Shop'
        );

        foreach($options as $key => $page) {
            $pageid = get_option($key);
            if(!$pageid) {
                $page = get_page_by_title($page, OBJECT, 'page');
                update_option($key, $page->ID);
            }
        }

    }

    /************************
     * POPULAR POST
     ***********************/

    public function setup_popular_post()
    {

        global $wpdb;
        $table = $wpdb->prefix . "popularposts";
        $now = current_time('mysql');
        $curdate = gmdate( 'Y-m-d', ( time() + ( get_site_option( 'gmt_offset' ) * 3600 ) ));
        $views = 1;

        $posts = wp_get_recent_posts(array(
            'numberposts' => 10,
        ), ARRAY_A);

        foreach($posts as $post){

            $wpdb->query( $wpdb->prepare(
                "INSERT INTO {$table}data
				(postid, day, last_viewed, pageviews) VALUES (%d, %s, %s, %d)
				ON DUPLICATE KEY UPDATE pageviews = pageviews + %4\$d, last_viewed = '%3\$s';",
                $post['ID'],
                $now,
                $now,
                $views
            ));

            $wpdb->query( $wpdb->prepare(
                "INSERT INTO {$table}summary
				(postid, pageviews, view_date, last_viewed) VALUES (%d, %d, %s, %s)
				ON DUPLICATE KEY UPDATE pageviews = pageviews + %2\$d, last_viewed = '%4\$s';",
                $post['ID'],
                $views,
                $curdate,
                $now
            ));

        };
    }


    /************************
     * SETUP STYLE
     ***********************/


    public function set_style($id)
    {
        ob_start();
        locate_template(array('admin/import/data/style_' . $id . '.dat'), true, true);
        $content = ob_get_contents();
        ob_end_clean();

        // removing theme mod first
        remove_theme_mods();

        global $wp_customize;
        $data = @unserialize( $content );

        if ( isset( $data['options'] ) ) {

            foreach ( $data['options'] as $option_key => $option_value ) {

                $option = new Sukawati_Customize_Setting( $wp_customize, $option_key, array(
                    'default'		=> '',
                    'type'			=> 'option',
                    'capability'	=> 'edit_theme_options'
                ) );

                $option->import( $option_value );
            }
        }

        // Call the customize_save action.
        do_action( 'customize_save', $wp_customize );

        // Loop through the mods.
        foreach ( $data['mods'] as $key => $val ) {

            // Call the customize_save_ dynamic action.
            do_action( 'customize_save_' . $key, $wp_customize );

            // Save the mod.
            set_theme_mod( $key, $val );
        }

        // Call the customize_save_after action.
        do_action( 'customize_save_after', $wp_customize );
    }



    /************************
     * SETUP MENU
     ***********************/


    public function set_menu($id)
    {
        $mainmenu = get_term_by('name','Main Menu', 'nav_menu');

        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $mainmenu->term_id;
        $locations['mobile'] = $mainmenu->term_id;

        set_theme_mod( 'nav_menu_locations', $locations );
    }



    /************************
     * IMPORT ADMIN SETTING
     ***********************/


    public function import_admin_setting($id)
    {
        global $joptionglobal;

        ob_start();
        locate_template(array('admin/import/data/backend_' . $id . '.json'), true, true);
        $content = ob_get_contents();
        ob_end_clean();

        $joptionglobal->import_option($content);
    }



    /************************
     * SETUP HOMEPAGE
     ***********************/

    public function set_homepage($id)
    {
        update_option('show_on_front', 'page');

        $pagename = '';
        if($id == 1) $pagename = 'Home';
        if($id == 2) $pagename = 'Home 3';
        if($id == 3) $pagename = 'Home';
        if($id == 4) $pagename = 'Home';
        if($id == 5) $pagename = 'Home 3';

        $homepage = get_page_by_title($pagename);
        if($homepage) {
            update_option('page_on_front', $homepage->ID);
        }

        $helloworld = get_page_by_title('Hello world!', OBJECT, 'post');
        if($helloworld) {
            wp_delete_post($helloworld->ID, false);
        }
    }



    /************************
     * WIDGET IMPORT
     ***********************/


    public function set_widget($id)
    {
        $this->reset_widget_content();

        ob_start();
        locate_template(array('admin/import/data/widget_' . $id . '.wie'), true, true);
        $content = ob_get_contents();
        ob_end_clean();
        $data = json_decode($content);

        $this->do_import_widget($data);
    }

    public function do_import_widget($data)
    {
        // available widget
        global $wp_registered_sidebars;
        $available_widgets = $this->available_widgets();

        $widget_instances = array();
        foreach ( $available_widgets as $widget_data ) {
            $widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
        }

        foreach ( $data as $sidebar_id => $widgets ) {

            // Skip inactive widgets
            // (should not be in export file)
            if ( 'wp_inactive_widgets' == $sidebar_id ) {
                continue;
            }

            // Check if sidebar is available on this site
            // Otherwise add widgets to inactive, and say so
            if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
                $sidebar_available = true;
                $use_sidebar_id = $sidebar_id;
                $sidebar_message_type = 'success';
                $sidebar_message = '';
            } else {
                $sidebar_available = false;
                $use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
                $sidebar_message_type = 'error';
                $sidebar_message = 'Sidebar does not exist in theme (using Inactive)';
            }

            // Result for sidebar
            $results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
            $results[$sidebar_id]['message_type'] = $sidebar_message_type;
            $results[$sidebar_id]['message'] = $sidebar_message;
            $results[$sidebar_id]['widgets'] = array();

            // Loop widgets
            foreach ( $widgets as $widget_instance_id => $widget ) {

                $fail = false;

                // Get id_base (remove -# from end) and instance ID number
                $id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
                $instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

                // Does site support this widget?
                if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
                    $fail = true;
                    $widget_message_type = 'error';
                    $widget_message = 'Site does not support widget'; // explain why widget not imported
                }

                // Filter to modify settings object before conversion to array and import
                // Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
                // Ideally the newer wie_widget_settings_array below will be used instead of this
                $widget = apply_filters( 'sukawati_widget_settings', $widget ); // object

                // Convert multidimensional objects to multidimensional arrays
                // Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
                // Without this, they are imported as objects and cause fatal error on Widgets page
                // If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
                // It is probably much more likely that arrays are used than objects, however
                $widget = json_decode( json_encode( $widget ), true );

                // Filter to modify settings array
                // This is preferred over the older wie_widget_settings filter above
                // Do before identical check because changes may make it identical to end result (such as URL replacements)
                $widget = apply_filters( 'wie_widget_settings_array', $widget );

                // Does widget with identical settings already exist in same sidebar?
                if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

                    // Get existing widgets in this sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' );
                    $sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

                    // Loop widgets with ID base
                    $single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
                    foreach ( $single_widget_instances as $check_id => $check_widget ) {

                        // Is widget in same sidebar and has identical settings?
                        if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

                            $fail = true;
                            $widget_message_type = 'warning';
                            $widget_message = 'Widget already exists'; // explain why widget not imported

                            break;

                        }

                    }

                }

                // No failure
                if ( ! $fail ) {

                    // Add widget instance
                    $single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
                    $single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
                    $single_widget_instances[] = $widget; // add it

                    // Get the key it was given
                    end( $single_widget_instances );
                    $new_instance_id_number = key( $single_widget_instances );

                    // If key is 0, make it 1
                    // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
                    if ( '0' === strval( $new_instance_id_number ) ) {
                        $new_instance_id_number = 1;
                        $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                        unset( $single_widget_instances[0] );
                    }

                    // Move _multiwidget to end of array for uniformity
                    if ( isset( $single_widget_instances['_multiwidget'] ) ) {
                        $multiwidget = $single_widget_instances['_multiwidget'];
                        unset( $single_widget_instances['_multiwidget'] );
                        $single_widget_instances['_multiwidget'] = $multiwidget;
                    }

                    // Update option with new widget
                    update_option( 'widget_' . $id_base, $single_widget_instances );

                    // Assign widget instance to sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
                    $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
                    $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
                    update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

                    // After widget import action
                    $after_widget_import = array(
                        'sidebar'           => $use_sidebar_id,
                        'sidebar_old'       => $sidebar_id,
                        'widget'            => $widget,
                        'widget_type'       => $id_base,
                        'widget_id'         => $new_instance_id,
                        'widget_id_old'     => $widget_instance_id,
                        'widget_id_num'     => $new_instance_id_number,
                        'widget_id_num_old' => $instance_id_number
                    );
                    do_action( 'sukawati_after_widget_import', $after_widget_import );

                    // Success message
                    if ( $sidebar_available ) {
                        $widget_message_type = 'success';
                        $widget_message = 'Imported';
                    } else {
                        $widget_message_type = 'warning';
                        $widget_message = 'Imported to Inactive';
                    }
                }

                // Result for widget instance
                $results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
                $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = ! empty( $widget['title'] ) ? $widget['title'] : 'No Title'; // show "No Title" if widget instance is untitled
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
            }
        }
    }

    public function available_widgets()
    {
        global $wp_registered_widget_controls;
        $widget_controls = $wp_registered_widget_controls;
        $available_widgets = array();

        foreach ( $widget_controls as $widget ) {
            if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes
                $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
                $available_widgets[$widget['id_base']]['name'] = $widget['name'];
            }
        }

        return $available_widgets;
    }

    public function reset_widget_content()
    {
        $sidebarOptions = get_option('sidebars_widgets');

        foreach($sidebarOptions as $sidebar_name => $sidebar_value) {
            if(is_array($sidebar_value)) {
                unset($sidebarOptions[$sidebar_name]);
                $sidebarOptions[$sidebar_name] = array();
            }
        }

        update_option('sidebars_widgets', $sidebarOptions);
    }
}

require_once ABSPATH . 'wp-includes/class-wp-customize-setting.php';
final class Sukawati_Customize_Setting extends WP_Customize_Setting {

    /**
     * Import an option value for this setting.
     *
     * @since 0.3
     * @param mixed $value The option value.
     * @return void
     */
    public function import( $value )
    {
        $this->update( $value );
    }
}

Sukawati_Import::getInstance();

function sukawati_import_view(){
    Sukawati_Import::getInstance()->print_content();
}


