<?php
$container = codetot_site_container();

$prefix_class = 'pricing-tables';

$_class = 'rel ' . $prefix_class;
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($background_image) ? ' section-bg' : ' section';
$_class .= !empty($background_contract) ? ' '. $prefix_class .'--' . esc_attr($background_contract) : '';
$_class .= !empty($block_preset) ? ' '. $prefix_class .'--' . esc_attr($block_preset) : ''. $prefix_class .'--preset-1';
$_class .= !empty($number_columns) ? ' '. $prefix_class .'--' . esc_attr($number_columns) .'-columns' : '';

$_card_style = !empty($item_style) ? esc_attr($item_style) : 'style-1';
?>
<?php
if (!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'title' => $title,
    'description' => $description
  ), $prefix_class);
}

// Main Content
$columns = !empty($items) ? array_map(function($item) use ($_card_style, $list_icon) {
  return get_block('pricing-box', array(
    'style' => $_card_style,
    'distinctive' =>  $item['distinctive'],
    'title' => $item['title'],
    'pricing' => $item['pricing'],
    'unit' => $item['unit'],
    'items' => $item['listings'],
    'list_icon' => !empty($list_icon) ? $list_icon: false,
    'button_text' => $item['button_text'],
    'button_url' => $item['button_url'],
    'button_style' =>!empty($item['button_style']) ? esc_attr($item['button_style']) : 'primary',
  ));
}, $items) : [];

if ($layout === 'slider') :
  $_silder_class = '';
  $_silder_class .= !empty($previous_next_style) ? ' ' . $prefix_class . '--button-' . esc_attr($previous_next_style) : ' ' . $prefix_class . '-button-circle';
  $_silder_class .= !empty($previous_next_alignment) ? ' ' . $prefix_class . '--button-' . esc_attr($previous_next_alignment) : ' ' . $prefix_class . '--button-middle';
  $_silder_class .= !empty($page_dots_style) ? ' ' . $prefix_class . '--dots-' . esc_attr($page_dots_style) : ' ' . $prefix_class . '--dots-circle';
  $_silder_class .= !empty($page_dots_alignment) ? ' ' . $prefix_class . '--dots-' . esc_attr($page_dots_alignment) : ' ' . $prefix_class . '--dots-circle';
  $_silder_class .= !empty($overlay) ? ' ' . $prefix_class . '--overlay' : '';

  $slider_settings = array(
    'contain' => true,
    'draggable' => true,
    'pauseAutoPlayOnHover' => true,
    'pageDots' => !empty($enable_page_dots),
    'prevNextButtons' => !empty($enable_prev_next_buttons),
    'cellAlign' => !empty($cell_alignment) ? $cell_alignment : 'left',
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
    'attributes' => ($layout === 'slider') ? ' data-ct-block="slider"' : '',
    'header' => (!empty($title) || !empty($description)) ? $header : false,
    'content' => $content
  ));
endif;
