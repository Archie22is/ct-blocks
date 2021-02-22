<?php

$_class = 'image-banner';
$_class .= !empty($class) ? ' ' . $class : '';
if (!empty($image)) :
  ob_start();
  printf('<div class="image-banner__wrapper">%s</div>', get_block('image', array(
    'image' => $image,
    'class' => 'image--cover image-banner__image',
    'lazyload' => false
  )));
  printf('<div class="image-banner__content"><div class="image-banner__inner">%s</div></div>', $content);
  $_content = ob_get_clean();
  if (!empty($_content)) :
  ?>
    <?php if (!empty($url)) :
      $_class .= ' image-banner--has-link';
      ?>
      <a class="<?php echo $_class; ?>" href="<?php echo $url; ?>">
        <?php echo $_content; ?>
      </a>
    <?php else : ?>
      <div class="<?php echo $_class; ?>">
        <?php echo $_content; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>
