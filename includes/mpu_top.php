<?php
$allowed_html = array(
    'script' => array(
        'type'   => array(),
        'id'     => array(),
        'name'   => array(),
        'value'  => array(),
    ),
    'div' => array(
        'id'    => array(),
        'class' => array(),
    ),
);
?>

<div class="mpu_top">
    <?php if (get_field('mpu_top', 'option')): ?>
        <?php echo wp_kses(get_field('mpu_top', 'option'), $allowed_html); ?>
    <?php endif; ?>
</div>
