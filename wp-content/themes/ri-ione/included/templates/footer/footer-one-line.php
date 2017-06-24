<div id="bottom-footer" class="footer-block">
    <?php
    $rit_top_footer = rit_top_footer();
    if ($rit_top_footer) {
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
    <?php }?>
    <div class="container">
        <?php
        if (is_active_sidebar('right-bottom-footer')) { ?>
            <div class="col-xs-12 col-sm-3 pull-right right-bottom-footer">
                <?php dynamic_sidebar('right-bottom-footer'); ?>
            </div>
        <?php } ?>
        <?php
        $rit_copyright_text = get_theme_mod('rit_short_copyright_text', '');
        if ($rit_copyright_text == '') {
            $rit_copyright_text = get_theme_mod('rit_copyright_text', '');
        }
        ?>
        <div class="left-bottom-footer  col-xs-12 col-sm-9">
            <?php
            if (is_active_sidebar('left-bottom-footer')) { ?>
                <?php dynamic_sidebar('left-bottom-footer'); ?>
            <?php } ?>
            <?php if (get_theme_mod('rit_enable_copyright', '1') && $rit_copyright_text != '') { ?>
                <div id="copyright" class="copyright  pull-left">
                    <?php
                    echo wp_kses($rit_copyright_text, array('a' => array('href' => array(), 'title' => array()), 'i' => array('class' => array()), 'br' => array('class' => array())));
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>