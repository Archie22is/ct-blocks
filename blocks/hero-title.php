<?php
$_class = 'hero-title';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($content_alignment) ? ' hero-title--alignment-' . esc_attr($content_alignment) : '';

$header = codetot_build_content_block(array(
  'label' => !empty($label) ? $label : '',
  'label_class' => 'label-text',
  'title' => !empty($title) ? $title : '',
  'title_tag' => 'h1',
  'description' => !empty($description) ? $description : ''
), 'hero-title');

$button_html = '';

if (!empty($buttons)) {

}

?>

<section class="<?php echo $_class; ?>">
  <div class="hero-title__wrapper">
    <div class="container hero-title__container">
      <div class="hero-title__inner">
        <?php echo $header; ?>
        <?php if (!empty($button_html)) : ?>
          <div class="hero-title__footer">
            <?php echo $button_html; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
