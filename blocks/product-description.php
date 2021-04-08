<?php
$_button_text = !empty($button_text) ? $button_text : __('Read more', 'ct-peakshop');
$_height = !empty($height) ? : 350;
$content = get_the_content();
if(!empty($content)) : ?>
  <div class="product-description js-product-description"
    data-ct-block="product-description"
    data-max-height="<?php echo $_height; ?>"
    >
    <?php if (!empty($title)) : ?>
      <h2 class="product-description__title"><?php echo $title; ?></h2>
    <?php endif; ?>
    <div class="wysiwyg product-description__content js-content">
      <?php echo apply_filters('the_content', $content); ?>
    </div>
    <div class="align-c product-description__footer">
      <button class="button button--primary product-description__button js-open-trigger">
        <span class="button__text"><?php echo $_button_text; ?></span>
      </button>
    </div>
  </div>
<?php endif; ?>