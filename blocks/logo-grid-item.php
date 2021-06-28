<?php

$_class = 'f logo-grid__item';
$_class .=  empty($item['url']) ? ' fdc logo-grid__item--no-link' : '';
$_class .= !empty($class) ? ' ' . $class : '';

$_enable_slider = isset($enable_slider) && $enable_slider ?? false;
$url = !empty($item['url']) ? $item['url'] : '';
$target = !empty($item['target']) ? $item['target'] : '_self';

// Build markup with slider enable
ob_start();
?>
  <?php
  the_block('image', array(
    'class' => 'w100 image--default image--contain logo-grid__image',
    'image' => $item['image']
  ));
  ?>
  <?php if(!empty($item['title'])) : ?>
    <p class="pt-05 logo-grid__item-title"><?php echo $item['title']; ?></p>
  <?php endif; ?>
<?php $item_content_html = ob_get_clean(); ?>

<div class="<?php echo $_class; ?>">
  <?php if (empty($url)) :
    echo $item_content_html;
  else :
    printf('<a class="%1$s" href="%2$s" target="%3$s" rel="noreferrer">%4$s</a>',
    'f fdc logo-grid__link',
    $url,
    $target,
    $item_content_html
  );
  endif;
  ?>
</div>
