<?php
$qb_single_product_button_text = get_field('single_product_button_text');
$qb_button_url = get_field('button_url');
$qb_button_target = get_field('button_target');
$qb_background_color = get_field('background_color');
$qb_border_color = get_field('border_color');
$qb_hover_color = get_field('border_color_hover');
$qb_text_color = get_field('button_text_color');
$qb_border_type = get_field('border_type');
$qb_border_size = get_field('border_size');
$qb_background_hover_color = get_field('background_color_hover');

?>

<div class="quik-buy-now-button-custom-block-preview">
<div class="quik-buy-now-button-custom-block" style="background-color: <?php echo esc_attr($qb_background_color); ?>; color: <?php echo esc_attr($qb_text_color); ?>; border: <?php echo esc_attr($qb_border_size . ' ' . $qb_border_type . ' ' . $qb_border_color); ?>;">
        <div class="centered-text">
        <a href="<?php echo esc_url($qb_button_url); ?>" target="<?php echo esc_attr($qb_button_target); ?>" aria-label="<?php echo esc_attr($qb_single_product_button_text); ?>">
            <?php echo esc_html($qb_single_product_button_text); ?>
        </a>
        </div>
    </div>
</div>


<script type="text/javascript">
    (function($) {
        // Function to update block preview
        function updatePreview() {
            var qb_single_product_button_text = $('[data-name="qb_single_product_button_text"] input').val();
            var qb_button_url = $('[data-name="qb_button_url"] input').val();
            var qb_button_target = $('[data-name="qb_button_target"] select').val();
            var qb_background_color = $('[data-name="qb_background_color"] input').val();
            var qb_background_hover_color = $('[data-name="qb_background_hover_color"] input').val();
            var qb_border_color = $('[data-name="qb_border_color"] input').val();
            var qb_text_color = $('[data-name="qb_text_color"] input').val();
            var qb_border_type = $('[data-name="qb_border_type"] input').val();
            var qb_border_size = $('[data-name="qb_border_size"] input').val();

            var $previewBlock = $('.quik-buy-now-button-custom-block-preview');
            var $customBlock = $previewBlock.find('.quik-buy-now-button-custom-block');

            $customBlock.css({
                'background-color': qb_background_color,
                'color': qb_text_color, 
                'border': qb_border_size + ' ' + qb_border_type + ' ' + qb_border_color
            });

            // Change background color on hover
            $customBlock.hover(
                function() {
                    $(this).css('background-color', qb_background_hover_color);
                },
                function() {
                    $(this).css('background-color', qb_background_color);
                }
            );

            $customBlock.find('.centered-text a')
                .text(qb_single_product_button_text)
                .attr('href', qb_button_url)
                .attr('target', qb_button_target);
        }

        // Call updatePreview() on field change
        $(document).on('change', '[data-type="acf-block"] [data-name]', function() {
            updatePreview();
        });

        // Initial call to updatePreview()
        updatePreview();
    })(jQuery);
</script>

<style type="text/css">

.quik-buy-now-button-custom-block:hover {
        background-color: <?php echo esc_attr($qb_background_hover_color); ?> !important;
    }

    .quik-buy-now-button-custom-block-preview {
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center; 
    }

    .quik-buy-now-button-custom-block-preview .quik-buy-now-button-custom-block {
        cursor: pointer;
        width: 100%;
        min-width: 75px;
        max-width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 20px;
        border-radius: 5px;
        display: inline-block;
    }

    .quik-buy-now-button-custom-block-preview .centered-text {
        text-align: center;
    }

    .quik-buy-now-button-custom-block-preview .centered-text a {
        text-decoration: none;
        color: inherit;
    }

</style>
