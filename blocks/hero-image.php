<?php
$_class = 'hero-image';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($content_alignment) ? ' hero-image--alignment-' . esc_attr($content_alignment) : '';
$_class .= !empty($spacing) ? ' hero-image--spacing-' . esc_attr($spacing) : '';
$_class .= !empty($background_position) ? ' hero-image--bg-position-' . esc_attr($background_position) : '';
$_class .= !empty($background_contract) ? ' hero-image--' .esc_attr($background_contract) : '';
$_class .= !empty($overlay) ? ' hero-image--has-overlay' : '';

$_overlay = !empty($overlay) ? $overlay : null;
ob_start();
if (!empty($image)) :
?>
<picture class="hero-image__image">
  <?php if (!empty($overlay)) : ?>
    <div class="hero-image__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($_overlay); ?>);"></div>
  <?php endif; ?>
  <?php
  $image_src = wp_get_attachment_image_src($image['ID'], 'full', null);
  $image_alt = get_post_meta($image['ID'], '_wp_attachment_image_alt', true);

  printf('<source srcset="%1$s" media="%2$s">', $image_src[0], '(min-width: 375px)');

  if (!empty($mobile_image)) {
    $mobile_image_src = wp_get_attachment_image_src($mobile_image['ID'], 'full', null);
    $mobile_image_alt = get_post_meta($mobile_image['ID'], '_wp_attachment_image_alt', true);

    printf('<img data-sizes="auto" src="%1$s" alt="%2$s" width="%3$s" height="%4$s" class="%5$s">',
      $mobile_image_src[0],
      $mobile_image_alt,
      $mobile_image_src[1],
      $mobile_image_src[2],
      'image__img lazyload'
    );
  } else {
    printf('<img data-sizes="auto" src="%1$s" alt="%2$s" width="%3$s" height="%4$s" class="%5$s">',
      $image_src[0],
      $image_alt,
      $image_src[1],
      $image_src[2],
      'image__img lazyload'
    );
  }
  ?>
</picture>
<?php
endif;
$image_html = ob_get_clean();

ob_start(); ?>
<?php if (!empty($label)) : ?>
  <p class="hero-image__label" data-aos="fade-up"><?php echo esc_html($label); ?></p>
<?php endif; ?>
<?php if (!empty($title)) : ?>
  <h1 class="hero-image__title" data-aos="fade-up"><?php echo $title; ?></h1>
<?php endif; ?>
<?php if (!empty($description)) : ?>
  <div class="wysiwyg hero-image__description" data-aos="fade-up"><?php echo $description; ?></div>
<?php endif; ?>
<?php if (!empty($buttons)) : ?>
  <div class="hero-image__footer" data-aos="fade-up">
    <?php the_block('button-group', array(
      'buttons' => $buttons,
      'class' => 'hero-image__button'
    )); ?>
  </div>
<?php endif; ?>
<?php
$content_html = ob_get_clean();

$container = codetot_site_container();

if (!empty($image)) :
  ?>
  <section class="<?php echo $_class; ?>">
    <?php
      the_block('hero-image-default', array(
        'container' => $container,
        'image_html' => $image_html,
        'content_html' => $content_html
      ));
    ?>
  </section>
<?php endif; ?>
