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

$_class = $prefix_class;
$_class .= !empty($block_preset) ? ' ' . $prefix_class . '--style-' . esc_attr($block_preset) : '';
$_class .= !empty($overlay) ? ' ' . $prefix_class . '--has-overlay' : '';
$_class .= !empty($background_contract) ? ' ' . $prefix_class . '--' . esc_attr($background_contract) : '';
$_class .= !empty($background_type) ? ' bg-' . esc_attr($background_type) : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($content_position) ? ' ' . $prefix_class . '--' . esc_attr($content_position) : '';
$_class .= !empty($columns_count) ? ' ' . $prefix_class . '--' . esc_attr($columns_count) . '-columns' : '';
$_class .= !empty($full_screen_layout) ? ' ' . $prefix_class . '--full-screen' : '';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$_silder_class = '';
$_silder_class .= !empty($previous_next_style) ? ' ' . $prefix_class . '--button-' . esc_attr($previous_next_style) : ' ' . $prefix_class . '-button-circle';
$_silder_class .= !empty($previous_next_alignment) ? ' ' . $prefix_class . '--button-' . esc_attr($previous_next_alignment) : ' ' . $prefix_class . '--button-middle';
$_silder_class .= !empty($page_dots_style) ? ' ' . $prefix_class . '--dots-' . esc_attr($page_dots_style) : ' ' . $prefix_class . '--dots-circle';
$_silder_class .= !empty($page_dots_alignment) ? ' ' . $prefix_class . '--dots-' . esc_attr($page_dots_alignment) : ' ' . $prefix_class . '--dots-circle';
$_silder_class .= !empty($overlay) ? ' ' . $prefix_class . '--overlay' : '';


$columns = !empty($items) ? array_map(function ($item) {
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
    'buttons' => ($item['disable_button']) ? $item['buttons'] : false,
    'item_url' => (!($item['disable_button'])) ? $item['item_url'] : false,
    'background_image' => $item['background_image']
  ));
}, $items) : [];

if ($layout === 'slider') :
  $slider_settings = array(
    'contain' => true,
    'draggable' => true,
    'pauseAutoPlayOnHover' => true,
    'pageDots' => !empty($enable_page_dots),
    'prevNextButtons' => !empty($enable_prev_next_buttons),
    'cellAlign' => !empty($cell_alignment) ? $cell_alignment : 'center',
    'autoPlay' => !empty($enable_autoplay) ? (!empty($speed) ? ($speed * 1000) : 5000) : false,
  );

  $content = codetot_build_slider($columns, $prefix_class, array(
    'slider_class' => $_silder_class,
    'slider_settings' => $slider_settings,
  ));
else :
  $content = codetot_build_grid_columns($columns, $prefix_class, array(
    'column_class' => 'default-section__col'
  ));
endif;

if (!empty($items)) :
  the_block('default-section', array(
    'class' => $_class,
    'lazyload' => false,
    'attributes' => (($layout === 'slider') ? ' data-ct-block="banner-grid"' : '') . ' data-reveal="fade-up"',
    'header' => (!empty($title) || !empty($description)) ? $header : false,
    'content' => $content
  ));
endif;
