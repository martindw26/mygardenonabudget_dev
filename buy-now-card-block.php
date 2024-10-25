<div style="display: flex; justify-content: center;">
    <?php
    // Block Template for Custom Block
    $buy_now_card_title = get_field('buy_now_card_title');
    $buy_now_card_button_url = get_field('buy_now_card_buy_now_url');
    $card_button_url_button_target = get_field('card_button_url_button_target');
    $buy_now_card_image = get_field('buy_now_card_image');
    $buy_now_card_about = get_field('buy_now_card_about');
    $buy_now_card_button_background_color = get_field('buy_now_card_button_background_color');
    $buy_now_card_button_hover_color = get_field('buy_now_card_button_hover_color');
    $buy_now_card_text_color = get_field('buy_now_card_text_color');
    $buy_now_card_button_text = get_field('buy_now_card_button_text');
    $buy_now_card_button_price = get_field('buy_now_card_button_price');
    $buy_now_card_border_color = get_field('buy_now_card_border_color');
    $buy_now_card_border_type = get_field('buy_now_card_border_type');
    $buy_now_card_border_size = get_field('buy_now_card_border_size');

    ?>

<div class="buy-now-card-dt">
    <div class="buy-now-card-button-custom-block-preview">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $buy_now_card_image;?>" class="img-fluid rounded-start buy-now-card-image" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body buy-now-card_body">
                        <h5 class="card-title"><?php echo $buy_now_card_title;?></h5>
                        <p class="card-text" style="height: 100px;"><strong>About this item</strong>
                            <?php echo $buy_now_card_about;?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center text-end">
                            <div>
                            <a href="<?php echo $buy_now_card_button_url; ?>" target="<?php echo $card_button_url_button_target; ?>">
                                <button type="button" id="card_button" class="btn btn-lg align-items-end card-button card-block" style="background-color: <?php echo esc_attr($buy_now_card_button_background_color); ?>; color: <?php echo esc_attr($buy_now_card_text_color); ?>">
                                    <?php echo $buy_now_card_button_text; ?> | <?php echo $buy_now_card_button_price; ?>
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>


<div class="buy-now-card-mobile">
    <div class="buy-now-card-button-custom-block-preview">
        <div class="card mb-3">
            <div class="row g-0 flex-column flex-md-row">
                <div class="col-12 col-md-4">
                    <img class="buy-now-card-mobile" src="<?php echo $buy_now_card_image;?>" alt="...">
                </div>
                <div class="col-12 col-md-8">
                    <div class="card-body buy-now-card_body">
                        <h5 class="card-title"><?php echo $buy_now_card_title;?></h5>
                        <p class="card-text" style="min-height: 100px;">
                            <strong>About this item</strong>
                            <?php echo $buy_now_card_about;?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="w-100 text-end">
                                <a href="<?php echo $buy_now_card_button_url; ?>" target="<?php echo $card_button_url_button_target; ?>">
                                    <button type="button" id="card_button" class="btn btn-lg card-button w-100 mt-2" 
                                        style="background-color: <?php echo esc_attr($buy_now_card_button_background_color); ?>; 
                                               color: <?php echo esc_attr($buy_now_card_text_color); ?>">
                                        <?php echo $buy_now_card_button_text; ?> | <?php echo $buy_now_card_button_price; ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
 (function($) {
    // Function to update block preview
    function updatePreview() {
        var buy_now_card_title = $('[data-name="buy_now_card_title"] input').val();
        var card_button_url = $('[data-name="buy_now_card_button_url"] input').val();
        var multi_buy_now_widget_button_url_button_target = $('[data-name="multi_buy_now_widget_button_url_button_target"] select').val();
        var buy_now_card_button_background_color = $('[data-name="buy_now_card_button_background_color"] input').val();
        var buy_now_card_image = $('[data-name="buy_now_card_image"] input').val();
        var buy_now_card_about = $('[data-name="buy_now_card_about"] input').val();
        var buy_now_card_button_price = $('[data-name="buy_now_card_button_price"] input').val();
        var buy_now_card_buy_now_url = $('[data-name="buy_now_card_buy_now_url"] input').val();
        var buy_now_card_button_text = $('[data-name="buy_now_card_button_text"] input').val();
        var buy_now_card_button_hover_color = $('[data-name="buy_now_card_button_hover_color"] input').val();
        var buy_now_card_border_color = $('[data-name="buy_now_card_border_color"] input').val();
        var buy_now_card_border_type = $('[data-name="buy_now_card_border_type"] input').val();
        var buy_now_card_border_size = $('[data-name="buy_now_card_border_size"] input').val();


        var $previewBlock = $('.buy-now-card-button-custom-block-preview');
        var $customBlock = $previewBlock.find('.card');

        $customBlock.find('.buy_now_card_title').text(buy_now_card_title);
        $customBlock.find('.buy_now_card_about').html('<strong>About this item</strong>' + buy_now_card_about);
        $customBlock.find('a').attr('href', buy_now_card_button_url);
        $customBlock.find('a').attr('target', multi_buy_now_widget_button_url_button_target);
        $customBlock.find('button').html(buy_now_card_button_text + ' | ' + buy_now_card_button_price);
        $customBlock.css({
            'background-color': buy_now_card_button_background_color,
            'color': card_button_text_color,
            'border': buy_now_card_border_size + ' ' + buy_now_card_border_type + ' ' + buy_now_card_border_color
        });
    }

    // Call updatePreview() on field change
    $(document).on('change', '[data-type="acf-block"] [data-name]', function() {
        updatePreview();
    });

    // Initial call to updatePreview()
    updatePreview();
})(jQuery);

</script>


<style>
img.img-fluid.rounded-start.buy-now-card-image {
    height: 100%;
    object-fit: cover;
}

button.btn.btn-lg.align-items-end.card-button.card-block:hover {
        background-color: <?php echo esc_attr($buy_now_card_button_hover_color); ?> !important;
    }

.buy-now-card-button-custom-block-preview .card {
    border: <?php echo esc_attr($buy_now_card_border_size); ?> <?php echo esc_attr($buy_now_card_border_type); ?> <?php echo esc_attr($buy_now_card_border_color); ?>;
}


@media screen and (max-width: 480px) {
    .buy-now-card-dt {
        display: none;
    }
}

@media screen and (min-width: 480px) {
    .buy-now-card-mobile {
        display: none;
    }
}

@media screen and (max-width: 480px) {
    .buy-now-card-mobile {
        display: block;
    }
}


img.buy-now-card-mobile{
    width: 100%;
    box-shadow: none !important; /* Removes any shadows */
    border-radius: 0 !important;  /* Removes any rounded corners */
}


</style>
