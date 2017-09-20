<?php
require_once(ABSPATH .'wp-content/themes/ri-ione-child/inc/Tax-meta-class/Tax-meta-class.php');
add_theme_support( 'post-thumbnails' );  //active les Post thumbnails (images à la une)


// Création de notre custom post type produit
function init_custom_produit(){

	$labels = array(
		'name' => 'produits',
		'singular_name' => 'produit',
		'menu_name' => 'Articles ShopStyle',
		'add_new' => 'Ajouter un produit',
		'add_new_item' => 'Ajouter un produit',
		'edit_item' => 'Modifier un produit',
		'new_item' => 'Nouveau produit',
		'all_items' => 'Tous les produits',
		'view_item' => 'Afficher le produit',
		'search_items' => 'Chercher un produit',
		'not_found' => 'Aucun produit trouvé',
		'not_found_in_trash' => 'Aucun produit trouvé dans la corbeille',
		
	);

	$args = array(
		'labels' => $labels,
		'description' => 'Description de l\'produit',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'produits' ),
		'capability_type' => 'post',
		'has_archive' => true,
		'menu_icon'   => 'dashicons-products',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments'),
		'register_meta_box_cb' => 'add_meta_boxes_produit' // On rattache une meta boxe à notre produit
	);
	
	//Création de notre custom post type
	register_post_type('produit',$args);
}

// On crée  notre custom type de type produits
add_action('init','init_custom_produit') ;

/******************************************* Fin du custom post type **************************/



/*********** On crée la taxonomy category, marque, couleur pour classer nos articles ************/

// taxonomy category
function init_taxonomy_category(){

	$labels = array(
		'name'							=> _x( 'Categorie', 'taxonomy general name', 'my_plugin' ),
		'singular_name'					=> _x( 'Categorie', 'taxonomy singular name', 'my_plugin' ),
		'menu_name'						=> _x( 'Categories', 'taxonomy general name', 'my_plugin' ),
		'search_items'					=> __( 'Rechercher une categorie', 'my_plugin' ),
		'popular_items'					=> __( 'Categories populaires', 'my_plugin' ),
		'all_items'						=> __( 'Toutes les categories', 'my_plugin' ),
		'parent_item'					=> __( 'Categorie parent', 'my_plugin' ),
		'parent_item_colon'				=> __( 'Categorie parent', 'my_plugin' ),
		'edit_item'						=> __( 'Modifier cette categorie', 'my_plugin' ),
		'view_item'						=> __( 'Afficher cette categorie', 'my_plugin' ),
		'update_item'					=> __( 'Mettre à jour cette categorie', 'my_plugin' ),
		'add_new_item'					=> __( 'Ajouter une nouvelle categorie', 'my_plugin' ),
		'new_item_name'					=> __( 'Ajouter une nouvelle categorie', 'my_plugin' ),
		'not_found'						=> __( 'Aucune categorie trouvée', 'my_plugin' ),
	);

	$rewrite = array(
		'slug'                       => 'produit_categorie',
		'with_front'                 => true,
		'hierarchical'               => false,
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var' 				 => true,
		'rewrite'                    => $rewrite,
	);

	register_taxonomy('categorie', array('produit'), $args);
}

add_action('init','init_taxonomy_category');


// taxonomy marque 
function init_taxonomy_marque(){

	$labels = array(
		'name'							=> _x( 'Marques', 'taxonomy general name', 'my_plugin' ),
		'singular_name'					=> _x( 'Marque', 'taxonomy singular name', 'my_plugin' ),
		'menu_name'						=> _x( 'Marques', 'taxonomy general name', 'my_plugin' ),
		'search_items'					=> __( 'Rechercher une Marque', 'my_plugin' ),
		'popular_items'					=> __( 'Marques populaires', 'my_plugin' ),
		'all_items'						=> __( 'Toutes les marques', 'my_plugin' ),
		'parent_item'					=> __( 'Marques parent', 'my_plugin' ),
		'parent_item_colon'				=> __( 'Marques parent', 'my_plugin' ),
		'edit_item'						=> __( 'Modifier cette Marque', 'my_plugin' ),
		'view_item'						=> __( 'Afficher cette Marque', 'my_plugin' ),
		'update_item'					=> __( 'Mettre à jour cette Marque', 'my_plugin' ),
		'add_new_item'					=> __( 'Ajouter une nouvelle Marque', 'my_plugin' ),
		'new_item_name'					=> __( 'Ajouter une nouvelle Marque', 'my_plugin' ),
		'not_found'						=> __( 'Aucune Marque trouvée', 'my_plugin' ),
	);

	$rewrite = array(
		'slug'                       => 'produit_marques',
		'with_front'                 => true,
		'hierarchical'               => true,
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var' 				 => true,
		'rewrite'                    => $rewrite,
	);

	register_taxonomy('marques', array('produit'), $args);
}

