<?php
get_header();
/* Template Name: Home Page */
?>
<!-- ################ TOP SECTION ################### -->
<?php get_template_part('includes/sections/trending'); ?>
<div class="row mt-2">
    <div class="col-lg">
    <?php
    $homepage_slider = get_field('homepage_slider','option');
    $slider_block_title = get_field('slider_block_title','option');

    $slider_posts_query = new WP_Query(array(
        'posts_per_page' => -1,
        'orderby' => 'rand',
        'post__in' => $homepage_slider,
    ));
    if ($slider_posts_query->have_posts()): ?>
        <!-- Featured Slider block -->
        <div class="col-lg mt-2 mb-2">
            <!-- Featured block Slider -->
            <h2 class="post-featured-block-title-slider"><?php echo $slider_block_title;?></h2>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $i = 0;
                    while ($slider_posts_query->have_posts()): $slider_posts_query->the_post(); ?>
                        <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                            <div class="archive-post-container">
                                <div class="row archive">
                                    <div class="col">
                                        <div class="position-relative">
                                            <?php if (has_post_thumbnail()): ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <img class="featured-post-image-fw" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                                                </a>
                                            <?php endif; ?>
                                            <div class="featured-post-overlay">
                                                <h4><a href="<?php the_permalink(); ?>" class="text-white mt-2"><?php the_title(); ?></a></h4>
                                                <p class="text-white"><?php echo get_the_date(); ?> | By <?php the_author(); ?></p>
                                                <?php
                                                    $categories = get_the_category();
                                                    if ($categories) {
                                                        $separator = ' > ';
                                                        foreach ($categories as $index => $category) {
                                                            if ($category->parent == 0) {
                                                                echo '<button type="button" class="btn btn-success btn-sm"><a style="color:white; text-decoration:none;" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</button></a>'; // Output the category name with a link
                                                                break; 
                                                            }
                                                        }
                                                    }
                                                    ?>                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $i++; endwhile; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    <?php endif;
    wp_reset_postdata();
?>
</div>
<div class="col-lg-4">
<div class="slider-post-right">
    <?php
    $latesttextpoststitle = get_field('text_block_title','option');
    ?>
    <?php
    $latesttextposts = get_field('text_block_posts','option');
    $latesttextpostsoffset = get_field('text_block_posts_offset','option');
    $slider_posts_query = new WP_Query(array(
        'posts_per_page' => 3,
        'orderby' => 'date',
        'category__in' => $latesttextposts,
        'offset' => $latesttextpostsoffset,
        'post__not_in' => $homepage_slider
    ));
    if ($slider_posts_query->have_posts()): 
        while ($slider_posts_query->have_posts()): $slider_posts_query->the_post(); 

            $primary_category = get_post_meta(get_the_ID(), '_yoast_wpseo_primary_category', true);
            if ($primary_category) {
                $category = get_term($primary_category);
            } else {
                // Fallback to the first category
                $categories = get_the_category();
                $category = (!empty($categories)) ? $categories[0] : null;
            }
            ?>
            <div class="post-item">
            <?php
            $category_link = get_category_link($category->term_id);
            ?>
            <?php if ($category): ?>
                <div class="post-category" style="color:darkgreen; font-weight: 500;">
|                       <a href="<?php echo esc_url($category_link); ?>" style="color:darkgreen; font-weight: 500; text-decoration:none;">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </div>
            <?php endif; ?>
            <h5 class="mt-2" ><a href="<?php the_permalink(); ?>" style="text-decoration:none; color:black;"><?php the_title(); ?></a></h5>
            <div class="post-excerpt"><?php echo excerpt(20);?></div>
            <p class="text-secondary mt-2"><?php echo get_the_date(); ?> | By <?php the_author(); ?></p><hr>
        </div>
        <?php
    endwhile;
endif;
wp_reset_postdata();
?>
</div>
</div>
<!-- ################ END TOP SECTION ################### -->

