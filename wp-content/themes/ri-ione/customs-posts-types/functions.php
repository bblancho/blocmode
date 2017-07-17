<?php

if (!function_exists('load_my_files')) {

	if( !is_admin() ) { //Charges les fichiers SAUF sur l'administration du site
	    function load_my_files()
	    {
	        wp_enqueue_style('style_perso', get_template_directory_uri() . '/css/style_perso.css');
	    }
	}
}

add_action('wp_enqueue_scripts', 'load_my_files');