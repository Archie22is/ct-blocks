<?php
$container = codetot_site_container();
$is_full_screen = !empty($enable_full_screen_layout) ? ' image-row--full-screen' : '';

$_class = 'image-row';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($block_preset) ? ' image-row--' . esc_attr($block_preset) : '';
$_class .= !empty($space_between) ? ' image-row--space-between' : '';
$_class .= !empty($image_zoom) ? ' image-row--image-zoom' : '';
$_class .= !empty($header_alignment) ? ' is-header-' .  $header_alignment : '';
$_class .= !empty($enable_full_screen_layout) ? ' default-section--no-container' : '';

$_attr = ' data-ct-block="image-row"';

if (!empty($title)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'title' => $title,
  ), 'image-row');
}

// Main Content
$_columns = !empty($columns) ? array_map(function ($item) {
  return array(
    'content' => get_block('image-banner', array(
      'image' => $item['image'],
      'url' => $item['url']
    )),
    'class' => 'image-row__col--' . $item['column_width']
  );
}, $columns) : [];

$content = codetot_build_grid_columns($_columns, 'image-row', array(
  'column_class' => 'default-section__col image-row__col'
));

the_block('default-section', array(
  'attributes' => $_attr,
  'class' => $_class,
  'header' => (!empty($title) || !empty($description)) ? $header : false,
  'content' => $content
));
