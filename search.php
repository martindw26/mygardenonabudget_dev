<style>

img.search_tumbnail {
    height: 200px;
    width: 100%;
    object-fit: contain;
}

</style>

<?php get_header(); ?>

<div class="container p-2 mt-2">

<?php get_template_part('includes/sections/trending'); ?>

<?php 
$ros_ad_header = get_field('ros_ad_header', 'option');

if ($ros_ad_header === 'on') {
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

<div class="row archive">
<?php
$sidebartoggle = get_field('show_sidebar_cat', 'option');
if ($sidebartoggle === "yes") {
    echo '<div class="col-md-8">';
} else {
    echo '<div class="col-lg-12">';
}
?>
        <section class="archive-title-horizontal-line"></section>

        <!-- SEO text -->
        <?php if (is_category()): ?>
            <?php $category_description = category_description();
            if (!empty($category_description)) : ?>
                <div class="bg-secondary text-light p-4 mb-4 border-dark lead">
                    <div><?php echo $category_description; ?></div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php get_template_part('includes/sections/search_function'); ?>

        <?php get_template_part( 'template-parts/sidebar_search' ); ?>

</div>

<?php get_footer(); ?>
