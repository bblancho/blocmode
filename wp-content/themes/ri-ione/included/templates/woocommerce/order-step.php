<?php
/**
 * Template Order step
 * @since: ri-ione 1.0
 */
?>
<ul id="order-step">
    <li class="step <?php if(is_cart()||is_checkout()||is_wc_endpoint_url( 'order-received' )){echo esc_attr('active');}?>">
        <?php esc_html_e('Cart','ri-ione') ?>
    </li>
    <li class="step <?php if(is_checkout()||is_wc_endpoint_url( 'order-received' )){echo esc_attr('active');}?>">
        <i class="fa fa-angle-right"></i>
        <?php esc_html_e('Check Out Detail','ri-ione') ?>
    </li>
    <li class="step  <?php if(is_wc_endpoint_url( 'order-received' )){echo esc_attr('active');}?>">
        <i class="fa fa-angle-right"></i>
        <?php esc_html_e('Order Complete','ri-ione') ?>
    </li>
</ul>
