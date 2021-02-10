<?php if (!empty($items)) : ?>
  <div class="hero-banner__list">
    <?php foreach ($items as $item) :
      ob_start();
      echo '<p class="large-text bold-text hero-banner__row-title">' . $item['title'] . '</p>';
      echo '<p class="hero-banner__row-description">' . $item['description'] . '</p>';
      if (!empty($item['button_text'])) {
        echo '<div class="hero-banner__row-footer">';
        the_block('button', array(
          'button' => $item['button_text'],
          'size' => 'small',
          'type' => 'outline-white'
        ));
        echo '</div>';
      }
      $content = ob_get_clean();
      ?>
      <div class="hero-banner__row">
        <?php the_block('image-banner', array(
          'class' => 'hero-banner__row-image',
          'lazyload' => false,
          'content' => $content,
          'image' => $item['image'],
          'url' => $item['url']
        )); ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
