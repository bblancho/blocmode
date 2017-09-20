<?php
require_once(ABSPATH .'wp-content/themes/ri-ione-child/inc/custom_post_type/custom_book.php') ;
require_once(ABSPATH .'wp-content/themes/ri-ione-child/inc/custom_post_type/custom_article.php') ;


require_once(ABSPATH ."wp-content/themes/ri-ione-child/inc/pages-admin-custom/admin-social-network.php") ;
require_once(ABSPATH ."wp-content/themes/ri-ione-child/inc/pages-admin-custom/admin-liste-shopstyle.php") ;

/* Chargement de la feuille du style du theme parent */

function wpchild_enqueue_styles(){
  wp_enqueue_style( 'wpm-ri-ione-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpchild_enqueue_styles' );


function Texa_meta_admin_css() {

	$admin_handle = 'texa_meta_admin_css';
	$admin_stylesheet = get_template_directory_uri() . '/inc/Tax-meta-class/css/Tax-meta-class.css';

	wp_enqueue_style( $admin_handle, $admin_stylesheet );
}
add_action('admin_enqueue_scripts', 'Texa_meta_admin_css', 11 );


function Texa_meta_admin_js() {

	$admin_handle = 'texa_meta_admin_js';
	$admin_stylesheet = get_template_directory_uri() . '/inc/Tax-meta-class/js/Tax-meta-class.js';

	wp_enqueue_script( $admin_handle, $admin_stylesheet );
}
add_action('admin_enqueue_scripts', 'Texa_meta_admin_js', 11 );


//require_once(ABSPATH .'wp-content/themes/ri-ione/customs-posts-types/functions.php');

// Création des tailles d'images des produits

add_image_size('article', 400, 600, true) ;
add_image_size('liste_articles', 270,auto, true);
add_image_size('articles_similaires', 220,auto, true);
add_image_size('folio', 495,330, true);
