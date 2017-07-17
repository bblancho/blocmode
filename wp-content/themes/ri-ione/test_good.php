<?php

    $PARAM_hote='localhost'; // le chemin vers le serveur
    $PARAM_nom_bd='dressingbu2210'; // le nom de votre base de données
    $PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
    $PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
    $pdo = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);

    // $cnx = stream_context_create(
    //     array(
    //         'http' => array(
    //             'header'  => "Authorization: Basic ",
    //             'Content-type: application/json'
    //         ),
    //     )
    // );

    // On crée le tableau qui va contenir les données de shopstylecollective
        $tab_pmeti = array();
        $tab_pmeti_attachements = array();

        $tab_produits_shopstylecollective = array();
        $data_bm = array();

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

    $url_section_articles = "http://api.shopstyle.com/api/v2/lists/47238984/items?pid=uid6681-36113709-88";

    // On récupère les données de shopstyle
        $json_file = file_get_contents($url_section_articles);

    $tab_format_json_article = verif_format_json( $json_file);


    // On test si la donnée reçu est au format JSon
    if ( $tab_format_json_article === true ) {

        // On décode le code Json
            $liste_articles  = json_decode($json_file);

            $tab_articles_shopstyle = $liste_articles->favorites;

        // On crée le tableau qui va stocker les articles venant de OneUp
            $tab_index_articles = array( 'name','price','salePrice','brand','description','url_produit','image','categorie' );

        foreach ($tab_articles_shopstyle as $article) {

            $name           = $article->product->name ;
            $price          = $article->product->price ;
            $salePrice      = $article->product->salePrice ;
            $brand          = $article->product->brand->name ;
            $description    = $article->product->description ;
            $url_produit    = $article->product->clickUrl ;
            $image          = $article->product->image->sizes->Original->url ;
            $tab_categorie  = $article->product->categories ;
            $revendeur      = $article->product->retailer->name;
            $categorie_name = '';

            foreach ($tab_categorie as $key => $value) {
               $categorie_name = $value->name ;
            }
             
            echo 'Nom du produit : '.$name.'<br/>';
            echo 'Revendeur : '.$revendeur.'<br/>';
            echo 'prix du produit : '.$price.'<br/>';
            echo 'Prix soldé : '.$salePrice.'<br/>';
            echo 'Marque : '.$brand.'<br/>';
            echo 'Description : '.$description.'<br/>';
            echo "<img src='$image'  alt='bug'>".'<br/>';
            echo 'lien : '.$url_produit.'<br/>';
            echo 'Categorie du produit : '.strtolower($categorie_name).'<br/>';

            die();

            // On crée un nouveau article
                $tab_index_articles = array(              
                    "name"          =>  $name,
                    "price "        =>  $price,
                    "salePrice"     =>  $salePrice,
                    "brand "        =>  $brand,
                    "description "  =>  $description,
                    "url_produit "  =>  $url_produit,
                    "image  "       =>  $image,
                    "categorie "    =>  $categorie_name,
                    "revendeur"     =>  $revendeur
                );

                $pdo->exec(" INSERT INTO
                    table_conversion_id (id_oneup, id_fabereo, section_oneup)
                    VALUES($id_post, $id_new_article, $id_section_article_oneup )
                ");

                $tab_id_article = array(
                    'post' => array(
                        'id_oneup' => $id_post,
                        'id_fabereo' => $id_new_article ,
                        'section_oneup' => $id_section_oneup
                    )
                );

                $tab_id_section = '';


        }

    } else {
        echo "Le tableau d'article n'est pas au format Json" ;
    }


?>
