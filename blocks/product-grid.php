<?php

$_enable_slider = isset($enable_slider) && $enable_slider ?? false;
$_columns = $columns ?? '4-col';

$_class = 'product-grid';
$_class .= $_enable_slider ? ' has-slider' : '';
$_class .= !empty($class) ? ' ' . $class : '';

$wrapper_class = 'products';
$wrapper_class .= !empty($_columns) ? ' columns-' . esc_html($_columns) : ' columns-4';
$wrapper_class .= $_enable_slider ? ' js-slider' : '';

$carousel_settings = apply_filters('codetot_product_grid_slider_settings', array(
  'cellAlign' => 'left',
  'pageDots' => true,
  'groupCells' => true,
  'percentagePosition' => true,
  'prevNextButtons' => true,
  'resize' => true
));

if ($carousel_settings['pageDots'] === true) {
  $_class .= ' has-page-dots';
}

if ($carousel_settings['prevNextButtons'] === true) {
  $_class .= ' has-prev-next-buttons';
}

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'title' => $title ?? ''
), 'product-grid');

ob_start(); ?>
<?php if (!empty($_enable_slider)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>' <?php endif; ?>
<?php if (!empty($columns) && $columns !== 'hide') : ?> data-columns="<?php echo $columns; ?>"<?php endif; ?>
  data-breakpoint="--sm"
<?php $column_attributes = ob_get_clean();

ob_start();

?>
<ul class="<?php echo $wrapper_class; ?>" <?php echo $column_attributes; ?>>
<?php

/**
 * For example: 'name' => 'related'
 */
if (!empty($loop_args)) {
  foreach ($loop_args as $loop_key => $loop_variable) {
    wc_set_loop_prop(sanitize_key($loop_key), sanitize_text_field($loop_variable));
  }
}

if (!empty($query) && $query instanceof WP_Query && $query->have_posts()) {
  while ( $query->have_posts() ) :
    $query->the_post();

    wc_get_template_part( 'content', 'product' );
  endwhile;
}

wp_reset_postdata();

if(!empty($columns)) {
  echo '</ul>';
} else {
  woocommerce_product_loop_end();
}

$content = ob_get_clean();

if ($_enable_slider) :
  $content = str_replace('<ul', '<div', $content);
  $content = str_replace('</ul>', '</div>', $content);
  $content = str_replace('<li', '<div', $content);
  $content = str_replace('</li>', '</div>', $content);
endif;

if (
  !empty($query) &&
  (!empty($columns) && $columns !== 'hide')
) :
  the_block('default-section', array(
    'class' => $_class,
    'attributes' => $_enable_slider ? ' data-ct-block="product-grid"' : '',
    'lazyload' => isset($enable_lazyload) && $enable_lazyload,
    'header' => $header,
    'content' => $content
  ));
endif;
