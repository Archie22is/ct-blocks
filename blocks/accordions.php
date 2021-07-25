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
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($block_preset) ? ' accordions--preset-' . esc_attr($block_preset) : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$_enable_schema = isset($enable_schema) && $enable_schema || (!isset($enable_schema));

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'alignment' => !empty($header_alignment) ? $header_alignment : 'left',
  'title' => !empty($title) ? $title : '',
  'description' => !empty($description) ? $description : ''
), 'accordions');

$columns = !empty($items) ? array_map(function($item) use ($_enable_schema) {
  return get_block('accordions-item', array(
    'item' => $item,
    'enable_schema' => $_enable_schema
  ));
}, $items) : [];

$content = codetot_build_grid_columns($columns, 'accordions', array(
  'column_class' => 'w100 default-section__col js-row'
));

$_attributes = ' data-ct-block="accordions" data-reveal="fade-up"';
$_attributes .= $_enable_schema ? ' itemscope itemtype="https://schema.org/FAQPage"' : '';

if (!empty($items)) :
  the_block('default-section', array(
    'id' => !empty($anchor_name) ? $anchor_name : '',
    'attributes' => $_attributes,
    'class' => $_class,
    'header' => (!empty($title) || !empty($description)) ? $header : false,
    'content' => $content
  ));
endif;
