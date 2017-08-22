<?php get_header() ; ?>

<main id="main-page" class="wrap-main-page index-page archive-page">
    <div class="container">

      <nav class="primary">
        <ul>
          <li> <a href="/blocmode/accueil-categorie-boutique/"> All Categories </a> </li>
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
              if ( is_wp_error( $term_link ) ) { continue ; }
          ?>
                <li>
                  <a href="<?php echo esc_url( $term_link ) ; ?>" title="<?php echo $term->name ; ?>" class='lien_categorie_accueil' title ="<?php the_title(); ?>" >
                    <?php echo $term->name ; ?> 
                  </a>
                </li>

          <?php } wp_reset_postdata() ; ?>
        </ul>
      </nav>

      <div>
        <ul class='produit_shopstyle'>
            <?php
            
              global $wp_query;
              $cat_name = $wp_query->query_vars['categorie'];

              $tax_query = array(
                  'post_type' => 'produit',
                  'posts_per_page' => -1,
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'categorie',
                      'field'    => 'slug',
                      'terms'    => $cat_name,
                      'include_children' => true,
                      'operator' => 'IN' 
                    ) 
                  )
              ) ;

              $query = new WP_Query($tax_query) ;
              // var_dump($query) ;
             
              ?>
           <ul class='produit_shopstyle'>
            <?php while ($query->have_posts()) : $query->the_post() ; ?>

                <li class="categorie_accueil">
                    <a href="<?php the_permalink() ; ?>" class='lien_categorie_accueil' title ="<?php the_title(); ?>">  
                        <?php the_post_thumbnail( 'folio' ); ?>
                        <span class="titre_categorie_accueil"> <?php the_title(); ?> </span>
                    </a>
                </li>

            <?php endwhile ; wp_reset_postdata() ;?>
        </ul>
        </ul>
      </div>
      
    </div>
</main>
<?php get_footer() ; ?>