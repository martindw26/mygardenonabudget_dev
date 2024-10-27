<div class="col-md-4 d-none d-md-block">
    <!-- Search Form -->
    <div id="search" style="margin-bottom:15px;">
        <form method="get" action="http://plants-and-seeds-local.local/" class="d-flex">
            <input type="text" name="s" class="form-control me-2" placeholder="Search Our Site..." aria-label="Search">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Top Posts Section -->
    <?php get_template_part('template-parts/sidebar_posts_top'); ?>

    <!-- Middle Ad Block -->
    <div class="sidebar-ad-container-middle mt-4 mb-2">
        <div class="ad-label"><p>Advertisement</p></div>
        <div class="sidebar-mpu-middle">
            <?php get_template_part('includes/mpu_top'); ?>
        </div>
    </div>

    <!-- Bottom Posts Section -->
    <?php get_template_part('template-parts/sidebar_posts_bottom'); ?>

    <!-- Bottom Ad Block -->
    <div class="sidebar-ad-container-bottom mt-4 mb-2">
        <div class="ad-label"><p>Advertisement</p></div>
        <div class="sidebar-mpu-bottom">
            <?php get_template_part('includes/mpu_bottom'); ?>
        </div>
    </div>
</div>
