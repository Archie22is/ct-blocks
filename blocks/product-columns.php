<?php
$container = codetot_site_container();

$_class = 'product-columns';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($columns) ? ' product-columns--' . $columns . '-column' : '';
$_class .= !empty($header_alignment) ? ' product-columns--header-' . $header_alignment : '';
$_class .= !empty($content_alignment) ? ' product-columns--item-' . $content_alignment : '';

// Generate header
ob_start(); ?>
<?php if (!empty($title)) : ?>
  <h2 class="h2 product-columns__title"><?php echo $title; ?></h2>
  <?php if (!empty($description)) : ?>
    <div class="product-columns__description"><?php echo $description; ?></div>
  <?php endif; ?>
<?php endif; ?>
<?php
$header = ob_get_clean();


// Generate main content
ob_start();
$count = 0;
?>
  <div class="grid">
    <?php
    foreach ($items as $index => $product_columns) :
      $count++;
      $product_args = $product_columns['attribute'] !== 'featured' ? codetot_get_product_query_by_type($product_columns['attribute']) : [];

      if ($product_columns['attribute'] === 'featured' && !empty($product_columns['products'])) {
        $product_args = array(
          'post_type' => 'product',
          'post__in' => wp_list_pluck($product_columns['products'], 'ID'),
          'posts_per_page' => count($product_columns['products'])
        );
      } else {
        $product_args['posts_per_page'] = $product_columns['number'] ?? 6;
      }

      $query = new WP_Query($product_args);

      if ($query->have_posts()) :
        ?>
        <div class="grid__col product-columns__col">
          <div class="product-columns__inner">
            <div class="products product-columns__items">
              <h2 class="product-columns__item-title"><?php echo esc_html($product_columns['title']); ?></h2>
              <div class="product-columns__item-content">
                <?php
                while ($query->have_posts()) : $query->the_post();

                  ob_start();
                  wc_get_template_part('content', 'product');
                  $html = ob_get_clean();
                  $html = str_replace('<li', '<div', $html);
                  $html = str_replace('</li>', '</div>', $html);

                  echo $html;

                endwhile;
                wp_reset_postdata();
                ?>
              </div>
            </div>
          </div>
          <?php
          if ($count > 1) {
            echo '</noscript>';
          }
          ?>
        </div>
      <?php endif; endforeach; ?>
  </div>
<?php
$content = ob_get_clean();

the_block('default-section', array(
  'class' => $_class,
  'attributes' => ' data-reveal="fade-up"',
  'content' => $content,
  'header' => (!empty($title) || !empty($description)) ? $header : false,
));
