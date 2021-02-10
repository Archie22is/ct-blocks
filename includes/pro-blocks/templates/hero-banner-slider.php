<?php
$slider_options = array(
  'cellAlign' => 'left',
  'contain'=> true,
  'prevNextButtons' => false
);

if (!empty($items)) : ?>
  <div class="hero-banner__slider js-slider" data-options='<?php echo json_encode($slider_options); ?>'>
    <?php foreach ($items as $item) : ?>
      <div class="hero-banner__slider-item">
        <?php the_block('image', array(
          'image' => $item['image'],
          'lazyload' => false,
          'class' => 'image--cover hero-banner__slider-image'
        )); ?>
        <div class="hero-banner__slider-content">
          <div class="hero-banner__slide__inner">
            <p class="label-text hero-banner__slider-label"><?php echo $item['label']; ?></p>
            <h2 class="hero-banner__slider-title"><?php echo $item['title']; ?></h2>
            <?php if (!empty($item['button_text']) && !empty($item['button_url'])) : ?>
              <div class="hero-banner__slider-footer">
                <?php the_block('button', array(
                  'button' => $item['button_text'],
                  'url' => $item['button_url'],
                  'type' => 'primary',
                  'class' => 'hero-banner__slider-button'
                )); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
