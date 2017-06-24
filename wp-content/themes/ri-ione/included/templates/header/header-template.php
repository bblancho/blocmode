<?php
//Header class
$rit_class_header = '';
$rit_header_top = rit_enable_header_top();
$rit_header_layout = rit_header_layout();
$rit_class_header .= rit_header_fullwidth() . ' ' . $rit_header_layout . ' ' . rit_header_transparent();
if ('stack-center' != $rit_header_layout &&'stack-center-2' != $rit_header_layout && $rit_header_layout != 'vertical') {
    $rit_class_header .= ' one-line';
}
?>

<div class="wrap-mobile-nav">
    <div class="search-wrap rit-search">
        <form method="get" class="clearfix" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" class="ipt text-field body-font" name="s"
                   placeholder="<?php echo esc_html__('Type & hit enter...', 'ri-ione'); ?>" autocomplete="off"/>
            <i class="fa fa-search"></i>
        </form>
    </div>
    <nav id="mobile-nav" class="primary-font">
        <?php wp_nav_menu(array('container_class' => 'canvas-menu', 'theme_location' => 'canvas')); ?>
    </nav>
</div>
<header id="rit-header" class="wrap-header <?php echo esc_attr($rit_class_header); ?>">
    <?php
    if ($rit_header_top) {
        get_template_part('/included/templates/header/header-layout/top', 'header');
    }
    get_template_part('/included/templates/header/header-layout/' . $rit_header_layout, 'layout');
    ?>
</header>
<div class="wrap-body-content <?php echo esc_attr($rit_header_layout == 'vertical' ? 'vertical-content' : ''); ?>">
