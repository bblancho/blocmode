<?php

	// On configure les options de la page
	function reseaux_sociaux_menu_admin_page(){
		add_menu_page(
	        'Administration des réseaux sociaux', // Titre de la page
	        'Réseaux sociaux', // Nom du lien dans la barre de menu
	        'manage_options', // qui peut voir le lien du menu
	        'admin-social-network', // slug ou id pour les sous menus
	        'create_html_admin_page_social_network', // Fonction de callback pou
	        'dashicons-networking', // icône dans le menu
	        62 //position dans la barre de menu
	    );

		// Création des sous-menus add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function )
	    // add_submenu_page( 'admin-social-network', 'Lien Shopstyle', 'Shopstyle', 'manage_options', 'shopstyle', 'create_section_social_network' ) ;

	    
	}
	add_action('admin_menu', 'reseaux_sociaux_menu_admin_page' ) ;


	function custom_settings(){
		// On renregistre le contenu de nos champs
		register_setting('reseaux_sociaux', 'facebook') ;
		register_setting('reseaux_sociaux', 'tweeter','sanitize_tweeter') ;
		register_setting('reseaux_sociaux', 'pinterest') ;

		//On crée une section add_settings_section( $id, $title, $callback, $page );
			add_settings_section('section_rs','Réseaux sociaux', 'section_reseaux_sociaux', 'admin-social-network' ) ;

		//add_settings_field( $id, $title, $callback, $page, $section )
			add_settings_field( 'social_facebook', 'Pseudo Facebook :', 'create_input_facebook', 'admin-social-network','section_rs' );
			add_settings_field( 'social_tweeter', "Pseudo Tweeter :", 'create_input_tweeter', "admin-social-network", 'section_rs'  );
			add_settings_field( 'social_pinterest', "Pseudo Pinterest :", 'create_input_pinterest', "admin-social-network", 'section_rs'  );
	}
	
	// on active les champs
	    add_action('admin_init', 'custom_settings') ;

	function section_reseaux_sociaux(){
		//echo "section reseau sociaux" ;
	}

	function create_input_facebook(){
		$facebook   = esc_attr( get_option('facebook') ) ;
		echo '<input type="text" name="facebook" value="'.$facebook.'">';
	}

	function create_input_tweeter(){
		$tweeter   = esc_attr( get_option('tweeter') ) ;
		echo '<input type="text" name="tweeter" value="'.$tweeter.'">';
	}

	function create_input_pinterest(){
		$pinterest   = esc_attr( get_option('pinterest') ) ;
		echo '<input type="text" name="pinterest" value="'.$pinterest.'">';
	}

	function sanitize_tweeter($input){
		$output = sanitize_text_field($input) ;
		$output = str_replace('@', '', $output) ;
		return $output ;
	}

	// création de la page html
	function create_html_admin_page_social_network(){
?>
		<div class="wrap">
			<?php  settings_errors() ; ?>
			
			<form method="POST" action="options.php">
				<table class="form-table">
					<tbody>
						<?php 
							do_settings_sections('admin-social-network') ; // slug de la page dans la déclaration du menu
							settings_fields('reseaux_sociaux') ; 
							submit_button('Sauvegarder', 'primary','save_modif' , true) ;
						?>
					</tbody>
				</table>
			</form>
		</div>
<?php
	}

	// On enregistre nos champs dans la BDD
	// add_action('admin_init', 'add_settings_fields_social_network') ;

	// function add_settings_fields_social_network(){

	// 	if( isset( $_POST['save_modif'] ) ) {

	// 		// echo 'fb = '.$_POST['options']['facebook'].'<br/>' ;
			
	// 		foreach ($_POST['options'] as $key => $value) {
	// 			if( empty($value) ) {
	// 				delete_option($key) ;
	// 			} else {
	// 				update_option($key, $value) ;
	// 			}
	// 		}
	// 	}	
	// }


