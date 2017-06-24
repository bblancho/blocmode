<?php
if (class_exists('YITH_WCAS')) {
    echo do_shortcode('[yith_woocommerce_ajax_search]');
} else {
    ?>
    <div class="header-search-block">
        <form method="post" class="clearfix" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" class="ipt text-field body-font" name="s"
                   placeholder="<?php echo esc_html__('Type & hit enter...', 'ri-ione'); ?>" autocomplete="off"/>
            <input type="hidden" name="post_type" value="product" />
        </form>
    </div>
<?php } ?>

<div id="right-header">
    <ul class="list-icon">
        <li class="search"><a href="javascript:;" class="search-trigger"
                              title="<?php echo esc_attr__('Toogle Search block', 'ri-ione') ?>"><i
                    class="clever-icon-search-5"></i><i class=" clever-icon-close"></i> </a></li>
        <?php if (class_exists('WooCommerce')) {
            if (get_permalink(get_option('woocommerce_myaccount_page_id')) != '') {
                ?>
                <li class="my-account-link">
                    <?php if (is_user_logged_in()) { ?>
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                           title="<?php _e('My Account', 'ri-ione'); ?>"><i class="clever-icon-user-2"></i> </a>
                    <?php } else { ?>
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                           title="<?php _e('Login / Register', 'ri-ione'); ?>"><i class="clever-icon-user-2"></i></a>
                    <?php } ?>
                </li>
            <?php } ?>
            <?php if (!rit_woo_catalog_mod()) { ?>
                <li class="top-ajax-cart">
                    <?php
                    get_template_part('included/templates/woocommerce/topheadcart'); ?>
                </li>
                <?php
            }
        } ?>
    </ul>
</div>
