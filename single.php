<?php get_header(); ?>

<div class="container p-2 mt-2">
  
<?php get_template_part('includes/sections/trending'); ?>



<?php
// Check if the ACF field exists and if it's true (enabled)
$run_of_site_leaderboard_enabled = get_field('ros_ad_header','option');

// Check if the toggle is on (true)
if ($leaderboard_bottom_script_enabled === 'on') {
    // Output or include the necessary script or functionality
    echo '<script>';
    // Add your leaderboard script or any other code here
    echo 'console.log("Run of site leaderboard script is enabled!");';
    echo '</script>';
} else {
    // Optionally, you can handle the case when the toggle is off
    echo '<script>';
    echo 'console.log("Run of site leaderboard script is disabled");';
    echo '</script>';
}
?> 

</div>

<div class="container text-sm-start p-2 mb-2 text-muted">
Plants & Seeds contains affiliate links to products. We may receive a commission for purchases made through these links. Please also report price issues at Report Price Issues
</div>

<div class="container">
    <div class="row">
       
       <div class="col-lg-8">
       
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
            <div class="container">

            <?php the_content(); ?>
                        


            </div>
<hr>

<section>
Social share bar to be added here
</section>

<hr>
<?php
$related_post_bottom_title = get_field ('related_post_bottom_title','option');
echo '<h2 class="related_post_bottom_title">'.$related_post_bottom_title .'</h2>';

$template_path = locate_template('includes/related.php');
if ($template_path) {
    include($template_path);
} else {
    echo 'Related section template not found.';
}
?>

            <div class="container-fluid text-black" style="height:60px; padding-top:8px;">
                <div class="social_share_header">
                    <?php
                    $on_article = get_field('on_article', 'option');
                    if ($on_article === 'yes') {
                        echo do_shortcode('[scriptless]');
                    }
                    ?>
                </div>
            </div>
            <br> 
            <?php endwhile; endif; ?>
        </div>

        <?php get_template_part( 'template-parts/sidebar' ); ?>

    </div>
</div>

</div>

<?php get_footer(); ?>
