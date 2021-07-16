<?php
$_class = 'image-row';
$_class .= !empty($space_between) ? ' image-row--space-between' : '';
$_class .= !empty($header_alignment) ? ' is-header-' .  $header_alignment : ' is-header-left';
$_class .= !empty($content_alignment) ? ' is-content-alignment-' .  $content_alignment : ' is-content-alignment-left';
$_class .= !empty($footer_alignment) ? ' is-footer-' .  $footer_alignment : ' is-footer-left';
$_class .= !empty($enable_full_screen_layout) ? ' default-section--no-container image-row--no-container' : '';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$_lazyload = !empty($lazyload) ?? true;

if (!empty($title)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'title' => $title,
    'description' => !empty($description) ? $description : ''
  ), 'image-row');
}

// Main Content
$_columns = !empty($columns) ? array_map(function ($item) use ($_lazyload) {
  $output_item = array(
    'class' => sprintf('image-row__col--%s', $item['column_width'])
  );

  if (!empty($item['url'])) {
    $output_item['content'] = get_block('image-banner', array(
      'image' => $item['image'],
      'url' => $item['url']
    ));
  } elseif (!empty($item['image_zoom'])) {
    $output_item['content'] = sprintf('<a class="image-row__image-wrapper has-link" data-fancybox href="%s">', esc_url($item['image']['url']));
    $output_item['content'] .= get_block('image', array(
      'image' => $item['image'],
      'class' => 'image--default image-row__image',
      'size' => !empty($enable_full_screen_layout) ? 'full' : 'large',
      'lazyload' => $_lazyload
    ));
    $output_item['content'] .= '</a>';
  }

  return $output_item;
}, $columns) : [];

$content = codetot_build_grid_columns($_columns, 'image-row', array(
  'column_class' => 'default-section__col image-row__col'
));

ob_start(); ?>
<?php if (!empty($buttons)) :
  the_block('button-group', array(
    'class' => 'image-row__buttons',
    'buttons' => $buttons
  ));
endif; ?>
<?php $footer = ob_get_clean();

the_block('default-section', array(
  'id' => !empty($id) ? $id : '',
  'class' => $_class,
  'lazyload' => $_lazyload,
  'tag' => !empty($title) ? 'section' : 'div',
  'header' => $header,
  'content' => $content,
  'footer' => $footer
));
