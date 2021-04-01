<div class="image-banner<?php if (!empty($class)) : echo ' ' . $class; endif; ?>">
  <?php if (!empty($url)) : ?>
    <a class="image-banner__link" href="<?php echo $url; ?>" title="<?php _e('Open a link', 'codetot'); ?>"></a>
  <?php endif; ?>
  <?php if (!empty($image)) : ?>
    <picture class="image image--cover image-banner__image">
      <?php
      if (is_array($image)) {
        $image = $image['ID'];
      }
      $mobile_image = wp_get_attachment_image_src($image, 'medium', null);
      $desktop_image = wp_get_attachment_image_src($image, 'full', null);
      printf('<source srcset="%1$s" media="(min-width: 376px)">', $desktop_image[0]);
      printf('<img class="image__img" src="%1$s" width="%2$s" height="%3$s" alt="%4$s">',
        $mobile_image[0],
        $mobile_image[1],
        $mobile_image[2],
        ''
      );
      ?>
    </picture>
  <?php endif; ?>
</div>
