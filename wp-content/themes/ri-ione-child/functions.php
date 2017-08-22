<?php

/* Chargement de la feuille du style du theme parent */
add_action( 'wp_enqueue_scripts', 'wpchild_enqueue_styles' );

function wpchild_enqueue_styles(){
  wp_enqueue_style( 'wpm-ri-ione-style', get_template_directory_uri() . '/style.css' );
}

require_once(ABSPATH .'wp-content/themes/ri-ione-child/customs-posts-types/custom_article.php') ;
require_once(ABSPATH ."wp-content/themes/ri-ione-child/inc/pages-admin-custom/admin-social-network.php") ;
require_once(ABSPATH ."wp-content/themes/ri-ione-child/inc/pages-admin-custom/admin-liste-shopstyle.php") ;
//require_once(ABSPATH .'wp-content/themes/ri-ione/customs-posts-types/functions.php');

// Création des tailles d'images des produits

add_image_size('article', 400, 600, true) ;
add_image_size('liste_articles', 270,auto, true);
add_image_size('articles_similaires', 220,auto, true);
add_image_size('folio', 495,330, true);
