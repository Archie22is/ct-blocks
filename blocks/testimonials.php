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

$header = codetot_build_content_block(array(
  'label' => !empty($label) ? $label : '',
  'title' => !empty($title) ? $title : '',
  'description' => !empty($description) ? $description : ''
), 'testimonials');

// Build background image and overlay
ob_start();
if (!empty($background_image)) {
  the_block('image', array(
    'class' => 'image--cover testimonials__background',
    'image' => $background_image
  ));
}
if (!empty($overlay)) { ?>
  <div class="testimonials__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
<?php }
$background = ob_get_clean();

$_columns = !empty($columns) ? array_map(function($column) {
  return get_block('testimonial-card', array(
    'column' => $column
  ));
}, $columns) : [];

$content = codetot_build_grid_columns($_columns, 'testimonials', array(
  'column_class' => 'default-section__col'
));

if (!empty($columns)) :
  the_block('default-section', array(
    'before_header' => $background,
    'class' => $_class,
    'header' => $header,
    'content' => $content
  ));
endif;
