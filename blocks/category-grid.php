<?php

$_image_size = $image_size ?? 'default';
$_enable_slider = $enable_slider ?? false;

$_class = 'category-grid';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_contract) ? ' is-' . esc_html($background_contract) . '-contract' : ' is-light-contract';
$_class .= !empty($columns_count) ? ' has-' . (int) esc_html($columns_count) . '-columns' : ' has-3-columns';
$_class .= !empty($block_preset) ? ' category-grid--preset-' . esc_html($block_preset) : ' category-grid--preset-default';
$_class .= !empty($content_alignment) ? ' has-' . esc_html($content_alignment). '-content-alignment' : ' has-left-content-aligment';
$_class .= $_enable_slider ? ' has-slider' : '';
$_class .= !empty($class) ? ' ' . $class : '';

$args = array(
  'orderby' => 'menu_order',
  'order' => 'asc',
  'hide_empty' => false,
  'pad_counts' => true,
  'child_of' => 0,
);

if (!empty($select_categories)) {
  $args['include'] = $select_categories;
  $args['orderby'] = 'include';
}

$product_categories = get_terms('product_cat', $args);

$header = codetot_build_content_block(array(
  'alignment' => $header_alignment ?? 'left',
  'title' => $title ?? '',
  'description' => $description ?? ''
), 'category-grid');

if (!empty($product_categories) && !is_wp_error($product_categories)) :
  $columns = array_map(function($product_category) use ($_image_size) {
    return get_block('category-grid-item', array(
      'category' => $product_category,
      'image_size' => $_image_size
    ));
  }, $product_categories);

  $column_html = codetot_build_grid_columns($columns, 'category-grid', array(
    'column_class' => 'default-section__col'
  ));

  $slider_settings = array(
    'cellAlign' => 'left',
    'prevNextButtons' => true,
    'pageDots' => false,
    'resize' => true
  );

  $slider_html = codetot_build_slider($columns, 'category-grid', array(
    'slider_settings' => $slider_settings
  ));

  $content = $_enable_slider ? $slider_html : $column_html;

  the_block('default-section', array(
    'attributes' => $_enable_slider ? ' data-ct-block="category-grid"' : '',
    'class' => $_class,
    'header' => $header,
    'lazyload' => isset($enable_lazyload) && $enable_lazyload,
    'content' => $content
  ));
endif;
