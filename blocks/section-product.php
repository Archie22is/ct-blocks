<?php
/** // Available parameters
 *  'enable_lazyload',
 *  'class',
 *  'anchor_name',
 *  'background_type',
 *  'background_contract',
 *  'section_align',
 *  'numbers',
 *  'columns',
 *  'show_category',
 *  'show_shop_link',
 *  // Content
 *  'label',
 *  'title',
 *  'description',
 *  'categories',
 *  'attribute',
 *  'button_text',
 *  'button_url',
 *  'button_target',
 *  'button_style'
 *
 */
$_columns = !empty($columns) ? (int) $columns : 4;
$_numbers = !empty($numbers) ? (int) $numbers : 8;
$_enable_lazyload = (isset($enable_lazyload) && $enable_lazyload) || !isset($enable_lazyload);
$list_class = 'products columns-' . esc_attr($_columns);
$list_class .= $_enable_lazyload ? ' js-grid is-not-loaded' : '';
$_categories_ids = !empty($categories) && !is_wp_error($categories) ? wp_list_pluck($categories, 'term_id') : '';

$_class = 'section-product';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= ' has-' . esc_attr($_columns) . '-columns';
$_class .= !empty($section_align) ? ' is-header-' . esc_attr($section_align) . ' is-footer-' . esc_attr($section_align) : ' is-header-left is-footer-left';
$_class .= !empty($show_category) ? ' display-categories' : '';
$_class .= !empty($class) ? ' ' . $class : '';

$block_attributes = array(
  'endpoint' => 'get_section_product_html',
  'queryType' => $attribute ?? 'on_sale',
  'postsPerPage' => $_numbers
);

if (!empty($_categories_ids)) {
  $block_attributes['categories'] = implode('|', $_categories_ids);
}

// Generate category links
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
      esc_html__('View all products', 'ct-blocks')
    );
  endif;
  echo '</div>';
  echo '</div>';
endif;
$category_links_html = ob_get_clean();

$header = codetot_build_content_block(array(
  'class' => 'section-header',
  'label' => !empty($label) ? $label : '',
  'title' => !empty($title) ? $title : '',
  'description' => !empty($description) ? $description : '',
  'after_content' => !empty($category_links_html) ? $category_links_html : false
), 'section-product');

ob_start();

printf('<ul class="%s">', $list_class);

if (!$_enable_lazyload) :
  $product_args = codetot_get_product_query_by_type($attribute);
  $product_args['posts_per_page'] = $_numbers;
  $product_args['tax_query'] = array(
    array(
      'taxonomy' => 'product_cat',
      'field' => 'term_id',
      'terms' => $_categories_ids
    )
  );
  $product_args['meta_query'] = array (
    array(
      'key' => '_stock_status',
      'value' => 'instock'
    )
  );

  $product_query = new WP_Query($product_args);

  if ($product_query->have_posts()) :
    while ( $product_query->have_posts() ) :
      $product_query->the_post();
      wc_get_template_part( 'content', 'product' );
    endwhile; wp_reset_postdata();
  else :
    printf('<li class="product no-product">%s</li>', esc_html__('There is no products available for this category.', 'ct-blocks'));
  endif;
endif;

echo '</ul>';

$content = ob_get_clean();

$footer = !empty($button_text) && !empty($button_url) ?
  get_block('button', array(
    'class' => 'section-product_button',
    'type' => !empty($button_style) ? $button_style : 'primary',
    'button' => $button_text,
    'url' => $button_url
  ))
: '';

the_block('default-section', array(
  'attributes' => $_enable_lazyload ? sprintf(' data-ct-block="section-product" data-settings=\'%s\'', json_encode($block_attributes)) : '',
  'id' => isset($anchor_name) ?  esc_html($anchor_name) : '',
  'class' => $_class,
  'lazyload' => $_enable_lazyload,
  'header' => $header,
  'content' => $content,
  'footer' => $footer
));
