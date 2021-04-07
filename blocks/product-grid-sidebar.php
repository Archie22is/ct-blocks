<?php
$container = codetot_site_container();
$_class = 'product-grid-sidebar';

$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($block_preset) ? ' product-grid-sidebar--' . esc_attr($block_preset) : '';
$_class .= !empty($style_color) ? ' product-grid-sidebar--' . esc_attr($style_color) : '';
$_class .= !empty($layout) ? ' product-grid-sidebar--' . esc_attr($layout) : '';
$_class .= !empty($columns) ? ' product-grid-sidebar--' . esc_attr($columns) .'-column' : '';

?>

<?php if (!empty($categories)) : ?>
  <section class="<?php echo $_class; ?>" data-ct-block="product-grid-sidebar">
    <div class="<?php echo $container; ?> product-grid-sidebar__container">
      <div class="product-grid-sidebar__inner">
        <div class="f product-grid-sidebar__grid">
          <div class="product-grid-sidebar__sidebar js-sidebar-block" data-aos="fade-right">
            <?php if (!empty($block_preset) && $block_preset == 'preset-1') : ?>
              <?php if (!empty($image_left)) :
                $image_html = get_block('image', array(
                  'image' => $image_left,
                  'class' => 'image--cover product-grid-sidebar__background-image'
                ));
                ?>
                <?php if (!empty($image_link)) : ?>
                  <a class="product-grid-sidebar__image-left-link" href="<?php echo $image_link ?>">
                    <?php echo $image_html; ?>
                  </a>
                <?php else : ?>
                  <?php echo $image_html; ?>
                <?php endif; ?>
              <?php endif; ?>
            <?php else : ?>
              <div class="product-grid-sidebar__sidebar-inner">
                <?php if (!empty($title)) : ?>
                  <div class="product-grid-sidebar__header">
                    <h2 class="product-grid-sidebar__title"><?php echo $title; ?></h2>
                    <button class="product-grid-sidebar__button js-trigger"
                            aria-label="<?php _e('Open product grid sidebar items', 'codetot'); ?>">
                      <?php codetot_svg('menu', true); ?>
                    </button>
                  </div>
                <?php endif; ?>
                <div class="product-grid-sidebar__category">
                  <ul class="product-grid-sidebar__items">
                    <?php foreach ($categories as $category): ?>
                      <li class="product-grid-sidebar__item">
                        <a href="<?php echo esc_url(get_term_link($category->term_id)); ?>"
                           class="product-grid-sidebar__item-link">
                          <?php echo esc_html($category->name); ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                  <?php if (!empty($button_text) && !empty($button_url)) : ?>
                    <div class="product-grid-sidebar__cta">
                      <?php the_block('button', array(
                        'class' => 'product-grid-sidebar__read-more',
                        'button' => $button_text,
                        'url' => !empty($button_url) ? $button_url : '',
                        'target' => !empty($button_target) ? $button_target : '',
                        'type' => !empty($button_style) ? $button_style : ''
                      )); ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
          <?php if (!empty($attribute)) :
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
            } else {
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
            if ($query->have_posts()) :?>
              <div class="product-grid-sidebar__main" data-aos="fade-left">
                <div class="f product-grid-sidebar__main-inner">
                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php the_block('product-card'); ?>
                  <?php endwhile; ?>
                </div>
              </div>
            <?php endif;
            wp_reset_postdata(); endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
