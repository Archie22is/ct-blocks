<?php
$container = codetot_site_container();

$carousel_settings = array(
  'contain' => true,
  'cellAlign' => 'left',
  'draggable' => false,
  'resize' => true,
  'groupCells' => true,
  'pageDots' => false
);


$_class = 'product-tabs';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($tabs_alignment) ? ' is-header-' . $tabs_alignment : '';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : '';

// Generate header
ob_start(); ?>
<?php if(!empty($title)) : ?>
  <h2 class="h2 product-tabs__title"><?php echo $title; ?></h2>
<?php endif; ?>
<ul class="f product-tabs__nav" aria-controls="product-tabs__tab" role="tablist">
  <?php $i=0; foreach ($items as $index => $product_tab) :
    $i++; ?>
    <li class="product-tabs__item" role="tab" aria-controls="<?php echo $index; ?>" aria-selected="<?php if ($index === 0) : echo 'true'; else: echo 'false'; endif; ?>"><?php echo $product_tab['title']; ?></li>
  <?php endforeach; ?>
</ul>
<div class="select-wrapper product-tabs__select-wrapper">
  <select class="product-tabs__select js-mobile">
    <?php foreach ($items as $index => $product_tab) : ?>
      <option value="<?php echo $index; ?>"><?php echo esc_html($product_tab['title']); ?></option>
    <?php endforeach; ?>
  </select>
</div>
<?php
$header = ob_get_clean();

// Generate main content
ob_start();
$count = 0;
foreach ($items as $index => $product_tab) :
  $count++;
  $product_args = $product_tab['attribute'] !== 'featured' ? codetot_get_product_query_by_type($product_tab['attribute']) : [];

  if ($product_tab['attribute'] === 'featured' && !empty($product_tab['products'])) {
    $product_args = array(
      'post_type' => 'product',
      'post__in' => wp_list_pluck($product_tab['products'], 'ID'),
      'posts_per_page' => count($product_tab['products'])
    );
  } else {
    $product_args['posts_per_page'] = $product_tab['number'] ?? 6;
  }

  $query = new WP_Query($product_args);

  if ( $query->have_posts() ) :
  ?>
  <div class="product-tabs__tab-content" id="<?php echo $index; ?>" role="tabpanel" aria-expanded="<?php if ($index === 0) : echo 'true'; else: echo 'false'; endif; ?>">
    <?php
    if ($count > 1) {
      echo '<noscript>';
    }
    ?>
    <div class="product-tabs__inner">
        <div class="products product-tabs__slider js-slider" data-carousel='<?php echo json_encode($carousel_settings); ?>'>
        <?php
        while ( $query->have_posts() ) : $query->the_post();

          ob_start();
          wc_get_template_part( 'content', 'product' );
          $html = ob_get_clean();
          $html = str_replace('<li', '<div', $html);
          $html = str_replace('</li>', '</div>', $html);

          echo $html;

        endwhile;
        wp_reset_postdata();
        ?>
      </div>
    </div>
    <?php
    if ($count > 1) {
      echo '</noscript>';
    }
    ?>
  </div>
  <?php endif; endforeach; ?>
<?php
$content = ob_get_clean();

the_block('default-section', array(
  'class' => $_class,
  'attributes' => ' data-child-block="product-tabs"',
  'header' => $header,
  'content' => $content
));
