<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */

get_header();

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
        <div id="primary"
             class="content-area container <?php echo esc_attr($rit_sidebar); ?>">
            <div class="row">
                <?php if ($rit_sidebar == 'left-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                    <?php get_sidebar(); ?>
                <?php } ?>
                <div id="detail-post" class="content-single content-block <?php echo esc_attr($rit_class_main); ?>">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('content', 'single');
                    endwhile;
                    ?>
                </div>
                <?php if ($rit_sidebar == 'right-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                    <?php get_sidebar('right'); ?>
                <?php } ?>
            </div>
        </div>
    </main>
<?php get_footer(); ?>