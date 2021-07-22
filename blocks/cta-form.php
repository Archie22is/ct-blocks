<?php
$container_class = codetot_site_container();
$preset_class = 'cta-form';
$_class = 'cta-form ';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($block_preset) ? ' ' . $preset_class . '--' . esc_attr($block_preset) : '';
$_class .= !empty($form_alignment) ? ' ' . $preset_class . '--form-' . esc_attr($form_alignment) : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($background_contract) ? ' '. $preset_class .'--' .esc_attr($background_contract) : '';
$_class .= (!empty($background_type) && (!empty($background_type) !== 'white')) ? ' bg-' . esc_attr($background_type) : '';
$_class .= ((!empty($background_type) !== 'white') || !empty($background_image)) ? ' section-bg' : ' section';
$_class .= !empty($background_image) ? ' rel bg-image' : '';
$_class .= !empty($overlay) ? ' ' . $preset_class . '--has-overlay' : '';


if (!empty($title) || !empty($content)) {
  $header = codetot_build_content_block(array(
    'title' => $title,
    'description' => $content
  ), $preset_class);
}
ob_start();
if (!empty($background_image)) {
the_block('image', array(
  'class' => 'image--cover cta-form__background',
  'image' => $background_image
));
}

if (!empty($overlay)) { ?>
  <div class="cta-form__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
<?php }
$background = ob_get_clean();

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
      'class' => $_class,
      'before_header' => $background,
      'sidebar' => !empty($sidebar) ? $sidebar : false,
      'content' => $header . $form
    ));
  else :
  the_block('default-section', array(
    'class' => $_class,
    'attributes' => ' data-reveal="fade-up"',
    'before_header' => $background,
    'header' => !empty($header) ? $header : false,
    'content' => $form
  ));
  endif;
endif;
