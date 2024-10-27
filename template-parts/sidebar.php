<div class="col-md-4 d-none d-md-block">
    <div id="search" style="margin-bottom:15px;">
        <form method="get" action="http://plants-and-seeds-local.local/" class="d-flex">
            <input type="text" name="s" class="form-control me-2" placeholder="Search Our Site...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Function to get category names from IDs -->
    function get_category_names($category_ids) {
        $category_names = [];
        if (is_array($category_ids)) {
            foreach ($category_ids as $term_id) {
                $term = get_term($term_id);
                if (is_a($term, 'WP_Term') && !is_wp_error($term)) {
                    $category_names[] = $term->name;
                }
            }
        }
        return implode(', ', $category_names);
    }

    <!-- Fetch top categories -->
    <?php
    $sidebar_top_categories = get_field('sidebar_top_categories', 'option');
    $posts_count_top = get_field('sidebar_top_post_count', 'option');
    $top_categories_string = get_category_names($sidebar_top_categories);
    ?>

    <!-- Related Posts Block for Top Categories -->
    <div class="sidebar">
        <h3 class="widget-title">Latest in: <?php echo esc_html($top_categories_string); ?></h3>

        <?php
        $top_categories = !empty($sidebar_top_categories) ? array_map('intval', $sidebar_top_categories) : [];

        // Fetch related posts for top categories
        $related_posts_top = new WP_Query([
            'posts_per_page' => $posts_count_top,
            'category__in' => $top_categories,
            'post__not_in' => [get_the_ID()],
            'orderby' => 'date',
        ]);

        if ($related_posts_top->have_posts()) :
            while ($related_posts_top->have_posts()) : $related_posts_top->the_post();
                $category = get_the_category();
                $category = !empty($category) ? $category[0] : false;
        ?>
                <div class="post-item">
                    <?php if ($category) : ?>
                        <div class="post-category">
                            <a class="sidebar_cat" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <h5 class="mt-2">
                        <a href="<?php the_permalink(); ?>" class="text-dark">
                            <?php the_title(); ?>
                        </a>
                    </h5>

                    <div class="post-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </div>

                    <p class="text-secondary mt-2">
                        <?php echo get_the_date(); ?> | By <?php the_author(); ?>
                    </p>
                    <hr>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo "<p>No posts found in top categories.</p>"; // Debugging message
        endif;
        ?>
    </div>

    <!-- Middle Ad Block -->
    <div class="sidebar-ad-container-middle mt-4 mb-2">
        <div class="ad-label"><p>Advertisement</p></div>
        <div class="sidebar-mpu-middle">
            <?php get_template_part('includes/mpu_top'); ?>
        </div>
    </div>

    <!-- Fetch bottom categories -->
    <?php
    $sidebar_bottom_categories = get_field('sidebar_bottom_categories', 'option');
    $posts_count_bottom = get_field('sidebar_bottom_post_count', 'option');
    $bottom_categories_string = get_category_names($sidebar_bottom_categories);
    ?>

    <!-- Related Posts Block for Bottom Categories -->
    <div class="sidebar">
        <h3 class="widget-title">Latest in: <?php echo esc_html($bottom_categories_string); ?></h3>

        <?php
        $bottom_categories = !empty($sidebar_bottom_categories) ? array_map('intval', $sidebar_bottom_categories) : [];

        // Fetch related posts for bottom categories
        $related_posts_bottom = new WP_Query([
            'posts_per_page' => $posts_count_bottom,
            'category__in' => $bottom_categories,
            'post__not_in' => [get_the_ID()],
            'orderby' => 'date',
        ]);

        if ($related_posts_bottom->have_posts()) :
            while ($related_posts_bottom->have_posts()) : $related_posts_bottom->the_post();
                $category_bottom = get_the_category();
                $category_bottom = !empty($category_bottom) ? $category_bottom[0] : false;
        ?>
                <div class="post-item">
                    <?php if ($category_bottom) : ?>
                        <div class="post-category">
                            <a class="sidebar_cat" href="<?php echo esc_url(get_category_link($category_bottom->term_id)); ?>">
                                <?php echo esc_html($category_bottom->name); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <h5 class="mt-2">
                        <a href="<?php the_permalink(); ?>" class="text-dark">
                            <?php the_title(); ?>
                        </a>
                    </h5>

                    <div class="post-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </div>

                    <p class="text-secondary mt-2">
                        <?php echo get_the_date(); ?> | By <?php the_author(); ?>
                    </p>
                    <hr>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo "<p>No posts found in bottom categories.</p>"; // Debugging message
        endif;
        ?>
    </div>

    <!-- Bottom Ad Block -->
    <div class="sidebar-ad-container-bottom mt-4 mb-2">
        <div class="ad-label"><p>Advertisement</p></div>
        <div class="sidebar-mpu-bottom">
            <?php get_template_part('includes/mpu_bottom'); ?>
        </div>
    </div>
</div>
