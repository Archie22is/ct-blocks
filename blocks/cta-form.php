<?php
$container_class = codetot_site_container();

$_class = 'cta-form cta-form--' . $style;
$_class .= !empty($class) ? ' ' . esc_attr($class) : '';
$_class .= !empty($background_color) ? ' section-bg bg-' . esc_attr($background_color) : ' section';
$_class .= !empty($overlay) ? ' cta-form--has-overlay' : '';
$_class .= !empty($background_types) ? ' cta-form--' . esc_attr($background_types) : '';
$_overlay = !empty($overlay) ? $overlay : null;
?>
<section class="<?php echo $_class; ?>">
    <div class="<?php echo $container_class; ?> cta-form__container rel z-2">
        <div class="cta-form__main">
            <div class="grid cta-form__grid">
                <?php if ($image): ?>
                <?php
                $image_src = wp_get_attachment_image_src($image, 'full');
                $image_src = $image_src[0];
                ?>
                <div class="cta-form__col">
                    <div class="cta-form__col-inner" data-aos="fade-up">
                        <div class="cta-form__image">
                            <?php echo '<img class="cta-form__img" src="'.$image_src.'" alt="'.$title.'"/>'; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="cta-form__col">
                    <div class="cta-form__col-inner">
                        <div class="cta-form__header">
                            <h2 class="cta-form__title" data-aos="fade-up">
                                <?php echo esc_html($title); ?>
                            </h2>
                            <p class="cta-form__content" data-aos="fade-up">
                                <?php echo esc_html($content); ?>
                            </p>
                        </div>
                      <?php if (!empty($select_form)) : ?>
                        <div class="cta-form__form" data-aos="fade-up">
                          <?php
                          $form_object = $select_form;
                          echo do_shortcode('[gravityform id="' . $form_object['id'] . '" title="true" description="true" ajax="true"]');
                          ?>
                        </div>
                      <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php if (!empty($background_image)) : ?>
        <?php the_block('image', array(
            'image' => $background_image,
            'class' => 'image--cover cta-form__background-image'
        )); ?>
    <?php endif; ?>
    <?php if (!empty($overlay)) : ?>
        <div class="cta-form__overlay"
             style="background-color: rgba(0, 0, 0, <?php echo esc_attr($_overlay); ?>);"></div>
    <?php endif; ?>
</section>
