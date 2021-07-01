<?php
/**
 * Available settings:
 * block_preset
 * header_alignment
 * background_type
 * columns
 * post_card_style
 */
$_class = 'section-post  is-mobile-horizontal';
$_class .= !empty($block_preset) ? ' section-post--preset-' . esc_attr($block_preset) : ' section-post--preset-1';
$_class .= !empty($header_alignment) ? ' is-header-' .  $header_alignment : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : '';
$_class .= !empty($class) ? ' ' . $class : '';

$_enable_lazyload = !empty($enable_lazyload);
$columns = [];

$post_args = array(
  'post_type' => 'post',
  'posts_per_page' => !empty($number_posts) ? $number_posts : '3',
  'category__in' => $category // Required
);

$post_query = new WP_Query($post_args);

if (!empty($label) || !empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'alignment' => $header_alignment,
    'label' => $label,
    'title' => $title,
    'description' => $description
  ), 'section-post');
}

if ($post_query->have_posts()) :
  while ($post_query->have_posts())  : $post_query->the_post();
    $columns[] = get_block('post-card', array(
      'class' => 'section-post__card',
      'card_style' => !empty($post_card_style) ? $post_card_style : 'style-1'
    ));
  endwhile; wp_reset_postdata();
endif;

$content = codetot_build_grid_columns($columns, 'section-post', array(
  'column_class' => 'default-section__col f fdc'
));

$footer = !empty($button_text) && !empty($button_url) ?
  get_block('button', array(
    'class' => 'section-post__button',
    'type' => !empty($button_style) ? $button_style : 'primary',
    'button' => $button_text,
    'url' => $button_url
  ))
: '';

the_block('default-section', array(
  'class' => $_class,
  'lazyload' => $_enable_lazyload,
  'header' => (!empty($title) || !empty($description)) ? $header : '',
  'content' => $content,
  'footer' => $footer
));
