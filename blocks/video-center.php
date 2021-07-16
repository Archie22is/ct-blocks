<?php

if (!empty($video) || !empty($video_file) || !empty($video_url)) :

  $_class = 'video-center is-header-center';
  $_class .= !empty($background_type) ? codetot_generate_block_background_class($background_type) : ' section';
  $_class .= !empty($background_contract) ? ' is-' . esc_attr($background_contract) . '-contract' : ' is-light-contract';
  $_class .= !empty($class) ? ' ' . $class : '';

  $video_content = '';
  $plyr_config = array();
  if (!empty($autoplay_video)) {
    $plyr_config['autoplay'] = true;
  }

  if (!empty($loop_video)) {
    $plyr_config['settings'] = array('loop');
  }

  if (!empty($video) && $video_type == 'video') {
    preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/mi', $video, $matches);
    $youtube_id = !empty($matches) ? $matches[1] : '';

    $video_content = sprintf('<div class="video-center__video js-video" data-plyr-embed-id="%1$s" data-plyr-provider="%2$s" data-poster="%3$s" %4$s></div>',
      $youtube_id,
      'youtube',
      !empty($poster_image) ? $poster_image['url'] : '',
      sprintf('data-plyr-config=\'%1$s\'', json_encode($plyr_config))
    );
  }

  if (!empty($video_file) && $video_type == 'file_upload') {
    $video_content = wp_sprintf('<video controls class="video-center__video js-video" poster="%1$s" %2$s><source src="%3$s" type="%4$s"></video>',
      !empty($poster_image) ? $poster_image['url'] : '',
      sprintf('data-plyr-config=\'%1$s\'', json_encode($plyr_config)),
      $video_file['url'],
      $video_file['mime_type']
    );
  }

  if (!empty($video_url) && $video_type == 'file_url') {
    $is_mp4 = preg_match('/^.*\.(mp4)$/i', $video_url);
    $is_webm = preg_match('/^.*\.(webm)$/i', $video_url);
    $type = $is_mp4 ? 'mp4' : '';
    $type = $is_webm ? 'webm' : '';

    $video_content = wp_sprintf('<video controls class="video-center__video js-video" poster="%1$s" %2$s><source src="%3$s" type="%4$s"></video>',
      !empty($poster_image) ? $poster_image['url'] : '',
      sprintf('data-plyr-config=\'%1$s\'', json_encode($plyr_config)),
      $video_url,
      $type
    );
  }

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

  the_block('default-section', array(
    'id' => !empty($id) ? $id : '',
    'lazyload' => true,
    'attributes' => ' data-ct-block="video-center"',
    'class' => $_class,
    'header' => $header,
    'content' => $video_content
  ));

endif;
