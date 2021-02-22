<?php if (!empty($title) || !empty($description)) :
  $content = codetot_build_content_block(array(
    'title' => $title,
    'description' => !empty($description) ? $description : '',
    'title_tag' => 'h3'
  ), 'feature-card');
endif; ?>

<div class="feature-card <?php echo (!empty($class)) ? $class : ''; ?>">
  <?php if (!empty($image_content)) : ?>
    <div class="feature-card__image-wrapper">
      <?php
      the_block('image', array(
        'image' => $image_content,
        'class' => !empty($image_class) ? ' ' .esc_attr($image_class) . ' feature-card__image' : ' image--cover feature-card__image',
        'size' => 'full'
      ));
      ?>
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
