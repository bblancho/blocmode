<?php
global $show_sidebar;

$query = new WP_Query( sukawati_build_statement() );
?>

<div class="post-container">
    <div class="main-post">
        <?php
        // The Loop

        if ( $query->have_posts() ) :

            $i = 1;
            $pos = 'left';
            while ( $query->have_posts() ) :
                $query->the_post();

                if(has_post_thumbnail()) {
                    /* rule 1 */
                    switch($i) {
                        case 1 :
                            get_template_part( 'content-classic-left' );
                            break;
                        case 2:
                            get_template_part( 'content-classic-right' );
                            break;
                        case 3:
                            get_template_part( 'content-classic-center' );
                            $i = 0;
                            break;
                    }


                    /* rule 2
                    if($i % 2 === 0) {
                        get_template_part( 'content-classic-center' );
                    } else {
                        if($pos === 'left') {
                            get_template_part( 'content-classic-left' );
                            $pos = 'right';
                        } else {
                            get_template_part( 'content-classic-right' );
                            $pos = 'left';
                        }
                    }
                    */

                    /* rule 3
                    switch($i) {
                        case 1 :
                            get_template_part( 'content-classic-left' );
                            break;
                        case 2:
                            get_template_part( 'content-classic-right' );
                            $i = 0;
                            break;
                    }
                    */


                    $i++;
                } else {
                    get_template_part( 'content-classic' );
                }

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