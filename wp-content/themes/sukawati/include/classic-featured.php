<?php
    if ( get_post_format() == 'gallery' ) {
    // query the gallery images meta
    $images = get_post_meta($post->ID, '_format_gallery_images', true);

    if ( $images && !empty($images) ) : ?>

        <div class="feature-holder galleries featured-classic">
            <div class="flexslider">
                <ul class="slides">
                    <?php foreach ( $images as $image_id ) :

                        $image = sukawati_get_image_src( $image_id, 'sukawati-new-feature-1' );
                        $attachment = get_post( $image_id );
                        $alt = trim(strip_tags( get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true) ));
                        $image_title = $attachment->post_title; ?>

                        <li><img alt="<?php echo esc_attr(empty($alt) ? sanitize_title($image_title) : $alt); ?>" src="<?php  echo esc_url( $image ) ?>"></li>

                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    <?php elseif ( has_post_thumbnail() ) : ?>
        <div class="feature-holder">
            <?php the_post_thumbnail('large') ?>
        </div>
    <?php endif; ?>

<?php } else { ?>

    <div class="feature-holder">
        <?php the_post_thumbnail('sukawati-new-feature-1') ?>
    </div>

<?php } ?>
