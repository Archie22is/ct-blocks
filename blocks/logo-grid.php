<?php

/**
 *
 * 'class',
 * 'anchor_name',
 * 'background_type',
 * 'enable_slideshow',
 * 'columns',
 * 'header_alignment',
 */

$container = codetot_site_container();

$_class = 'logo-grid';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($enable_slideshow) ? ' logo-grid--has-slider' : '';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

// $_class .= empty($description) ? ' logo-grid--no-description' : '';
$_slider_options = empty($slider_options) ? array(
  'contain' => true,
  'cellAlign' => 'center',
  'pageDots' => false,
  'prevNextButtons' => true,
  'groupCells' => true,
  'percentagePosition' => true
) : $slider_options;

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'alignment' => $header_alignment,
  'title' => $title,
  'description' => $description
), 'feature-grid');

// Build column content
$columns = !empty($items) ? array_map(function($item) use($enable_slideshow) {
  return get_block('logo-grid-item', array(
    'enable_slider' => $enable_slideshow,
    'item' => $item
  ));
}, $items) : [];

// Build slider content
ob_start(); ?>
<div class="logo-grid__slider js-slider" data-carousel='<?php echo json_encode($_slider_options); ?>'>
  <?php echo $columns; ?>
</div>
<?php
$slider_html = ob_get_clean();

// Wrap content
$content = !$enable_slideshow ? codetot_build_grid_columns($columns, 'logo-grid', array(
  'column_attributes' => 'data-aos="fade-up"',
  'column_class' => $layout === 'column' ? 'default-section__col' : 'sidebar-section__col'
)) : $slider_html;

the_block('default-section', array(
  'id' => !empty($id) ? $id : '',
  'attributes' => ' data-ct-block="logo-grid"',
  'class' => $_class,
  'header' => $header,
  'content' => $content
));
