<?php
$container_class = codetot_site_container();
$preset_class = 'cta-form section';
$_class = 'cta-form cta-form--' . $style;
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($block_preset) ? ' ' . $preset_class . '--' . esc_attr($block_preset) : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($background_color) ? ' section-bg bg-' . esc_attr($background_color) : ' section';
$_class .= !empty($overlay) ? ' ' . $prefix_class . '--has-overlay' : '';
$_class .= !empty($background_types) ? ' cta-form--' . esc_attr($background_types) : '';

if (!empty($title) || !empty($content)) {
  $header = codetot_build_content_block(array(
    'title' => $title,
    'description' => $content
  ), $preset_class);
}

ob_start();

the_block('image', array(
  'image' => $image,
  'class' => (!empty($image_size) ? 'image--' . $image_size : 'image--default') . ' ' . $preset_class . '__sidebar-image '
));

$sidebar = ob_get_clean();

if (!empty($select_form)) :
  ob_start();

  echo '<div class="cta-form__form">';
  gravity_form($select_form, false, false, false, null, true);
  echo '</div>';

  $form = ob_get_clean();
endif;

if (!empty($select_form)) :
  if (!empty($image)):
    the_block('sidebar-section', array(
      'class' => $preset_class. '__content',
      'sidebar' => !empty($sidebar) ? $sidebar : false,
      'content' => $header . $form
    ));
  else :
  the_block('default-section', array(
    'class' => $_class,
    'header' => !empty($header) ? $header : false,
    'content' => $form
  ));
  endif;
endif;
