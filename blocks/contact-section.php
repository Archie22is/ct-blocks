<?php
$container = codetot_site_container();

$_class = 'contact-section';
$_class .= !empty($contact_primary_layout) ? ' contact-section--primary-' . $contact_primary_layout : '';
$_class .= !empty($contact_secondary_layout) ? ' contact-section--secondary-' . $contact_secondary_layout : '';
$_class .= !empty($full_screen_layout) ? ' contact-section--full-screen' : '';
$_class .= !empty($contact_form_style) ? ' contact-section--' . $contact_form_style : '';
$_class .= !empty($class) ? ' ' . $class : '';

?>
<section class="<?php echo $_class; ?>" data-block="contact-section">
  <div class="<?php echo $container; ?> contact-section__container">
    <div class="grid contact-section__grid contact-section__grid--primary">
      <div class="grid__col contact-section__col contact-section__col--map" data-aos="fade-up">
        <?php if (!empty($google_maps)) : ?>
          <div class="contact-section__map-wrapper">
            <div class="contact-section__map js-map">
              <div class="contact-section__map-marker js-marker"
                   data-lat="<?php echo $google_maps['lat']; ?>"
                   data-lng="<?php echo $google_maps['lng']; ?>"
                   data-marker="<?php echo get_template_directory_uri(); ?>/assets/img/marker.png">
                <div class="contact-section__map-popup">
                  <p class="contact-section__map-address"><?php echo $google_maps['address']; ?></p>
                  <div class="contact-section__loader"></div>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <div class="grid__col contact-section__col contact-section__col--block">
        <?php if (!empty($address) || !empty($contact_information) || !empty($form)) : ?>
          <div class="contact-section__wrapper">
            <!-- Form vs Content -->
            <div class="grid contact-section__grid contact-section__grid--secondary">
              <div class="grid__col contact-section__col contact-section__col--content" data-aos="fade-up">
                <div class="contact-section__content">
                  <div class="grid contact-section__grid contact-section__grid--tertiary">
                    <div class="grid__col contact-section__col contact-section__col--address">
                      <div class="wysiwyg contact-section__inner">
                        <?php echo $address; ?>
                      </div>
                    </div>
                    <div class="grid__col contact-section__col contact-section__col--info">
                      <div class="wysiwyg contact-section__inner">
                        <?php echo $contact_information; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="grid__col contact-section__col contact-section__col--form" data-aos="fade-up">
                <?php if (!empty($contact_form)) : ?>
                  <div
                    class="contact-section__form">
                    <?php echo do_shortcode('[gravityform id="' . $contact_form . '" title="false" description="false" ajax="true"]'); ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
