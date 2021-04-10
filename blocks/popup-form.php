<?php

// 'class',
// 'block_preset',
// 'select_form',
// 'action_attribute',
// 'label',
// 'title',
// 'description'
$container_class = codetot_site_container();

$prefix_class = 'popup-form';

$_class = $prefix_class;
$_class .= !empty($block_preset) ? ' ' . $prefix_class . '--' . esc_attr($block_preset) : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

if (!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'label' => $label,
    'title' => $title,
    'description' => $description
  ), $prefix_class);
}

ob_start();
if (!empty($content)) :
  echo '<div class="'. $prefix_class .'__content">'. $content .'</div>';
endif;

if (!empty($select_form)) :
  echo '<div class="' . $prefix_class . '__form default-section__col">';
  echo do_shortcode('[gravityform id="' . $select_form . '" title="true" description="false" ajax="true"]');
  echo '</div>';
endif;

$content = ob_get_clean();

if (!empty($select_form)) :
    the_block('default-section', array(
      'class' => $_class,
      'attributes' => ' data-action-attribute="'.$action_attribute.'" data-ct-block="popup-form"',
      'header' => (!empty($title) || !empty($description)) ? $header : false,
      'content' => $content
    ));
endif;
?>
