<!-- Exhibitor Grid Container -->
<div class="grid-container">
    <?php if (have_rows('exhibitors_directory')): ?>
        <?php 
        // Loop through exhibitors
        while (have_rows('exhibitors_directory')): the_row();
            $image_directory = get_sub_field('c_image_directory');
            $name_directory = get_sub_field('c_name_directory');
            $category_field_directory = get_sub_field('categories_directory');
            $c_contact_directory = get_sub_field('c_contact_directory');
            $bio_directory = get_sub_field('c_bio_directory');
            $url_directory = get_sub_field('c_url_directory'); 
            ?>
            <div class="grid-item" data-name="<?php echo esc_attr(strtolower($name_directory)); ?>" data-category="<?php echo esc_attr(strtolower($category_field_directory)); ?>">
                <a <?php echo $url_directory ? 'href="' . esc_url($url_directory) . '" target="_blank" rel="noopener noreferrer"' : ''; ?> style="text-decoration: none; color: inherit;">
                    <?php if ($image_directory): 
                        // Check if $image_directory is an attachment ID or URL
                        if (is_numeric($image_directory)) {
                            // If $image_directory is an ID, get the medium size image
                            $image_data_directory = wp_get_attachment_image_src($image_directory, 'medium');
                            $image_url_directory = $image_data_directory ? $image_data_directory[0] : '';
                        } else {
                            // If $image_directory is a URL, use it as-is (fallback)
                            $image_url_directory = esc_url($image_directory);
                        }
                        // Display the image if the URL is available
                        if ($image_url_directory): ?>
                            <img class="exhibitor_image_directory" src="<?php echo esc_url($image_url_directory); ?>" alt="<?php echo esc_attr($name_directory); ?>">
                        <?php endif; 
                    endif; ?>

                    <?php 
                    $directory_show_company_name = get_field('directory_show_company_name');

                    if ($directory_show_company_name === 'yes'): ?>
                        <h3 class="exhibitor_name"><?php echo esc_html($name_directory); ?></h3>
                    <?php else: ?>
                        <h3 class="exhibitor_name" style="display:none;"><?php echo esc_html($name_directory); ?></h3>
                    <?php endif; ?>
                    
                    <?php 
                    $display_category = get_field('exhibitor_block_display_categories'); 

                    if ($display_category === 'on'): ?>
                        <!-- Display the category -->
                        <p class="exhibitor_cat"><?php echo esc_html($category_field_directory); ?></p>
                    <?php else: ?>
                        <p class="exhibitor_cat" style="display:none;"></p>
                    <?php endif; ?>


                    <?php 
                    $display_contact = get_field('exhibitor_block_display_contact'); 

                    if ($display_contact === 'on'): ?>
                            <button class="exhibitor_visit_web_button">
                                <?php echo esc_html($c_contact_directory); ?>
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