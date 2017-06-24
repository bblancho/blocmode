<?php if (get_theme_mod('rit_stick_logo', '') != '') { ?>
    <div class="sticky-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
           title="<?php bloginfo('name'); ?>"><img
                src="<?php echo esc_url(get_theme_mod('rit_stick_logo')) ?>" alt="<?php bloginfo('name'); ?>"/></a>
    </div>
<?php } ?>