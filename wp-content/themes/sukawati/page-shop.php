<?php get_header(); ?>


    <!-- content -->
    <div id="post-wrapper" class="fullwidth">
        <div class="container">
            <span class="line-heading-single"></span>
            <div class="post-container">
                <div class="main-post">

                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>">
                            <div class="content-header-single">
                                <h1 class="content-title"><?php the_title(); ?></h1>

                                <span class="content-separator"></span>

                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="feature-holder">
                                        <?php the_post_thumbnail('large') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="entry clearfix">
                                <?php
                                the_content();
                                ?>
                            </div>

                        </article>
                    <?php endwhile; ?>

                </div>


                <div class="clear"></div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>