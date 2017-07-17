<?php

add_action('init', 'register_portfolio');

function register_portfolio() {
	register_post_type('portfolio',
		array(
		'labels' => array(
			‘name’ => ‘Portfolio’,
			‘singular_name’ => ‘Projet’,
			‘add_new’ => ‘Ajouter un projet’,
			‘add_new_item’ => ‘Ajouter un nouveau projet’,
			‘edit_item’ => ‘Editer un projet’,
			‘new_item’ => ‘Nouveau projet’,
			‘view_item’ => ‘Voir le projet’,
			‘search_items’ => ‘Rechercher un projet’,
			‘not_found’ => ‘Aucun projet’,
			‘not_found_in_trash’ => ‘Aucun projet dans la corbeille’,
			‘parent_item_colon’ =>  »,
			‘menu_name’ => ‘Portfolio’
		),
		‘public’ => true,
		‘show_ui’ => true,
		‘menu_icon’ => ‘dashicons-screenoptions’,
		‘capability_type’ => ‘post’,
		‘hierarchical’ => false,
		‘menu_position’ => 5,
		‘supports’ => array(‘title’,’editor’),
		‘taxonomies’ => array(‘category’),
		‘register_meta_box_cb’ => ‘add_portfolio_metaboxes’,
		‘has_archive’ => true,
		‘rewrite’ => array(‘slug’ => $post_type, ‘with_front’ => true)
	));
}

// METABOXES
// Init
function add_portfolio_metaboxes() {
	add_meta_box(‘metadonnees’, ‘Métadonnées’, ‘metadonnees’, ‘portfolio’, ‘side’, ‘default’);
	add_meta_box(‘presentation’, ‘Texte de présentation’, ‘presentation’, ‘portfolio’, ‘normal’, ‘default’);
}
// Build
function metadonnees() {
	global $post;

	echo ‘<input type="hidden" name="projectmeta_noncename" id="projectmeta_noncename" value="' .wp_create_nonce(plugin_basename(__FILE__)) . '" />‘;

	$client = get_post_meta($post->ID, ‘_client’, true);
	$date = get_post_meta($post->ID, ‘_date’, true);

	echo ‘<p><label for="_client">Client : </label> ‘;
	echo ‘<input type="text" id="_client" name="_client" value="' . $client . '" class="widefat" /></p>‘;
	echo ‘<p><label for="_date">Date(s) : </label> ‘;
	echo ‘<input type="text" id="_date" name="_date" value="' . $date . '" class="widefat" /></p>‘;
}
function presentation() {
	global $post;

	echo ‘<input type="hidden" name="projectdesc_noncename" id="projectdesc_noncename" value="' .wp_create_nonce(plugin_basename(__FILE__)) . '" />‘;

	$description = get_post_meta($post->ID, ‘_description’, true);

	wp_editor(  », ‘_description’, array( ‘textarea_name’ => ‘_description’, ‘media_buttons’ => false, ‘textarea_rows’ => 6 ) );
}
// Saving data
function portfoliometas_save() {
	if( !wp_verify_nonce($_POST[‘projectmeta_noncename’], plugin_basename(__FILE__)) ) {
		return $post->ID;
	}
	if( !wp_verify_nonce($_POST[‘projectdesc_noncename’], plugin_basename(__FILE__)) ) {
		return $post->ID;
	}
	if( !current_user_can(‘edit_post’, $post->ID) ) {
		return $post->ID;
	}

	$portfoliometas[‘_description’] = $_POST[‘_description’];
	$portfoliometas[‘_client’] = $_POST[‘_client’];
	$portfoliometas[‘_date’] = $_POST[‘_date’];

	foreach( $portfoliometas as $key => $value ) {
		if( $post->post_type == ‘revision’ ) {
			return;
		}
		$value = implode(‘,’, (array)$value);

		if( get_post_meta($post->ID, $key, FALSE) ) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if( !$value ) delete_post_meta($post->ID, $key);
	}
}
add_action(‘save_post’, ‘portfoliometas_save’, 1, 2);

?>