<?php
$container = codetot_site_container();

$_class = 'rel section-bg testimonials';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($overlay) ? ' testimonials--has-overlay' : '';
$_class .= !empty($block_preset) ? ' testimonials--preset-' . esc_attr($block_preset) : ' testimonials--preset-1';

$header = codetot_build_content_block(array(
  'label' => $label,
  'title' => $title,
  'description' => $description
), 'testimonials');

ob_start();
if (!empty($columns) && $block_preset === 'preset-4') :
  $carousel_settings_nav = array(
    'contain' => true,
    'wrapAround' => true,
    'pageDots' => false,
    'prevNextButtons' => false,
    'draggable' => false,
  );
  $carousel_settings = array(
    'contain' => true,
    'wrapAround' => true,
    'pageDots' =>  false,
    'prevNextButtons' => true,
    'cellAlign' => 'center',
    'draggable' => true,
  );

?>
  <div class="testimonials__row testimonials-row__images">
    <div class="testimonials__columns testimonials__columns--main js-slider-main" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>' <?php endif; ?>>
      <?php foreach ($columns as $column) :
        the_block('testimonial-card-image', array(
          'column' => $column
        ));
      endforeach; ?>
    </div>
  </div>
  <div class="testimonials__row testimonials__row--navigation">
    <div class="testimonials__columns testimonials__columns--nav js-slider-nav" <?php if (!empty($carousel_settings_nav)) : ?> data-carousel='<?= json_encode($carousel_settings_nav); ?>' <?php endif; ?>>
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
    'class' => $_class,
    'header' => $header,
    'content' => $content
  ));

endif;
