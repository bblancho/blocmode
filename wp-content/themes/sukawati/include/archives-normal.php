<?php
    global $show_sidebar;
?>

<div class="post-container">
    <div class="main-post">
    <?php
        // The Loop
        if ( have_posts() ) :

            while ( have_posts() ) : the_post();
                get_template_part( 'content' );
            endwhile;

            // Pagination
            if(vp_option('joption.paging_type', 'number') === 'number')
            {
                sukawati_pagination();
            } else {
                sukawati_pagination_nomal();
            }

        endif;

        /* Restore original Post Data */
        wp_reset_postdata();
    ?>

    </div>

    <?php if ($show_sidebar) get_sidebar() ?>

    <div class="clear"></div>
</div>