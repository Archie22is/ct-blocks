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

// Get image html
ob_start();
if (!empty($image)) :?>
  <div class="hero-image__image-wrapper">
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
<?php
endif;
$image_html = ob_get_clean();

// Get content
ob_start(); ?>
<?php if (!empty($label)) : ?>
  <div class="hero-image__label"><?php echo $label; ?></div>
<?php endif; ?>
<?php // $title always requires, not need check ?>
<?php printf('<%1$s class="hero-image__title">%2$s</%1$s>', $_title_tag, $title); ?>
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

?>

<section class="<?php echo $_class; ?>">
  <?php if ($fullscreen) :
    printf('<div class="container hero-image__container hero-image__container--image">%s</div>', $image_html);
  else :
    echo $image_html;
  endif; ?>
  <div class="hero-image__wrapper">
    <div class="hero-image__content">
      <div class="container hero-image__container hero-image__container--content">
        <div class="hero-image__inner">
          <?php echo $content_html; ?>
        </div>
      </div>
    </div>
  </div>
</section>
