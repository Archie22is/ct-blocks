<?php
$default_settings = array(
  'title' => 'Default Title',
  'description' => '<p>Example Description text</p>'
);

$header = codetot_build_content_block(wp_parse_args(array(
  'label' => $label,
  'title' => $title,
  'description' => $description,
  'enable_container' => true
), $default_settings), 'video-center');

preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/mi', $video, $matches);

$youtube_id = !empty($matches) ? $matches[1] : '';

?>

<section class="section video-center is-loading<?php if (!empty($class)) : echo ' ' . $class; endif; ?>" data-child-block="video-center">
  <?php echo $header; ?>
  <?php if (!empty($youtube_id)) : ?>
    <div class="video-center__main">
      <div class="container video-center__main-container">
        <div class="video-center__inner">
          <div class="video-center__loader">
            <?php the_block('loader', array(
              'class' => 'loader--dark'
            )); ?>
          </div>
          <div class="js-video" data-plyr-embed-id="<?php echo $youtube_id; ?>" data-plyr-provider="youtube" <?php if (!empty($poster_image)) : ?> data-poster="<?php echo $poster_image['url']; ?>" <?php endif; ?>></div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</section>
