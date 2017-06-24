<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <!-- TradeDoubler site verification 2964427 -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Header -->
<?php
if(get_theme_mod('rit_enable_popup','1')==1 && !isset($_COOKIE['rit-cookie-popup'])){
    ?>
<div id="rit-popup" class="<?php if(get_theme_mod('rit_enable_popup_mobile','1')!='1'){echo esc_attr('hide_on_mobile');}?>">
    <a href="javascript:;" class="close-popup"><i class="cs-font clever-icon-close"></i></a>
    <div class="rit-wrap-popup">
        <?php dynamic_sidebar( 'popup_widget' ); ?>
    </div>
    <div class="rit-cookie-popup">
        <input type="checkbox" id="rit-cookie-popup"/><?php echo esc_html__('Don\'t show this popup again.')?>
    </div>
</div>
<div class="mask-popup <?php if(get_theme_mod('rit_enable_popup_mobile','1')!='1'){echo esc_attr('hide_on_mobile');}?>"></div>
<?php
}
get_template_part('included/templates/header/header', 'template'); ?>