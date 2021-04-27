<?php
/**
 * Block: Accordions
 *
 * Available settings:
 * - class
 * - anchor_name
 * - layout
 * - fullscreen
 * - block_presets
 * - background_type
 * - header_alignment
 */
$container = codetot_site_container();

$_class = 'accordions has-1-column';
$_class .= !empty($block_preset) ? ' accordions--style-' . esc_attr($block_preset) : '';
$_class .= !empty($is_fullwidth) ? ' accordions--no-container' : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($block_preset) ? ' accordions--preset-' . esc_attr($block_preset) : '';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'alignment' => $header_alignment,
  'title' => $title,
  'description' => $description
), 'accordions');

$columns = !empty($items) ? array_map(function($item) {
  return get_block('accordions-item', array(
    'item' => $item
  ));
}, $items) : [];

$content = codetot_build_grid_columns($columns, 'accordions', array(
  'column_class' => $layout === 'column' ? 'w100 default-section__col js-row' : 'w100 sidebar-section__col js-row'
));

if (!empty($items)) :
  if ($layout === 'column') {
    the_block('default-section', array(
      'id' => !empty($id) ? $id : '',
      'attributes' => ' data-ct-block="accordions"',
      'class' => $_class,
      'header' => (!empty($title) || !empty($description)) ? $header : false,
      'content' => $content
    ));
  } else {
    the_block('sidebar-section', array(
      'id' => !empty($id) ? $id : '',
      'attributes' => ' data-ct-block="accordions"',
      'class' => $_class,
      'sidebar' => (!empty($title) || !empty($description)) ? $header : false,
      'content' => $content
    ));
  }
endif;
