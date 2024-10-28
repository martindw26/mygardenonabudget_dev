<?php
$yt_id = get_field('yt_id');
?>

<div class="youtube-custom-block-preview">
  <div class="youtube-custom-block">
      <div class="yt_embed_block">
          <!-- Responsive YouTube Embed -->
          <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000;">
              <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($yt_id); ?>?rel=0" 
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
            
            // Removed dynamic style application
        }

        // Call updatePreview() on load to apply the PHP values initially
        $(document).ready(function() {
            updatePreview();
        });
    })(jQuery);
</script>
