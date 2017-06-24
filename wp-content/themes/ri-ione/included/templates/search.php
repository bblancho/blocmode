<div class="search-wrap rit-search">
<?php
if ( class_exists( 'YITH_WCAS' ) ) {
    echo do_shortcode('[yith_woocommerce_ajax_search]');
} else {
?>
    <form method="post" class="clearfix" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="hidden" name="post_type" value="product" />
        <input type="text" class="ipt text-field body-font" name="s" placeholder="<?php echo esc_html__('Type & hit enter...', 'ri-ione'); ?>" autocomplete="off" />
        <i class="fa fa-search"></i>
    </form>

<?php }?></div>