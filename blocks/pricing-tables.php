<?php
$container = 'container';
$prefix_class = 'pricing-tables';

$_class = 'rel ' . $prefix_class;
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($background_image) ? ' section-bg' : ' section';
$_class .= !empty($background_contract) ? ' '. $prefix_class .'--' . esc_attr($background_contract) : '';
$_class .= !empty($block_preset) ? ' '. $prefix_class .'--' . esc_attr($block_preset) : ' '. $prefix_class .'--preset-1';
$_class .= !empty($number_columns) ? ' has-' . esc_attr($number_columns) .'-columns' : ' has-3-columns';

if (!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'title' => $title,
    'description' => $description
  ), $prefix_class);
}

// Main Content
$columns = !empty($items) ? array_map(function($item) use ($item_style, $content_alignment, $highlight_text) {
  $item_class = '';
  $item_class .= !empty($item['is_highlight']) ? ' pricing-box--highlight' : '';
  $item_class .= !empty($item_style) ? ' pricing-box--' . esc_attr($item_style) : ' pricing-box--style-1';
  $item_class .= !empty($content_alignment) ? ' is-alignment-' . esc_attr($content_alignment) : ' is-alignment-left';
  $item['highlight_text'] = !empty($highlight_text) ? $highlight_text : '';

  $item['class'] = $item_class;

  return get_block('pricing-box', $item);
}, $items) : [];

$content = codetot_build_grid_columns($columns, $prefix_class, array(
  'column_class' => 'default-section__col'
));

if (!empty($items)) :
  the_block('default-section', array(
    'class' => $_class,
    'header' => (!empty($title) || !empty($description)) ? $header : false,
    'content' => $content
  ));
endif;
