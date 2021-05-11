<?php
$container = codetot_site_container();

$_class = 'guarantee-list';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : ' has-3-columns';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($block_preset) ? ' guarantee-list--' . $block_preset : '';
$_class .= !empty($fullscreen) ? ' guarantee-list--fullscreen' : '';
$_class .= !empty($hide_mobile) ? ' section--hide-mobile' : '';

$attributes = !empty($anchor_name) ? sprintf(' id="%s"', $anchor_name) : '';

$columns = !empty($items) ? array_map(function($item) use ($layout, $content_alignment){
  return get_block('guarantee-card', array(
    'type' => $item['icon_type'],
    'icon' => ($item['icon_type'] === 'svg') ? $item['icon_svg'] : $item['icon_image']['ID'],
    'title' => $item['title'],
    'description' => $item['description'],
    'layout' => $layout,
    'alignment' => $content_alignment
  ));
}, $items) : [];

$content = codetot_build_grid_columns($columns, 'guarantee-list', array(
  'column_class' => 'default-section__col'
));

if (!empty($items)) :
  the_block('default-section', array(
    'class' => $_class,
    'attributes' => $attributes,
    'content' => $content
  ));
endif;

