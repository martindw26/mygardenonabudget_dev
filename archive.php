<?php get_header(); ?>

<div class="container p-2 mt-2">
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


<div class="col-md-8">


        <h2>
            <?php
                if ( is_category() ) {
                    single_cat_title('Latest ');
                } elseif ( is_tag() ) {
                    single_tag_title('');
                } elseif ( is_author() ) {
                    the_post();
                    echo 'Author Archives: ' . get_the_author();
                    rewind_posts();
                } elseif ( is_day() ) {
                    echo 'Daily Archives: ' . get_the_date();
                } elseif ( is_month() ) {
                    echo 'Monthly Archives: ' . get_the_date('F Y');
                } elseif ( is_year() ) {
                    echo 'Yearly Archives: ' . get_the_date('Y');
                } else {
                    echo 'Archives:';
                }
            ?>
        </h2>
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

        <div id="primary" class="content-area">
    <main id="main" class="site-main container">
        <div class="row">
        <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 text-dark border-0">
                            <div class="four-col-block">
                                <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="card-img-top four-col-block-thumb" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h6 class="mt-2">
                                        <a href="<?php the_permalink(); ?>" class="four-col-block-title text-dark"><?php the_title(); ?></a>
                                    </h6>
                                    <?php
                                    $author_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
                                    ?>
                                    <p class="card-text"><?php echo get_the_date(); ?> | By <?php echo $author_name; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    
                    <div class="d-flex justify-content-center align-items-center mb-4" style="height: 20px;">               
                    <div class="pagination">
    <?php
        // Customizing the pagination to include Bootstrap classes
        the_posts_pagination( array(
            'mid_size'           => 2,
            'prev_text'          => __( '&laquo; Previous', 'textdomain' ),
            'next_text'          => __( 'Next &raquo;', 'textdomain' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'textdomain' ) . ' </span>',
            'screen_reader_text' => __( 'Posts navigation' ),
        ) );
    ?>
</div>
</div>


            <?php else : ?>
                <p><?php _e( 'No posts found in this category.', 'textdomain' ); ?></p>
            <?php endif; ?>
        </div>
</div>


</div>

        
<?php get_template_part( 'template-parts/sidebar' ); ?>




</div>

<?php get_footer(); ?>
