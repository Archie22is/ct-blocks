<?php

$_class = 'hero-two-up';
$_class .= !empty($block_layout) ? ' is-layout-' . esc_attr($block_layout) : ' is-layout-default';
$_class .= !empty($block_spacing) ? ' is-spacing-' . esc_attr($block_spacing) : ' is-vertical-spacing-default';
$_class .= !empty($content_alignment) ? ' is-content-alignment-' . esc_attr($content_alignment) : ' is-content-alignment-center';
$_class .= !empty($media_type) ? ' is-media-' . esc_attr(str_replace('_', '-', $media_type)) : ' is-media-image';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$_media_type = !empty($media_type) ? $media_type : 'image';
$_enable_container = !empty($enable_container) ? $enable_container : false;

ob_start();
echo '<figure class="hero-two-up__media-wrapper">';
// Load image
if ($_media_type === 'image' && !empty($image)) :
  echo wp_get_attachment_image($image['ID'], 'full', null, array(
    'loading' => false,
    'class' => 'hero-two-up__image'
  ));
endif;
// Load Youtube video
if ($_media_type === 'youtube_video' && !empty($youtube_video)) :
  echo $youtube_video;
endif;
echo '</figure>';
// Load MP4
if ($_media_type === 'mp4_video' && !empty($mp4_video_url)) :
  printf('<video class="hero-two-up__video"><source src="%1$s" type="video/mp4"></video>', esc_url($mp4_video_url));
endif;
$media_html = ob_get_clean();

// Generate buttons
ob_start();
if (!empty($buttons)) : ?>
  <div class="mt-1 hero-two-up__footer">
    <?php the_block('button-group', array(
      'buttons' => $buttons,
      'class' => 'hero-two-up__button'
    )); ?>
  </div>
<?php endif;
$button_html = ob_get_clean();

$content_html = codetot_build_content_block(array(
  'label' => !empty($label) ? $label : '',
  'title' => !empty($title) ? $title : '',
  'description' => !empty($description) ? $description : '',
  'title_tag' => 'h1',
  'block_tag' => 'div'
), 'hero-two-up');

$content_html .= $button_html;

ob_start();
echo '<div class="f fw hero-two-up__grid">';
if (!empty($media_html)) :
  printf('<div class="w100 hero-two-up__col hero-two-up__col--media">%s</div>', $media_html);
endif;
if (!empty(strip_tags($content_html))) :
  printf('<div class="w100 hero-two-up__col hero-two-up__col--content"><div class="hero-two-up__inner">%s</div></div>', $content_html);
endif;
echo '</div>';
$grid_html = ob_get_clean();

?>

<section class="<?php echo $_class; ?>" data-reveal="fade-up">
  <?php if ($enable_container) : ?>
    <div class="container hero-two-up__container"><?php echo $grid_html; ?></div>
  <?php else : ?>
    <div class="hero-two-up__wrapper"><?php echo $grid_html; ?></div>
  <?php endif; ?>
</section>
