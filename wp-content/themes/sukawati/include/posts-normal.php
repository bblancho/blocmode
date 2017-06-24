<?php
    global $show_sidebar;

    $query = new WP_Query( sukawati_build_statement() );
?>

<div class="post-container">
    <div class="main-post">
    <?php
        // The Loop
        if ( $query->have_posts() ) :

            while ( $query->have_posts() ) :
                $query->the_post();
                get_template_part( 'content' );
            endwhile;

            // Pagination
            if(vp_option('joption.paging_type', 'number') === 'number')
            {
                sukawati_pagination( $query );
            } else {
                sukawati_pagination_nomal($query);
            }

        endif;

        /* Restore original Post Data */
        wp_reset_postdata();
    ?>

    </div>

    <?php if ($show_sidebar) get_sidebar() ?>

    <div class="clear"></div>
</div>