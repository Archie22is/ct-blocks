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
$_title_tag = !empty($section_title_tag) ? $section_title_tag : 'h1';
$container = codetot_site_container();

ob_start();
if (!empty($image)) :
?>
<?php if(empty($fullscreen)) : ?>
  <div class="<?php echo $container; ?> hero-image__image-container">
<?php endif; ?>
  <div class="rel hero-image__image-wrapper">
    <?php if (!empty($overlay)) : ?>
      <div class="hero-image__overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($_overlay); ?>);"></div>
    <?php endif; ?>
    <?php the_block('image', array(
      'image' => $image,
      'size' => wp_is_mobile() ? 'medium' : 'full',
      'lazyload' => false,
      'class' => 'w100 image--cover hero-image__image'
    )); ?>
  </div>
<?php if(empty($fullscreen)) : ?>
  </div>
<?php endif; ?>
<?php
endif;
$image_html = ob_get_clean();

ob_start(); ?>
<?php if (!empty($label)) : ?>
  <p class="hero-image__label"><?php echo esc_html($label); ?></p>
<?php endif; ?>
<?php if (!empty($title)) : ?>
  <?php echo sprintf('<%1$s class="hero-image__title">%2$s</%1$s>', $_title_tag, $title); ?>
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
