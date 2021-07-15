<?php

$_class = 'testimonials';
$_class .= !empty($overlay) ? ' has-overlay' : '';
$_class .= !empty($columns_layout) ? ' has-'. $columns_layout .'-columns' : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_image) ? ' rel has-background-image' : '';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : '';
$_class .= !empty($block_preset) ? ' testimonials--preset-' . esc_attr($block_preset) : ' testimonials--preset-default';
$_class .= !empty($header_alignment) ? ' is-header-' .  $header_alignment : '';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($enable_slider) ? ' testimonials--slider' : '';

$header = codetot_build_content_block(array(
  'label' => !empty($label) ? $label : '',
  'title' => !empty($title) ? $title : '',
  'description' => !empty($description) ? $description : ''
), 'testimonials');

$carousel_settings = array(
  'prevNextButtons' => true,
  'pageDots' => true,
  'cellAlign' => 'center',
  'groupCells' => true,
  'wrapAround' => true
);


// Build background image and overlay
ob_start();
if (!empty($background_image)) {
  the_block('image', array(
    'class' => 'image--cover testimonials__background',
    'image' => $background_image
  ));
}
if (!empty($overlay)) { ?>
  <div class="testimonials__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
<?php }
$background = ob_get_clean();

if(!empty($enable_slider) == 1 ) {
  ob_start();
  if(!empty($columns)) : ?>
    <div class="testimonials__slider js-slider" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>' <?php endif; ?>>
      <?php foreach($columns as $column ) : ?>
        <div class="testimonials__item">
          <?php the_block('testimonial-card', array(
            'column' => $column
          ));?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php
  endif;
  $content = ob_get_clean();
} else {
  $_columns = !empty($columns) ? array_map(function($column) {
    return get_block('testimonial-card', array(
      'column' => $column
    ));
  }, $columns) : [];

  $content = codetot_build_grid_columns($_columns, 'testimonials', array(
    'column_class' => 'default-section__col'
  ));
}

if (!empty($columns)) :
  the_block('default-section', array(
    'before_header' => $background,
    'class' => $_class,
    'id' => !empty($anchor_name) ? $anchor_name : '',
    'header' => $header,
    'content' => $content,
    'lazy' => true,
     'attributes' => 'data-ct-block="testimonials"'
  ));
endif;
