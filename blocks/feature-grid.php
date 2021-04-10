<?php
$container = codetot_site_container();

$_class = 'feature-grid';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : '';
$_class .= !empty($enable_slider) ? ' enable-slider' : '';
$_class .= !empty($content_alignment) ? ' is-content-alignment-'.  $content_alignment : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : '';

$_card_class = 'feature-card';
$_card_class .= !empty($image_size) ? ' feature-card--image-' . esc_attr($image_size) : '';
$_card_class .= !empty($content_alignment) ? ' feature-card--' . $content_alignment : '';
$_card_class .= !empty($box_content) ? ' feature-card--boxed' : '';

if (!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $content_alignment,
    'title' => $title,
    'description' => $description
  ), 'feature-grid');
}

// Main Content
$columns = !empty($items) ? array_map(function($item) use ($_card_class, $image_size) {
  return get_block('feature-card', array(
    'class' => $_card_class,
    'image_class' => !empty($image_size) ? 'image--' . $image_size : 'image--default',
    'icon_type' => $item['icon_type'],
    'image_content' => ($item['icon_type'] === 'svg') ? $item['icon_svg'] : $item['icon_image']['ID'],
    'title' => $item['title'],
    'description' => $item['description'],
    'button_text' => $item['button_text'],
    'button_url' => $item['button_url'],
    'button_style' => $item['button_style'] ?? 'primary'
  ));
}, $items) : [];

$content = codetot_build_grid_columns($columns, 'feature-grid', array(
  'column_attributes' => 'data-aos="fade-up"',
  'column_class' => 'default-section__col'
));

if (!empty($items)) :
  the_block('default-section', array(
    'class' => $_class,
    'header' => (!empty($title) || !empty($description)) ? $header : false,
    'content' => $content
  ));
endif;
?>