add_action('init','init_taxonomy_marque');


// taxonomy couleur
function init_taxonomy_couleur(){

	$labels = array(
		'name'							=> _x( 'Couleurs', 'taxonomy general name', 'my_plugin' ),
		'singular_name'					=> _x( 'Couleur', 'taxonomy singular name', 'my_plugin' ),
		'menu_name'						=> _x( 'Couleurs', 'taxonomy general name', 'my_plugin' ),
		'search_items'					=> __( 'Rechercher une couleur', 'my_plugin' ),
		'popular_items'					=> __( 'Couleurs populaires', 'my_plugin' ),
		'all_items'						=> __( 'Toutes les marques', 'my_plugin' ),
		'parent_item'					=> __( 'Couleurs parent', 'my_plugin' ),
		'parent_item_colon'				=> __( 'Couleurs parent', 'my_plugin' ),
		'edit_item'						=> __( 'Modifier cette couleur', 'my_plugin' ),
		'view_item'						=> __( 'Afficher cette couleur', 'my_plugin' ),
		'update_item'					=> __( 'Mettre à jour cette couleur', 'my_plugin' ),
		'add_new_item'					=> __( 'Ajouter une nouvelle couleur', 'my_plugin' ),
		'new_item_name'					=> __( 'Ajouter une nouvelle couleur', 'my_plugin' ),
		'not_found'						=> __( 'Aucune couleur trouvée', 'my_plugin' ),
	);

	$rewrite = array(
		'slug'                       => 'produit_couleur',
		'with_front'                 => true,
		'hierarchical'               => true,
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);

	register_taxonomy('couleur', array('produit'), $args);
}

add_action('init','init_taxonomy_couleur');

// taxonomy couleur
function init_taxonomy_selection(){

	$labels = array(
		'name'							=> _x( 'selection', 'taxonomy general name', 'my_plugin' ),
		'singular_name'					=> _x( 'selection', 'taxonomy singular name', 'my_plugin' ),
		'menu_name'						=> _x( 'selection', 'taxonomy general name', 'my_plugin' ),
		'search_items'					=> __( 'Rechercher une selection', 'my_plugin' ),
		'popular_items'					=> __( 'selection populaires', 'my_plugin' ),
		'all_items'						=> __( 'Toutes les marques', 'my_plugin' ),
		'parent_item'					=> __( 'selection parent', 'my_plugin' ),
		'parent_item_colon'				=> __( 'selection parent', 'my_plugin' ),
		'edit_item'						=> __( 'Modifier cette selection', 'my_plugin' ),
		'view_item'						=> __( 'Afficher cette selection', 'my_plugin' ),
		'update_item'					=> __( 'Mettre à jour cette selection', 'my_plugin' ),
		'add_new_item'					=> __( 'Ajouter une nouvelle selection', 'my_plugin' ),
		'new_item_name'					=> __( 'Ajouter une nouvelle selection', 'my_plugin' ),
		'not_found'						=> __( 'Aucune selection trouvée', 'my_plugin' ),
	);

	$rewrite = array(
		'slug'                       => 'selection',
		'with_front'                 => true,
		'hierarchical'               => true,
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);

	register_taxonomy('selection', array('produit'), $args);
}

add_action('init','init_taxonomy_selection');

/*************** fin de la taxonomy selection *****************************/




/******************* Les Metas Box **********************/
add_action('add_meta_boxes','add_meta_boxes_produit');

function add_meta_boxes_produit(){
	add_meta_box('meta_produit', 'Données du produit' , 'metabox_produit','produit') ;
}


