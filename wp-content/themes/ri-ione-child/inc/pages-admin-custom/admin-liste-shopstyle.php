<?php

	// On configure les options de la page
	function admin_liste_shopstyle(){
		add_menu_page(
	        'Administration des listes Shopstyle', // Titre de la page
	        'Shopstyle', // Nom du lien dans la barre de menu
	        'manage_options', // qui peut voir le lien du menu
	        'admin-shopstyle', // slug ou id pour les sous menus
	        'create_html_admin_shopstyle', // Fonction de callback pou
	        'dashicons-networking', // icône dans le menu
	        62 //position dans la barre de menu
	    );

		// Création des sous-menus
		//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function )
	}
	add_action('admin_menu', 'admin_liste_shopstyle' ) ;

	function custom_settings_shopstyle(){

		if( isset($_POST['add_liste'] ) ){

			$tab_Post_shopstyle = array( $_POST['id_shopstyle_1'] , $_POST['id_shopstyle_2'] ,  $_POST['id_shopstyle_3'] ) ;

			$tab_id_shopstyle = array();

			foreach ($tab_Post_shopstyle as $value) {
				if ( !empty($value) ) {
					$tab_id_shopstyle[] = $value ;
				}
			}

			require_once('json_shopstyle.php') ;
		}
		
		// On renregistre le contenu de nos champs
		register_setting('liste_shopstyle', 'id_shopstyle_1') ;
		register_setting('liste_shopstyle', 'id_shopstyle_2') ;
		register_setting('liste_shopstyle', 'id_shopstyle_3') ;

		//On crée une section pour regrouper nos boutons
			//add_settings_section( $id, $title, $callback, $page );
			add_settings_section('shopstyle','Identifiant des listes Shopstyle', 'section_shopstyle', 'admin-shopstyle' ) ;

		//add_settings_field( $id, $title, $callback, $page, $section )
			add_settings_field( 'id_shopstyle_1', 'Identifiant 1 :', 'create_id_input_1', 'admin-shopstyle','shopstyle'  );
			add_settings_field( 'id_shopstyle_2', "Identifiant 2 :", 'create_id_input_2', "admin-shopstyle", 'shopstyle' );
			add_settings_field( 'id_shopstyle_3', "Identifiant 3 :", 'create_id_input_3', "admin-shopstyle", 'shopstyle' );
	}
	// on active les champs
    add_action('admin_init', 'custom_settings_shopstyle') ;


	function section_shopstyle(){
		//echo "section reseau sociaux" ;
		$url = get_stylesheet_directory_uri() ;
		echo '<img src="'.$url.'/images/logo_ShopStyle.png" alt="cat" />' ;
	}

	function create_id_input_1(){
		$id_shopstyle_1   = esc_attr( get_option('id_shopstyle_1') ) ;
		echo '<input type="text" name="id_shopstyle_1" value=""> ' ;
	}

	function create_id_input_2(){
		$id_shopstyle_2   = esc_attr( get_option('id_shopstyle_2') ) ;
		echo '<input type="text" name="id_shopstyle_2" value=""> ' ;
	}

	function create_id_input_3(){
		$id_shopstyle_3   = esc_attr( get_option('id_shopstyle_3') ) ;
		echo '<input type="text" name="id_shopstyle_3" value="">' ;
	}

	// création de la page html
	function create_html_admin_shopstyle(){
?>
		<div class="wrap">
			<?php  settings_errors() ; ?>

			<form method="POST" action="options.php">
				<table class="form-table">
					<tbody>
						<?php 
							do_settings_sections('admin-shopstyle') ; // slug de la page dans la déclaration du menu
							settings_fields('liste_shopstyle') ; 
							submit_button('Ajouter les listes', 'primary','add_liste' , true) ;
							$url = get_stylesheet_directory_uri() ;
							echo '<img src="'.$url.'/images/id_liste_shopstyle_4.png" alt="cat" />' ;
						?>
					</tbody>
				</table>
			</form>
		</div>
<?php
	}

