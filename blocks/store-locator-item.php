<div class="store-locator-item <?php echo $class; ?>" data-title="<?php echo $item['title']; ?>" data-lat="<?php echo $item['lat']; ?>" data-lng="<?php echo $item['lng']; ?>">
  <h3 class="store-locator-item__title"><?php echo $item['title']; ?></h3>
  <p class="f store-locator-item__address"><span class="f"><?php codetot_svg('address', true); ?></span><?php echo $item['address']; ?></p>
  <a href="tel:<?php echo $item['phone']; ?>" class="f store-locator-item__phone"><span class="f"><?php codetot_svg('hotline', true); ?></span><?php echo $item['phone']; ?></a>
</div>
