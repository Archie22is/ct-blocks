<?php
$container = codetot_site_container();
$carousel_settings = array(
  'prevNextButtons' => true,
  'pageDots' => false,
);

if(!empty($product_tabs)) : ?>
  <div class="product-tabs" data-pro-block="product-tabs">
    <div class="product-tabs__inner js-tabs">
      <div class="<?php echo $container; ?> product-tabs_container">
        <div class="product-tabs__header" data-aos="fade-up">
          <ul class="f product-tabs__nav" aria-controls="product-tabs__tab" role="tablist">
            <?php $i=0; foreach ($product_tabs as $index => $product_tab) :
              $i++; ?>
              <li class="product-tabs__item" role="tab" aria-controls="<?php echo $index; ?>" aria-selected="<?php if ($index === 0) : echo 'true'; else: echo 'false'; endif; ?>"><?php echo $product_tab['title']; ?></li>
            <?php endforeach; ?>
          </ul>
          <div class="select-wrapper product-tabs__tab-select">
            <select class="product-tabs__select js-mobile">
              <?php foreach ($product_tabs as $index => $product_tab) : ?>
                <option value="<?php echo $index; ?>"><?php echo esc_html($product_tab['title']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="product-tabs__main">
          <?php  foreach ($product_tabs as $index => $product_tab) : ?>
            <div class="product-tabs__carousel" id="<?php echo $index; ?>" role="tabpanel" aria-expanded="<?php if ($index === 0) : echo 'true'; else: echo 'false'; endif; ?>">
              <div class="product-tabs__inner" data-pro-block="global-slider">
                <div class="product-tabs__grid js-slider" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>'<?php endif; ?>>
                  <?php if($product_tab['attribute'] == 'featured') :
                    foreach( $product_tab['products'] as $product ):
                    setup_postdata($product); ?>
                      <div class="product-tabs__col">
                        <?php the_block('product-card'); ?>
                      </div>
                  <?php endforeach;
                  wp_reset_postdata(); ?>
                  <?php else :
                    $product_args = codetot_get_product_query_by_type($product_tab['attribute']);
                    $product_args['posts_per_page'] = $product_tab['number'];
                    $query = new WP_Query($product_args);
                    if ($query->have_posts() ) :
                      while($query->have_posts()) : $query->the_post(); ?>
                      <div class="product-tabs__col">
                        <?php the_block('product-card'); ?>
                      </div>
                    <?php endwhile;
                    endif; wp_reset_postdata();
                  endif; ?>
                </div>
              </div>
            </div>
            <?php
            endforeach; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif;
