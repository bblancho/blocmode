<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */
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
get_header(); ?>
<main id="main-page" class="wrap-main-page index-page archive-page">
    <div class="container">
        <div id="primary" class="content-area row <?php echo esc_attr($rit_sidebar); ?>">
            <?php if ($rit_sidebar == 'left-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
            <div id="main" class="site-main <?php echo esc_attr($rit_class_main); ?>">
                <h1 class="page-title"><?php printf(esc_html__('Search Results for: %s', 'ri-ione'), get_search_query()); ?></h1>
                <div class="wrap-blog-layout <?php echo esc_attr('layout-' . get_theme_mod('rit_default_post_col', 3) . '-col') ?> row">
                    <?php if (have_posts()) :
                        while (have_posts()) : the_post();
                            get_template_part('content', 'grid');
                        endwhile;
                    else :
                        get_template_part('content', 'none');
                    endif; ?>
                </div>
                <?php
                if (have_posts()) :
                    get_template_part('/included/templates/pagination');
                endif;
                ?>
            </div><!-- .site-main -->
            <?php if ($rit_sidebar == 'right-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                <?php get_sidebar('right'); ?>
            <?php } ?>
        </div>
    </div>
</main><!-- .site-main -->

<?php get_footer(); ?>
