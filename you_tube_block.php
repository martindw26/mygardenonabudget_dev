<?php
$yt_id = get_field('yt_id');
$yt_background_colour = get_field('youtube_background_colour');
$yt_border_size = get_field('youtube_border_size');
$yt_border_type = get_field('youtube_border_type');
$yt_border_color = get_field('youtube_border_color');
?>

<div class="youtube-custom-block-preview" 
     data-bg-color="<?php echo esc_attr($yt_background_colour); ?>" 
     data-border-size="<?php echo esc_attr($yt_border_size); ?>" 
     data-border-type="<?php echo esc_attr($yt_border_type); ?>" 
     data-border-color="<?php echo esc_attr($yt_border_color); ?>">
  
  <div class="youtube-custom-block" 
       style="background-color: <?php echo esc_attr($yt_background_colour); ?>; 
              border: <?php echo esc_attr($yt_border_size . ' ' . $yt_border_type . ' ' . $yt_border_color); ?>;">
      
      <div class="yt_embed_block">
          <!-- Responsive YouTube Embed -->
          <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000;">
              <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($yt_id); ?>" 
                      style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
                      frameborder="0" 
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                      allowfullscreen>
              </iframe>
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
    (function($) {
        // Function to update block preview based on PHP variables set as data attributes
        function updatePreview() {
            var $previewBlock = $('.youtube-custom-block-preview');
            var $customBlock = $previewBlock.find('.youtube-custom-block');
            
            // Retrieve PHP values from data attributes
            var ytBackgroundColor = $previewBlock.data('bg-color');
            var ytBorderSize = $previewBlock.data('border-size');
            var ytBorderType = $previewBlock.data('border-type');
            var ytBorderColor = $previewBlock.data('border-color');
            
            // Apply styles dynamically using the retrieved PHP values
            $customBlock.css({
                'background-color': ytBackgroundColor,
                'border': ytBorderSize + ' ' + ytBorderType + ' ' + ytBorderColor
            });
        }

        // Call updatePreview() on load to apply the PHP values initially
        $(document).ready(function() {
            updatePreview();
        });
    })(jQuery);
</script>
