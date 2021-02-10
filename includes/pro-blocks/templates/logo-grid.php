<?php

/**
 *
'class',
'anchor_name',
'background_type',
'enable_slideshow',
'columns',
'header_alignment',
 */

$container = codetot_site_container();
$_class = 'logo-grid';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($columns) ? ' logo-grid--' . esc_attr($columns) . '-columns' : 'logo-grid--6-columns';
$_class .= empty($description) ? ' logo-grid--no-description' : '';
$_class .= !empty($header_alignment) ? ' logo-grid--header-' . esc_attr($header_alignment) : '';
$_class .= !empty($background_type) ? ' bg-' . esc_attr($background_type) : '';
$_class .= !empty($enable_slideshow) ? ' logo-grid--has-slider' : '';
if (!empty($background_type) && codetot_is_dark_background($background_type)) {
  $_class .= ' logo-grid--dark-contract';
}
$_class .=  !empty($background_type) && $background_type !== 'white' ? ' section-bg' : ' section';
$_slider_options = empty($slider_options) ? array(
  'contain' => true,
  'cellAlign' => 'center',
  'pageDots' => false,
  'prevNextButtons' => true,
  'groupCells' => true,
  'percentagePosition' => true
) : $slider_options;

if (!empty($title) || !empty($items)) :
  ?>
  <section class="<?php echo $_class; ?>"<?php if(!empty($anchor_name)) : printf(' id="%s"', $anchor_name); endif; ?>
    <?php if (!empty($enable_slideshow)) : ?> data-block="logo-grid"<?php endif; ?>
  >
    <div class="<?php echo $container; ?> logo-grid__container">
      <?php if (!empty($title) || !empty($description)) : ?>
        <header class="align-c logo-grid__header" data-aos="fade-up">
          <?php if (!empty($title)) : ?>
            <h2 class="logo-grid__title" data-aos="fade-up"><?php echo $title; ?></h2>
          <?php endif; ?>
          <?php if (!empty($description)) : ?>
            <div class="logo-grid__description" data-aos="fade-up"><?php echo $description; ?></div>
          <?php endif; ?>
        </header>
      <?php endif; ?>
      <?php if (!empty($items)) : ?>
        <div class="logo-grid__main" data-aos="fade-up">
          <?php if (!empty($enable_slideshow)) : ?>
            <div class="logo-grid__slider js-slider" data-carousel='<?php echo json_encode($_slider_options); ?>'>
              <?php foreach ($items as $item) : ?>
                <div class="logo-grid__col">
                  <figure class="logo-grid__image-slider-wrapper">
                    <?php
                    ob_start();
                    echo wp_get_attachment_image($item['image']['ID'], 'full', null, array(
                      'class' => 'logo-grid__image-slider lazyload js-image'
                    ));
                    $image_html = ob_get_clean();
                    $image_html = str_replace('src=""', 'data-sizes="auto" data-src="', $image_html);
                    $image_html = str_replace('srcset="', 'data-srcset="', $image_html);

                    echo $image_html;
                    ?>
                  </figure>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else : ?>
            <div class="grid logo-grid__grid">
              <?php foreach ($items as $item) : ?>
                <div class="grid__col logo-grid__col">
                  <?php the_block('image', array(
                    'class' => 'image--contain logo-grid__image',
                    'size' => 'logo',
                    'image' => $item['image']
                  )); ?>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
