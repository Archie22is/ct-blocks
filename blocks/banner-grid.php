<?php
/**
 * Block: Banner Grid
 *
 * Available settings:
 * - class
 * - block_preset
 * - layout
 * - columns
 * - items
 * ---- overlay
 * ---- content_position
 * ---- background_contract
 * ---- background_type
 * ---- label
 * ---- title
 * ---- description
 * ---- buttons
 * ---- background_image
 */

$prefix_class = 'banner-grid';

$_class = 'section-bg ' . $prefix_class;
$_class .= !empty($block_preset) ? ' ' . $prefix_class . '--style-' . esc_attr($block_preset) : '';
$_class .= !empty($overlay) ? ' ' . $prefix_class . '--has-overlay' : '';
$_class .= !empty($background_contract) ? ' ' . $prefix_class . '--' . esc_attr($background_contract) : '';
$_class .= !empty($background_type) ? ' bg-' . esc_attr($background_type) : '';
$_class .= !empty($content_position) ? ' ' . $prefix_class . '--' . esc_attr($content_position) : '';
$_class .= !empty($columns_count) ? ' ' . $prefix_class . '--' . esc_attr($columns_count) . '-columns': '';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';


$columns = !empty($items) ? array_map(function($item) {

  return get_block('bottom-cta', array(
    'class' => 'banner-grid__col-inner',
    'overlay' => $item['overlay'],
    'content_position' => $item['content_position'],
    'content_alignment' => $item['content_alignment'],
    'background_contract' => $item['background_contract'],
    'background_type' => $item['background_type'],
    'label' => $item['label'],
    'title' => $item['title'],
    'description' => $item['description'],
    'buttons' => ($item['disable_button'])? $item['buttons'] : false,
    'item_url' => (!($item['disable_button']))? $item['item_url'] : false,
    'background_image' => $item['background_image']
  ));
}, $items) : [];

$content = codetot_build_grid_columns($columns, $prefix_class, array(
  'column_attributes' => 'data-aos="fade-up"',
  'column_class' => 'default-section__col'
));

if (!empty($items)) :
  if ($layout === 'column') {
    the_block('default-section', array(
      'class' => $_class,
      'header' => (!empty($title) || !empty($descriptiom)) ? $header : false,
      'content' => $content
    ));
  }
endif;
