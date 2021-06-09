<?php
$container = codetot_site_container();

$_class = 'rel section-bg testimonials';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($overlay) ? ' testimonials--has-overlay' : '';
$_class .= (!empty($background_type) && (!empty($background_type) !== 'white')) ? ' bg-' . esc_attr($background_type) : '';
$_class .= ((!empty($background_type) !== 'white') || !empty($background_image)) ? ' section-bg' : ' section';
$_class .= !empty($background_image) ? ' rel bg-image' : '';
$_class .= !empty($background_contract) ? ' testimonials--' . esc_attr($background_contract) : '';
$_class .= !empty($block_preset) ? ' testimonials--preset-' . esc_attr($block_preset) : ' testimonials--preset-1';
$_class .= !empty($header_alignment) ? ' is-header-' .  $header_alignment : '';

$header = codetot_build_content_block(array(
  'label' => $label,
  'title' => $title,
  'description' => $description
), 'testimonials');

if (!empty($title) || !empty($content)) {
  $header = codetot_build_content_block(array(
    'title' => $title,
    'description' => $content
  ), $preset_class);
}
ob_start();

if (!empty($background_image)) {
the_block('image', array(
  'class' => 'image--cover testimonials__background',
  'image' => $background_image
));
}

if (!empty($overlay)) { ?>
  <div class="testimonials__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
<?php }
$background = ob_get_clean();

ob_start();
if (!empty($columns) && $block_preset === '4') :
  $carousel_settings_nav = array(
    'asNavFor' => '.js-slider-main',
    'pageDots' => false,
    'prevNextButtons' => false,
    'cellAlign' => 'center',
    'draggable' => false,
    'wrapAround' =>  true
  );
  $carousel_settings = array(
    'contain' => true,
    'pageDots' => false,
    'prevNextButtons' => true,
    'cellAlign' => 'center',
    'wrapAround' =>  true
  );
?>
  <div class="testimonials__row testimonials-row__images">
    <div class="testimonials__columns testimonials__columns--nav js-slider-nav" <?php if (!empty($carousel_settings_nav)) : ?> data-carousel='<?= json_encode($carousel_settings_nav); ?>' <?php endif; ?>>
      <?php foreach ($columns as $column) :
        the_block('testimonial-card-image', array(
          'column' => $column
        ));
      endforeach; ?>
    </div>
  </div>
  <div class="testimonials__row testimonials__row--navigation">
    <div class="testimonials__columns testimonials__columns--main js-slider-main" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>' <?php endif; ?>>
      <?php foreach ($columns as $column) :
        the_block('testimonial-card-content', array(
          'column' => $column
        ));
      endforeach; ?>
    </div>
  </div>
<?php
else :
  $carousel_settings = array(
    'contain' => true,
    'pageDots' => false,
    'prevNextButtons' => true,
    'percentagePosition' => true,
    'cellAlign' => 'left'
  );
?>
  <div class="testimonials__columns js-slider" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>' <?php endif; ?>>
    <?php foreach ($columns as $column) :
      the_block('testimonial-card', array(
        'column' => $column
      ));
    endforeach; ?>
  </div>
<?php
endif;
$content = ob_get_clean();

if (!empty($columns)) :

  the_block('default-section', array(
    'attributes' => ' data-ct-block="testimonials"',
    'before_header' => $background,
    'class' => $_class,
    'header' => $header,
    'content' => $content
  ));

endif;
