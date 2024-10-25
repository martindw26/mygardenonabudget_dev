<!-- Exhibitor Grid Container -->
<div class="grid-container_featured">
    <?php if (have_rows('exhibitors_directory_featured')): ?>
        <?php 
        // Loop through exhibitors
        while (have_rows('exhibitors_directory_featured')): the_row();
            $image_directory_featured = get_sub_field('c_image_directory_featured');
            $name_directory_featured = get_sub_field('c_name_directory_featured');
            $category_field_directory_featured = get_sub_field('categories_directory_featured');
            $c_contact_directory_featured = get_sub_field('c_contact_directory_featured');
            $bio_directory_featured = get_sub_field('c_bio_directory_featured');
            $url_directory_featured = get_sub_field('c_url_directory_featured'); 
            ?>
            <div class="grid-item_featured" data-name="<?php echo esc_attr(strtolower($name_directory_featured)); ?>" data-category="<?php echo esc_attr(strtolower($category_field_directory_featured)); ?>">
                <a <?php echo $url_directory_featured ? 'href="' . esc_url($url_directory_featured) . '" target="_blank" rel="noopener noreferrer"' : ''; ?> style="text-decoration: none; color: inherit;">
                    <?php if ($image_directory_featured): 
                        // Check if $image_directory is an attachment ID or URL
                        if (is_numeric($image_directory_featured)) {
                            // If $image_directory is an ID, get the medium size image
                            $image_data_directory_featured = wp_get_attachment_image_src($image_directory_featured, 'medium');
                            $image_url_directory_featured = $image_data_directory_featured ? $image_data_directory_featured[0] : '';
                        } else {
                            // If $image_directory is a URL, use it as-is (fallback)
                            $image_url_directory_featured = esc_url($image_directory_featured);
                        }
                        // Display the image if the URL is available
                        if ($image_url_directory_featured): ?>
                            <img class="exhibitor_image_directory_featured" src="<?php echo esc_url($image_url_directory_featured); ?>" alt="<?php echo esc_attr($name_directory_featured); ?>">
                        <?php endif; 
                    endif; ?>

                    <?php 
                    $directory_show_company_name_featured = get_field('directory_show_company_name_featured');

                    if ($directory_show_company_name_featured === 'yes'): ?>
                        <h3 class="exhibitor_name"><?php echo esc_html($name_directory_featured); ?></h3>
                    <?php else: ?>
                        <h3 class="exhibitor_name" style="display:none;"><?php echo esc_html($name_directory_featured); ?></h3>
                    <?php endif; ?>
                    
                    <?php 
                    $display_category_featured = get_field('exhibitor_block_display_categories_featured'); 

                    if ($display_category_featured === 'on'): ?>
                        <!-- Display the category -->
                        <p class="exhibitor_cat"><?php echo esc_html($category_field_directory_featured); ?></p>
                    <?php else: ?>
                        <p class="exhibitor_cat" style="display:none;"></p>
                    <?php endif; ?>


                    <?php 
                    $display_contact_featured = get_field('exhibitor_block_display_contact_featured'); 

                    if ($display_contact_featured === 'on'): ?>
                            <button class="exhibitor_visit_web_button">
                                <?php echo esc_html($c_contact_directory_featured); ?>
                            </button>
                    <?php else: ?>
                        <h3 class="exhibitor_visit_web_button" style="display:none;">
                    <?php endif; ?>
                </a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No featured exhibitors available at this time.</p>
    <?php endif; ?>
</div>