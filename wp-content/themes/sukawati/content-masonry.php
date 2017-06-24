<?php
add_filter( 'excerpt_length', 'sukawati_home_masonry_excerpt_length', 999 );
add_filter('excerpt_more', 'sukawati_home_excerpt_more');

$additionalclass = 'article-masonry-box';
if(!has_post_thumbnail()) {
    $additionalclass = 'article-masonry-box no-thumbnail';
}

?>
<div class="article-masonry-container">
    <article id="post-<?php the_ID(); ?>" <?php post_class( $additionalclass ); ?>>
        <div class="article-masonry-wrapper clearfix">

            <?php get_template_part( 'include/featured-content-masonry' ); ?>

            <div class="masonry-excerpt">
                <div class="content-meta">
                    <span class="meta-category"><?php the_category(', '); ?></span>
                    <span class="meta-date"><?php the_date();  ?></span>
                </div>
                <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                <div class="article-masonry-summary">
                    <?php the_excerpt(); ?>

                    <?php if ( vp_option('joption.archives_show_readmore', 0) ) : ?>
                        <div class="readmore-wrap">
                            <a href="<?php the_permalink(); ?>" class="readmore"><?php esc_html_e( 'Continue Reading', 'sukawati') ?> <span class="meta-nav">&rarr;</span></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>
</div>
<?php
remove_filter('excerpt_length', 'sukawati_home_masonry_excerpt_length');
remove_filter('excerpt_more', 'sukawati_home_excerpt_more');
?>