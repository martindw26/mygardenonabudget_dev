<?php
// Get current category ID
$current_category = get_the_category();
$current_category_id = !empty($current_category) ? $current_category[0]->term_id : null;

// Set up initial query arguments to filter by category only
$args = [
    'post_type'      => 'post',
    'posts_per_page' => $min_results,
    'category__in'   => $current_category_id ? [$current_category_id] : [], // Filter by current category
];

$query = new WP_Query($args);

// If not enough results, modify query to search by keywords
if ($query->found_posts < $min_results && !empty($keywords)) {
    $args['s'] = $keywords; // Use 's' to search keywords in post content or description
    $query = new WP_Query($args);
}

// Check if there are posts found and display results
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        // Display post title and excerpt with link
        echo '<div>';
        echo '<h5 class="mt-2"><a href="' . get_the_permalink() . '" class="text-dark">' . get_the_title() . '</a></h5>';
        echo '<div class="post-excerpt">' . wp_trim_words(get_the_excerpt(), 20) . '</div>';
        echo '<p class="text-secondary mt-2">' . get_the_date() . ' | By ' . get_the_author() . '</p>';
        echo '<hr></div>';
    }
    wp_reset_postdata();
} else {
    echo 'No matching posts found.';
}
?>
