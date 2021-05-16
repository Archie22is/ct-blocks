<?php
if (!empty($content) || !empty($images)) : ?>
  <section class="section two-up slider" data-ct-block="two-up-slider">
    <div class="container two-up-slider__container">
      <div class="two-up-slider__wrapper js-wrapper">
        <div class="rel two-up-slider__grid">
          <div class="rel two-up-slider__col two-up-slider__col--content">
            <div class="fa1 f fdc jcc two-up-slider__inner">
              <div class="wysiwyg two-up-slider__content">
                <?php echo $content; ?>
              </div>
              <?php if (!empty($button_url) & !empty($button_text)) : ?>
                <footer class="section-footer two-up-slider__footer">
                  <?php the_block('button', array(
                    'type' => 'primary',
                    'class' => 'two-up-slider__button',
                    'url' => $button_url,
                    'button' => $button_text
                  )); ?>
                </footer>
              <?php endif; ?>
            </div>
          </div>
          <?php if (!empty($images)) : ?>
            <div class="two-up-slider__col two-up-slider__col--slider">
              <div class="js-slider flickity--white-dots two-up-slider__slider">
                <?php foreach($images as $image) : ?>
                  <div class="two-up-slider__item">
                    <?php the_block('image', array(
                      'class' => 'image--cover two-up-slider__image',
                      'image' => $image
                    )); ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
