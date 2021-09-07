<?php
$_class = 'hero-slider-sidebar';
$_class .= !empty($class) ? ' ' . $class : '';

$slider_args = array(
  'cellAlign' => 'left',
  'pageDots' => true,
  'prevNextButtons' => false,
  'lazyload' => true,
  'sync' => '.js-slider-nav',
);

$nav_slider_args = array(
  'cellAlign' => 'center',
  'pageDots' => false,
  'prevNextButtons' => false,
  'percentagePosition' => false,
  'groupCells' => true,
);

?>
<?php if(!empty($banner_left) || !empty($banner_right)) : ?>
<section class="<?php echo $_class; ?>" data-ct-block="hero-slider-sidebar" data-reveal="fade-up">
  <div class="hero-slider-sidebar__container">
    <div class="hero-slider-sidebar__grid">
      <?php if(!empty($banner_left)) : ?>
        <div class="hero-slider-sidebar__col hero-slider-sidebar__col--left">
          <div class="hero-slider-sidebar__left">
            <div class="hero-slider-sidebar__slider js-slider" data-carousel='<?php echo json_encode($slider_args); ?>'>
              <?php foreach($banner_left as $index => $item) :
                $html = get_block('image', array(
                  'image' => $item['image'],
                  'class' => 'image--cover hero-slider-sidebar__image',
                  'size' => 'full'
                ));
                ?>
                <div class="hero-slider-sidebar__slider-item <?php if ($index > 0) : echo ' is-not-loaded'; endif; ?>">
                  <?php if ($index > 0) : echo '<noscript>'; endif;
                  if(!empty($item['url'])) :
                    printf('<a class="%1$s" href="%2$s">%3$s</a>',
                      'hero-slider-sidebar__slider-url',
                      $item['url'],
                      $html
                    );
                  else :
                    echo $html;
                  endif;
                  if ($index > 0) : echo '</noscript>'; endif; ?>
                </div>
                <?php $index++; ?>
              <?php endforeach; ?>
            </div>
            <div class="hero-slider-sidebar__slider-nav js-nav-slider" data-carousel='<?php echo json_encode($nav_slider_args); ?>'>
              <?php foreach( $banner_left as $item ): ?>
                <div class="hero-slider-sidebar__nav-item">
                  <p class="hero-slider-sidebar__slider-title"><?php echo $item['title']; ?></p>
                </div>
              <?php endforeach;?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php if(!empty($banner_right)) : ?>
        <div class="hero-slider-sidebar__col hero-slider-sidebar__col--right">
          <div class="hero-slider-sidebar__right">
            <?php foreach($banner_right as $item) : ?>
              <div class="hero-slider-sidebar__right-item">
                <?php if(!empty($item['url'])) : ?>
                  <a  href="<?php echo $item['url']; ?>" class="hero-slider-sidebar__slider-url">
                <?php endif;
                  the_block('image', array(
                    'image' => $item['image'],
                    'class' => 'image--cover hero-slider-sidebar__right-image',
                    'size' => 'full'
                  ));
                if(!empty($item['url'])) : ?>
                  </a>
                <?php endif; ?>
              </div>
            <?php endforeach;?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
