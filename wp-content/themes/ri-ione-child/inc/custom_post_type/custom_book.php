<?php
require_once(ABSPATH .'wp-content/themes/ri-ione-child/inc/Tax-meta-class/Tax-meta-class.php');
add_theme_support('post-thumbnails') ;

// On crée notre cpt livre
	function init_custom_book(){
		$labels = array(
			'name' => 'Livres',
			'singular_name' => 'livre',
			'menu_name' => 'Livres',
			'add_new' => 'Ajouter un livre',
			'add_new_item' => 'Ajouter un livre',
			'edit_item' => 'Modifier un livre',
			'new_item' => 'Nouveau livre',
			'all_items' => 'Tous les livres',
			'view_item' => 'Afficher le livre',
			'search_items' => 'Chercher un livre',
			'not_found' => 'Aucun livre trouvé',
			'not_found_in_trash' => 'Aucun livre trouvé dans la corbeille',	
		);

		$args = array(
			'labels' => $labels,
			'description' => 'Description du livre',
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'livres' ),
			'capability_type' => 'post',
			'has_archive' => true,
			'menu_icon'   => 'dashicons-book',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments'),
			'register_meta_box_cb' => 'add_meta_boxes_book' // On rattache une meta boxe à notre livre
		);
		register_post_type( 'book', $args) ;
	}
add_action('init','init_custom_book') ;


// On crée notre cpt auteur
	function init_custom_auteur(){
		$labels = array(
			'name' => 'Auteurs',
			'singular_name' => 'Auteur',
			'menu_name' => 'Auteurs',
			'add_new' => 'Ajouter un auteur',
			'add_new_item' => 'Ajouter un Auteur',
			'edit_item' => 'Modifier un Auteur',
			'new_item' => 'Nouveau auteur',
			'all_items' => 'Tous les auteurs',
			'view_item' => 'Afficher l\'auteur',
			'search_items' => 'Chercher un auteur',
			'not_found' => 'Aucun auteur trouvé',
			'not_found_in_trash' => 'Aucun auteur trouvé dans la corbeille',	
		);

		$args = array(
			'labels' => $labels,
			'description' => "Description de l'auteur",
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'auteurs' ),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array( 'title', 'editor'),
		);
		register_post_type( 'auteur', $args) ;
	}
add_action('init','init_custom_auteur') ;



