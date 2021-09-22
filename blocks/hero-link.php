<?php
$_class = 'hero-link';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($block_preset) ? ' hero-link--style-' . esc_attr($block_preset) : '';
$_class .= !empty($enable_prev_next_buttons) ? ' hero-link--button-' . esc_attr($previous_next_style) : ' hero-slider--button-circle';
$_class .= !empty($enable_page_dots) ? ' hero-link--dots-' . esc_attr($page_dots_style) : ' hero-slider--dots-circle';

$id = !empty($anchor_name) ? $anchor_name : '';
$carousel_settings = array(
  'prevNextButtons' => !empty($enable_prev_next_buttons),
  'pageDots' => !empty($enable_page_dots),
  'cellAlign' => 'center',
  'contain' => true,
  'groupCells' => 1,
  'wrapAround' => true,
  'autoPlay' => !empty($slider_autoplay) ? (int) $slider_autoplay * 1000 : false
);

if(!empty($items)) : ?>
<div class="<?php echo $_class;?>" <?php if(!empty($id)) : ?> id="<?php echo $id; ?>"<?php endif; ?> data-ct-block="hero-link" data-reveal="fade-up">
  <div class="hero-link__inner">
    <div class="hero-link__slider js-slider"  <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>' <?php endif; ?>>
      <?php foreach($items as $key => $item) : ?>
        <div class="hero-link__item<?php if ($key > 0) : ?> is-not-loaded<?php endif; ?>">
          <?php if ($key > 0) : ?><noscript><?php endif; ?>
            <div class="hero-link__item-inner">
              <?php
              $image_html = get_block('image', array(
                'image' => $item['image']['ID'],
                'class' => 'image--cover hero-link__image js-image',
                'lazyload' => false,
                'size' => wp_is_mobile() ? 'medium' : 'full'
              ));

              if( !empty($item['url']) ) {
                printf('<a class="hero-link__url" href="%1$s" target="%2$s">%3$s</a>', $item['url'], $item['button_target'], $image_html);
              } else {
                echo $image_html;
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
