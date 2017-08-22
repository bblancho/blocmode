<?php
/**
 * Template Name: Home categorie boutique
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */

get_header();

?>
<main id="main-page" class="wrap-main-page index-page archive-page">
    <div class="container">

        <ul class='produit_shopstyle'>
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

                <li class="categorie_accueil">
                    <h1 class="title">

                      <a href="<?php echo esc_url( $term_link ) ; ?>" title="<?php echo $term->name ; ?>" class='lien_categorie_accueil' title ="<?php the_title(); ?>" >  
                        <img src="<?php echo get_template_directory_uri() ; ?>/images/photo_cat.jpg" alt="cat" />
                        <span class="titre_categorie_accueil"> <?php echo $term->name ; ?> </span>
                      </a>

                    </h1>
                </li>

            <?php } ?>
        </ul>

    </div>
</main>
<?php
wp_enqueue_style('animations');
wp_enqueue_script('lazyload-master');
get_footer();