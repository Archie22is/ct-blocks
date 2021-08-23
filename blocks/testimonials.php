<?php

$_class = 'testimonials';
$_class .= !empty($overlay) ? ' has-overlay' : '';
$_class .= !empty($columns_layout) ? ' has-'. $columns_layout .'-columns' : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_image) ? ' rel has-background-image' : '';
$_class .= !empty($background_contract) ? ' is-' . $background_contract . '-contract' : '';
$_class .= !empty($block_preset) ? ' testimonials--preset-' . esc_attr($block_preset) : ' testimonials--preset-default';
$_class .= !empty($header_alignment) ? ' is-header-' .  $header_alignment : '';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($enable_slider) ? ' testimonials--slider' : '';

$header = codetot_build_content_block(array(
  'label' => !empty($label) ? $label : '',
  'title' => !empty($title) ? $title : '',
  'description' => !empty($description) ? $description : ''
), 'testimonials');

$_slider_options = empty($slider_options) ? array(
  'contain' => true,
  'prevNextButtons' => true,
  'pageDots' => true,
  'cellAlign' => 'center',
  'groupCells' => true
) : $slider_options;

// Build background image and overlay
ob_start();
if (!empty($overlay)) : ?>
  <div class="testimonials__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
<?php endif;
$background_html = ob_get_clean();

// Build column content
$columns = !empty($columns) ? array_map(function($column) {
  return get_block('testimonial-card', array(
    'item' => $column
  ));
}, $columns) : [];
$column_content = codetot_build_grid_columns($columns, 'testimonials', array(
  'column_class' => 'default-section__col'
));

$slider_html = codetot_build_slider($columns, 'testimonials', array(
  'slider_settings' => $_slider_options
));

// Wrap content
$content = !$enable_slider ? $column_content : $slider_html;

if (!empty($content)) :
  the_block('default-section', array(
    'attributes' => 'data-ct-block="testimonials"',
    'background_image' => $background_image ?? '',
    'before_header' => $background_html ?? '',
    'class' => $_class,
    'lazyload' => isset($enable_lazyload) && $enable_lazyload,
    'id' => $anchor_name ?? '',
    'header' => $header,
    'content' => $content
  ));
endif;
