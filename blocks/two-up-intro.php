<?php
/**
 * Available class:
 * - two-up-intro--style-creative-box (image and content overlap)
 * - two-up-intro--size-large (large spacing)
 * - two-up-intro--style-gym (large text)
 * - two-up-intro--style-gym-2 (large block with dark background and white text)
 * - two-up-intro--no-container (no container - full width)
 * - two-up-intro--style-short (available space between 2 columns, top and bottom)
 */

$_class = 'two-up-intro';
$_class .= !empty($background_type) ? ' bg-' . esc_attr($background_type) : '';
$_class .= !empty($background_type) && $background_type !== 'white' ? ' section-bg' : ' section';
$_class .= !empty($content_alignment) ? ' two-up-intro--alignment-' . esc_attr($content_alignment) : '';
$_class .= !empty($image_position) ? ' two-up-intro--image-' . esc_attr($image_position) : '';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_image_size = 'two-up-intro__image';
$_image_size .= !empty($image_size) ? ' image--' . $image_size : 'image--cover';

$container = codetot_site_container();
if (!empty($image) || !empty($content)) :
  ?>
  <section class="<?php echo $_class; ?>">
    <div class="two-up-intro__wrapper">
      <div class="<?php echo $container; ?> two-up-intro__container">
        <div class="f fw two-up-intro__grid">
          <?php if (!empty($image)) : ?>
            <div class="two-up-intro__col two-up-intro__col--image" data-aos="fade-up">
              <?php the_block('image', array(
                'image' => $image,
                'class' => $_image_size
              )); ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($content)) : ?>
            <div class="two-up-intro__col two-up-intro__col--content">
              <div class="two-up-intro__inner">
                <?php if (!empty($title)) : ?>
                  <header class="two-up-intro__header">
                    <?php if (!empty($label)) : ?>
                      <p class="two-up-intro__label" data-aos="fade-up"><?php echo esc_html($label); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($title)) : ?>
                      <h2 class="two-up-intro__title" data-aos="fade-up"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>
                  </header>
                <?php endif; ?>
                <div class="wysiwyg two-up-intro__content" data-aos="fade-up"><?php echo $content; ?></div>
                <?php if (!empty($buttons)) : ?>
                  <div class="two-up-intro__footer" data-aos="fade-up">
                    <?php the_block('button-group', array(
                      'buttons' => $buttons,
                      'class' => 'two-up-intro__buttons'
                    )); ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
