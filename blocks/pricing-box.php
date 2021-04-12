<?php
$_class = 'pricing-box';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($style) ? ' pricing-box--' . $style : 'pricing-box--style-1';
$_class .= !empty($distinctive) ? ' pricing-box--distinctive' : '';
?>
<div class="<?php echo $_class; ?>" data-aos="fade-up">
  <?php if (!empty($title)) : ?>
    <div class="pricing-box__header">
      <h3 class="pricing-box__title"><?php echo $title; ?></h3>
    </div>
  <?php endif; ?>
  <?php if (!empty($pricing)) : ?>
    <div class="pricing-box__pricing">
      <?php echo $pricing; ?>
      <span> <?php if (!empty($unit)) :echo ' ' . $unit; endif; ?> </span>
    </div>
  <?php endif; ?>
  <?php if (!empty($items)) : ?>
    <div class="pricing-box__feature" data-aos="fade-up" data-aos-duration="800">
      <ul class="pricing-box__items">
        <?php foreach ($items as $item) : ?>
          <li class="pricing-box__item"><?php echo $item['item']; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  <?php if (!empty($button_text) && !empty($button_url)) : ?>
    <div class="align-c pricing-box__cta" data-aos="fade-up" data-aos-duration="800">
      <?php
      the_block('button', array(
        'class' => 'pricing-box__button',
        'button' => $button_text,
        'url' => $button_url
      ));
      ?>
    </div>
  <?php endif; ?>
</div>
