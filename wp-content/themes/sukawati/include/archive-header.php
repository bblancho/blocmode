<div class="category-header ">
<?php

    $heading = '';
    $content = '';

    if ( is_day() ) :
        $heading = sprintf( esc_html__( 'Daily Archives', 'sukawati' ) );
        $content = get_the_date();
    elseif ( is_month() ) :
        $heading = sprintf( esc_html__( 'Monthly Archives', 'sukawati' ) );
        $content = get_the_date( _x( 'F Y', 'monthly archives date format', 'sukawati' ) );
    elseif ( is_year() ) :
        $heading = sprintf( esc_html__( 'Yearly Archives', 'sukawati' ));
        $content = get_the_date( _x( 'Y', 'yearly archives date format', 'sukawati' ) );
    elseif ( is_category() ) :
        $heading = sprintf( esc_html__( 'Posts in Category', 'sukawati' ));
        $content = single_cat_title( '', false );
    elseif ( is_tag() ) :
        $heading = sprintf( esc_html__( 'Posts in Tag', 'sukawati' ));
        $content = single_tag_title( '', false );
    elseif ( is_search() ) :
        $heading = sprintf( esc_html__( 'Search Result For', 'sukawati' ));
        $content = get_search_query();
    elseif ( is_author() ) :
        $heading = sprintf( esc_html__( 'All posts by', 'sukawati' ) );
        $content = sukawati_get_author_name();
    else :
        $heading = esc_html__( 'Archives', 'sukawati' );
    endif;
?>
    <span><?php echo esc_html( $heading ); ?></span>
    <h2><?php echo esc_html($content); ?></h2>
</div>