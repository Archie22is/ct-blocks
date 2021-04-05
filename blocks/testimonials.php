<?php
$container = codetot_site_container();

if (!(empty($block_preset))) :
  if ($block_preset === 'preset-4') :
    $carousel_settings_nav = array(
      'wrapAround' => true,
      'pageDots' => false,
      'contain' => true,
      'draggable' => false,
    );
    $carousel_settings = array(
      'contain' => true,
      'pageDots' =>  false,
      'prevNextButtons' => false,
      'cellAlign' => 'center',
      'asNavFor' =>  '.js-slider-nav',
      'wrapAround' => true
    );
    else :
      $carousel_settings = array(
        'contain' => true,
        'pageDots' =>  true,
        'prevNextButtons' => true,
        'cellAlign' => 'center',
        'wrapAround' => true
      );
  endif;
endif;

$_class = 'rel testimonials';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($overlay) ? ' testimonials--has-overlay' : '';
$_class .= !empty($block_preset) ? ' testimonials--' . esc_attr($block_preset) : ' testimonials--preset-1';

?>
<section class="<?php echo esc_attr($_class); ?>" data-ct-block="testimonials">
  <div class="rel <?php echo $container; ?> testimonials__container">
    <?php if (!empty($title) || !empty($description)) : ?>
      <header class="testimonials__header">
        <?php if (!empty($label)) : ?>
          <p class="testimonials__label" data-aos="fade-up"><?php echo esc_html($label); ?></p>
        <?php endif; ?>
        <?php if (!empty($title)) : ?>
          <h2 class="testimonials__title" data-aos="fade-up"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if (!empty($description)) : ?>
          <div class="wysiwyg testimonials__description" data-aos="fade-up"><?php echo $description; ?></div>
        <?php endif; ?>
      </header>
    <?php endif; ?>
    <?php if (!empty($columns) && $block_preset === 'preset-4') : ?>
      <div class="testimonials__main">
        <div
          class="testimonials__columns testimonials__columns--main js-slider-main" <?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>'<?php endif; ?>>
          <?php foreach ($columns as $column) : ?>
            <div class="testimonials__column">
              <figure class="testimonials__inner">
                <div class="testimonials__profile" data-aos="fade-up">
                  <?php if (!empty($column['image'])) : ?>
                    <?php the_block('image', array(
                      'image' => $column['image'],
                      'class' => 'image--cover testimonials__image'
                    )); ?>
                  <?php endif; ?>
                </div>
              </figure>
            </div>
          <?php endforeach; ?>
        </div>
        <div
          class="testimonials__columns testimonials__columns--nav js-slider-nav"<?php if (!empty($carousel_settings_nav)) : ?> data-carousel='<?= json_encode($carousel_settings_nav); ?>'<?php endif; ?>>
          <?php foreach ($columns as $column) : ?>
            <div class="testimonials__column">
              <figure class="testimonials__inner">
                <div class="testimonials__profile" data-aos="fade-up">
                  <figcaption class="testimonials__info">
                    <?php if (!empty($column['name'])) : ?>
                      <p><?php echo $column['name'] ?></p>
                    <?php endif; ?>
                    <?php if (!empty($column['profession'])) : ?>
                      <cite><?php echo $column['profession'] ?></cite>
                    <?php endif; ?>
                  </figcaption>
                </div>
                <blockquote class="testimonials__comment" data-aos="fade-up">
                  <?php if (!empty($column['title'])) : ?>
                    <h3><?php echo $column['title']; ?></h3>
                  <?php endif; ?>
                  <?php if (!empty($column['testimonial'])) : ?>
                    <p><?php echo $column['testimonial']; ?></p>
                  <?php endif; ?>
                </blockquote>
              </figure>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php else : ?>
      <div class="testimonials__main ">
        <div
          class="testimonials__columns js-slider"<?php if (!empty($carousel_settings)) : ?> data-carousel='<?= json_encode($carousel_settings); ?>'<?php endif; ?>>
          <?php foreach ($columns as $column) : ?>
            <div class="testimonials__column">
              <figure class="testimonials__inner">
                <blockquote class="testimonials__comment" data-aos="fade-up">
                  <div class="testimonials__icon testimonials__icon--open">
                    <?php codetot_svg('quotation-marks-open', true) ?>
                  </div>
                  <?php if (!empty($column['title'])) : ?>
                    <h3><?php echo $column['title']; ?></h3>
                  <?php endif; ?>
                  <?php if (!empty($column['testimonial'])) : ?>
                    <p><?php echo $column['testimonial']; ?></p>
                  <?php endif; ?>
                  <div class="testimonials__icon testimonials__icon--close">
                    <?php codetot_svg('quotation-marks-close', true) ?>
                  </div>
                </blockquote>
                <div class="testimonials__profile" data-aos="fade-up">
                  <?php if (!empty($column['image'])) : ?>
                    <?php the_block('image', array(
                      'image' => $column['image'],
                      'class' => 'image--cover testimonials__image'
                    )); ?>
                  <?php endif; ?>
                  <figcaption class="testimonials__info">
                    <?php if (!empty($column['name'])) : ?>
                      <p><?php echo $column['name'] ?></p>
                    <?php endif; ?>
                    <?php if (!empty($column['profession'])) : ?>
                      <cite><?php echo $column['profession'] ?></cite>
                    <?php endif; ?>
                  </figcaption>
                </div>
              </figure>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <?php if (!empty($background)): ?>
    <div class="abs testimonials__background">
      <?php the_block('image', array(
        'image' => $background,
        'class' => 'image--cover testimonials__background'
      )); ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($overlay)) : ?>
    <div class="testimonials__overlay"
         style="background-color: rgba(0, 0, 0, <?php echo esc_attr($overlay); ?>);"></div>
  <?php endif; ?>
</section>
