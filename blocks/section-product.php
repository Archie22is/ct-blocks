<?php
$container = codetot_site_container();
$_class = 'section-product section';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($columns) ? ' has-' . esc_attr($columns) . '-columns' : '';
$_class .= !empty($section_align) ? ' is-header-' . esc_attr($section_align) . ' is-footer-' . esc_attr($section_align) : '';
$_class .= !empty($show_category) ? ' display-categories' : '';

ob_start();
if ($show_category && !empty($categories) && !is_wp_error($categories)) :
  echo '<div class="section-product__categories-wrapper">';
  echo '<div class="section-product__categories">';
  foreach ($categories as $category) :
    printf('<a class="section-product__link" href="%1$s"><span class="button__text">%2$s</span></a>',
      get_term_link($category->term_id),
      esc_html($category->name)
    );
  endforeach;
  if (!empty($show_shop_link)) :
    printf('<a class="section-product__link section-product__link--shop" href="%1$s"><span class="button__text">%2$s</span></a>',
      get_permalink(wc_get_page_id('shop')),
      esc_html__('View all', 'ct-blocks')
    );
  endif;
  echo '</div>';
  echo '</div>';
endif;

$category_links_html = ob_get_clean();

if (!empty($title) || !empty($description)) {
  $header = codetot_build_content_block(array(
    'class' => 'section-header',
    'label' => !empty($label ) ? $label : false,
    'title' => $title,
    'description' => $description,
    'after_content' => !empty($category_links_html) ? $category_links_html : false
  ), 'section-product');
}

if (empty($categories)) :
  echo '<div class="container">You do not have any category, please enter the category to display the product section</div>';
else :
  if (!empty($attribute)) :
    if ($attribute == 'featured') {
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
        ),
      );
    } else {
      $product_args = codetot_get_product_query_by_type($attribute);
      $product_args['posts_per_page'] = !empty($numbers) ? $numbers : '10';;
      $product_args['tax_query'] = array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'id',
          'terms' => wp_list_pluck($categories, 'term_id')
        )
      );
      $product_args['meta_query'] = array (
        array(
          'key' => '_stock_status',
          'value' => 'instock'
        )
      );
    }
    $query = new WP_Query($product_args);
  endif;

  $products = [];
  if ($query->have_posts()) :
    while ($query->have_posts())  : $query->the_post();
      $products[] = get_block('product-card');
    endwhile; wp_reset_postdata();
  endif;

  $content = codetot_build_grid_columns($products, 'section-product', array(
    'column_class' => 'product default-section__col'
  ));

  $content = str_replace('section-product__grid', 'products section-product__grid', $content);

  $footer = !empty($button_text) && !empty($button_url) ?
    get_block('button', array(
      'class' => 'section-product_button',
      'type' => !empty($button_style) ? $button_style : 'primary',
      'button' => $button_text,
      'url' => $button_url
    ))
  : '';

  if ($query->have_posts()) :

    the_block('default-section', array(
      'class' => $_class,
      'header' => (!empty($title) || !empty($description)) ? $header : '',
      'content' => $content,
      'footer' => $footer
    ));

  endif;
endif;
