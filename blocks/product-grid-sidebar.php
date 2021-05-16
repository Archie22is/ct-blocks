<?php
$container = codetot_site_container();
$preset_class = 'product-grid-sidebar';
$_class = 'section '. $preset_class;

$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($header_alignment) ? ' is-header-'.  $header_alignment : '';
$_class .= !empty($block_preset) ? ' ' . $preset_class . '--' . esc_attr($block_preset) : '';
$_class .= !empty($columns) ? ' ' . $preset_class . '--' . esc_attr($columns) .'-columns' : '';

if (!empty($categories)) :

//HEADER
ob_start();
echo '<div class="'.$preset_class.'__menu-items js-sidebar-block">';
foreach ($categories as $category):
  echo '<li class="' . $preset_class . '__item">';
  echo '<a href="' . esc_url(get_term_link($category->term_id)) . '" class="' . $preset_class . '__item-link">';
  echo esc_html($category->name);
  echo '</a>';
  echo '</li>';
endforeach;
echo '</div>';
echo '<button class="' . $preset_class . '__menu js-trigger" aria-label="Open a mobile menu">';
codetot_svg('menu', true);
echo '  </button>';

if (!empty($button_text) && !empty($button_url)) :
  echo '<div class="' . $preset_class . '__cta">';
  the_block('button', array(
    'class' => '' . $preset_class . '__read-more',
    'button' => $button_text,
    'url' => !empty($button_url) ? $button_url : '',
    'target' => !empty($button_target) ? $button_target : '',
    'type' => !empty($button_style) ? $button_style : ''
  ));
  echo '</div>';
endif;

$description = ob_get_clean();

if (!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'title' => $title,
    'description' => $description
  ), $preset_class);
}
//END HEADER

//CONTENT
//IMAGE SIDEBAR
ob_start();

if (!empty($image_sidebar_items)) :
  foreach ($image_sidebar_items as $image):
    echo !empty($image['url']) ?  '<a href="' . $image['url'] . '">' : false;

    the_block('image', array(
      'image' => $image['image'],
      'class' => (!empty($image_size) ? 'image--' . $image_size : 'image--default') . ' ' . $preset_class . '__sidebar-image '
    ));

    echo !empty($image['url']) ? '</a>' : false;
  endforeach;
endif;

$sidebar = ob_get_clean();
//END IMAGE SIDEBAR

//PRODUCT COLUMNS
if (!empty($attribute)) :
  if ($attribute == 'featured') :
    $product_args = array(
      'post_type' => 'product',
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'product_visibility',
          'field' => 'name',
          'terms' => 'featured',
        ),
        array(
          'taxonomy' => 'product_cat',
          'field' => 'id',
          'terms' => wp_list_pluck($categories, 'term_id')
        ),
      )
    );
  else :
    $product_args = codetot_get_product_query_by_type($attribute);
    $product_args['posts_per_page'] = !empty($numbers) ? $numbers : '10';;
    $product_args['tax_query'] = array(
      array(
        'taxonomy' => 'product_cat',
        'field' => 'id',
        'terms' => wp_list_pluck($categories, 'term_id')
      )
    );
  endif;

  $query = new WP_Query($product_args);
  $products = [];

  if ($query->have_posts()) :
    while ($query->have_posts())  : $query->the_post();
      $products[] = get_block('product-card');
    endwhile; wp_reset_postdata();
  endif;
endif;

$product_columns = codetot_build_grid_columns($products, $preset_class, array(
  'grid_class' => 'products'
));

if (!empty($image_sidebar_items)) :
  ob_start();
  the_block('sidebar-section', array(
    'class' => $preset_class. '__content sidebar-section--no-container',
    'sidebar' => !empty($sidebar) ? $sidebar : false,
    'content' => $product_columns
  ));

  $content = ob_get_clean();
else :
  $content = $product_columns;
endif;
//END PRODUCT COLUMNS
//END CONTENT

the_block('default-section', array(
  'attributes' => ' data-ct-block="product-grid-sidebar"',
  'class' => $_class,
  'header' => !empty($header) ? $header : false,
  'content' => $content
));
endif;
?>
