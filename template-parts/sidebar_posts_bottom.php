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
        // Retrieve the term objects for the bottom categories
        $term_objects = get_terms([
            'taxonomy' => 'category',
            'include' => $bottom_categories, // Include only the categories in our array
            'hide_empty' => false, // Optional: show empty categories as well
        ]);

        // Extract the names of the terms
        $term_names = wp_list_pluck($term_objects, 'name'); // Get an array of term names

        // Output the term names as a comma-separated list
        echo esc_html(implode(', ', $term_names)); 
        ?>
    </h3>

    <?php
    // Query for related posts
    $related_posts_bottom = new WP_Query([
        'posts_per_page' => !empty($posts_count_bottom) ? intval($posts_count_bottom) : 5, // Default to 5 if not set
        'category__in' => $bottom_categories,
        'orderby' => 'date',
        'order' => 'DESC', // Optional: set order to descending
    ]);

    // Check if there are any posts to display
    if ($related_posts_bottom->have_posts()) :
        while ($related_posts_bottom->have_posts()) : $related_posts_bottom->the_post();
            $category_bottom = get_the_category();
            $category_bottom = !empty($category_bottom) ? $category_bottom[0] : null; // Use null instead of false
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
                    <?php echo esc_html(get_the_date()); ?> | By <?php echo esc_html(get_the_author()); ?>
                </p>
                <hr>
            </div>
    <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data after the loop
    else :
        // If no posts found
        echo '<p>No related posts found.</p>';
    endif;
    ?>
</div>
