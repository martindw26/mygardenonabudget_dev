<div style="display: flex; justify-content: center;">
    <?php
    // Block Template for Custom Block
    $multi_buy_now_widget_title = get_field('multi_buy_now_widget_title');
    $multi_buy_now_widget_button_url = get_field('multi_buy_now_widget_buy_now_url');
    $multi_buy_now_widget_button_url_button_target = get_field('multi_buy_now_widget_button_url_button_target');
    $multi_buy_now_widget_image = get_field('multi_buy_now_widget_image');
    $multi_buy_now_widget_button_background_color = get_field('multi_buy_now_widget_button_background_color');
    $multi_buy_now_widget_button_hover_color = get_field('multi_buy_now_widget_button_hover_color');
    $multi_buy_now_widget_text_color = get_field('multi_buy_now_widget_text_color');
    $multi_buy_now_widget_button_text = get_field('multi_buy_now_widget_button_text');
    $multi_buy_now_widget_button_price = get_field('multi_buy_now_widget_button_price');
    $multi_buy_now_widget_border_color = get_field('multi_buy_now_widget_border_color');
    $multi_buy_now_widget_border_type = get_field('multi_buy_now_widget_border_type');
    $multi_buy_now_widget_border_size = get_field('multi_buy_now_widget_border_size');
    // Items
    $multi_buy_now_widget_items = get_field('multi_buy_now_widget_items');

    // Extract prices and their corresponding items
    $prices = array();
    foreach ($multi_buy_now_widget_items as $key => $item) {
        $prices[$key] = floatval(preg_replace('/[^0-9.]/', '', $item['multi_buy_now_widget_button_price']));
    }

    // Sort prices while preserving the keys
    asort($prices);

    $sorted_items = array();
    foreach ($prices as $key => $price) {
        $sorted_items[] = $multi_buy_now_widget_items[$key];
    }
    ?>

    <div class="multi_buy_now_widget-desktop">
        <div class="multi_buy_now_widget-custom-block-preview-desktop">
            <div class="row pb-2">
                <div class="col">
                <hr>
                <h4><?php echo $multi_buy_now_widget_title; ?></h4>
                </div>
            </div>

            
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <tbody>
                    <?php foreach ($sorted_items as $item) : ?>
                        <tr>
                            <td class="text-start"><?php echo $item['multi_buy_now_widget_item']; ?></td>
                            <td class="text-start"><?php echo $item['multi_buy_now_widget_item_seller']; ?></td>
                            <td class="text-center button">
                            <a href="<?php echo esc_url($item['multi_buy_now_widget_button_url']); ?>"  target="<?php echo $multi_buy_now_widget_button_url_button_target; ?>" 
                                class="btn btn-primary"  aria-label="<?php echo esc_attr($multi_buy_now_widget_button_text . ' for ' . $item['multi_buy_now_widget_button_price']); ?>">
                                <?php echo $multi_buy_now_widget_button_text . ' | ' . $item['multi_buy_now_widget_button_price']; ?>
</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



    </div>

    <div class="multi_buy_now_widget-mobile">
        <div class="multi_buy_now_widget-custom-block-preview-mobile">
            <div class="row pb-2">
                <div class="col">
                    <hr>
                    <h4><?php echo $multi_buy_now_widget_title; ?></h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 d-flex flex-column justify-content-between text-start">
                    <ul class="list-group flex-fill">
                        <?php foreach ($sorted_items as $item) : ?>
                            <?php $button_price = get_field('multi_buy_now_widget_button_price');?>
                            <li class="widget-list-item">
                                <div class="container">
                                <a href="<?php echo esc_url($item['multi_buy_now_widget_button_url']); ?>" target="<?php echo $multi_buy_now_widget_button_url_button_target; ?>" class="btn btn-primary mb-2 text-start">
                                        <?php echo $item['multi_buy_now_widget_item_seller']; ?><br>
                                        <?php if ($button_price === 'yes') { ?>
                                            From <?php echo $item['multi_buy_now_widget_button_price']; ?> 
                                        <?php } else { ?>
                                            
                                        <?php } ?>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <hr class="mb-3 mt-2">
            </div>
        </div>
    </div>
</div>








<style>
    img.buy_now_block_comparison{
        object-fit:cover;
        height: 200px;
        width:100%;
        padding:10px;
    }

    button.btn.btn-lg.align-items-end.card-button:hover {
        background-color: <?php echo esc_attr($multi_buy_now_widget_button_hover_color); ?> !important;
    }

    .multi_buy_now_widget-custom-block-preview {
    border: <?php echo esc_attr($multi_buy_now_widget_border_size); ?> <?php echo esc_attr($multi_buy_now_widget_border_type); ?> <?php echo esc_attr($multi_buy_now_widget_border_color); ?>;
  }



li.widget-list-item{
  list-style-type: none;
  align-items: start;
  line-height: 35pt;
  text-align: left;
}

/* Default styles */
.multi_buy_now_widget-desktop {
    display: block;
}
.multi_buy_now_widget-mobile {
    display: none;
}

/* Media query for mobile devices */
@media only screen and (max-width: 767px) {
    .multi_buy_now_widget-desktop {
        display: none;
    }
    .multi_buy_now_widget-mobile {
        display: block;
        width:100%;
    }
}


/* Styles for multi_buy_now_widget */
.multi_buy_now_widget {
    /* Your styles for the widget */
}

/* Styles for custom block */
.multi_buy_now_widget-custom-block-preview {
    width: 800px;
    padding:10px;
   
}

/* Media query for desktop screens */
@media (min-width: 1024px) {
    .multi_buy_now_widget-custom-block-preview {
      min-width: 100%;
    }
}


</style>


