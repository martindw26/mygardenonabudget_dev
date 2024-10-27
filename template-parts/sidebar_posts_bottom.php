<?php
    // Function to get category names from IDs for the bottom section
    function get_bottom_category_names($category_ids) {
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

    // bottom categories and related posts
    $sidebar_bottom_categories = get_field('sidebar_bottom_categories', 'option');
    $categories_string_bottom = get_bottom_category_names($sidebar_bottom_categories);
    $posts_count_bottom = get_field('sidebar_bottom_post_count', 'option');
    $bottom_categories = !empty($sidebar_bottom_categories) ? array_map('intval', $sidebar_bottom_categories) : [];
    ?>

    <!-- Related Posts Block for bottom Categories -->
    <div class="sidebar">
        <h3 class="widget-title">Latest in: <?php echo esc_html($categories_string_bottom); ?></h3>

        <?php
        $related_posts_bottom = new WP_Query([
            'posts_per_page' => $posts_count_bottom,
            'category__in' => $bottom_categories,
            'orderby' => 'date',
        ]);

        if ($related_posts_bottom->have_posts()) :
            while ($related_posts_bottom->have_posts()) : $related_posts_bottom->the_post();
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