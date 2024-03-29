<?php if (!empty($title) || !empty($description)) :
  $default_args = array(
    'class' => 'w100',
    'title' => !empty($title) ? $title : '',
    'description' => !empty($description) ? $description : '',
    'title_tag' => !empty($title_tag) ? $title_tag : 'h3',
    'block_tag' => 'div'
  );

  $_content_args = !empty($content_args) ? wp_parse_args($content_args, $default_args) : $default_args;

  $content = codetot_build_content_block($_content_args, 'feature-card');
endif;

$_media_size = !empty($media_size) ? $media_size : 'image--default';

$_class = 'feature-card';
$_class .= !empty($enable_card_link) && !empty($card_link) ? ' feature-card--link' : '';
$_class .= ' is-' . esc_attr($_media_size);
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';

$media_class = 'is-' . $_media_size;
$media_html = '';

if ($icon_type === 'svg' && !empty($svg_icon)) {
  $media_html = sprintf('<span class="feature-card__svg %1$s" aria-hidden="true">%2$s</span>', $_media_size, $svg_icon);
}

if ($icon_type === 'image' && !empty($image)) {
  $media_html = get_block('image', array(
    'image' => $image,
    'class' => $_media_size . ' feature-card__image'
  ));
}

$cta_link_html = '';
if (!empty($button_text) && !empty($button_url) && empty($enable_card_link)) :
  $cta_link_html = sprintf('<div class="pt-1 feature-card__footer">%s</div>', get_block('button', array(
    'button' => $button_text,
    'url' => $button_url,
    'type' => !empty($button_style) ? $button_style : '',
    'class' => 'feature-card__button'
  )));
endif;

ob_start(); ?>
  <div class="f fdc feature-card__media-wrapper">
    <?php echo $media_html; ?>
  </div>
  <div class="f fdc feature-card__content">
    <?php echo $content; ?>
    <?php
    if (!empty($cta_link_html)) :
      echo $cta_link_html;
    endif;
    ?>

  </div>
<?php $card_html = ob_get_clean();

if (!empty($enable_card_link) && !empty($card_link)) :
  printf('<a class="%1$s" href="%2$s" target="%3$s">%4$s</a>',
    $_class,
    $card_link,
    $card_link_target,
    $card_html
  );
else :
  printf('<div class="%1$s">%2$s</div>',
    $_class,
    $card_html
  );
endif;

?>
