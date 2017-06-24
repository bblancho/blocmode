<?php
    $postnum = vp_option('joption.sidefeed_post_number', 6);
    $query = new WP_Query(array(
        'post_type'             => "post",
        'orderby'               => "date",
        'order'                 => "DESC",
        'posts_per_page'        => $postnum
    ));
?>

<div id="sidefeed">
    <div class="sidefeed-post-wrapper clearfix">
        <div class="sidefeed-heading">
            <h2><?php esc_html_e('Latest Stories', 'sukawati') ?></h2>
            <div class="sidefeed-cat-toggle">
                <i class="fa fa-angle-down"></i>
            </div>

            <ul class="sidefeed-cat">
                <li><a href="#" data-catid="" data-name="<?php esc_html_e('Latest Stories', 'sukawati') ?>"><?php esc_html_e('All Categories', 'sukawati') ?></a></li>
                <?php
                $categories = get_categories(array(
                    'orderby' => 'name',
                    'order' => 'ASC'
                ));

                foreach($categories as $category) {
                    sprintf('<li><a href="%s" data-catid="%s" data-name="%s">%s</a> </li>', get_category_link( $category->term_id ), esc_attr( $category->term_id ), esc_attr( $category->name ), $category->name);
                }
                ?>
            </ul>
        </div>

        <div class="sidefeed-posts">
            <div class="sidefeed-post-container" data-page="1" data-catid="">
                <?php if ( $query->have_posts() ) :
                        while ($query->have_posts()) : $query->the_post(); ?>

                        <div class="sidefeed-post clearfix">
                            <?php if( has_post_thumbnail(get_the_ID()) ) : ?>
                                <div class="post-thumb">
                                    <a href="<?php echo esc_url(get_permalink( get_the_ID())); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'sukawati-popular-post' ) ?></a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content">
                                <h3><a href="<?php echo get_permalink( get_the_ID() ); ?>"><?php the_title(); ?></a></h3>
                                <div class="content-meta">
                                    <span class="meta-date"><?php the_date(); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div class="sidefeed-loadmore">
                <button class="sidefeed-btn" data-end="<?php esc_html_e('End of Content','sukawati'); ?>" data-loading="<?php esc_html_e('Loading...','sukawati'); ?>" data-loadmore="<?php esc_html_e('Load More','sukawati'); ?>">
                    <?php esc_html_e('Load More', 'sukawati') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<div id="search-overlay">
    <div class="search-overlay-inner">
        <?php get_search_form(); ?>
        <p><?php esc_html_e('Search stories by typing keyword and hit enter to begin searching.', 'sukawati') ?></p>
    </div>

    <div class="search-overlay-close"></div>
</div>

<?php wp_reset_postdata(); ?>