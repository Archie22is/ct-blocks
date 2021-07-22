<?php
$_class = 'hero-title';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($content_alignment) ? ' hero-title--alignment-' . esc_attr($content_alignment) : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';

$header = codetot_build_content_block(array(
  'label' => !empty($label) ? $label : '',
  'label_class' => 'label-text',
  'title' => !empty($title) ? $title : '',
  'title_tag' => 'h1',
  'description' => !empty($description) ? $description : ''
), 'hero-title');

// Generate buttons
ob_start();
if (!empty($buttons)) : ?>
  <div class="mt-1 hero-title__footer">
    <?php the_block('button-group', array(
      'buttons' => $buttons,
      'class' => 'hero-title__buttons'
    )); ?>
  </div>
<?php endif;
$button_html = ob_get_clean();
?>

<section class="<?php echo $_class; ?>" data-reveal="fade-up">
  <div class="hero-title__wrapper">
    <div class="container hero-title__container">
      <div class="hero-title__inner">
        <?php echo $header; ?>
        <?php if (!empty($button_html)) :
          echo $button_html;
        endif; ?>
      </div>
    </div>
  </div>
</section>
