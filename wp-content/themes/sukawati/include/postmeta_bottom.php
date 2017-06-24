<?php $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
<div class="content-meta-bottom">
    <div class="meta-author">
        <?php esc_html_e( 'By', 'sukawati' ) ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php echo esc_html(sukawati_get_author_name()); ?></a>
    </div>

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

    <div class="meta-comment">
        <?php comments_popup_link( esc_html__( 'No Comments', 'sukawati' ), esc_html__( '1 Comment', 'sukawati' ), esc_html__( '% Comments', 'sukawati' ), '', esc_html__( 'Comments are closed', 'sukawati' ) ); ?>
    </div>
</div>