<?php
$container = codetot_site_container();

$_class = 'feature-grid';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($background_contract) ? ' feature-grid--' . $background_contract : '';

$_card_class = 'feature-card';
$_card_class .= !empty($image_size) ? ' feature-card--image-' . esc_attr($image_size) : '';
$_card_class .= !empty($content_alignment) ? ' feature-card--' . $content_alignment : '';
$_card_class .= !empty($box_content) ? ' feature-card--boxed' : '';

$_button_style = !empty($button_style) ? esc_attr($button_style) : 'primary';

if (!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'title' => $title,
    'description' => $description
  ), 'feature-grid');
}

// Main Content
$columns = !empty($items) ? array_map(function($item) use ($_card_class, $_button_style) {
  return get_block('feature-card', array(
    'class' => $_card_class,
    'image_class' => !empty($image_size) ? 'image--' . $image_size : 'image--cover',
    'image_content' => $item['icon_image']['ID'],
    'title' => $item['title'],
    'description' => $item['description'],
    'button_text' => $item['button_text'],
    'button_url' => $item['button_url'],
    'button_style' => $_button_style
  ));
}, $items) : [];

$content = codetot_build_grid_columns($columns, 'feature-grid', array(
  'column_attributes' => 'data-aos="fade-up"',
  'column_class' => $layout === 'column' ? 'default-section__col' : 'sidebar-section__col'
));

if (!empty($items)) :
  if ($layout === 'column') {
    the_block('default-section', array(
      'class' => $_class,
      'header' => $header,
      'content' => $content
    ));
  } else {
    the_block('sidebar-section', array(
      'class' => $_class,
      'sidebar' => $header,
      'content' => $content
    ));
  }
endif;
?>

