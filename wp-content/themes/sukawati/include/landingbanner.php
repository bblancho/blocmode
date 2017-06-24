<div id="popular-category">
    <div class="container">

        <?php if(vp_option('jeg_landingbanner.banner_title') !== '') : ?>
            <h2 class="line-heading">
                <span><?php echo esc_html(vp_metabox('jeg_landingbanner.banner_title')); ?></span>
            </h2>
        <?php endif; ?>

        <?php
        $landingbanner = vp_metabox('jeg_landingbanner.jeg_landing_banner_option');
        ?>
        <div class="popular-category-wrapper popular3">
            <?php
            foreach($landingbanner as $landing) {
                $bannerimage = $landing['banner_image'];
                $bannerimage = wp_get_attachment_image_src($bannerimage, 'sukawati-half-featured');
                ?>
                <div class="popular-item">
                    <img src="<?php echo esc_url($bannerimage[0]); ?>"/>
                    <div class="popular-item-wrapper">
                        <div class="popular-item-content">
                            <span><?php echo esc_html($landing['banner_alt_top']); ?></span>
                            <h3>
                                <a href="<?php echo esc_html($landing['banner_url']); ?>">
                                    <?php echo esc_html($landing['banner_title']); ?>
                                </a>
                            </h3>
                            <em><?php echo esc_html($landing['banner_alt_bottom']); ?></em>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>
