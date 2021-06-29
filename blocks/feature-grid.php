<?php
$container = codetot_site_container();

$_class = 'feature-grid';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : ' is-header-left';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : '';

$_card_class = '';
$_card_class .= !empty($content_alignment) ? ' is-content-alignment-' . $content_alignment : '';
$_card_class .= !empty($enable_card_border) ? ' has-border' : '';

if (!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'label' => $label,
    'title' => $title,
    'description' => $description
  ), 'feature-grid');
}

// Main Content
$columns = !empty($items) ? array_map(function($item) use ($_card_class, $media_size) {
  $item['class'] = $_card_class;
  $item['media_size'] = $media_size;
  $item['image'] = $item['icon_image'];
  $item['svg_icon'] = $item['icon_svg'];

  return get_block('feature-card', $item);
}, $items) : [];

if ($enable_slider) {
  $slider_settings = array(
    'contain' => true,
    'draggable' => true,
    'pauseAutoPlayOnHover' => true,
    'pageDots' => false
  );

  $content = codetot_build_slider($columns, 'feature-grid', array(
    'slider_settings' => $slider_settings,
  ));
} else {
  $content = codetot_build_grid_columns($columns, 'feature-grid', array(
    'column_class' => 'default-section__col'
  ));
}

if (!empty($items)) :
  the_block('default-section', array(
    'attributes' => $enable_slider ? ' data-ct-block="feature-grid"' : '',
    'class' => $_class,
    'header' => (!empty($title) || !empty($description)) ? $header : false,
    'content' => $content
  ));
endif;
?>

