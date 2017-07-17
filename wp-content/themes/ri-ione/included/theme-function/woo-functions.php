<?php
/**
 * Created by PhpStorm.
 * User: NTK
 * Date: 6/22/2015
 * Time: 4:18 PM
 * All custom function of woo.
 */
if (class_exists('WooCommerce')) {
    add_action('after_setup_theme', 'rit_woocommerce_support');
    if (!function_exists('rit_woocommerce_support')) {
        function rit_woocommerce_support()
        {
            add_theme_support('woocommerce');
        }
    }
    //Remove link close woo 2.5
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
//Custom number product display
    add_filter('loop_shop_per_page', create_function('$cols', 'return ' . get_theme_mod('rit_number_products_display','12') . ';'), 20);

    //Custom number products related display
    add_filter('woocommerce_output_related_products_args', 'rit_related_products_args');
    if(!function_exists('rit_related_products_args')) {
        function rit_related_products_args($args)
        {
            if (get_theme_mod('rit_woo_related_display') == '') {
                $args['posts_per_page'] = 4; // 4 related products
            } else
                $args['posts_per_page'] = get_theme_mod('rit_woo_related_display');
            return $args;
        }
    }
    if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
        function woocommerce_template_loop_product_thumbnail()
        {
            $rit_img = get_post_thumbnail_id(get_the_ID());
            $rit_attachments = get_attached_file($rit_img);
            if (has_post_thumbnail() && $rit_attachments) :
                $rit_item = wp_get_attachment_image_src($rit_img, 'shop_catalog');
                $rit_img_url = $rit_item[0];
                $rit_width = $rit_item[1];
                $rit_height = $rit_item[2];
                $resolution = $rit_width / $rit_height;
                $rit_img_title = get_the_title($rit_img);
                ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
                   data-resolution="<?php echo esc_attr($resolution) ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/placeholder.gif"
                         height="<?php echo esc_attr($rit_height) ?>" width="<?php echo esc_attr($rit_width) ?>"
                         class="lazy-img" data-original="<?php echo esc_attr($rit_img_url) ?>"
                         alt="<?php echo esc_attr($rit_img_title); ?>"/>
                </a>
                <?php
            endif;
        }
    }
    // add_action('woocommerce_before_shop_loop_item_title', 'rit_loop_product_thumbnail', 10);
    if (!function_exists('rit_loop_product_thumbnail')) {
        function rit_loop_product_thumbnail($size = 'shop_catalog')
        {
            $id = get_the_ID();
            $image_product_hover = get_theme_mod('rit_woo_product_hover');
            $gallery = get_post_meta($id, '_product_image_gallery', true);
            if (!empty($gallery) && ($image_product_hover != 'off')) {
                $gallery = explode(',', $gallery);
                $first_image_id = $gallery[0];
                echo wp_get_attachment_image($first_image_id, $size, false, array('class' => 'hover-image'));
            }
        }
    }
    /* WooCommerce - Ajax add to cart =================================================================================== */
    //Update topcart when addtocart(Ajax cart)
    add_filter('woocommerce_add_to_cart_fragments', 'rit_top_cart');
    if (!function_exists("rit_top_cart")) {
        function rit_top_cart($fragments)
        {
            ob_start();
            get_template_part('included/templates/woocommerce/topheadcart');
            $fragments['#top-cart'] = ob_get_clean();
            return $fragments;
        }
    }
    /* WooCommerce - Ajax remover cart ================================================================================== */
    add_action('wp_ajax_cart_remove_product', 'rit_woo_remove_product');
    add_action('wp_ajax_nopriv_cart_remove_product', 'rit_woo_remove_product');
    if (!function_exists('rit_woo_remove_product')) {
        function rit_woo_remove_product()
        {
            $product_key = $_POST['product_key'];
            $cart = WC()->instance()->cart;
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                if ($cart_item['product_id'] == $product_key) {
                    $removed = WC()->cart->remove_cart_item($cart_item_key);
                }
            }
            if ($removed) {
                $output['status'] = '1';
                $output['cart_count'] = $cart->get_cart_contents_count();
                $output['cart_subtotal'] = $cart->get_cart_subtotal();
            } else {
                $output['status'] = '00';
            }
            echo json_encode($output);
            exit;
        }
    }
    //Woocommerce Sidebar
    if(!function_exists('rit_woo_sidebar')){
        function rit_woo_sidebar(){
            $rit_woo_sidebar= get_theme_mod('rit_woo_sidebar_option','left-sidebar');
            if (isset($_GET['sidebar'])):
                if($_GET['sidebar']=='left'){
                    $rit_woo_sidebar='left-sidebar';
                }
                else if($_GET['sidebar']=='no'){
                    $rit_woo_sidebar='no-sidebar';
                }
                else{
                    $rit_woo_sidebar='right-sidebar';
                }
            endif;
            return $rit_woo_sidebar;
        }
    }
    if(!function_exists('rit_woo_sidebar_status')){
        function rit_woo_sidebar_status(){
            $rit_sb_status='';
            if(isset($_COOKIE['sidebar-status'])){
                $rit_sb_status=($_COOKIE['sidebar-status']=='true'?' disable-sidebar':'');
            }
            return $rit_sb_status;
        }

    }
    //Hide Quick view
    if(!function_exists('rit_woo_enable_quickview')){
        function rit_woo_enable_quickview(){
            $rit_qv_status=true;
            if(get_theme_mod('rit_woo_hide_quickview','')==1){
                $rit_qv_status=false;
            }
            return $rit_qv_status;
        }

    }
    //Hide Stock label
    if(!function_exists('rit_woo_enable_stocklabel')){
        function rit_woo_enable_stocklabel(){
            $rit_status=true;
            if(get_theme_mod('rit_woo_hide_stock_label','')==1){
                $rit_status=false;
            }
            return $rit_status;
        }

    }
    //Disable Zoom
    if(!function_exists('rit_woo_enable_zoom')){
        function rit_woo_enable_zoom(){
            $rit_status=true;
            if(get_theme_mod('rit_woo_disable_zoom','')==1){
                $rit_status=false;
            }
            return $rit_status;
        }

    }
    //Catalog Mod
    if(!function_exists('rit_woo_catalog_mod')){
        function rit_woo_catalog_mod(){
            $rit_catalog_status=get_theme_mod('rit_woo_catalog_mod','')=='1'?true:false;
            if (isset($_GET['catalog_mod'])):
                $rit_catalog_status=true;
            endif;
            if($rit_catalog_status) {
                remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            }
            return $rit_catalog_status;
        }
    }
    //Product Detail Layout
    if(!function_exists('rit_woo_layout_single')){
        function rit_woo_layout_single(){
            $rit_layout_single=get_post_meta(get_the_ID(),'rit_woo_layout_single',true);
            if($rit_layout_single=='inherit'||$rit_layout_single==''){
                $rit_layout_single=get_theme_mod('rit_woo_layout_single','vertical-gallery');
            }
            return $rit_layout_single;
        }
    }
    remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
    //Change breadcrumb location
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
    add_action( 'rit_woocommerce_cart_collaterals', 'woocommerce_cross_sell_display',5 );
    remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
    add_action('rit_woocommerce_breadcrumb','woocommerce_breadcrumb',20);
    //Add woocommerce_show_product_loop_sale_flash
    add_action('rit_woocommerce_show_product_loop_sale_flash','woocommerce_show_product_loop_sale_flash',5);
    //Change location Order
    remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
    add_action('rit_woocommerce_catalog_ordering','woocommerce_catalog_ordering',10);
    //Remove Rating
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
    //Single Sale Flash
    remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
    add_action('rit_woocommerce_show_product_sale_flash','woocommerce_show_product_sale_flash',10);
    //Single hook
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
    add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',15);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
    add_action('woocommerce_after_single_product_summary','woocommerce_template_single_meta',18);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);
    add_action('woocommerce_after_single_product_summary','woocommerce_template_single_sharing',5);
    //Woo layout
    if(!function_exists('rit_woo_layout')){
        function rit_woo_layout(){
            $rit_layout = get_theme_mod('rit_woo_layout','grid');
            if (isset($_GET['product-layout'])):
                $rit_layout = $_GET['product-layout'];
            endif;
            if (isset($_COOKIE['product-layout'])):
                $rit_layout = $_COOKIE['product-layout'];
            endif;
            return $rit_layout;
        }
    }
    /* Ajax Url ==========================================================================================================*/
    add_action('wp_head','rit_framework_ajax_url',15);
    function rit_framework_ajax_url() {
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo esc_url( admin_url('admin-ajax.php') ); ?>';
        </script>
        <?php
    }
    /* Ajax Quick Viewl ==================================================================================================*/
    add_action('wp_ajax_rit_quickview', 'rit_quickview');
    add_action('wp_ajax_nopriv_rit_quickview', 'rit_quickview');

    /* The Quickview Ajax Output */
    function rit_quickview() {

        global $post, $product, $woocommerce;
        wp_enqueue_script( 'wc-add-to-cart-variation' );
        $product_id = $_POST['product_id'];

        $product = wc_get_product( $product_id);

        $post = $product->post;

        setup_postdata( $post );

        ob_start();

        wc_get_template_part( 'quick', 'view' );

        $output = ob_get_contents();

        ob_end_clean();

        wp_reset_postdata();

        echo $output;

        exit;
    }
    add_action( 'after_setup_theme', 'ri_support_lb' );
    if(!function_exists('ri_support_lb')){
        function ri_support_lb() {
            add_theme_support( 'wc-product-gallery-lightbox' );
        }
    }
}