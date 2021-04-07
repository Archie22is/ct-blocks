<?php if (!empty($title) || !empty($description)) :
  $default_args = array(
    'title' => $title,
    'description' => !empty($description) ? $description : '',
    'title_tag' => 'h3',
    'block_tag' => 'div'
  );

  $_content_args = !empty($content_args) ? wp_parse_args($content_args, $default_args) : $default_args;

  $content = codetot_build_content_block($_content_args, 'feature-card');
endif; ?>

<div class="feature-card <?php echo (!empty($class)) ? $class : ''; ?>">
<?php if (!empty($image_content) && !empty($icon_type)) : ?>
    <div class="feature-card__image-wrapper">
      <?php if ($icon_type === 'svg') : ?>
        <span class="feature-card__svg" aria-hidden="true"><?php echo $image_content; ?></span>
      <?php else :
        the_block('image', array(
          'image' => $image_content,
          'class' => !empty($image_class) ? ' ' . esc_attr($image_class) . ' feature-card__image' : ' image--cover feature-card__image',
          'size' => 'full'
        ));
      endif; ?>
    </div>
  <?php endif; ?>
  <div class="feature-card__content">
    <?php echo $content; ?>
    <?php if (!empty($button_text) && !empty($button_url)) : ?>
      <div class="feature-card__footer">
        <?php the_block('button', array(
          'button' => $button_text,
          'url' => $button_url,
          'type' => !empty($button_style) ? $button_style : '',
          'class' => 'feature-card__button'
        )); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
