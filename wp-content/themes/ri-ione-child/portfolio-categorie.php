<?php
/*
Template Name: Portfolio-termegorie
*/
?>

<?php get_header() ; ?>

<div id="arianne">Vous êtes ici : <a href="#" >Accueil</a> > Portfolio</div>
  <section id="contenu-accueil">
          
    <nav class="primary clearfix">
      <ul>
        <li><a href="#" class="selected" data-filter="*">All</a></li>
        
        <?php 
          $terms_categories = get_terms( 
            array( 
              'taxonomy' => 'categorie',
              'order'    => 'desc',
              'hide_empty' => false, // On affiche les taxonomies qui ne sont pas rattachées à un post
              'parent' => 0  // On cache les fils de la taxonomie
            ) 
          );

          foreach ( $terms_categories as $term) {
            $term_link = get_term_link($term,'categorie') ;

            // If there was an error, continue to the next term.
              if ( is_wp_error( $term_link ) ) {
                continue;
              }
        ?>
          

          <li><a href="<?php echo esc_url( $term_link ) ; ?> " title="<?php echo $term->name ; ?>" > <?php echo $term->name ; ?> </a></li>

        <?php } ?> 
 </section>
       
  <div class="clearboth"></div>
</div>
<?php get_footer() ; ?>