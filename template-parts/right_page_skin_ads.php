<?php 
/**
 * Template Part: right Page Skin Ads (ACF Options Page)
 * Description: Displays ads using an ACF repeater from the Options Page within <div class="page-skin-right">
 */

// Check if ACF is active
if (!function_exists('have_rows')) {
    echo '<!-- ACF Plugin is not active. Please activate ACF plugin. -->';
    return;
}
?>


  <?php 
  // Fetch ads from the 'right_page_skin_ads' repeater field on the Options Page
  if (have_rows('right_page_skin_ads', 'option')) : 
    
    // Create an array to hold all the ad data
    $ads = [];
    
    // Loop through all the repeater rows and store the data
    while (have_rows('right_page_skin_ads', 'option')) : the_row(); 
      
      // Get subfields from the repeater
      $right_page_skin = get_sub_field('right_page_skin'); 
      $right_page_skin_url = get_sub_field('right_page_skin_url'); 
      
      // Ensure both the image and URL are available before adding to the array
      if ($right_page_skin && $right_page_skin_url) {
        $ads[] = [
          'image' => $right_page_skin,
          'url' => $right_page_skin_url
        ];
      }
      
    endwhile;

    // If there are ads in the array, randomly select one
    if (!empty($ads)) :
      // Shuffle the ads array to randomize the order and select the first one
      $random_ad = $ads[array_rand($ads)];
      
      // Randomly generate a rotation angle between -10 and 10 degrees
      $random_rotation = rand(-10, 10); 
      ?>
      
      <p class="advert_label">Advertisement</p>
      <a href="<?php echo esc_url($random_ad['url']); ?>" target="_blank" style="transform: rotate(<?php echo $random_rotation; ?>deg);">
        <img src="<?php echo esc_url($random_ad['image']); ?>" alt="right Page Skin Ad">
      </a>

    <?php else: ?>
      <!-- No valid ads found in the repeater field -->
      <p>No valid ads found. Please check the ACF fields on the Options Page.</p>
    <?php endif; ?>
    
  <?php else : ?>
    <!-- No ads found in the repeater field on Options Page -->
    <p>No ads found in the ACF repeater field on the Options Page. Please add ads in the ACF settings.</p>
  <?php endif; ?>

