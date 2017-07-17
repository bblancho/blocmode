<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */

get_header('shop');
global $post;

$id = $post->ID;

$rit_sidebar = $rit_class_main = '';
$rit_sidebar = get_theme_mod('rit_default_sidebar', 'right-sidebar');
if ($rit_sidebar == 'no-sidebar') {
    $rit_class_main = 'col-xs-12';
} elseif ($rit_sidebar == 'right-sidebar') {
    $rit_class_main = 'col-sm-9 col-xs-12';
} elseif ($rit_sidebar == 'left-sidebar') {
    $rit_class_main = 'col-sm-9 col-xs-12';
} else {
    $rit_class_main = 'col-sm-6 col-xs-12';
}
?>

<main id="main-page" class="wrap-main-single">
    <div id="primary" class="content-area woo-page content-single">

    <div id="product-<?php echo $id; ?>" class="post-<?php echo $id; ?> product type-product status-publish has-post-thumbnail instock shipping-taxable product-type-external">

        <div class="wrap-top-single-product vertical-gallery rit-product-zoom">
            <?php
                while (have_posts()) : the_post();
                    get_template_part('content', 'single2');
                endwhile;
            ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>