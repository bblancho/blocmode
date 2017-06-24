
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php
$footer_text = vp_option('joption.footer_text', 'Copyright &copy; Jegtheme 2016. Brands are the property of their respective owners.' );
?>
    <div class="footer-margin"></div>

    <?php if ( is_active_sidebar( SUKAWATI_FOOTER_INSTAGRAM ) ) : ?>
        <div id="footer-instagram" class="clearfix">
            <?php /* Instagram Widget */ if ( is_active_sidebar( SUKAWATI_FOOTER_INSTAGRAM ) ) dynamic_sidebar( SUKAWATI_FOOTER_INSTAGRAM ) ?>
        </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( SUKAWATI_FOOTER_SUBSCRIBE ) ) : ?>
        <div class="subscribe-footer clearfix">
            <div class="container">
                <?php /* Subscribe Widget */ if ( is_active_sidebar( SUKAWATI_FOOTER_SUBSCRIBE ) ) dynamic_sidebar( SUKAWATI_FOOTER_SUBSCRIBE ) ?>
            </div>
        </div>
    <?php endif; ?>

    <div id="footer">
        <?php if( vp_option('joption.show_footer_widget', true) ) : ?>
            <div class="footer-widget">
                <div class="container clearfix">
                    <div class="grid one-third">
                        <?php /* Footer Widget 1 */ if ( is_active_sidebar( SUKAWATI_FOOTER_WIDGET_1 ) ) dynamic_sidebar( SUKAWATI_FOOTER_WIDGET_1 ) ?>
                    </div>
                    <div class="grid one-third">
                        <?php /* Footer Widget 2 */ if ( is_active_sidebar( SUKAWATI_FOOTER_WIDGET_2 ) ) dynamic_sidebar( SUKAWATI_FOOTER_WIDGET_2 ) ?>
                    </div>
                    <div class="grid one-third last">
                        <?php /* Footer Widget 3 */ if ( is_active_sidebar( SUKAWATI_FOOTER_WIDGET_3 ) ) dynamic_sidebar( SUKAWATI_FOOTER_WIDGET_3 ) ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        <?php endif; ?>

        <div class="footer-bottom clearfix">
            <div class="container">
                <div class="social-copy">
                    <p><?php echo wp_kses_post( $footer_text );?></p>
                </div>
            </div>
        </div>
    </div>

    </div><!-- /#wrapper -->

    <div class="gototop hidden"><i class="fa fa-angle-up"></i></div>

    <?php get_template_part( 'include/sidefeed' ); ?>

    <?php wp_footer() ?>
    </body>
</html>