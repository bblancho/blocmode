<?php get_header(); ?>

<!-- content -->
<div id="post-wrapper" class="normal">
    <div class="container">
        <div class="notfound">
            <div class="notfoundfirst"><?php esc_html_e( 'Error 404', 'sukawati' ) ?></div>
            <div class="notfoundsec">
                <p><?php esc_html_e( "It look like the page you're looking for doesn't exist, sorry", 'sukawati' ) ?></p>
                <div><?php get_search_form(); ?></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>