<?php
$_class = 'hero-slider';
$_class .= !empty($block_preset) ? ' hero-slider--' . esc_attr($block_preset) : '';
$_class .= !empty($content_alignment) ? ' hero-slider--alignment-' . esc_attr($content_alignment) : ' hero-slider--alignment-left';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($previous_next_style) ? ' hero-slider--button-' . esc_attr($previous_next_style) : ' hero-slider--button-circle';
$_class .= !empty($page_dots_style) ? ' hero-slider--dots-' . esc_attr($page_dots_style) : ' hero-slider--dots-circle';
$_class .= !empty($overlay) ? ' hero-slider--overlay' : '';

$carousel_settings = array(
  'prevNextButtons' => !empty($enable_prev_next_buttons),
  'pageDots' => !empty($enable_page_dots),
  'cellAlign' => 'center',
  'pauseAutoPlayOnHover' => true,
  'groupCells' => 1
);
?>

<?php if (!empty($items)) : ?>
  <section class="<?php echo $_class; ?>" data-ct-block="hero-slider">
    <div class="hero-slider__wrapper">
      <div class="align-c hero-slider__inner">
        <?php if (!empty($items)) : ?>
          <div class="hero-slider__slider js-slider" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>' <?php endif; ?>>
            <?php foreach ($items as $item) : ?>
              <div class="hero-slider__item">
                <div class="hero-slider__item-inner">
                  <picture class="image image--cover hero-slider__image js-image">
                    <?php
                    $image = !empty($item['image']) ? $item['image'] : [];
                    $mobile_image = !empty($item['image_mobile']) ? $item['image_mobile'] : [];

                    echo codetot_get_image_reponsive_html($image, array(
                      'disable_lazyload' => true,
                      'mobile_image' => $mobile_image,
                    ));
                    ?>
                  </picture>
                  <?php if (!empty($overlay)) : ?>
                    <div class="hero-slider__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
                  <?php endif; ?>
                  <?php if (!empty($item['description']) || !empty($item['title'])) : ?>
                    <div class="hero-slider__content js-content">
                      <div class="container hero-slider__container">
                        <div class="hero-slider__box">
                          <?php if (!empty($item['label'])) : ?>
                            <p class="label-text bold-text hero-slider__label"><?php echo esc_html($item['label']); ?></p>
                          <?php endif; ?>
                          <?php if (!empty($item['title'])) : ?>
                            <h1 class="h1 hero-slider__title"><?php echo esc_html($item['title']); ?></h1>
                          <?php endif; ?>
                          <?php if (!empty($item['description'])) : ?>
                            <div class="wysiwyg hero-slider__description"><?php echo $item['description'] ?></div>
                          <?php endif; ?>
                          <?php if (!empty($item['buttons'])) : ?>
                            <div class="hero-slider__footer">
                              <?php the_block('button-group', array(
                                'buttons' => $item['buttons'],
                                'class' => 'hero-slider__button-group'
                              )); ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
