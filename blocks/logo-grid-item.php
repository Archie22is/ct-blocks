<?php
$_enable_slider = isset($enable_slider) && $enable_slider ?? false;
// var_dump($_enable_slider);
// Build markup with slider enable
ob_start();
?>

<figure class="logo-grid__image-slider-wrapper">
  <?php
  ob_start();
  echo wp_get_attachment_image($item['image']['ID'], 'full', null, array(
    'class' => 'logo-grid__image-slider lazyload js-image'
  ));
  $image_html = ob_get_clean();
  $image_html = str_replace('src=""', 'data-sizes="auto" data-src="', $image_html);
  $image_html = str_replace('srcset="', 'data-srcset="', $image_html);

  echo $image_html;
  ?>
</figure>

<?php $item_content = ob_get_clean(); ?>

<?php if(!empty($item['title'])) : ?>
  <h3 class="logo-grid__item-title"><?php echo $item['title']; ?></h3>
<?php endif; ?>

<?php if ($_enable_slider) :
  echo $item_content;
else :
  $url = !empty($item['url']) ? $item['url'] : '#';
  $target = !empty($item['target']) ? $item['target'] : '_self';

  echo '<a href="'. $url .'" target="' . $target . '">';
  the_block('image', array(
    'class' => 'image--contain logo-grid__image',
    'size' => 'logo',
    'image' => $item['image']
  ));
  echo '</a>';
endif; ?>

