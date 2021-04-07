<?php
$container = codetot_site_container();
$_class = 'social-form';
$_class .= !empty($class) ? ' ' . $class : '';
?>
<section class="<?php echo $_class; ?>">
  <div class="<?php echo $container; ?> social-form__container">
    <div class="social-form__main">
      <div class="grid social-form__grid">
        <div class="grid social-form__col grid social-form__social">
          <?php if (!empty($social_title)) : ?>
            <div class="social-form__header">
              <h3 class="social-form__title"><?php echo $social_title ?></h3>
              <?php if (!empty($social_description)) : ?>
                <div class="wysiwyg social-form__description"><?php echo $social_description ?></div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <div class="social-form__social-content">
            <?php
            the_block('social-links');
            ?>
          </div>
        </div>
        <?php if (!empty($select_form)) : ?>
          <div class="grid social-form__col grid social-form__form">
            <div class="social-form__form-content" data-aos="fade-up">
              <?php
              echo do_shortcode('[gravityform id="' . esc_attr($select_form) . '" title="true" description="true" ajax="true"]');
              ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
