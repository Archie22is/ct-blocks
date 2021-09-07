<?php
$_class = 'feature-grid';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : ' has-3-columns';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : ' is-header-left';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : ' is-light-contract';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$_card_class = '';
$_card_class .= $card_layout === 'column' ? 'f fw fdc is-column-layout' : 'f fw is-row-layout';
$_card_class .= !empty($content_alignment) ? ' is-content-alignment-' . $content_alignment : '';
$_card_class .= !empty($enable_card_border) ? ' has-border' : '';

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'alignment' => $header_alignment ?? 'left',
  'label' => $label ?? '',
  'title' => $title ?? '',
  'description' => $description ?? ''
), 'feature-grid');

// Main Content
$columns = !empty($items) ? array_map(function($item) use ($_card_class, $media_size) {
  $item['class'] = $_card_class;
  $item['media_size'] = $media_size;
  $item['image'] = $item['icon_image'];
  $item['svg_icon'] = $item['icon_svg'];

  return get_block('feature-card', $item);
}, $items) : [];

$content = codetot_build_grid_columns($columns, 'feature-grid', array(
  'column_class' => 'default-section__col'
));

the_block('default-section', array(
  'class' => $_class,
  'id' => $anchor_name ?? '',
  'background_image' => $background_image ?? '',
  'header' => $header,
  'content' => $content
));

