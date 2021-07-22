<?php
$container = codetot_site_container();


$_class = 'product-tabs';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($header_alignment) ? ' is-header-' . $header_alignment : '';
$_class .= !empty($footer_alignment) ? ' is-footer-' . $footer_alignment : '';
$_class .= !empty($header_alignment) ? ' product-tabs--nav-' . $header_alignment : '';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : '';

// Generate header
ob_start(); ?>
  <?php if(!empty($title)) : ?>
    <h2 class="h2 product-tabs__title"><?php echo $title; ?></h2>
  <?php endif; ?>
  <?php if (!empty($categories)) : ?>
    <ul class="f product-tabs__nav" aria-controls="product-tabs__tab" role="tablist">
      <?php $i=0; foreach ($categories as $index => $category) :
        $i++; ?>
        <li class="product-tabs__item" role="tab" aria-controls="<?php echo $index; ?>" aria-selected="<?php echo var_export($index === 0, true); ?>"><?php echo esc_html( $category->name ); ?></li>
      <?php endforeach; ?>
    </ul>
    <div class="select-wrapper product-tabs__select-wrapper">
      <select class="product-tabs__select js-mobile">
        <?php foreach ($categories as $index => $category) : ?>
          <option value="<?php echo $index; ?>"><?php echo esc_html( $category->name ); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  <?php endif; ?>
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

  $query = new WP_Query($product_args);
 ?>
  <div class="product-tabs__tab-content" id="<?php echo $index; ?>" role="tabpanel" aria-expanded="<?php echo var_export($index === 0, true); ?>">
    <noscript>
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
    </noscript>
  </div>
  <?php
endforeach;
$content = ob_get_clean();

$footer = !empty($button_text) && !empty($button_url) ?
get_block('button', array(
  'class' => 'product-tabs__button',
  'type' => !empty($button_style) ? $button_style : 'primary',
  'button' => $button_text,
  'target' => $target,
  'url' => $button_url
))
: '';

the_block('default-section', array(
  'class' => $_class,
  'attributes' => ' data-ct-block="product-tabs" data-reveal="fade-up"',
  'header' => $header,
  'content' => $content,
  'footer' => $footer
));
