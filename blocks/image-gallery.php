<?php
$_class = 'image-gallery section';
$_class .= !empty($style) ? ' image-gallery--' . esc_attr($style) : '';
$_class .= !empty($items) ? ' image-gallery--' . count($items) . '-items' : '';
$container = codetot_site_container();
?>
<?php if(!empty($items)) : ?>
  <div class="<?php echo $_class; ?>" data-reveal="fade-up">
    <div class="<?php echo $container; ?> image-gallery__container">
      <div class="image-gallery__main">
        <div class="image-gallery__items">
          <?php foreach ($items as $item) :
            // Build html
            ob_start(); ?>
            <?php the_block('image', array(
              'image' => $item['image'],
              'class' => 'image--cover image-gallery__item__image'
            )); ?>
            <?php if(!empty($item['title']) || !empty($item['description'])) : ?>
            <div class="image-gallery__content">
              <?php if(!empty($item['title'])) : ?>
                <p class="label-text image-gallery__label"><?php echo $item['title']; ?></p>
              <?php endif; ?>
              <?php if(!empty($item['description'])) : ?>
                <h3 class="h3 image-gallery__title"><?php echo $item['description']; ?></h3>
              <?php endif; ?>
            </div>
          <?php endif; ?>
            <?php $item_html = ob_get_clean();
            if ($item['button_text'] && !empty($item['button_url'])) : ?>
            <div class="image-gallery__item image-gallery__item--has-link">
              <?php echo $item_html; ?>
              <div class="image-gallery__footer">
                <?php the_block('button', array(
                  'button' => esc_html($item['button_text']),
                  'type' => 'outline-white',
                  'class' => 'image-gallery__button'
                )); ?>
              </div>
              <a class="image-gallery__item-link" href="<?php echo $item['button_url']; ?>"></a>
            </div>
            <?php else : ?>
              <div class="image-gallery__item">
                <?php echo $item_html; ?>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
