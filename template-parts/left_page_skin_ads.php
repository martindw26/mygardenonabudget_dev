<?php
// Ensure that ACF function exists (check if ACF is active)
if (function_exists('have_rows')):

    // Check if the repeater field 'left_page_skin_ads' has rows of data
    if (have_rows('left_page_skin_ads')): 

        // Initialize an array to store the ads
        $ads = [];

        // Loop through the repeater rows
        while (have_rows('left_page_skin_ads')): the_row();
            $image_array = get_sub_field('left_page_skin');  // Get the image array
            $url = get_sub_field('left_page_skin_url');      // Get the ad URL

            // Check if the image array has a URL and URL is not empty
            if ($image_array && isset($image_array['url']) && $url) {
                $ads[] = [
                    'image' => $image_array['url'], // Access 'url' key from the image array
                    'url' => $url
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
            // Display a comment if no ads are available
            echo '<!-- No ads available in the repeater field -->';
        }
    else:
        // Display a comment if the repeater field has no data
        echo '<!-- Repeater field "left_page_skin_ads" has no rows -->';
    endif;

else:
    // Display a comment if ACF is not activated
    echo '<!-- ACF plugin is not active or missing -->';
endif;
?>
