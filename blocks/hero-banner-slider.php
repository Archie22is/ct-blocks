<?php
  $slider_options = array(
    'contain'=> true,
    'prevNextButtons' => false,
    'draggable' => true,
    'wrapAround' => true,
    'autoPlay' => 5000,
    'cellAlign'=> 'left'
  );

  if($block_preset === 'preset-2') :
    $carousel_settings_nav = array(
      'wrapAround' => true,
      'pageDots' => false,
      'prevNextButtons' => false,
      'draggable' => false,
      'cellAlign'=> 'left',
      'asNavFor' => (!empty($block_preset) && $block_preset === 'preset-2') ? '.js-slider' : false
    );
  endif;

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

<?php if(!empty($navItems)) : ?>
<div class="hero-banner__slider-nav js-slider-nav" data-options='<?php echo json_encode($carousel_settings_nav); ?>'>
    <?php foreach ($navItems as $navItem) : ?>
    <div class="hero-banner__slider-nav-item">
        <p class="hero-banner__slider-nav-label"><?php echo $navItem['label']; ?></p>
        <h2 class="hero-banner__slider-nav-title"><?php echo $navItem['title']; ?></h2>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
