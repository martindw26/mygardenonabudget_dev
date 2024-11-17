<?php
// Check if the ACF plugin function exists
if (function_exists('have_rows')):

    // Check if the repeater field 'left_page_skin_ads' has rows of data
    if (have_rows('left_page_skin_ads')): 

        // Initialize an array to store the ads
        $ads = [];

        // Loop through the repeater rows
        while (have_rows('left_page_skin_ads')): the_row();
            // Retrieve the image array and URL field
            $image = get_sub_field('left_page_skin');   // This will return an array
            $image_url = $image['url'] ?? '';           // Extract the image URL
            $ad_url = get_sub_field('left_page_skin_url'); // Get the ad URL

            // Check if both image URL and ad URL are not empty
            if ($image_url && $ad_url) {
                $ads[] = [
                    'image' => $image_url,
                    'url' => $ad_url
                ];
            }
        endwhile;

        // Check if the ads array is not empty
        if (!empty($ads)) {
            // Randomly select an ad
            $random_ad = $ads[array_rand($ads)];
            $ad_image = $random_ad['image'];
            $ad_url = $random_ad['url'];
            ?>
            
            <!-- Ad Container -->
            <div class="page-skin-left">
                <p class="advert_label">Advertisement</p>
                <a href="<?php echo esc_url($ad_url); ?>" target="_blank">
                    <img src="<?php echo esc_url($ad_image); ?>" alt="Left Page Skin Ad">
                </a>
            </div>
            
            <?php
        } else {
            // Display a comment if no ads are found
            echo '<!-- No ads available in the repeater field -->';
        }
    else:
        // Display a comment if the repeater field has no data
        echo '<!-- Repeater field "left_page_skin_ads" has no rows -->';
    endif;

else:
    // Display a comment if the ACF plugin is not active
    echo '<!-- ACF plugin is not active or missing -->';
endif;
?>
