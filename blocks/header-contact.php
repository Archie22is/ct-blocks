<?php
$items = codetot_get_contact_info();

if(!empty($items)) : ?>
  <ul class="header-contact">
    <?php foreach ( $items as $item ) : ?>
      <li class="header-contact__item">
        <span class="header-contact__icon"><?php codetot_svg($item['type']);; ?></span>
        <span class="header-contact__content"><?php echo $item['url'] ?></span>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
