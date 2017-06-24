<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */
the_content();
get_template_part('included/templates/inpost_pagination');
edit_post_link(esc_html(__('Edit', 'ri-ione')), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->');