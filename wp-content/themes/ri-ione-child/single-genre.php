<?php
/*
Template Name: Liste genre
*/
?>

<?php get_header() ; ?>

<div id="arianne">Vous êtes ici : <a href="#" >Accueil</a> > Portfolio</div>
  <section id="contenu-accueil">
          
    <nav class="primary clearfix">
    
        <!-- <li><a href="#" class="selected" data-filter="*">All</a></li> -->
        
        <?php 

            $args = array( 
                'taxonomy' => 'categorie',
                'order'    => 'desc',
                'hide_empty' => false, // On affiche les taxonomies qui ne sont pas rattachées à un post
                'parent' => 0  // On cache les fils de la taxonomie
            ) ;

            $terms_categories = get_terms($args);
            
            // on veut afficher les produits de la taxonomy 'categorie' 

            foreach ( $terms_categories as $cat) {

                $produits = get_posts(
                    array(
                        'order' => 'DESC',
                        'post_type' => 'produit',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorie',
                                'field' =>'id',
                                'terms' => $cat->term_id
                            )
                        )
                    )
                );

        
                //var_dump($cat);
                echo "<h2> $cat->name </h2>" ;
                echo "<h3>".count($produits)." article(s) dans la catégorie $cat->name </h3> " ;
               
                echo "<ol>" ;
                    
                    foreach ($produits as $p) {
                        echo"<li> $p->post_title. <li/>" ;
                    }
                    
                echo "</ol>";

                // echo"titre : $produits->post_title <br/>";
            } 
        ?>
          

          <!-- <li><a href="<?php echo esc_url( $term_link ) ; ?> " title="<?php echo $term->name ; ?>" > <?php echo $term->name ; ?> </a></li> -->
    </nav>
        
 </section>
       
  <div class="clearboth"></div>
</div>
<?php get_footer() ; ?>