//Création de mes metas boxes
function metabox_produit($post){

  $url_produit 	= get_post_meta($post->ID,'_url_produit',true);
  $bouton_texte = get_post_meta($post->ID,'_bouton_texte',true);
  $prix 		= get_post_meta($post->ID,'_prix',true);
  $val 			= get_post_meta($post->ID,'_prix_solde',true);


  echo '<label for="_url_produit">URL du site: </label>';
  echo '<input id="_url_produit" type="text" name="_url_produit" value="'.$url_produit.'" />';

  echo '<label for="_bouton_texte"> Texte du bouton </label>';
  echo '<input id="_bouton_texte" type="text" name="_bouton_texte" value="'.$bouton_texte.'" />';

  echo '<label for="_prix"> Prix  (€) : </label>';
  echo '<input id="_prix" type="text" name="_prix" value="'.$prix.'" />';

  echo '<label for="_prix_solde"> Prix en promotion (€) : </label>';
  echo '<input id="_prix_solde" type="text" name="_prix_solde" value="'.$val.'" />';
}


//Sauvegarde des données de la meta boxe
add_action('save_post', 'save_donnees_produit');

function save_donnees_produit($post_ID){

	$url_produit 	= $_POST['_url_produit'] ;
	$bouton_texte	= $_POST['_bouton_texte'] ; 
	$prix 			= $_POST['_prix'] ;
	$prix_solde 	= $_POST['_prix_solde'] ;

	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return ;
	}

	// Secondly we need to check if the user intended to change this value.
  		if ( !wp_verify_nonce( $_POST['data_book_nonce'], plugin_basename( __FILE__ ) ) )
      		return;
      	
	// Finaly we need to check if the current user is authorised to do this action. 
	  	if ( 'page' == $_POST['post_type'] ) {
		    if ( ! current_user_can( 'edit_page', $post_id ) )
		        return;
	  	} else {
		    if ( ! current_user_can( 'edit_post', $post_id ) )
		        return;
	  	}

	if( isset($url_produit) ){
		$url_produit =esc_html($url_produit) ;
		update_post_meta($post_ID,'_url_produit',esc_url($url_produit) );
	}

	if( isset($bouton_texte) ){
		$bouton_texte =esc_html($bouton_texte) ;
		update_post_meta($post_ID,'_bouton_texte',sanitize_text_field($bouton_texte) );
	}

	if( isset($prix) ){
		$prix =esc_html($prix) ;
		update_post_meta($post_ID,'_prix',sanitize_text_field($prix) );
	}

	if( isset($prix_solde) ){
		$prix_solde =esc_html($prix_solde) ;
		update_post_meta($post_ID,'_prix_solde',sanitize_text_field($prix_solde) );
	}

}


/*************** Ajout d'une colonne dans CPT "Article" ***********************/

function add_column_taxo_category($columns){
	$columns['image_produit'] = "Image du produit";
	return $columns ;
}
add_filter('manage_edit-produit_columns', 'add_column_taxo_category') ;


function manage_produit_columns($columns){
	global $post;

	switch ($columns) {
		case 'image_produit':
			$post_thumbnail_id = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'thumbnail',false );
			$url_article = $post_thumbnail_id[0] ;
			$titre 	= esc_attr(get_the_title($post->id) ) ;
	       	echo "<img src='$url_article' alt='$titre' />";
		
		default:
			break;
	}
}
add_action('manage_produit_posts_custom_column', 'manage_produit_columns') ;



/********* Ajout des colonnes dans les taxonomys *******************/

$config = array(
	'id' => 'img_genre',			// meta box id, unique per meta box
	'title' => 'Image de la catégorie',	// meta box title
	'pages' => array('categorie'),		// taxonomy name, accept categories, post_tag and custom taxonomies
	'context' => 'normal',			// where the meta box appear: normal (default), advanced, side; optional
	'fields' => array(),			// list of meta fields (can be added by field arrays)
	'local_images' => true,		// Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => false		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);

// Initiate your taxonomy custom fields
$img_meta = new Tax_Meta_Class($config);

$img_meta->addImage('image_field_id',array('name'=> __('My Image ','Image de la catégorie')));

$img_meta->Finish();

// Utilisation front-end

	// $saved_data = get_tax_meta($term_id,'text_field_id');
	// echo $saved_data;
