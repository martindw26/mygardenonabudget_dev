<?php
// Ensure ACF is active before using these functions

// Function to get category names from IDs
function get_bottom_category_names($category_ids_bottom) {
    $category_names_bottom = [];
    if (is_array($category_ids_bottom)) {
        foreach ($category_ids_bottom as $term_id_bottom) {
            $term = get_term($term_id_bottom);
            if (is_a($term, 'WP_Term') && !is_wp_error($term)) {
                $category_names_bottom[] = $term->name; // Correct variable name
            }
        }
    }
    return implode(', ', $category_names_bottom);
}

// Retrieve ACF fields for sidebar bottom categories and post count
$sidebar_bottom_categories = get_field('sidebar_bottom_categories', 'option');
$categories_string_bottom = get_bottom_category_names($sidebar_bottom_categories);
$posts_count_bottom = get_field('sidebar_bottom_post_count', 'option');
$bottom_categories = !empty($sidebar_bottom_categories) ? array_map('intval', $sidebar_bottom_categories) : [];
?>

<!-- Related Posts Block for Bottom Categories -->
<div class="sidebar">
    <h3 class="widget-title">Latest in: <?php echo esc_html($categories_string_bottom); ?></h3>

    <?php
    // Query for related posts
    $related_posts_bottom = new WP_Query([
        'posts_per_page' => $posts_count_bottom,
        'category__in' => $bottom_categories,
        'orderby' => 'date',
    ]);

    // Check if there are any posts to display
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
        wp_reset_postdata(); // Reset the post data after the loop
    else :
        // If no posts found
        echo '<p>No related posts found.</p>';
    endif;
    ?>
</div>
