<?php
$_class = 'guarantee-card';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($layout) ? ' guarantee-card--' . esc_attr($layout) : '';
$_class .= !empty($alignment) ? ' guarantee-card--' . esc_attr($alignment): '';
?>
<?php if (!empty($title) || !empty($description) || !empty($icon)) : ?>
<div class="<?php echo $_class; ?>">
  <div class="guarantee-card__wrapper">
    <?php if ($type === 'svg') : ?>
      <span class="guarantee-card__svg" aria-hidden="true"><?php echo $icon; ?></span>
    <?php elseif ($type === 'image' && !empty($icon)) :
      the_block('image', array(
        'image' => $icon,
        'class' => 'image--contain guarantee-card__image'
      ));
    endif; ?>
  </div>
  <?php if (!empty($title) || !empty($description)) : ?>
  <div class="guarantee-card__content">
    <?php if (!empty($title)) : ?>
    <p class="label-text bold-text uppercase-text guarantee-card__title"><?php echo $title; ?></p>
    <?php endif; ?>
    <?php if (!empty($description)) : ?>
      <div class="small-text guarantee-card__description"><?php echo $description; ?></div>
    <?php endif; ?>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>
