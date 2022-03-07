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
 * - enable_running_count
 */
$_class = 'counters';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : ' is-header-left';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : '';

// Card class
$_card_class = !empty($layout_items) ? ' is-layout-'. esc_attr($layout_items) : ' is-layout-column';
$_card_class .= !empty($content_alignment) ? ' is-content-alignment-'.  esc_attr($content_alignment) : '';

// Enable running count
$_enable_running_count = $enable_running_count ?? true;

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'alignment' => $header_alignment ?? 'left',
  'title' => $title ?? '',
  'description' => $description ?? ''
), 'counters');

$columns = !empty($counters) ? array_map(function($item) use ($_card_class, $_enable_running_count) {
  return get_block('counters-item', array(
    'item' => $item,
    'class' => $_card_class,
		'enable_running_count' => $_enable_running_count
  ));
}, $counters) : [];

$content = codetot_build_grid_columns($columns, 'counters', array(
  'column_class' => 'w100 default-section__col'
));

the_block('default-section', array(
  'id' => $anchor_name ?? '',
  'attributes' => ' data-ct-block="counters"',
  'class' => $_class,
  'background_image' => $background_image ?? '',
  'header' => $header,
  'content' => $content,
  'tag' => empty($title) ? 'div' : 'section'
));
