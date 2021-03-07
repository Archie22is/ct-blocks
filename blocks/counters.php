<?php
/**
 * Block: Counters
 *
 * Available settings:
 * - class
 * - anchor_name
 * - layout
 * - layout_items
 * - columns
 * - header_alignment
 * - content_alignment
 * - background_type
 */
$_class = 'counters';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : ' is-header-left';

// Background Type
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$_card_class = !empty($layout_items) ? ' counters__col--layout-'. $layout_items : ' counters__col--layout-column';
$_card_class .= !empty($content_alignment) ? ' counters__col--alignment-' . $content_alignment : ' counters__col--alignment-left';

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'alignment' => $header_alignment,
  'title' => $title,
  'description' => $description
), 'counters');

// Main Content
$columns = !empty($counters) ? array_map(function($item) {
  return get_block('counters-item', array(
    'item' => $item
  ));
}, $counters) : [];

$content = codetot_build_grid_columns($columns, 'counters', array(
  'column_class' => $layout === 'column' ? 'default-section__col ' . $_card_class : 'sidebar-section__col ' . $_card_class
));

if (!empty($counters)) :
  if ($layout === 'column') {
    the_block('default-section', array(
      'id' => !empty($id) ? esc_attr($id) : '',
      'attributes' => ' data-ct-block="counters" data-aos="fade-up"',
      'class' => $_class,
      'header' => (!empty($title) || !empty($descriptiom)) ? $header : false,
      'content' => $content
    ));
  } else {
    the_block('sidebar-section', array(
      'id' => !empty($id) ? esc_attr($id) : '',
      'attributes' => ' data-ct-block="counters" data-aos="fade-up"',
      'class' => $_class,
      'sidebar' => (!empty($title) || !empty($descriptiom)) ? $header : false,
      'content' => $content
    ));
  }
endif;
