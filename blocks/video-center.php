<?php

$_class = 'video-center is-loading';
$_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
$_class .= !empty($background_contract) ? ' is-' . esc_attr($background_contract) . '-contract' : ' is-light-contract';
$_class .= !empty($class) ? ' ' . $class : '';

$default_settings = array(
  'title' => 'Default Title',
  'description' => '<p>Example Description text</p>'
);

$header = codetot_build_content_block(wp_parse_args(array(
  'label' => !empty($label) ? $label : false,
  'title' => !empty($title) ? $title : false,
  'description' =>  !empty($description) ? $description : false,
  'enable_container' => true
), $default_settings), 'video-center');

preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/mi', $video, $matches);

$youtube_id = !empty($matches) ? $matches[1] : '';

?>

<section class="<?php echo $_class; ?>" data-ct-block="video-center">
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
