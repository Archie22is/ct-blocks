<?php
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

$header = codetot_build_content_block(array(
  'title' => $title ?? '',
  'description' => $content ?? ''
), $preset_class);

ob_start();
if (!empty($overlay)) : ?>
  <div class="cta-form__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
<?php endif;
$background_html = ob_get_clean();

if (!empty($select_form)) :
  ob_start();

  echo '<div class="cta-form__form">';
  gravity_form($select_form, false, false, false, null, true);
  echo '</div>';

  $content = ob_get_clean();

  the_block('default-section', array(
    'class' => $_class,
    'background_image' => $background_image ?? '',
    'before_header' => $background_html,
    'header' => $header,
    'content' => $content
  ));
endif;
