<?php
$container_class = codetot_site_container();
$args = array(
  'orderby' => 'menu_order',
  'order' => 'asc',
  'hide_empty' => false,
  'pad_counts' => true,
  'child_of' => 0,
);
if (!empty($select_categories)) {
  $args['include'] = $select_categories;
  $args['orderby'] = 'include';
}

$product_categories = get_terms('product_cat', $args);

$_class = 'category-grid';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($style) ? ' category-grid--' . esc_attr($style) : ' category-grid--1';
$_class .= !empty($columns) ? ' category-grid--' . $columns . '-columns' : '';

if (!empty($product_categories) && !is_wp_error($product_categories)) :
?>
  <section class="<?php echo $_class; ?>">
    <div class="<?php echo $container_class; ?> category-grid__container">
      <?php if (!empty($title)) : ?>
        <header class="category-grid__header">
          <h2 class="category-grid__title"><?php echo esc_html($title); ?></h2>
          <?php if (!empty($sub_title)) : ?>
            <div class="category-grid__sub-title"><?php echo esc_html($sub_title); ?></div>
          <?php endif; ?>
        </header>
      <?php endif; ?>
      <div class="category-grid__main">
        <div class="grid category-grid__grid">
          <?php
          foreach ($product_categories as $category) :
            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $placeholder_image = wc_placeholder_img_src();
            ?>
            <div class="category-grid__col">
              <div class="category-grid__col-inner">
                <a class="category-grid__link" href="<?php echo get_term_link($category->term_id); ?>">
                  <?php
                  if (!empty($thumbnail_id)) :
                    the_block('image', array(
                      'image' => $thumbnail_id,
                      'class' => 'image--cover category-grid__image'
                    ));
                  else :
                    echo '<picture class="image image--cover category-grid__image">';
                    printf('<img src="%1$s" width="%2$s" height="%3$s" alt="%4$s">',
                      $placeholder_image,
                      '150',
                      '150',
                      __('Placeholder image', 'woocommerce')
                    );
                    echo '</picture>';
                  endif;
                  ?>
                  <span class="category-grid__label"><?php echo $category->name; ?></span>
                </a>
              </div>
            </div>
          <?php endforeach; ?>

          <?php if (!empty($enable_button) && count($enable_button) !== 0) : ?>
            <div class="category-grid__col">
                <?php the_block('button', array(
                  'class' => 'category-grid__col-inner category-grid__button',
                  'button' => $button_text,
                  'type' => !empty($button_style) ? $button_style : '',
                  'url' => !empty($button_url) ? $button_url : '',
                  'attr' => !empty($button_attr) ? $button_attr : '',
                  'target' => !empty($target) ? $target : '',
                  'icon' => 'right-arrow'
                )); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
