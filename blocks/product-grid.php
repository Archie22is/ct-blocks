<?php

$_class = 'product-grid';
$_class = !empty($class) ? ' ' . $class : '';

$header = codetot_build_content_block(array(
  'title' => !empty($title) ? $title : ''
), 'product-grid');

ob_start();
if(!empty($columns)) {
  echo '<ul class ="products columns-'. esc_attr($columns) . '">';
} else {
  woocommerce_product_loop_start();
}

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
  echo '<ul class ="products columns-'.$columns.'">';
} else {
  woocommerce_product_loop_end();
}

$content = ob_get_clean();

if (!empty($query) || !empty($list)) :
  the_block('default-section', array(
    'class' => $_class,
    'header' => $header,
    'content' => $content
  ));
endif;
