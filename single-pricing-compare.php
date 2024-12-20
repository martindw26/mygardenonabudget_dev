i<?php get_header(); 
/**
 * Template Name: Price Compare
 * Template Post Type: post
 * Description: A custom post type for price table filtered and price compare
 */
?>

<div class="container p-2 mt-2">
  
<?php get_template_part('includes/sections/trending'); ?>



<?php 
// Initialize the $ros_ad_header variable
$ros_ad_header = get_field('ros_ad_header', 'option');

if (!is_singular()) {
    $leaderboard_ros_top_header_path = get_field('leaderboard_ros_top_header_path', 'option');
}

if ($ros_ad_header === 'on' && is_single()) { // Check if $ros_ad_header is 'on' and the current post is a single post
    echo '<section class="ros_ad_header">';
    $leaderboard_ros_top_body_script = get_field('leaderboard_ros_top_body_script', 'option');
    $leaderboard_top_body_script_switch = get_field('ros_ad_header', 'option');
  
    if ($leaderboard_top_body_script_switch === 'on') {
        echo '<section class="ad_header_top">';
        echo $leaderboard_ros_top_body_script;
        echo '</section>';
    }
    echo '</section>';
}
?>
</div>

<div class="container text-sm-start p-2 mb-2 text-muted">
Plants & Seeds contains affiliate links to products. We may receive a commission for purchases made through these links. Please also report price issues at Report Price Issues
</div>

<div class="container-fluid">

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-image">
                    <?php the_post_thumbnail('post-featured-image', ['class' => 'img-fluid', 'alt' => get_the_title()]); ?>
                </div>
            <?php endif; ?>
            <div class="post-title">
                <h1 class="text-center fs-1 pt-4"><?php the_title(); ?></h1>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php if (has_post_thumbnail()) : ?>
            </div>
            <?php endif; ?>
            <div class="text-center">
                <section class="meta-top">
                    <?php
                    $author_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
                    ?>
                    <p class="text-muted">
                        <?php echo get_the_date(); ?> | By <?php echo $author_name; ?> |
                        <?php
                        // Check if the post has categories
                        $categories = get_the_category();
                        if ($categories) {
                            $separator = ' > '; // Define the separator

                            // Loop through each category
                            foreach ($categories as $index => $category) {
                                echo '<a style="color:green; text-decoration:none;" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>'; // Output the category name with a link
                                // Add separator if it's not the last category
                                if ($index < count($categories) - 1) {
                                    echo $separator;
                                }
                            }
                        }
                        ?>
                    </p>
                </section>
            </div>

           
<?php 
$enable_product_post_filtered_table_plants = get_field('enable_product_post_filtered_table_plants'); 
if ($enable_product_post_filtered_table_plants === 'on') {
    get_template_part('template-parts/prodcut_post_filtered_table_plants');
}
?>


<?php 
$enable_product_post_filtered_table_products = get_field('enable_product_post_filtered_table_products'); 
if ($enable_product_post_filtered_table_products === 'on') {
    get_template_part('template-parts/product_post_filtered_table_products');
}
?>

            <?php get_template_part( 'includes/comparison' ); ?>

            </div>
            <div class="container-fluid text-black" style="height:60px; padding-top:8px;">
                <div class="social_share_header">
                    <?php
                    $on_article = get_field('on_article', 'option');
                    if ($on_article === 'yes') {
                        echo do_shortcode('[scriptless]');
                    }
                    ?>
                </div>
            <br> 
            <?php endwhile; endif; ?>
        </div>

    </div>

</div>

<?php get_footer(); ?>
