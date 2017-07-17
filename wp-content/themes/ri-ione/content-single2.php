<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */
if (!(strpos(get_the_content(),'[gallery') === false)){
    wp_enqueue_style('slick');
    wp_enqueue_style('slick-theme');
    wp_enqueue_script('slick');
}


global $post;

$id = $post->ID ; // Id du produit

$sql = "SELECT * FROM `wor3390_postmeta` WHERE `post_id` = $id ORDER BY `meta_value` ASC" ;

$result = $wpdb->get_results( $sql ) ;

$data_products = array();

// On séléctionne les meta key qu'on souhaite récuèperer de notre BDD 
$tab_meta_key = array('_prix','_prix_solde','_url_produit','_bouton_texte' );

// On parcourt le résultat de notre tableau
foreach( $result  as $key => $result ){

    // On parcourt notre tableau de meta key
    foreach ($tab_meta_key as $key) {

        // On teste si les valeurs des 2 metas keys sont identique
        if ( $result->meta_key == $key) {
            // Si les 2 valeurs sont identique on récupere le nom de la meta key ainsi que ca valeur, et on la stocke dans notre tableau
            $data_products[$key] = $result->meta_value ;
        }
    }
}

?>
    <div class="container">
        <div class="single-produit-breadcrumb">
            <?php
                do_action('rit_woocommerce_breadcrumb');
                get_template_part('single-product', 'navigation_2');
            ?>
        </div>

        <div class="wrap-left-single-product">  
            <div class="wrap-single-image">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-image<?php echo (is_single()) ? ' single-image' : ''; ?>">
                        <?php the_post_thumbnail('shop_single'); ?>
                    </div>
                <?php 
                    endif; 
                ?>
            </div>
        </div>

        <div class='titre_produit'>
            <h1 class="product_title entry-title"> <?php the_title() ?> </h1>

            <div class="wrap-price">
                <p class="price"> 
                    
                    <?php if( !empty($data_products['_prix_solde']) ) { ?>
                        <del> 
                            <span>
                                <?php echo $data_products['_prix'] ." € " ; ?>
                            </span>
                        </del> 

                        <ins>
                            <?php echo $data_products['_prix_solde'] ." € 000 <br/>" ; ?>
                        </ins> 
                       
                        <div class="product-description">
                            <?php echo apply_filters('woocommerce_short_description', get_the_excerpt()) ?>
                        </div>

                        <p class="cart" > 
                            <a class="single_add_to_cart_button button" href="<?php echo $data_products['_url_produit'] ; ?>" >  
                                <?php echo strtoupper( $data_products['_bouton_texte'] )."<br/>" ; ?> 
                            </a>  
                        </p>

                        
                    <?php } else { ?>

                        <ins>
                            <?php echo $data_products['_prix'] ." € " ; ?>
                        </ins> 

                        <div class="product-description">
                            <?php echo apply_filters('woocommerce_short_description', get_the_excerpt()) ?>
                        </div>

                        <p class="cart" > 
                            <a class="single_add_to_cart_button button" alt="lien du produit" href="<?php echo $data_products['_url_produit'] ; ?>" >  
                                <?php echo $data_products['_bouton_texte'] ."<br/>" ; ?> 
                            </a>  
                        </p>

                    <?php } ?>

                </p>
            </div>

        </div>

        <article id="post-<?php the_ID(); ?>" <?php (is_single()) ? post_class() : post_class('post-item'); ?> >        

            <?php
                if (get_theme_mod('rit_social_sharing') != '1') {
                    get_template_part('included/templates/single', 'section_2'); // On inclut les réseaux sociaux
                }
            ?>

            <div class="post-content">
                <?php
                    the_content();
                ?>
            </div>

            <?php
                if (get_theme_mod('rit_related_articles') != '1') {
                    get_template_part('included/templates/related_posts');
                }
            ?>

        </article><!-- #post-## -->
    </div>

<?php
// If comments are open or we have at least one comment, load up the comment template.
// if (comments_open() || get_comments_number()) :
//     comments_template('', true);
// endif;
