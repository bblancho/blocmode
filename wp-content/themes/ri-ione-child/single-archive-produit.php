<?php
/**
 * Template Name: Accueil boutique
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

$args = array( 'post_type' => 'produit', 'posts_per_page' => -1 ) ;

$loop = new WP_Query($args) ;

?>
<main id="main-page" class="wrap-main-page index-page archive-page">
    <div class="container">

        <ul class='produit_shopstyle'>
            <?php while ( $loop->have_posts() ) : $loop->the_post() ; ?>

                <li class="categorie_accueil">
                    <h1 class="title">
                      <a href="<?php the_permalink() ; ?>" class='lien_categorie_accueil' title ="<?php the_title(); ?>">  
                        <?php the_post_thumbnail( 'folio' ); ?>
                        <span class="titre_categorie_accueil"> <?php the_title(); ?> </span>
                      </a>
                    </h1>
                </li>

            <?php endwhile; wp_reset_postdata() ; ?>
        </ul>

    </div>
</main>
<?php
wp_enqueue_style('animations');
wp_enqueue_script('lazyload-master');
get_footer();