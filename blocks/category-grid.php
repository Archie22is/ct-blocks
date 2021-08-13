<?php

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
  'title' => !empty($title) ? $title : '',
  'description' => !empty($description) ? $description : ''
), 'category-grid');

$_columns = array_map(function($product_category) {
  return get_block('category-grid-item', array(
    'category' => $product_category
  ));
}, $product_categories);

$content = codetot_build_grid_columns($_columns, 'category-grid', array(
  'column_class' => 'default-section__col'
));

$_class = 'category-grid';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : ' is-light-contract';
$_class .= !empty($columns_count) ? ' has-' . $columns_count . '-columns' : ' has-3-columns';
$_class .= !empty($block_preset) ? ' category-grid--preset-' . esc_attr($block_preset) : ' category-grid--preset-default';
$_class .= !empty($class) ? ' ' . $class : '';

if (!empty($product_categories) && !is_wp_error($product_categories)) :
  the_block('default-section', array(
    'class' => $_class,
    'header' => $header,
    'lazyload' => isset($enable_lazyload) && $enable_lazyload,
    'content' => $content
  ));
endif; ?>
