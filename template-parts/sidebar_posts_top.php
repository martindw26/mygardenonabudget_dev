<?php
    // Function to get category names from IDs for the top section
    function get_top_category_names($category_ids) {
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

    // Top categories and related posts
    $sidebar_top_categories = get_field('sidebar_top_categories', 'option');
    $categories_string_top = get_top_category_names($sidebar_top_categories);
    $posts_count_top = get_field('sidebar_top_post_count', 'option');
    $top_categories = !empty($sidebar_top_categories) ? array_map('intval', $sidebar_top_categories) : [];
    ?>

    <!-- Related Posts Block for Top Categories -->
    <div class="sidebar">
        <h3 class="widget-title">Latest in: <?php echo esc_html($categories_string_top); ?></h3>

        <?php
        $related_posts_top = new WP_Query([
            'posts_per_page' => $posts_count_top,
            'category__in' => $top_categories,
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
        endif;
        ?>
    </div>