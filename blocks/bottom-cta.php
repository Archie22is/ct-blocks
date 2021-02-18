<?php
$_class = 'section-bg bottom-cta';
$_class .= !empty($block_preset) ? ' bottom-cta--style-' . esc_attr($block_preset) : '';
$_class .= !empty($overlay) ? ' bottom-cta--has-overlay' : '';
$_class .= !empty($background_contract) ? ' bottom-cta--' . esc_attr($background_contract) : '';
$_class .= !empty($background_type) ? ' bg-' . esc_attr($background_type) : '';
$_class .= !empty($content_position) ? ' bottom-cta--' . esc_attr($content_position) : '';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

if (!empty($title)) : ?>
  <div class="rel <?php echo $_class; ?>">
    <div class="rel z-2 bottom-cta__wrapper">
      <div class="container bottom-cta__container">
        <div class="align-c bottom-cta__inner">
          <?php echo ($block_preset === 'preset-1') ? '<div class="bottom-cta__box">' : '' ?>
          <?php if (!empty($label)) : ?>
            <p class="label-text bottom-cta__label" data-aos="fade-up"><?php echo $label; ?></p>
          <?php endif; ?>
          <h2 class="h2 bottom-cta__title" data-aos="fade-up"><?php echo $title; ?></h2>
          <p class="bottom-cta__description" data-aos="fade-up"><?php echo $description; ?></p>
          <?php echo ($block_preset === 'preset-1') ? '</div>' : '' ?>
          <?php if (!empty($buttons)) : ?>
            <div class="bottom-cta__footer" data-aos="fade-up">
              <?php foreach ($buttons as $button) :
                the_block('button', array(
                  'class' => 'bottom-cta__button',
                  'size' => 'large',
                  'type' => $button['button_style'],
                  'button' => $button['button_text'],
                  'url' => $button['button_url']
                ));
              endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php if (!empty($background_image)) : ?>
      <?php the_block('image', array(
        'image' => $background_image,
        'class' => 'image--cover bottom-cta__background-image'
      )); ?>
    <?php endif; ?>
    <?php if (!empty($overlay)) : ?>
      <div class="bottom-cta__overlay"
           style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
    <?php endif; ?>
  </div>
<?php endif; ?>
