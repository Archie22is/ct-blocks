<?php
$_class = 'default-content';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($content_alignment) ? ' is-content-alignment-' . esc_attr($content_alignment) : ' is-content-alignment-left';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';

$header = codetot_build_content_block(array(
  'title' => !empty($title) ? $title : '',
  'title_tag' => 'h2'
), 'default-content');

ob_start();
  if( !empty($content) ):
  echo '<div class="wysiwyg default-content__description">';
  echo $content;
  echo '</div>';
endif;
$content = ob_get_clean();

the_block('default-section', array(
  'id' => !empty($anchor_name) ? esc_html($anchor_name) : '',
  'lazyload' => isset($enable_lazyload) && $enable_lazyload,
  'class' => $_class,
  'header' => $header,
  'content' => $content
));
