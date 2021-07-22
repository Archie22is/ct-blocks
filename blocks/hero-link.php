<?php
$_class = 'hero-link';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($block_preset) ? ' hero-link--style-' . esc_attr($block_preset) : '';
$_class .= !empty($enable_prev_next_buttons) ? ' hero-link--button-' . esc_attr($previous_next_style) : ' hero-slider--button-circle';
$_class .= !empty($enable_page_dots) ? ' hero-link--dots-' . esc_attr($page_dots_style) : ' hero-slider--dots-circle';

$id = !empty($anchor_name) ? $anchor_name : '';
$carousel_settings = array(
  'prevNextButtons' => !empty($enable_prev_next_buttons) ? true : false,
  'pageDots' => !empty($enable_page_dots) ? true : false,
  'cellAlign' => 'center',
  'groupCells' => 1,
  'wrapAround' => true,
  'autoPlay' => 3500,
);

if(!empty($items)) : ?>
<div class="<?php echo $_class;?>" <?php if(!empty($id)) : ?> id="<?php echo $id; ?>"<?php endif; ?> data-ct-block="hero-link" data-reveal="fade-up">
  <div class="hero-link__inner">
    <div class="hero-link__slider js-slider" <?php if (!empty($carousel_settings)) : ?> data-options='<?= json_encode($carousel_settings); ?>' <?php endif; ?>>
      <?php foreach($items as $key => $item) : ?>
        <div class="hero-link__item<?php if ($key > 0) : ?> is-not-loaded<?php endif; ?>">
          <?php if ($key > 0) : ?><noscript><?php endif; ?>
            <div class="hero-link__item-inner">
              <?php
              if($item['url']) {
                echo '<a class="hero-link__url" href="'.$item['url'].'">';
              }
                the_block('image', array(
                  'image' => $item['image']['ID'],
                  'class' => 'image--cover hero-link__image js-image',
                  'lazyload' => false,
                  'size' => 'large'
                ));
              if($item['url']) {
                echo '</a>';
              }
              ?>
            </div>
          <?php if ($key > 0) : ?></noscript><?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif;
