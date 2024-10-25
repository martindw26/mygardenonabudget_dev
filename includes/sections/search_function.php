<div id="primary" class="content-area">
    <main id="main" class="site-main container">
        <div class="row">
            <?php
            // Custom query to ensure only published posts are retrieved
            $args = array(
                'post_status' => 'publish',
                'post_type' => array 
                    ('post'),
                's' => get_search_query()             
            );

            $query = new WP_Query($args);

            if ( $query->have_posts() ) : ?>
                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        printf(
                            esc_html__( 'Search Results for: %s', 'textdomain' ),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                </header><!-- .page-header -->

                <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 text-dark border-0">
                            <div class="four-col-block">
                                <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="card-img-top four-col-block-thumb" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h6 class="mt-2">
                                        <a href="<?php the_permalink(); ?>" class="four-col-block-title text-dark"><?php the_title(); ?></a>
                                    </h6>
                                    <?php
                                    $author_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
                                    ?>
                                    <p class="card-text"><?php echo get_the_date(); ?> | By <?php echo $author_name; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

                <div class="d-flex justify-content-center align-items-center mb-4" style="height: 20px;">
                    <div class="pagination">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'           => 2,
                            'prev_text'          => __( '&laquo; Previous', 'textdomain' ),
                            'next_text'          => __( 'Next &raquo;', 'textdomain' ),
                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'textdomain' ) . ' </span>',
                            'screen_reader_text' => __( 'Posts navigation' ),
                        ) );
                        ?>
                    </div>
                </div>

            <?php else : ?>
                <p><?php _e( 'No posts found.', 'textdomain' ); ?></p>
            <?php endif; ?>

            <?php wp_reset_postdata(); // Reset query ?>
                
            <!-- Refine Search Form -->
            <?php get_template_part('includes/sections/refine_search'); ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->
</div>
