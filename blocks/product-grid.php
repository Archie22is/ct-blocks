<?php

$_enable_slider = isset($enable_slider) && $enable_slider;
$_columns = !empty($columns) ? $columns : 4;

$_class = 'product-grid';
$_class .= $_enable_slider ? ' has-slider' : '';
$_class .= !empty($class) ? ' ' . $class : '';

$wrapper_class = 'products';
$wrapper_class .= !empty($columns) ? ' columns-' . esc_html($columns) : ' columns-4';
$wrapper_class .= $_enable_slider ? ' js-slider' : '';

$carousel_settings = apply_filters('codetot_product_grid_slider_settings', array(
  'cellAlign' => 'left',
  'pageDots' => true,
  'groupCells' => true,
  'percentagePosition' => true,
  'prevNextButtons' => true,
  'resize' => true,
  'items' => (int) $_columns
));

if ($carousel_settings['pageDots'] === true) {
  $_class .= ' has-page-dots';
}

if ($carousel_settings['prevNextButtons'] === true) {
  $_class .= ' has-prev-next-buttons';
}

$header = codetot_build_content_block(array(
  'title' => $title ?? ''
), 'product-grid');

ob_start();

?>
<ul class="<?php echo $wrapper_class; ?>" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>' <?php endif; ?>>
<?php

if ($query instanceof WP_Query && $query->have_posts()) {
  while ( $query->have_posts() ) :
    $query->the_post();

    wc_get_template_part( 'content', 'product' );
  endwhile;
}

if (!empty($list) && is_array($list)) {
  foreach ( $list as $item ) :

    $post_object = get_post( $item->get_id() );
    setup_postdata( $GLOBALS['post'] =& $post_object );
    wc_get_template_part( 'content', 'product' );

  endforeach;
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

if (!empty($query) || !empty($list)) :
  the_block('default-section', array(
    'class' => $_class,
    'attributes' => $_enable_slider ? ' data-ct-block="product-grid"' : '',
    'lazyload' => isset($enable_lazyload) && $enable_lazyload,
    'header' => $header,
    'content' => $content
  ));
endif;
