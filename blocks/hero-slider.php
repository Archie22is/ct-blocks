<?php
$_class = 'hero-slider';
$_class .= !empty($block_preset) ? ' hero-slider--' . esc_attr($block_preset) : '';
$_class .= !empty($content_alignment) ? ' hero-slider--alignment-' . esc_attr($content_alignment) : ' hero-slider--alignment-left';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($previous_next_style) ? ' hero-slider--button-' . esc_attr($previous_next_style) : ' hero-slider--button-circle';
$_class .= !empty($previous_next_alignment) ? ' hero-slider--button-' . esc_attr($previous_next_alignment) : ' hero-slider--button-middle';
$_class .= !empty($page_dots_style) ? ' hero-slider--dots-' . esc_attr($page_dots_style) : ' hero-slider--dots-circle';
$_class .= !empty($page_dots_alignment) ? ' hero-slider--dots-' . esc_attr($page_dots_alignment) : ' hero-slider--dots-circle';
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
          <div
            class="hero-slider__slider js-slider" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>'<?php endif; ?>>
            <?php foreach ($items as $item) : ?>
              <div class="hero-slider__item">
                <div class="hero-slider__item-inner">
                  <picture class="image image--cover hero-slider__image js-image">
                    <?php
                    $image_alt = get_post_meta($item['image']['ID'], '_wp_attachment_image_alt', true);
                    $image_src = wp_get_attachment_image_src($item['image']['ID'], 'medium', null);
                    $image_srcset = wp_get_attachment_image_srcset($item['image']['ID'], 'full');

                    printf('<source srcset="%1$s" media="%2$s">', $image_srcset, '(min-width: 768px)');

                    if (!empty($item['image_mobile'])) {
                      $mobile_image_src = wp_get_attachment_image_src($item['image_mobile']['ID'], 'full', null);
                      $mobile_image_alt = get_post_meta($item['image_mobile']['ID'], '_wp_attachment_image_alt', true);

                      printf('<img src="%1$s" alt="%2$s" width="%3$s" height="%4$s" class="%5$s">',
                        $mobile_image_src[0],
                        $mobile_image_alt,
                        $mobile_image_src[1],
                        $mobile_image_src[2],
                        'image__img'
                      );
                    } else {
                      printf('<img src="%1$s" alt="%2$s" width="%3$s" height="%4$s" class="%5$s">',
                        $image_src[0],
                        $image_alt,
                        $image_src[1],
                        $image_src[2],
                        'image__img'
                      );
                    }
                    ?>
                  </picture>
                  <?php if (!empty($overlay)) : ?>
                    <div class="hero-slider__overlay"
                         style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
                  <?php endif; ?>
                  <?php if (!empty($item['description']) || !empty($item['title'])) : ?>
                    <div class="hero-slider__content js-content">
                      <div class="container hero-slider__container">
                        <div class="hero-slider__box" data-aos="fade-up">
                          <?php if (!empty($item['label'])) : ?>
                            <p
                              class="label-text bold-text hero-slider__label"><?php echo esc_html($item['label']); ?></p>
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
