<?php
$rit_top_footer = rit_top_footer();
$rit_main_footer = rit_main_footer();
if ($rit_top_footer || $rit_main_footer) {
    ?>
    <a href="javascript:;" class="footer-view btn"
       data-text="<?php esc_attr_e('Show Less', 'ri-ione'); ?>"><?php esc_html_e('Show More', 'ri-ione'); ?></a>
    <?php
}
if ($rit_top_footer) {
    ?>
    <div id="top-footer">
        <?php dynamic_sidebar('top-footer'); ?>
    </div>
<?php }
if ($rit_main_footer) {
    if (is_active_sidebar('main-footer-1') || is_active_sidebar('main-footer-2') || is_active_sidebar('main-footer-3') || is_active_sidebar('main-footer-4')) { ?>
        <div id="main-footer" class="footer-block">
            <div class="container">
                <div class="wrap-main-footer">
                    <div class="col-xs-12 col-sm-3 col-md-2 main-footer-block">
                        <?php dynamic_sidebar('main-footer-1'); ?>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-2 main-footer-block">
                        <?php dynamic_sidebar('main-footer-2'); ?>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-4 main-footer-block">
                        <?php dynamic_sidebar('main-footer-3'); ?>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-4 main-footer-block">
                        <?php dynamic_sidebar('main-footer-4'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
$rit_copyright_text = get_theme_mod('rit_copyright_text', '');
if ((get_theme_mod('rit_enable_copyright', '1') && $rit_copyright_text != '') || is_active_sidebar('bottom-footer')) { ?>
    <div id="bottom-footer" class="footer-block">
        <div class="container">
            <div id="copyright" class="col-xs-12 col-sm-6">
                <?php
                echo wp_kses($rit_copyright_text, array('a' => array('href' => array(), 'title' => array()), 'i' => array('class' => array()), 'br' => array('class' => array())));
                ?>
            </div>
            <div class="col-xs-12 col-sm-6 bottom-footer-block">
                <?php dynamic_sidebar('bottom-footer'); ?>
            </div>
        </div>
    </div>
<?php } ?>
