<?php
$container = codetot_site_container();


$_class = 'product-tabs-slider';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($header_alignment) ? ' is-header-' . $header_alignment : '';
$_class .= !empty($footer_alignment) ? ' is-footer-' . $footer_alignment : '';
$_class .= !empty($header_alignment) ? ' product-tabs-slider--nav-' . $header_alignment : '';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : '';

$carousel_settings = array(
  'prevNextButtons' => true,
  'pageDots' => false,
);

// Generate header
ob_start(); ?>
  <?php if(!empty($label)) : ?>
      <p class="product-tabs-slider__label"><?php echo $label; ?></p>
  <?php endif; ?>
  <?php if(!empty($title)) : ?>
    <h2 class="h2 product-tabs-slider__title"><?php echo $title; ?></h2>
  <?php endif; ?>
  <?php if(!empty($description)) : ?>
    <div class="wysiwyg product-tabs-slider__description"><?php echo $description; ?></div>
  <?php endif; ?>
  <?php if (!empty($product_tabs)) : ?>
    <ul class="f product-tabs-slider__nav" aria-controls="product-tabs-slider__tab" role="tablist">
      <?php $i=0; foreach ($product_tabs as $index => $item) :
        $i++; ?>
        <li class="product-tabs-slider__item" role="tab" aria-controls="<?php echo $index; ?>" aria-selected="<?php echo var_export($index === 0, true); ?>"><?php echo $item['title']; ?></li>
      <?php endforeach; ?>
    </ul>
    <div class="select-wrapper product-tabs-slider__select-wrapper">
      <select class="product-tabs-slider__select js-mobile">
        <?php foreach ($product_tabs as $index => $item) : ?>
          <option value="<?php echo $index; ?>"><?php echo $item['title']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  <?php endif; ?>
  <?php
$header = ob_get_clean();

// Generate main content
ob_start();
$count = 0;
foreach ($product_tabs as $index => $item) :
  $count++;
  if (!empty($item['attribute'])) :
    if ($item['attribute'] == 'featured') {
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
            'terms' => $item['categories']
          ),
        ),
      );
    } else {
      $product_args = codetot_get_product_query_by_type($item['attribute']);
      $product_args['posts_per_page'] = !empty($numbers) ? $numbers : '10';;
      $product_args['tax_query'] = array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'id',
          'terms' =>  $item['categories']
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

  $query = new WP_Query($product_args);
 ?>
  <div class="product-tabs__tab-content" id="<?php echo $index; ?>" role="tabpanel" aria-expanded="<?php echo var_export($index === 0, true); ?>">
      <?php if ( $query->have_posts() ) : ?>
        <div class="product-tabs__inner">
          <?php
          if (!empty($columns)) {
            echo '<ul class ="products columns-' . esc_attr($columns) . '">';
          } else {
            woocommerce_product_loop_start();
          }

          while ( $query->have_posts() ) :
            $query->the_post();

            wc_get_template_part( 'content', 'product' );
          endwhile;
          wp_reset_postdata();

          if (!empty($columns)) {
            echo '</ul>';
          } else {
            woocommerce_product_loop_end();
          }
          ?>
        </div>
      <?php else :
        the_block('message-block', array(
          'content' => esc_html__('There is no product to display.', 'ct-blocks')
        ));
      endif; ?>
  </div>
  <?php
endforeach;
$content = ob_get_clean();

if (!empty($product_tabs)) :
the_block('default-section', array(
  'class' => $_class,
  'attributes' => ' data-ct-block="product-tabs-slider"',
  'header' => $header,
  'content' => $content,
));
endif;
