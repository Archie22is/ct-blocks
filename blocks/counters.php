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
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : ' is-header-left';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : '';

// Card class
$_card_class = !empty($layout_items) ? ' is-layout-'. esc_attr($layout_items) : ' is-layout-column';
$_card_class .= !empty($content_alignment) ? ' is-content-alignment-'.  esc_attr($content_alignment) : '';

if(!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'title' => $title,
    'description' => $description
  ), 'counters');
}

// Main Content
$columns = !empty($counters) ? array_map(function($item) {
  return get_block('counters-item', array(
    'item' => $item
  ));
}, $counters) : [];

if (!empty($counters)) :
  the_block('default-section', array(
    'id' => !empty($anchor_name) ? esc_attr($anchor_name) : '',
    'attributes' => ' data-ct-block="counters"',
    'class' => $_class,
    'header' => (!empty($title) || !empty($description)) ? $header : false,
    'content' => $content
  ));
endif;
