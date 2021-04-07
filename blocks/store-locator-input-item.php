<?php foreach ($items as $item) : ?>
  <?php $address = $item['address'];?>
  <div class="store-locator-item js-data-location" data-title="<?php echo $item['title']; ?>" data-lat="<?php echo $address['lat'] ?>" data-lng="<?php echo $address['lng'] ?>">
    <h3 class="store-locator-item__title"><?php echo $item['title']; ?></h3>
    <p class="f store-locator-item__address"><span class="f store-locator-item__icon"><?php codetot_svg('address', true); ?></span><?php echo $address['address']; ?></p>
    <a href="tel:<?php echo $item['hotline']; ?>" class="f store-locator-item__phone"><span class="f store-locator-item__icon"><?php codetot_svg('hotline', true); ?></span><?php echo $item['hotline']; ?></a>

    <?php
    if (!empty($item['button_text'])) :
      the_block('button', array(
        'button' => $item['button_text'],
        'type' => !empty($item['button_style']) ? $item['button_style'] : false,
        'url' => !empty($item['button_url']) ? $item['button_url'] : false,
        'target' => !empty($item['target']) ? $item['target'] : false
      ));
    endif;
    ?>
  </div>
<?php endforeach; ?>