<?php
// Check if the ACF field exists and if it's true (enabled)
$leaderboard_middle_script_enabled = get_field('hp_ldr_middle_1','option');

// Check if the toggle is on (true)
if ($leaderboard_middle_script_enabled === 'on') {
    // Output or include the necessary script or functionality
    echo '<script>';
    // Add your leaderboard script or any other code here
    echo 'console.log("Leaderboard Middle script is enabled!");';
    echo '</script>';
} else {
    // Optionally, you can handle the case when the toggle is off
    echo '<script>';
    echo 'console.log("Leaderboard Middle script is disabled");';
    echo '</script>';
}
?>




<!-- ################ MIDDLE SECTION ################### -->
<?php 
// Get the repeater field data from the options page
if (have_rows('homepage_static_block_category', 'option')) :
    while (have_rows('homepage_static_block_category', 'option')) : the_row();
        $homepage_featured_title = get_sub_field('homepage_featured_title', 'option');
        $homepage_featured_right = get_sub_field('homepage_featured_right');
        $homepage_slider = get_sub_field('homepage_slider');
        $homepage_featured_left = get_sub_field('homepage_featured_left');
        $homepage_featured_left_offset = get_sub_field('homepage_featured_left_offset');
        
        // Query for the large post on the left
        $column1_query = new WP_Query(array(
            'posts_per_page' => 1,
            'category__in' => $homepage_featured_right,
            'post__not_in' => $homepage_slider,
            'orderby' => 'date',
        ));

        if ($column1_query->have_posts()) :
            while ($column1_query->have_posts()) : $column1_query->the_post();
