<div class="image-placeholder<?php if (!empty($class)) : echo ' ' . $class; endif; ?>">
  <?php
  if (!empty($logo)) :
    the_block('image', array(
      'image' => $logo['ID'],
      'class' => 'image-placeholder__image',
      'size' => 'full'
    ));
  else :
    echo '<div class="image-placeholder__icon">';
    codetot_svg('default-logo', true);
    echo '</div>';
  endif;
  ?>
</div>
