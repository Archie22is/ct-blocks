<?php
$_no_lazyload = isset($lazyload) && $lazyload ? $lazyload : false;

if (!empty($image) && !empty($class)) :
  $image_id = false;


  if (!empty($image['ID'])) {
    $image_id = $image['ID'];
  } elseif (is_int( (int) $image_id)) {
    $image_id = $image;
  } else {
    echo '<-- Undefined image -->';
  }
  ?>
  <picture class="image <?php echo $class; ?>">
    <?php
    if (!$_no_lazyload) {
      ob_start();
      echo wp_get_attachment_image($image_id, 'full', null, array(
        'class' => 'image__img lazyload'
      ));
      $image_html = ob_get_clean();
      $image_html = str_replace('src="', 'data-sizes="auto" data-src="', $image_html);
      $image_html = str_replace('srcset="', 'data-srcset="', $image_html);
      echo $image_html;
    } else {
      $mobile_image = wp_get_attachment_image_src($image_id, 'medium', null);
      $large_image = wp_get_attachment_image_src($image_id, 'large', null);
      $desktop_image = wp_get_attachment_image_src($image_id, 'full', null);

      if (!empty($large_image)) {
        printf('<source srcset="%1$s" media="(min-width: 768px)">', $large_image[0]);
      }

      if (!empty($desktop_image)) {
        printf('<source srcset="%s" media="(min-width: 1280px)">', $desktop_image[0]);
      }

      printf('<img class="image__img" src="%1$s" width="%2$s" height="%3$s" alt="%4$s">',
        $mobile_image[0],
        !empty($mobile_image[1]) ? esc_attr($mobile_image[1]) : 360,
        !empty($mobile_image[2]) ? esc_attr($mobile_image[2]) : 180,
        !empty($mobile_image[3]) ? esc_attr($mobile_image[3]) : 'Image'
      );
    }
    ?>
  </picture>
<?php endif; ?>
