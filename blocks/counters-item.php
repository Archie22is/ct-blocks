<?php
// var_dump($item);
$media_class = 'icon-type--'.$item['icon_type'];

if (!empty($item)): ?>
  <div class="f fdc counters-item <?php echo $class; ?>">
    <?php if (!empty($item['icon_svg']) || !empty($item['icon_image'])) : ?>
      <div class="mb-05 counters__wrapper <?php echo $media_class; ?>">
        <?php if ($item['icon_type'] === 'svg' && !empty($item['icon_svg']) ) : ?>
          <span class="counters__svg" aria-hidden="true"><?php echo $item['icon_svg']; ?></span>
        <?php elseif ($item['icon_type'] === 'image' && !empty($item['icon_image'])) :
          the_block('image', array(
            'image' => $item['icon_image'],
            'size' => 'medium',
            'class' => 'image--contain image--square counters__image'
          ));
        endif; ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($item['count'])) : ?>
      <p class="counters__count">
        <span class="h3 counters__count-number js-counter"><?php echo $item['count']; ?></span>
        <?php if (!empty($item['unit'])) : ?>
          <span class="counters__unit"><?php echo $item['unit']; ?></span>
        <?php endif; ?>
      </p>
    <?php endif; ?>
    <div class="counters__content">
      <?php if (!empty($item['title'])) : ?>
        <p class="bold-text counters__item-title"><?php echo $item['title']; ?></p>
      <?php endif; ?>
      <?php if (!empty($item['description'])) : ?>
        <p class="counters__item-description"><?php echo $item['description']; ?></p>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>
