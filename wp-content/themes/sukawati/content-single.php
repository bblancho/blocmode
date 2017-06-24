<?php
$featured_img   = sukawati_get_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( sukawati_post_class() ); ?> data-article-type="<?php echo esc_attr(get_post_format()) ?>">
    <div class="content-header-single">
        <?php if ( vp_option('joption.single_show_postmeta', 1) )
            get_template_part( 'include/postmeta' ); ?>

        <h1 class="content-title"><?php the_title(); ?></h1>

        <span class="content-separator"></span>

        <?php get_template_part( 'include/featured-content' ); ?>
    </div>
    <div class="content-inner">
        <div class="content-share-follow">
            <?php if ( vp_option('joption.single_show_socials', 1) ): ?>
            <div class="content-share-wrapper">
                <div class="social-sharing">
                    <div class="sharing-facebook">
                        <a data-shareto="<?php esc_html_e('Facebook', 'sukawati') ?>" rel="nofollow" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(wp_get_shortlink()) ?>"><i class="fa fa-facebook"></i></a>
                    </div>
                    <div class="sharing-twitter">
                        <a data-shareto="<?php esc_html_e('Twitter', 'sukawati') ?>" rel="nofollow" target="_blank" href="https://twitter.com/home?status=<?php echo esc_html(urlencode( get_the_title()) ); ?>%20-%20<?php echo esc_url(wp_get_shortlink()) ?>"><i class="fa fa-twitter"></i></a>
                    </div>
                    <div class="sharing-google">
                        <a data-shareto="<?php esc_html_e('Google', 'sukawati') ?>" rel="nofollow" target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url(wp_get_shortlink()) ?>"><i class="fa fa-google"></i></a>
                    </div>
                    <div class="sharing-pinterest">
                        <a data-shareto="<?php esc_html_e('Pinterest', 'sukawati') ?>" rel="nofollow" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(wp_get_shortlink()) ?>&amp;media=<?php echo esc_url( $featured_img ); ?>&amp;description=<?php echo esc_html(urlencode( get_the_title()) ); ?>"><i class="fa fa-pinterest"></i></a>
                    </div>
                    <div class="sharing-linkedin">
                        <a data-shareto="<?php esc_html_e('Linkedin', 'sukawati') ?>" rel="nofollow" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(wp_get_shortlink()) ?>&amp;title=<?php echo esc_html(urlencode( get_the_title()) ) ?>&amp;summary=<?php echo esc_html(urlencode( wp_strip_all_tags( get_the_excerpt() ))) ?>&amp;source=<?php echo esc_html(urlencode( get_bloginfo( 'name' )) ) ?>"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="entry">
            <?php
            if(vp_option('joption.show_related_post', 0)) {

                echo wp_kses(sukawati_relatedpost(array(
                    'size' => vp_option('joption.related_post_number', 4)
                )), array(
                    'aside' => array(
                        'class' => true
                    ),
                    'h6' => array(
                        'class' => true
                    ),
                    'div' => array(
                        'class' => true
                    ),
                    'a' => array(
                        'href' => true,
                        'class' => true
                    ),
                ));

            }
            ?>
            <?php
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sukawati' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div>
    </div>
</article>