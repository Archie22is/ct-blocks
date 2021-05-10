<?php
$container = codetot_site_container();


$_class = 'product-tabs';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($header_alignment) ? ' is-header-' . $header_alignment : '';
$_class .= !empty($header_alignment) ? ' product-tabs--nav-' . $header_alignment : '';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : '';

// Generate header
ob_start(); ?>
<?php if(!empty($title)) : ?>
  <h2 class="h2 product-tabs__title"><?php echo $title; ?></h2>
<?php endif; ?>
<ul class="f product-tabs__nav" aria-controls="product-tabs__tab" role="tablist">
  <?php $i=0; foreach ($categories as $index => $category) :
    $i++; ?>
    <li class="product-tabs__item" role="tab" aria-controls="<?php echo $index; ?>" aria-selected="<?php if ($index === 0) : echo 'true'; else: echo 'false'; endif; ?>"><?php echo esc_html( $category->name ); ?></li>
  <?php endforeach; ?>
</ul>
<div class="select-wrapper product-tabs__select-wrapper">
  <select class="product-tabs__select js-mobile">
    <?php foreach ($categories as $index => $category) : ?>
      <option value="<?php echo $index; ?>"><?php echo esc_html( $category->name ); ?></option>
    <?php endforeach; ?>
  </select>
</div>
<?php
$header = ob_get_clean();

// Generate main content
ob_start();
$count = 0;
foreach ($categories as $index => $category) :
  $count++;
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
            'terms' => $category->term_id
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
          'terms' => $category->term_id
        )
      );
      $product_args['meta_query'] = array (
        array(
          'key' => '_stock_status',
          'value' => 'instock'
        )
      );
    }
  endif;
 ?>
  <div class="product-tabs__tab-content" id="<?php echo $index; ?>" role="tabpanel" aria-expanded="<?php if ($index === 0) : echo 'true'; else: echo 'false'; endif; ?>">
    <?php
      $query = new WP_Query($product_args);
      if ( $query->have_posts() ) : ?>
      <div class="product-tabs__inner">
        <div class="products grid product-tabs__grid">
          <?php
          while ($query->have_posts())  : $query->the_post();
            echo '<div class="grid__col default-section__col product-tabs__col">';
              the_block('product-card');
            echo '</div>';
          endwhile; wp_reset_postdata();
          ?>
        </div>
      </div>
    <?php
    else :
      the_block('message-block', array(
        'content' => esc_html__('There is no product to display.', 'ct-blocks')
      ));
    endif;
    ?>
  </div>
  <?php
endforeach;
$content = ob_get_clean();

the_block('default-section', array(
  'class' => $_class,
  'attributes' => ' data-ct-block="product-tabs"',
  'header' => $header,
  'content' => $content
));
