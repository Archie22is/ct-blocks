<?php
$container_class = codetot_site_container();
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
  'title' => $title,
  'description' => $sub_title
), 'category-grid');

$_columns = array_map(function($product_category) {
  return get_block('category-grid-item', array(
    'category' => $product_category
  ));
}, $product_categories);

$content = codetot_build_grid_columns($_columns, 'category-grid');

$_class = 'category-grid bg-white section-bg';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($style) ? ' category-grid--' . esc_attr($style) : ' category-grid--1';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : ' has-5-columns';


if (!empty($product_categories) && !is_wp_error($product_categories)) :

  the_block('default-section', array(
    'class' => $_class,
    'header' => $header,
    'content' => $content
  ));

endif; ?>
