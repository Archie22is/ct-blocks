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
  'groupCells' => 1,
  'percentage' => true,
  'draggable' => true,
  'contain' => true,
  'cellAlign' => 'left',
  'asNavFor' => '.js-slider'
);

if (!empty($items)) : ?>
  <div class="hero-banner__slider-inner">
    <div class="hero-banner__slider js-slider" data-options='<?php echo json_encode($slider_options); ?>'>
      <?php foreach ($items as $item) :
        $no_content = !empty($item['label']) || !empty($item['title']);

        $item_class = 'hero-banner__slider-item';
        $item_class .= $no_content ? ' hero-banner__slider-item--no-content' : '';
      ?>
        <div class="<?php echo $item_class; ?>">
          <picture class="hero-banner__slider-image">
            <?php echo codetot_get_image_reponsive_html($item['image'], array(
              'disable_lazyload' => true
            )); ?>
          </picture>
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
    <?php if (!empty($nav_items)) : ?>
      <div class="hero-banner__slider-nav js-slider-nav" data-options='<?php echo json_encode($carousel_settings_nav); ?>'>
        <?php foreach ($nav_items as $nav_item) : ?>
          <div class="hero-banner__slider-nav-item">
          <?php if (!empty($nav_items['label'])) : ?>
              <p class="label-text bold-text hero-banner__slider-nav-label"><?php echo $nav_items['label']; ?></p>
            <?php endif; ?>
            <?php if (!empty($nav_items['title'])) : ?>
              <p class="hero-banner__slider-nav-title"><?php echo $nav_items['title']; ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
