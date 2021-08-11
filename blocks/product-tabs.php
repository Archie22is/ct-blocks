<?php

$_class = 'product-tabs';
$_class .= !empty($header_alignment) ? ' is-header-alignment-' . esc_html($header_alignment) : ' is-header-left';
$_class .= !empty($footer_alignment) ? ' is-footer-alignment-' . esc_html($footer_alignment) : ' is-footer-left';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : ' has-4-columns';
$_class .= !empty($class) ? ' ' . $class : '';

$_columns = !empty($columns) && is_numeric($columns) ? $columns : 4;
$_enable_lazyload = isset($enable_lazyload) && $enable_lazyload;

$block_attributes = array(
  'endpoint' => 'get_product_tabs_html',
  'postsPerPage' => !empty($numbers) ? (int) $numbers : 8,
  'queryType' => !empty($attribute) ? esc_attr($attribute) : 'on_sale'
);

$items = [];
foreach($categories as $index => $category) :
  $items[] = array(
    'id' => esc_attr($category->slug),
    'name' => esc_html($category->name),
    'category_id' => esc_attr($category->term_id),
    'is_active' => $index === 0,
    'is_lazyload' => $_enable_lazyload
  );
endforeach;

// Generate header
ob_start(); ?>
<?php if(!empty($title)) : ?>
  <h2 class="h2 product-tabs__title"><?php echo $title; ?></h2>
<?php endif; ?>
<?php if (!empty($categories)) : ?>
  <div class="mt-2 d-inline-flex product-tabs__nav-wrapper">
    <ul class="f product-tabs__nav" aria-controls="product-tabs__tab" role="tablist">
      <?php foreach ($items as $item) : ?>
        <?php printf('<li class="rel product-tabs__item" role="tab" aria-controls="%1$s" aria-selected="%2$s">%3$s</li>',
          $item['id'],
          var_export($item['is_active'], true),
          $item['name']
        ); ?>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
<?php
$header = ob_get_clean();

// Generate main content
ob_start();
foreach ($items as $item) : ?>
  <div class="product-tabs__tab-content js-tab-content" data-category-id="<?php echo $item['category_id']; ?>" id="<?php echo $item['id']; ?>" role="tabpanel" aria-expanded="<?php echo var_export($item['is_active'], true); ?>">
    <div class="rel product-tabs__inner">
      <ul class ="products columns-<?php echo esc_attr($_columns); ?> js-grid<?php if (!$item['is_active'] || ($item['is_active'] && $item['is_lazyload'])) : ?> is-not-loaded<?php endif; ?>">
        <?php
        if ($item['is_active'] && !$item['is_lazyload']) :
          $product_args = codetot_get_product_query_by_type($block_attributes['queryType']);
          $product_args = wp_parse_args(array(
            'posts_per_page' => $block_attributes['postsPerPage'],
            'tax_query' => array(
              array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $item['category_id']
              )
              ),
              'meta_query' => array (
                array(
                  'key' => '_stock_status',
                  'value' => 'instock'
                )
              )
          ), $product_args);

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
          ?>
      </ul>
      <?php if ( !empty($display_product_category_link_button) ) : ?>
        <div class="mt-2 product-tabs__footer">
          <?php the_block('button', array(
            'class' => 'product-tabs__button',
            'atts' => ' title="' . sprintf(__('View all products in %s', 'ct-blocks'), $item['name']) . '"',
            'type' => !empty($button_style) ? $button_style : 'primary',
            'button' => esc_html__('View all products', 'ct-blocks'),
            'target' => !empty($button_target) ? esc_attr($button_target) : '_self',
            'url' => get_term_link((int) $item['category_id'], 'product_cat')
          )); ?>
        </div>
      <?php endif; ?>
      <?php the_block('loader', array(
        'class' => 'loader--dark product-tabs__loader'
      )); ?>
    </div>
  </div>
  <?php
endforeach;
$content = ob_get_clean();

the_block('default-section', array(
  'class' => $_class,
  'lazyload' => (isset($enable_lazyload) && $enable_lazyload) || !isset($enable_lazyload),
  'attributes' => ' data-ct-block="product-tabs" data-settings=\'' . json_encode($block_attributes) . '\'',
  'header' => $header,
  'content' => $content
));
