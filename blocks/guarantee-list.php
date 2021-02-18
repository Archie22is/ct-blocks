<?php
$container = codetot_site_container();

$available_classes_key = array(
  'block_preset' => $block_preset,
  'layout' => $layout,
  'background_type' => $background_type,
  'content_alignment' => $content_alignment,
  'column' => count($items),
  'fullscreen' => $fullscreen,
  'hide_mobile' => $hide_mobile,
  'class' => $class
);

$block_class = codetot_block_generate_class($available_classes_key, 'guarantee-list');

if (!empty($items)) : ?>
  <div class="<?php echo $block_class; ?>" data-aos="fade-up"<?php if(!empty($anchor_name)) : printf(' id="%s"', $anchor_name); endif; ?>>
    <div class="container guarantee-list__container">
      <div class="grid guarantee-list__grid">
        <?php foreach ($items as $item) : ?>
          <div class="grid__col guarantee-list__col">
            <div class="guarantee-list__media-wrapper">
              <?php if ($item['icon_type'] === 'icon') : ?>
                <span class="<?php echo esc_html($item['icon_name']); ?> guarantee-list__icon" aria-hidden="true"></span>
              <?php elseif ($item['icon_type'] === 'image' && !empty($item['icon_image'])) : ?>
                <?php the_block('image', array(
                  'image' => $item['icon_image']['ID'],
                  'class' => 'image--cover image-row__image guarantee-list__image'
                )); ?>
              <?php endif; ?>
            </div>
            <div class="guarantee-list__content">
              <p class="label-text bold-text uppercase-text guarantee-list__title"><?php echo $item['title']; ?></p>
              <?php if (!empty($item['description'])) : ?>
                <div class="small-text guarantee-list__description"><?php echo $item['description']; ?></div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
