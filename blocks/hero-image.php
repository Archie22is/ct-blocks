<?php
$_class = 'hero-image';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($content_alignment) ? ' hero-image--alignment-' . esc_attr($content_alignment) : '';
$_class .= !empty($spacing) ? ' hero-image--spacing-' . esc_attr($spacing) : '';
$_class .= !empty($background_position) ? ' hero-image--bg-position-' . esc_attr($background_position) : '';
$_class .= !empty($background_contract) ? ' hero-image--' .esc_attr($background_contract) : '';
$_class .= !empty($overlay) ? ' hero-image--has-overlay' : '';
$_class .= (empty($fullscreen)) ? ' hero-image--no-fullscreen' : '';

$_overlay = !empty($overlay) ? $overlay : '0';

$container = codetot_site_container();

ob_start();
if (!empty($image)) :
?>
<?php if(empty($fullscreen)) : ?>
  <div class="<?php echo $container; ?> hero-image__image-container">
<?php endif; ?>
  <picture class="hero-image__image">
    <?php if (!empty($overlay)) : ?>
      <div class="hero-image__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($_overlay); ?>);"></div>
    <?php endif; ?>
    <?php
    if (!empty($image)) {

      if (!empty($mobile_image)) {
        printf('<source srcset="%1$s" media="(max-width: 360px)">', $mobile_image['url']);
      }

      ob_start();

      echo wp_get_attachment_image($image['ID'], 'full', null, array(
        'class' => 'image__img'
      ));
      $desktop_image_html = ob_get_clean();
      $desktop_image_html = str_replace(' loading="lazy"', '', $desktop_image_html);

      echo $desktop_image_html;
    } else {
      the_block('image-placeholder');
    }
    ?>
  </picture>
<?php if(empty($fullscreen)) : ?>
  </div>
<?php endif; ?>
<?php
endif;
$image_html = ob_get_clean();

ob_start(); ?>
<?php if (!empty($label)) : ?>
  <p class="hero-image__label" data-aos="fade-up"><?php echo esc_html($label); ?></p>
<?php endif; ?>
<?php if (!empty($title)) : ?>
  <h1 class="hero-image__title"><?php echo $title; ?></h1>
<?php endif; ?>
<?php if (!empty($description)) : ?>
  <div class="wysiwyg hero-image__description"><?php echo $description; ?></div>
<?php endif; ?>
<?php if (!empty($buttons)) : ?>
  <div class="hero-image__footer">
    <?php the_block('button-group', array(
      'buttons' => $buttons,
      'class' => 'hero-image__button'
    )); ?>
  </div>
<?php endif; ?>
<?php
$content_html = ob_get_clean();

if (!empty($content_html)) :
  ?>
  <section class="<?php echo $_class; ?>">
    <?php echo $image_html; ?>
    <div class="hero-image__wrapper">
      <div class="hero-image__content">
        <div class="<?php echo $container; ?> hero-image__container">
          <div class="hero-image__inner">
            <?php echo $content_html; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
