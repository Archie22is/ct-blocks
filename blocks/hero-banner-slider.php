<?php

$slider_options = array(
  'contain' => true,
  'prevNextButtons' => false,
  'draggable' => true,
  'cellAlign' => 'left'
);

$carousel_settings_nav = array(
  'pageDots' => false,
  'prevNextButtons' => false,
  'percentage' => true,
  'draggable' => false,
  'cellAlign' => 'left',
  'asNavFor' => '.js-slider'
);

if (!empty($items)) : ?>
  <div class="hero-banner__slider-inner">
    <div class="hero-banner__slider js-slider" data-options='<?php echo json_encode($slider_options); ?>'>
      <?php foreach ($items as $item) :
        $no_content = !empty($item['label']) || !empty($item['title']);
      ?>
        <div class="hero-banner__slider-item<?php if ($no_content) : echo ' hero-banner__slider-item--no-content';
                                            endif; ?>">
          <?php the_block('image', array(
            'image' => $item['image'],
            'lazyload' => false,
            'class' => 'image--cover hero-banner__slider-image'
          )); ?>
          <?php if (!empty($item['label']) || !empty($item['title'])) : ?>
            <div class="hero-banner__slider-content">
              <div class="hero-banner__slide__inner">
                <p class="label-text hero-banner__slider-label"><?php echo $item['label']; ?></p>
                <p class="hero-banner__slider-title"><?php echo $item['title']; ?></p>
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
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <?php if (!empty($navItems)) : ?>
      <div class="hero-banner__slider-nav js-slider-nav" data-options='<?php echo json_encode($carousel_settings_nav); ?>'>
        <?php foreach ($navItems as $navItem) : ?>
          <div class="hero-banner__slider-nav-item">
            <p class="label-text bold-text hero-banner__slider-nav-label"><?php echo $navItem['label']; ?></p>
            <p class="hero-banner__slider-nav-title"><?php echo $navItem['title']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
