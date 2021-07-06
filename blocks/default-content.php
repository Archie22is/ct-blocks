<?php
$_class = 'default-content';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($content_alignment) ? ' default-content--alignment-' . esc_attr($content_alignment) : '';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';

$header = codetot_build_content_block(array(
  'title' => !empty($title) ? $title : '',
  'title_tag' => 'h3'
), 'default-content');

ob_start();
  if( !empty($content) ):
  echo '<div class="wysiwyg">';
  echo $content;
  echo '</div>';
endif;
$content = ob_get_clean();
?>
<?php if( !empty($content) ): ?>
<section class="<?php echo $_class; ?>" id="<?php echo !empty($anchor_name) ? $anchor_name : '';?>">
  <div class="default-content__wrapper">
    <div class="container default-content__container">
      <div class="default-content__inner">
        <?php echo $header; ?>
        <?php echo $content ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
