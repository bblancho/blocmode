<?php
add_filter( 'excerpt_length', 'sukawati_home_excerpt_length_classic' );
add_filter('excerpt_more', 'sukawati_home_excerpt_more');
$postclass = sukawati_post_class(get_the_ID()) . " classic-center classic-post";
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( $postclass ); ?> data-article-type="<?php echo esc_attr(get_post_format()); ?>">

        <div class="feature-holder">
            <?php the_post_thumbnail('sukawati-new-feature-3') ?>
        </div>

        <div class="content-classic-wrapper">

            <div class="content-header-single">
                <?php if ( vp_option('joption.archives_show_postmeta', 1) )
                    get_template_part( 'include/postmeta' );
                ?>

                <h2 class="content-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>

            </div>

            <div class="entry">
                <?php the_excerpt(); ?>
            </div>

            <?php if ( vp_option('joption.archives_show_postmetabottom', 1) )
                get_template_part( 'include/postmeta_classic' );
            ?>

        </div>

        <div class="clearfix"></div>

    </article>

<?php
remove_filter('excerpt_length', 'sukawati_home_excerpt_length_classic');
remove_filter('excerpt_more', 'sukawati_home_excerpt_more');
?>