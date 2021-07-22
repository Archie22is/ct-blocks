<?php if (!empty($items)) : ?>
  <div class="three-up-card" data-reveal="fade-up">
    <div class="container three-up-card__container">
      <div class="grid three-up-card__grid">
        <?php foreach ($items as $item) : ?>
        <div class="grid__col three-up-card__col">
          <div class="rel three-up-card__item">
            <?php
            the_block('image', array(
              'image' => $item['image'],
              'class' => 'image--cover three-up-card__image',
            ));
            ?>
            <div class="abs three-up-card__content">
              <div class="three-up-card__box">
                <?php if (!empty($item['label'])) : ?>
                  <p class="three-up-card__label">
                    <?php echo $item['label'] ?>
                  </p>
                <?php endif; ?>
                <?php if (!empty($item['title'])) : ?>
                  <h3 class="three-up-card__title">
                    <?php echo $item['title'] ?>
                  </h3>
                <?php endif; ?>
                <?php if (!empty($item['button_text'])) : ?>
                  <div class="three-up-card__cta">
                    <?php
                    the_block('button', array(
                      'class' => 'three-up-card__button',
                      'size' => 'large',
                      'type' => 'link',
                      'button' => $item['button_text'],
                      'url' => $item['button_url']
                    ));
                    ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif;
