<?php
$container = codetot_site_container();

$post_args = array(
  'post_type' => 'post',
  'posts_per_page' => !empty($number_posts) ? $number_posts : '3',
  'category__in' => !empty($category) ? $category : '',
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
    $columns[] = get_block('post-card');
  endwhile; wp_reset_postdata();
endif;

$content = codetot_build_grid_columns($columns, 'section-post', array(
  'column_attributes' => 'data-aos="fade-up"',
  'column_class' => 'default-section__col'
));

$footer = !empty($button_text) && !empty($button_url) ?
  get_block('button', array(
    'class' => 'section-post__button',
    'type' => !empty($button_style) ? $button_style : 'primary',
    'button' => $button_text,
    'url' => $button_url
  ))
: '';

$_class = 'section-post';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($footer_alignment) ? ' is-footer-'.  $footer_alignment : '';
$_class .= !empty($columns) ? ' has-'. count($columns) .'-columns' : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($block_preset) ? ' section-post--' . $block_preset : '';

if ($post_query->have_posts()) :

  the_block('default-section', array(
    'class' => $_class,
    'header' => (!empty($title) || !empty($descriptiom)) ? $header : '',
    'content' => $content,
    'footer' => $footer
  ));

endif;
