<?php
$container = codetot_site_container();
$is_full_screen = !empty($enable_full_screen_layout) ? ' image-row--full-screen' : '';

$_class = 'image-row';
$_class .= !empty($block_preset) ? ' image-row--' . esc_attr($block_preset) : '';
$_class .= !empty($columns) ? ' image-row--' . count($columns) . '-columns' : '';
$_class .= !empty($space_between) ? ' image-row--space-between' : '';
$_class .= !empty($image_zoom) ? ' image-row--image-zoom' : '';
$_class .= !empty($enable_slideshow) ? ' image-row--has-slider' : '';

if (!empty($enable_slideshow)) :
  $carousel_settings = array(
    'contain' => true,
    'cellAlign' => 'center',
    'pageDots' => false,
    'prevNextButtons' => true,
    'groupCells' => true,
    'percentagePosition' => true,
    'draggable' => true
  );
endif;
?>
<div class="<?php echo $_class; ?> <?php if (!empty($is_full_screen)) : echo $is_full_screen; endif; ?>"
     data-aos="fade-up" <?php echo !empty($enable_slideshow) ? 'data-ct-block="image-row"' : ''; ?>>
  <div class="<?php echo $container; ?> image-row__container">
    <div class="image-row__wrapper">
      <div class="grid image-row__grid">
        <?php if (!empty($enable_slideshow)) : ?>
        <div class="image-row__slider js-slider" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>'<?php endif; ?> style="width: 100%">
        <?php endif; ?>

          <?php foreach ($columns as $key => $column) : ?>
            <div class="grid__col image-row__col image-row__col--<?php echo $column['column_width']; ?>">
              <a class="image-row__link fancybox"
                 href="<?php echo (!empty($image_zoom)) ? esc_url($column['image']['url']) : (!empty($column['url']) ? $column['url'] : 'javascript:void(0)'); ?>" <?php echo (!empty($image_zoom)) ? 'data-fancybox="img"' : '' ?>>
                <?php the_block('image', array(
                  'image' => $column['image']['ID'],
                  'class' => 'image--cover image-row__image js-image'
                )); ?>
                <?php if (!empty($image_zoom)) : ?>
                  <?php codetot_svg('zoom', true); ?>
                <?php endif; ?>
              </a>
            </div>
          <?php endforeach; ?>

        <?php if (!empty($enable_slideshow)) : ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
