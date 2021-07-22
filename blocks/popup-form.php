<?php

ob_start();
if (!empty($form_title)) :
  printf('<p class="modal__title">%s</p>', $form_title);
endif;
$header = ob_get_clean();

ob_start();
if (!empty($select_form)) :
  echo '<div class="wysiwyg modal__form">';
  echo do_shortcode('[gravityform id="' . $select_form . '" title="false" description="false" ajax="true"]');
  echo '</div>';
endif;
$content = ob_get_clean();

$_class = 'modal--popup-form';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

the_block('modal', array(
  'attributes' => ' data-ct-block="popup-form" data-reveal="fade-up"',
  'class' => $_class,
  'id' => esc_attr($form_id),
  'header' => !empty($header) ? $header : '',
  'content' => $content
));

?>
