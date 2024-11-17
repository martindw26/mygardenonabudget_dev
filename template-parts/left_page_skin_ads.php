<?php 
/**
 * Template Part: Left Page Skin Ads (ACF Options Page)
 * Description: Displays ads using an ACF repeater from the Options Page within <div class="page-skin-left">
 */

// Check if ACF is active
if (!function_exists('have_rows')) {
    echo '<!-- ACF Plugin is not active. Please activate ACF plugin. -->';
    return;
}
?>

<div class="page-skin-left">
  <?php 
  // Fetch ads from the 'left_page_skin_ads' repeater field on the Options Page
  if (have_rows('left_page_skin_ads', 'option')) : ?>
    <p class="advert_label">Advertisement</p>
    
    <?php while (have_rows('left_page_skin_ads', 'option')) : the_row(); 
      
      // Get subfields from the repeater
      $left_page_skin = get_sub_field('left_page_skin'); 
      $left_page_skin_url = get_sub_field('left_page_skin_url'); 
      
      // Debugging output
      if (!$left_page_skin) {
        echo '<!-- No image found in left_page_skin subfield -->';
      }
      if (!$left_page_skin_url) {
        echo '<!-- No URL found in left_page_skin_url subfield -->';
      }
      
      // Check if both image and URL are available before displaying
      if ($left_page_skin && $left_page_skin_url) : 
        // Randomly generate a rotation angle between -10 and 10 degrees
        $random_rotation = rand(-10, 10); 
        ?>
        <a href="<?php echo esc_url($left_page_skin_url); ?>" target="_blank">
          <img src="<?php echo esc_url($left_page_skin); ?>" alt="Left Page Skin Ad" style="transform: rotate(<?php echo $random_rotation; ?>deg);">
        </a>
      <?php else: ?>
        <!-- Debugging: Missing data -->
        <p>Ad data is incomplete. Please check ACF fields on the Options Page.</p>
      <?php endif; ?>
      
    <?php endwhile; ?>
    
  <?php else : ?>
    <!-- No ads found in the repeater field on Options Page -->
    <p>No ads found in the ACF repeater field on the Options Page. Please add ads in the ACF settings.</p>
  <?php endif; ?>
</div>
