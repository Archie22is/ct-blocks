<?php
$carousel_settings = array(
  'prevNextButtons' => true,
  'pageDots' => false,
);
$_style = !empty($style) ? esc_attr($style) : 'style-1';
$_button_style = !empty($button_style) ? esc_attr($button_style) : 'primary';
$_button_size = !empty($button_size) ? esc_attr($button_size) : 'normal';
$_class = 'team-member';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($style) ? ' team-member--style-' . esc_attr($style) : '';
$_class .= !empty($background_type) ? ' team-member--' . esc_attr($background_type) : '';
$_class .= !empty($items_layout) ? ' team-member--items-' . esc_attr($items_layout) : '';
$_class .= !empty($number_columns) ? ' team-member--column-' . esc_attr($number_columns) : '';
$_class .= !empty($item_style) ? ' team-member--item-style-' . esc_attr($item_style) : '';
?>
<?php if(!empty($items)) : ?>
  <section class="<?php echo $_class; ?>" data-ct-block="team-member" data-reveal="fade-up">
    <div class="container team-member__container">
      <div class="grid team-member__grid">
        <?php if(!empty($title)) : ?>
          <header class="grid__col team-member__col team-member__col--header">
            <?php if(!empty($label)) : ?>
              <p class="team-member__label"><?php echo $label; ?></p>
            <?php endif; ?>
            <h2 class="team-member__title"><?php echo $title; ?></h2>
          </header>
        <?php endif; ?>
        <?php if(!empty($description)) : ?>
          <div class="grid__col team-member__col team-member__col--description">
            <div class="wysiwyg team-member__description">
              <?php echo $description; ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if(!empty($button_text) && !empty($button_url) && !empty($_button_style)) : ?>
          <div class="grid__col team-member__col team-member__col--cta">
            <?php
            the_block('button', array(
              'class' => 'team-member__button',
              'size' => $_button_size,
              'type' => $_button_style,
              'button' => $button_text,
              'url' => $button_url
            ));
            ?>
          </div>
        <?php endif; ?>
        <div class="grid__col team-member__col team-member__col--items">
          <div class="team-member__items<?php if (!empty($carousel_settings) && ($items_layout == 'slider')) : ?> js-slider<?php endif; ?>" <?php if (!empty($carousel_settings) && ($items_layout == 'slider')) : ?> data-carousel='<?= json_encode($carousel_settings); ?>'<?php endif; ?>>
            <?php foreach ($items as $item) : ?>
              <div class="team-member__item">
            <?php if (!empty($item['url'])) :?>
                <a href="<?php echo $item['url']; ?>" class="team-member__url">
            <?php endif; ?>
                <div class="team-member__inner">
                  <?php the_block('image', array(
                    'image' => $item['image'],
                    'class' => 'image--cover team-member__image'
                  )); ?>
                  <?php if(!empty($item['title'])) : ?>
                    <div class="team-member__content">
                      <h3 class="team-member__item-title"><?php echo $item['title']; ?></h3>
                      <?php if(!empty($item['sub_title'])) : ?>
                        <p class="team-member__item-sub-title"><?php echo $item['sub_title']; ?></p>
                      <?php endif; ?>
                      <?php if(!empty($item['description'])) : ?>
                        <div class="wysiwyg team-member__item-description"><?php echo $item['description']; ?></div>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>
            <?php if (!empty($item['url'])) :?>
              </a>
           <?php endif; ?>
            </div>
            <?php endforeach; ?>
          </a>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
