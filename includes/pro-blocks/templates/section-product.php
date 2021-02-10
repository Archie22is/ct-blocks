<?php
$container = codetot_site_container();
$_class = 'section-product';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($columns) ? ' section-product--' . esc_attr($columns) .'-column' : '';
$_class .= !empty($section_align) ? ' section-product--align-' . esc_attr($section_align) : '';
if (!empty($categories)) :
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
        )
      );
    }
    else {
      $product_args = codetot_get_product_query_by_type($attribute);
      $product_args['posts_per_page'] = !empty($numbers) ? $numbers : '10';;
      $product_args['tax_query'] = array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'id',
          'terms' => wp_list_pluck($categories, 'term_id')
        )
      );
    }
    $query = new WP_Query($product_args);
  endif;
endif;
if ($query->have_posts()) :?>
  <section class="<?php echo $_class; ?>">
    <div class="<?php echo $container; ?> section-product__container">
      <?php if (!empty($title)) : ?>
      <div class="section-product__header">
        <h2 class="section-product__title"><?php echo $title ?></h2>
      </div>
      <?php endif; ?>
      <div class="section-product__main">
        <div class="grid section-product__grid">
          <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="grid__col section-product__col">
              <?php the_block('product-card'); ?>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
      <?php if (!empty($button_text) && !empty($button_url)) : ?>
        <div class="mt-1 section-product__footer">
          <?php the_block('button', array(
            'class' => 'section-product__read-more',
            'button' => $button_text,
            'url' => !empty($button_url) ? $button_url : '',
            'target' => !empty($target) ? $target : '',
            'type' => !empty($button_style) ? $button_style : ''
          )); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php wp_reset_postdata(); endif; ?>
