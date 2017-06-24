<?php
$logo   = apply_filters('sukawati_logo_6', vp_option('joption.logo', get_template_directory_uri() .'/images/logo.png'));
$logo2x = apply_filters('sukawati_logo_6_retina', vp_option('joption.logo_retina', get_template_directory_uri() .'/images/logo@2x.png'));

$logo_mobile   = apply_filters('sukawati_logo_mobile', vp_option('joption.logo_mobile', get_template_directory_uri() .'/images/logo.png'));
$logo_mobile2x = apply_filters('sukawati_logo_mobile_retina', vp_option('joption.logo_mobile_retina', get_template_directory_uri() .'/images/logo@2x.png'));
?>
<!-- heading v6 -->
<div id="heading" class="sixth-nav">
    <div class="top-wrapper">
        <div class="container nav-header">
            <div class="nav-social">
                <?php echo wp_kses(sukawati_social_icon(), array(
                    'ul' => array(
                        'class' => true
                    ),
                    'li' => array(

                    ),
                    'a' => array(
                        'target' => true,
                        'rel' => true,
                        'href' => true,
                    ),
                    'i' => array(
                        'class' => true,
                    ),
                )); ?>
            </div>

            <div class="logo-wrapper">
                <a title="<?php bloginfo('name'); ?>" href="<?php echo esc_url(home_url()); ?>">
                    <img class="logo-desktop" src="<?php echo esc_url( $logo ); ?>" data-at2x="<?php echo esc_url( $logo2x ); ?>" alt="<?php bloginfo('name'); ?>">
                    <img class="logo-mobile"  src="<?php echo esc_url( $logo_mobile ); ?>" data-at2x="<?php echo esc_url( $logo_mobile2x ); ?>" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>

            <div class="nav-right">
                <div class="nav-search">
                    <i class="fa fa-search"></i>
                </div>

                <?php
                if(function_exists('is_woocommerce'))  :
                    get_template_part( 'include/mini-cart' );
                endif;
                ?>
            </div>
        </div>
    </div>

    <div class="nav-helper"></div>
    <div class="nav-container">
        <div class="nav-wrapper">
            <div class="container group">

                <div class="mobile-navigation">
                    <i class="fa fa-bars"></i>
                </div>

                <div class="mobile-menu">
                    <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'mobile' , 'fallback_cb' => false ) ); ?>
                </div>

                <div class="navigation">
                    <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary', 'fallback_cb' => false ) ); ?>
                </div>

                <?php
                if(function_exists('is_woocommerce'))  :
                    get_template_part( 'include/mini-cart' );
                endif;
                ?>

                <div class="nav-search">
                    <i class="fa fa-search"></i>
                </div>

                <div class="nav-social">
                    <?php echo wp_kses(sukawati_social_icon(), array(
                        'ul' => array(
                            'class' => true
                        ),
                        'li' => array(

                        ),
                        'a' => array(
                            'target' => true,
                            'rel' => true,
                            'href' => true,
                        ),
                        'i' => array(
                            'class' => true,
                        ),
                    )); ?>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- heading v6 ended -->