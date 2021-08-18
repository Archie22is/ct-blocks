<?php

$_class = 'logo-grid';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : ' has-4-columns';
$_class .= !empty($header_alignment) ? ' is-header-' .  $header_alignment : 'is-header-left';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($enable_slideshow) ? ' logo-grid--has-slider' : ' logo-grid--no-slider';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

// $_class .= empty($description) ? ' logo-grid--no-description' : '';
$_slider_options = empty($slider_options) ? array(
  'contain' => true,
  'pageDots' => false,
  'autoPlay' => 5000,
  'item' => $columns
) : $slider_options;

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'alignment' => $header_alignment ?? 'left',
  'title' => $title ?? '',
  'description' => $description ?? ''
), 'logo-grid');

// Build column content
$columns = !empty($items) ? array_map(function($item) use($enable_slideshow, $header_alignment) {
  return get_block('logo-grid-item', array(
    'class' => 'logo-grid__item--' . $header_alignment,
    'enable_slider' => $enable_slideshow,
    'item' => $item
  ));
}, $items) : [];

$column_content = codetot_build_grid_columns($columns, 'logo-grid');

// Build slider content
ob_start(); ?>
<div class="logo-grid__slider js-slider" data-carousel='<?php echo json_encode($_slider_options); ?>'>
  <?php echo implode('' . PHP_EOL, $columns); ?>
</div>
<?php
$slider_html = ob_get_clean();

// Wrap content
$content = !$enable_slideshow ? $column_content : $slider_html;

the_block('default-section', array(
  'id' => $anchor_name ?? '',
  'attributes' => ' data-ct-block="logo-grid"',
  'background_image' => $background_image ?? '',
  'class' => $_class,
  'header' => $header,
  'content' => $content,
));