?>
<div class="mt-2">
<h2 class="post-featured-block-title"><?php echo $homepage_featured_title ?></h2>
    <div class="row">
            <div class="col-lg-7">
                <!-- Large post on the left -->
                <div class="featured-right-post">
                    <div class="position-relative">  
                        <div class="featured-right">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>"><img class="featured-right" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>"></a>
                            <?php endif; ?>
                            <div class="featured-post-overlay">
                                <h5><a href="<?php the_permalink(); ?>" class="text-white mt-2"><?php the_title(); ?></a></h5>
                                <?php
                                $author_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
                                ?>
                                <p class="text-white"><?php echo get_the_date(); ?> | By <?php echo $author_name; ?></p>
                                <?php
                                // Check if the post has categories
                                $categories = get_the_category();
                                if ($categories) {
                                    $separator = ' > '; // Define the separator
                                    // Loop through each category to find the primary one
                                    foreach ($categories as $index => $category) {
                                        if ($category->parent == 0) { // Check if it's the primary category
                                            echo '<button type="button" class="btn btn-success btn-sm"><a style="color:white; text-decoration:none;" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</button></a>'; // Output the category name with a link
                                            // No need to add a separator as it's the primary category
                                            break; // Exit the loop once primary category is found
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php 
endwhile;
wp_reset_postdata();
else :
?>
<div class="col-lg-6">
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
</div>
<?php endif; ?>
<div class="col-lg-5">
<div class="row">
    <?php 
    // Query for the smaller posts on the right
    $column2_query = new WP_Query(array(
        'posts_per_page' => 2,
        'category__in' => $homepage_featured_left,
        'post__not_in' => $homepage_slider,
        'orderby' => 'date',
        'offset'   => $homepage_featured_left_offset,
    ));
if ($column2_query->have_posts()) :
while ($column2_query->have_posts()) : $column2_query->the_post();
?>
<div class="col-lg-12">
    <div class="border-0 m-0">
        <div class="position-relative">  
            <div class="featured-left">
                <?php if (has_post_thumbnail()): ?>
                    <a href="<?php the_permalink(); ?>"><img class="featured-left" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>"></a>
                <?php endif; ?>
                <div class="featured-post-overlay">
                    <h5><a href="<?php the_permalink(); ?>" class="text-white mt-4"><?php the_title(); ?></a></h5>
                    <?php
                    $author_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
                    ?>
                    <p class="text-white"><?php echo get_the_date(); ?> | By <?php echo $author_name; ?></p>
                    <?php
                    // Check if the post has categories
                    $categories = get_the_category();
                    if ($categories) {
                        $separator = ' > '; // Define the separator
                        // Loop through each category to find the primary one
                        foreach ($categories as $index => $category) {
                            if ($category->parent == 0) { // Check if it's the primary category
                                echo '<button type="button" class="btn btn-success btn-sm"><a style="color:white; text-decoration:none;" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</button></a>'; // Output the category name with a link
                                // No need to add a separator as it's the primary category
                                break; // Exit the loop once primary category is found
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    endwhile;
    wp_reset_postdata();
else :
?>
    <div class="col-lg-6">
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    </div>
<?php endif; ?>
</div>
</div>
<?php 
endwhile;
endif;
?>
</div>
</div>
<!-- ################ END MIDDLE SECTION ################### -->
</div>
<?php 
$leaderboard_middle_body_script = get_field('leaderboard_middle_body_script', 'option');
$leaderboard_middle_body_script_switch = get_field('leaderboard_middle_body_script_switch', 'option');
$four_col_block_featured_title = get_field('four_col_block_featured_title', 'option');
$four_col_block_featured_cat = get_field('four_col_block_featured_cat', 'option');
$four_col_block_featured_post = get_field('four_col_block_featured_post', 'option');
$four_col_block_featured_offset = get_field('four_col_block_featured_offset', 'option');

?>
<!-- ################ BOTTOM SECTION ################### -->
<h2 class="post-featured-block-title"><?php echo $four_col_block_featured_title?></h2>
<div class="row">
    <?php 
    $column3_query = new WP_Query(array(
        'posts_per_page' => 4,
        'category__in' => $four_col_block_featured_cat,
        'post__not_in' => $four_col_block_featured_post,
        'orderby' => 'date',
        'offset'   => $four_col_block_featured_offset,
    ));

    if ($column3_query->have_posts()) :
        while ($column3_query->have_posts()) : $column3_query->the_post();
    ?>
    <div class="col-lg-3 text-white"> 
        <div class="border-0 m-0">
            <div class="four-col-block">
                <?php if (has_post_thumbnail()): ?>
                    <a href="<?php the_permalink(); ?>"><img class="four-col-block-thumb" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>"></a>
                <?php endif; ?>
                    <section class="four-block-title">
                    <h6 class="mt-2"><a href="<?php the_permalink(); ?>" class="four-col-block-title"><?php the_title(); ?></a></h6>
                    </section>
                    <?php
                    $author_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
                    ?>
                    <p class="four-col-block-title"><?php echo get_the_date(); ?> | By <?php echo $author_name; ?></p>

            </div>
        </div>
    </div>
<?php 
endwhile;
wp_reset_postdata();
else :
?>
<div class="col-lg-3"> <!-- Adjusted class to col-lg-3 for proper grid -->
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
</div>
<?php endif; ?>
</div>
<!-- ################ BOTTOM SECTION ################### -->

<?php
// Check if the ACF field exists and if it's true (enabled)
$leaderboard_bottom_script_enabled = get_field('hp_ldr_bottom','option');

// Check if the toggle is on (true)
if ($leaderboard_bottom_script_enabled === 'on') {
    // Output or include the necessary script or functionality
    echo '<script>';
    // Add your leaderboard script or any other code here
    echo 'console.log("Leaderboard Bottom script is enabled!");';
    echo '</script>';
} else {
    // Optionally, you can handle the case when the toggle is off
    echo '<script>';
    echo 'console.log("Leaderboard Bottom script is disabled");';
    echo '</script>';
}
?>

</div>
<?php get_footer(); ?>
