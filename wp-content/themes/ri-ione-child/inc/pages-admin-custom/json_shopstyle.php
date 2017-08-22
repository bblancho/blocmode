<?php
    $PARAM_hote='localhost'; // le chemin vers le serveur
    $PARAM_nom_bd='dressingbu2210'; // le nom de votre base de données
    $PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
    $PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
    $pdo = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);

    // On crée le tableau qui va contenir les données de shopstylecollective
        $tab_produits_shopstylecollective = array();

    /**
     * Vérification du format du tableau Json
     * @param  [json] $json_file
     * @return [boolean] $val_test_json_fin
     */
    function verif_format_json( $json_file) {

        $val_test_json_debut = '';
        $val_test_json_fin = '';

        $accolade_open = "{" ;
        $accolade_close = "}" ;

        // On récupère la position de notre 1er occurence de notre Tableau Json
            $pos_debut  = strpos( $json_file , $accolade_open ) ;

        // On récupère la dernière occurence de notre accolade
            $pos_fin    =  strrchr($json_file , $accolade_close) ;

        // Je compte le nombre d'élèment qui se trouve dans ma variable
            $nb_string_tab_json = strlen($pos_fin) ;

        // On véreifie si on a une accolade au début de notre tableau $json_file
            if ( $pos_debut !== false && $pos_debut === 0 ) {
                $val_test_json_debut = true;
            } else {
                $val_test_json_debut = false;
                $erreur = "Le premiere caractère n'est pas une accolade ouvrante .";

                return  $val_test_json_debut ;
            }

        // On véreifie si on a une accolade à la fin de notre tableau $json_file
            if ( $pos_fin !== false && $nb_string_tab_json === 1 && $val_test_json_debut == true ) {

                $val_test_json_fin = true;

            } else {
                $val_test_json_fin = false;
                $erreur = "Le dernier caractère n'est pas une accolade fermante .";

                return $val_test_json_fin;
            }

        return $val_test_json_fin ;
    }

    $erreur = "" ;
    global $wpdb;
    $n = 1;
    foreach ($tab_id_shopstyle as  $id_liste) {
       
        $url_section_articles = "http://api.shopstyle.com/api/v2/lists/$id_liste/items?pid=uid6681-36113709-88";
        

        // On récupère les données de shopstyle
            $json_file = file_get_contents($url_section_articles);

        $tab_format_json_article = verif_format_json( $json_file);

        //On test si la donnée reçu est au format JSon
        if ( $tab_format_json_article === true ) {

            // On décode le code Json
                $liste_articles  = json_decode($json_file);

                $tab_articles_shopstyle = $liste_articles->favorites;
                
            foreach ($tab_articles_shopstyle as $article) {

                $art = array(
               'post_author' => 1,
               'post_date'=> '2017-08-01 04:03:26',
               'post_date_gmt'=> '2017-08-01 04:03:30',
               'post_content'=> 'azdzazedzd',
               'post_title'=> 'DONNA KARAN - SWEAT À LOGO',
               'post_excerpt'=>"ion et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des ",
               'post_status'=>'publish', 
                'comment_status'=>'open',
                'ping_status'=>'closed',
                'post_password'=>'',
                'post_name'=>'donna-karan-sweat-a-logo-2',
                'to_ping'=>'',
                'pinged'=>'',
                'post_modified'=>'2017-08-03 06:51:22', 
                'post_modified_gmt'=>'2017-08-03 04:51:22',
                'post_content_filtered'=>'',
                'post_parent'=>0,
                'guid'=>'http://localhost/blocmode/?post_type=produit&#038;p=3857',
                'menu_order'=>0,
                'post_type'=>'produit',
                'post_mime_type'=>'', 
                'comment_count'=>0 ) ;

                $insertion = $wpdb->insert( $wpdb->prefix .'posts', $art ) ;

                $wpdb->show_errors();
                
                $n++ ;
            }

        } else {
            echo "Le tableau d'article n'est pas au format Json" ;
        }
    }
    echo " n $n" ;
    die();
