<?php
$container_class = codetot_site_container();

if (!empty($query) || !empty($list)) : ?>
  <section class="product-grid<?php if (!empty($class)) : echo ' ' . $class; endif; ?>">
    <div class="<?php echo $container_class; ?> product-grid__container">
      <?php if (!empty($title)) : ?>
        <div class="product-grid__header">
          <h2 class="h2 product-grid__title"><?php echo esc_html($title); ?></h2>
        </div>
      <?php endif; ?>
      <div class="product-grid__main">
        <?php

        woocommerce_product_loop_start();

        if ($query instanceof WP_Query && $query->have_posts()) {
          while ( $query->have_posts() ) :
            $query->the_post();

            wc_get_template_part( 'content', 'product' );
          endwhile;
        }

        if (!empty($list) && is_array($list)) {
          foreach ( $list as $item ) :

            $post_object = get_post( $item->get_id() );
            setup_postdata( $GLOBALS['post'] =& $post_object );
            wc_get_template_part( 'content', 'product' );

          endforeach;
        }

        wp_reset_postdata();

        woocommerce_product_loop_end();
        ?>
      </div>
    </div>
  </section>
<?php endif; ?>
