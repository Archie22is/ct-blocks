<?php if (!empty($category) && is_object($category)) :
  $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
  $placeholder_image = wc_placeholder_img_src();
  ?>
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
        printf(
          '<img src="%1$s" width="%2$s" height="%3$s" alt="%4$s">',
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
<?php endif; ?>
