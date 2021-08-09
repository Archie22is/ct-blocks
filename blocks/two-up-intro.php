<?php

if (!empty($image_size) && empty($media_size) && is_user_logged_in() && current_user_can( 'manage_options' )) {
  $error = new WP_Error('new_update', 'Please edit this page and update block Two Up Intro to new settings. This notice only available to Admin only. Contact dev@codetot.com for more information.');

  printf('<pre>%s</pre>', $error->get_error_message());
}

$_class = 'two-up-intro';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : ' is-light-contract';
$_class .= !empty($block_spacing) ? ' is-spacing-' . esc_attr($block_spacing) : ' is-spacing-default';
$_class .= !empty($block_spacing) && $block_spacing === 'fullscreen' ? ' default-section--no-container' : '';
$_class .= !empty($content_alignment) ? ' is-content-alignment-' . esc_attr($content_alignment) : ' is-content-alignment-left';
$_class .= !empty($image_position) ? ' is-layout-' . esc_attr($image_position). '-image' : ' is-layout-left-image';
$_class .= !empty($media_size) ? ' is-media-size-' . esc_attr($media_size) : ' is-media-size-default';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$main_content_html = codetot_build_content_block(array(
  'label' => !empty($label) ? $label : '',
  'title' => !empty($title) ? $title : '',
  'description' => !empty($content) ? $content : '',
  'default_class' => 'two-up-intro__content'
), 'two-up-intro');

$default_image_sizes = ['default', 'cover', 'contain'];
$has_full_hd_sizes = ['cover', 'contain'];
$large_media_sizes = ['cover-height-32', 'cover-height-151', 'flex-height'];

$_image_class = !empty($media_size) && in_array($media_size, $default_image_sizes) ? 'image--' . $media_size : '';
$_image_class .= !empty($media_size) && in_array($media_size, $has_full_hd_sizes) ? ' image--hd' : '';
$_image_class .= ' two-up-intro__image';

$_image_size = 'large';
$_image_size = !empty($media_size) && in_array($media_size, $large_media_sizes) ? 'full' : 'large';

ob_start();
if (!empty($image)) :
  the_block('image', array(
    'image' => $image,
    'class' => $_image_class,
    'size' => $_image_size
  ));
endif;
$media_content = ob_get_clean();

ob_start();
if (!empty($buttons)) :
  ?>
  <div class="pt-1 two-up-intro__footer">
    <?php the_block('button-group', array(
      'buttons' => $buttons,
      'class' => 'two-up-intro__buttons'
    )); ?>
  </div>
<?php endif;
$buttons_html = ob_get_clean();

$main_content_html .= $buttons_html;

$main_content = printf('<div class="two-up-intro__inner">%s</div>', $main_content_html);

$content = codetot_build_grid_columns(array(
  $media_content,
  $main_content
), 'two-up-intro');

the_block('default-section', array(
  'lazyload' => (isset($enable_lazyload) && $enable_lazyload) || !isset($enable_lazyload),
  'class' => $_class,
  'id' => $anchor_name,
  'content' => $content
));
