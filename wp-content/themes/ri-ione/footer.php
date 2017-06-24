<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */
$rit_footer_status = true;
$rit_footer_style=$rit_class='';
$rit_footer_style = get_theme_mod('rit_footer_layout', 'default');
if (is_page()||is_single()) {
    if (get_post_meta(get_the_ID(), 'rit_disable_footer', true) == '1') {
        $rit_footer_status = false;
    }
    if (get_post_meta(get_the_ID(), 'rit_footer_layout', true) != '' && get_post_meta(get_the_ID(), 'rit_footer_layout', true) != 'inherit') {
        $rit_footer_style = get_post_meta(get_the_ID(), 'rit_footer_layout', true);
    }
} else {
    if (get_theme_mod('rit_disable_footer', '0') == '1') {
        $rit_footer_status = false;
    }
}
$rit_class=$rit_footer_style.' '.rit_footer_sticky();
$rit_class.=rit_top_footer()?'': ' top-footer-disable';
$rit_class .= rit_main_footer()?'':' main-footer-disable';
if ($rit_footer_status) {
    ?>
    <footer id="footer-page" class="site-footer <?php echo esc_attr($rit_class)?>">
        <?php get_template_part('included/templates/footer/footer', $rit_footer_style); ?>
    </footer>
<?php } ?>
<div id="back-to-top"><i class="clever-icon-up"></i></div>
</div>
<?php wp_footer(); ?>
</body>
</html>