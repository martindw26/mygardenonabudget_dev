<div class="page-skin-left">
  <?php if( have_rows('left_page_skin_ads') ): ?>
    <p class="advert_label">Advertisement</p>
    <?php while( have_rows('left_page_skin_ads') ): the_row(); 
      $left_page_skin = get_sub_field('left_page_skin'); 
      $left_page_skin_url = get_sub_field('left_page_skin_url');
    ?>
      <a href="<?php echo esc_url($left_page_skin_url); ?>" target="_blank">
        <img src="<?php echo esc_url($left_page_skin); ?>" alt="Left Page Skin">
      </a>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
