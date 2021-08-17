<?php if (!empty($category) && is_object($category)) :
  $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
  $placeholder_image = wc_placeholder_img_src();
  $_image_class = !empty($image_size) ? 'image--' . esc_html($image_size) : ' image--cover';
  $_image_class .= !empty($image_size) && $image_size !== 'default' ? ' image--hd' : '';
  ?>
  <div class="category-grid__item">
    <a class="category-grid__link" href="<?php echo get_term_link($category->term_id); ?>" title="<?php printf('View %s', $category->name); ?>">
      <?php
      if (!empty($thumbnail_id)) :
        the_block('image', array(
          'image' => $thumbnail_id,
          'class' => sprintf('%s category-grid__image', $_image_class)
        ));
      else :
        the_block('image-placeholder', array(
          'class' => 'category-grid__placeholder-image'
        ));
      endif;
      ?>
      <span class="d-block category-grid__label"><span class="category-grid__label__text"><?php echo $category->name; ?></span></span>
    </a>
  </div>
<?php endif; ?>