/********************* Taxonomy *****************************/
// On crée la taxonomie rattaché à notre meta CPT 'book'
	function init_taxonomy_genre(){
		$labels = array(
			'name'							=> _x( 'genre', 'taxonomy general name', 'my_plugin' ),
			'singular_name'					=> _x( 'genre', 'taxonomy singular name', 'my_plugin' ),
			'menu_name'						=> _x( 'genres', 'taxonomy general name', 'my_plugin' ),
			'search_items'					=> __( 'Rechercher un genre', 'my_plugin' ),
			'popular_items'					=> __( 'genres populaires', 'my_plugin' ),
			'all_items'						=> __( 'Tous les genres', 'my_plugin' ),
			'parent_item'					=> __( 'genre parent', 'my_plugin' ),
			'parent_item_colon'				=> __( 'genre parent', 'my_plugin' ),
			'edit_item'						=> __( 'Modifier ce genre', 'my_plugin' ),
			'view_item'						=> __( 'Afficher ce genre', 'my_plugin' ),
			'update_item'					=> __( 'Mettre à jour ce genre', 'my_plugin' ),
			'add_new_item'					=> __( 'Ajouter un nouveau genre', 'my_plugin' ),
			'new_item_name'					=> __( 'Ajouter une nouveau genre', 'my_plugin' ),
			'not_found'						=> __( 'Aucune genre trouvé', 'my_plugin' ),
		);

		$rewrite = array(
			'slug'                       => 'genre',
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

		register_taxonomy( 'genre', array('book'), $args);
	}	

add_action('init','init_taxonomy_genre') ;



/********************** Les métaboxes ******************/

// initialiser la metabox
function add_meta_boxes_book(){

	//string $id (required), string $title (required), callable $callback (required), string|array|WP_Screen $screen = null, string $context = 'advanced', string $priority = 'default', array $callback_args = null

	//on utilise la fonction add_metabox() pour initialiser une metabox
		add_meta_box( 'book_info', 'Information sur ce livre', 'add_fields_meta_book', 'book' ) ;
}

add_action('add_meta_boxes','add_meta_boxes_book') ; // Hook pour activer les metaboxes


function add_fields_meta_book($post){
	global $post;
	
 	// Use nonce for verification
  		wp_nonce_field( plugin_basename( __FILE__ ), 'data_book_nonce' );

	//get_post_meta( int $post_id, string $key = '', bool $single = false )
		$auteur_livre 		= get_post_meta( $post->ID,'auteur_livre',true ) ;
		$date_publication 	= get_post_meta( $post->ID, 'date_publication' , true ) ;

		echo '<label for="auteur_livre"> Auteur du livre </label>';
		echo '<input id="auteur_livre" type="text" name="auteur_livre" value="'.$auteur_livre.'" />'; 

		echo '<label for="date_publication"> Date de publication </label>';
		echo '<input id="date_publication" type="date" name="date_publication" value="'.$date_publication.'" />'; 
		
		// $args_1 = array( 
		// 	'name' => 'auteur',
		// 	'public'   => true,
		// 	'_builtin' => false
		// );

		// $post_types = get_post_types( $post->ID  );
		// echo '<pre>';
		// 	print_r($post_types);
		// echo '</pre>';

		// foreach ( $post_types  as $post_type ) {

		//    echo '<p> nom :' . $post_type->labels->add_new . '</p>';
		// }

		// $post_types = get_post_custom($post->ID); 
		// echo '<pre>';
		// 	print_r($post_types);
		// echo '</pre>';
		
		// foreach ( $post_types  as $post_type ) {

		//    echo '<p> nom :' . $post_type->posts['post_name'] . '</p>';
		// }
}

function save_data_metaboxe_book( $post_id ){
	
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

	$auteur_livre = $_POST['auteur_livre'] ; 
 	update_post_meta($post_id ,'auteur_livre', sanitize_text_field($auteur_livre) ) ;

 	$date_publication   = $_POST['date_publication'] ;
 	update_post_meta($post_id ,'date_publication', sanitize_text_field($date_publication) ) ;
}

add_action( 'save_post', 'save_data_metaboxe_book' );



/*************** Modification des colonnes ********/

// Add the custom columns to the book post type:
function add_new_book_columns($columns) { 
    $columns['ecrivain'] = __('ecrivain', 'your_text_domain' );
    $columns['images'] = __('Photo de l\'article', 'your_text_domain' );

    return $columns;
}

// manage_{$post_type}_posts_columns ou manage_{$post_type}_posts_column
add_filter('manage_edit-book_columns', 'add_new_book_columns');


// Add the data to the custom columns for the book post type:
function manage_book_columns($columns) {
    global $post;

    switch ($columns) {
    case 'ecrivain':
        $ecrivain = get_post_meta($post->ID,'auteur_livre', true) ;
        echo $ecrivain ;
    break;

    case 'images':
        $src 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail', false, '' );
        $titre 	= esc_attr(get_the_title($post->id) ) ;
       	$image 	= $src[0] ;
       	echo "<img src='$image' alt='$titre' />";

    break;

    default:
        break;
    } // end switch
}
add_action('manage_book_posts_custom_column', 'manage_book_columns');



/********* Ajout des colonnes dans les taxonomys *******************/

$config = array(
	'id' => 'img_genre',			// meta box id, unique per meta box
	'title' => 'Couverture genre',	// meta box title
	'pages' => array('genre'),		// taxonomy name, accept categories, post_tag and custom taxonomies
	'context' => 'normal',			// where the meta box appear: normal (default), advanced, side; optional
	'fields' => array(),			// list of meta fields (can be added by field arrays)
	'local_images' => false,		// Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => false		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);

// Initiate your taxonomy custom fields
$img_meta = new Tax_Meta_Class($config);

//text field
$img_meta->addText('text_field_id',array('name'=> 'Mon champ texte'));

//textarea field
$img_meta->addTextarea('textarea_field_id',array('name'=> 'Ma zone de texte'));

$img_meta->Finish();

// Utilisation front-end

	// $saved_data = get_tax_meta($term_id,'text_field_id');
	// echo $saved_data;