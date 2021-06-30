<?php

/**
 *
  'class',
  'anchor_name',
  'content_alignment',
  'background_image',
  'background_overlay',
  'background_type',
  'block_preset',
  'block_spacing',
  'block_container',
  'block_layout'
 */

$_class = 'bottom-cta';
$_class .= !empty($background_image) ? ' rel has-background' : '';
$_class .= !empty($content_alignment) ? ' is-content-alignment-' . esc_attr($content_alignment) : ' is-content-alignment-center';
$_class .= !empty($block_spacing) ? ' is-vertical-spacing-' . esc_attr($block_spacing) : ' is-vertical-spacing-default';
$_class .= !empty($block_layout) ? ' is-layout-' . esc_attr($block_layout) : ' is-layout-column';
$_class .= !empty($overlay) ? ' has-overlay' : '';

if (empty($block_container) || (!empty($block_container) && $block_container !== 'boxed')) {
  $_class .= ' has-container-fullwidth';
  $_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
} else {
  $_class .= ' section-bg has-container-boxed has-bg-' . esc_attr($background_type);
}

$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$content = codetot_build_content_block(array(
  'title' => !empty($title) ? $title : '',
  'description' => !empty($description) ? $description : '',
  'description_class' => 'mt-05',
  'block_tag' => 'div'
), 'bottom-cta');

ob_start(); ?>
<?php if (!empty($buttons)) : ?>
  <div class="pt-1 bottom-cta__footer">
    <?php foreach ($buttons as $button) :
      the_block('button', array(
        'class' => 'bottom-cta__button',
        'size' => 'large',
        'type' => $button['button_style'],
        'button' => $button['button_text'],
        'url' => $button['button_url'],
        'target' => $button['target']
      ));
    endforeach; ?>
  </div>
<?php endif; ?>
<?php $footer = ob_get_clean();

$content .= $footer;

ob_start(); ?>
<?php if (!empty($background_image)) : ?>
  <?php the_block('image', array(
    'image' => $background_image,
    'class' => 'image--cover bottom-cta__background-image'
  )); ?>
<?php endif; ?>
<?php if (!empty($overlay)) : ?>
  <div class="bottom-cta__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
<?php endif; ?>
<?php $background_html = ob_get_clean();

the_block('default-section', array(
  'id' => !empty($anchor_name) ? $anchor_name : '',
  'class' => $_class,
  'lazyload' => !empty($enable_lazyload),
  'before_header' => $background_html,
  'content' => $content
));
