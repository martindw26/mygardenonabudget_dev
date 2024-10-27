<?php 

// Retrieve ACF fields for sidebar bottom categories and post count
$sidebar_bottom_categories = get_field('sidebar_bottom_categories', 'option');
$posts_count_bottom = get_field('sidebar_bottom_post_count', 'option');

// Ensure $sidebar_bottom_categories is an array of integers
$bottom_categories = !empty($sidebar_bottom_categories) ? array_map('intval', (array) $sidebar_bottom_categories) : [];

?>

<!-- Related Posts Block for Bottom Categories -->
<div class="sidebar">
    <h3 class="widget-title">
        Latest in: 
        <?php 
        // Retrieve term objects for the bottom categories
        $term_objects = get_terms([
            'taxonomy' => 'category',
            'include' => $bottom_categories,
            'hide_empty' => false, // Show empty categories as well
        ]);

        // Extract the names of the terms
        $term_names = wp_list_pluck($term_objects, 'name'); // Get an array of term names

        // Output the term names as a comma-separated list
        echo esc_html(implode(', ', $term_names)); 
        ?>
    </h3>

    <?php
    // Query for related posts
    $related_posts_args = [
        'posts_per_page' => $posts_count_bottom, 
        'category__in' => $bottom_categories,
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    $related_posts_query = new WP_Query($related_posts_args);

    // Check if there are any posts to display
    if ($related_posts_query->have_posts()) :
        while ($related_posts_query->have_posts()) : $related_posts_query->the_post();
            $post_category = get_the_category();
            $primary_category = !empty($post_category) ? $post_category[0] : null; // Use null instead of false
    ?>
            <div class="post-item">
                <?php if ($primary_category) : ?>
                    <div class="post-category">
                        <a class="sidebar_cat" href="<?php echo esc_url(get_category_link($primary_category->term_id)); ?>">
                            <?php echo esc_html($primary_category->name); ?>
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
                    <?php echo esc_html(get_the_date()); ?> | By <?php echo esc_html(get_the_author()); ?>
                </p>
                <hr>
            </div>
    <?php
        endwhile;
        wp_reset_postdata(); // Reset post data after the loop
    else :
        // If no posts found
        echo '<p>No related posts found.</p>';
    endif;
    ?>
</div>
