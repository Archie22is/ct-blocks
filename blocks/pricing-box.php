<?php
$_class = 'f fdc pricing-box';
$_class .= !empty($class) ? ' ' . $class : '';
$_highlight_text = !empty($highlight_text) ? $highlight_text : esc_html__('Popular', 'ct-blocks');
?>
<div class="<?php echo $_class; ?>">
  <?php if (!empty($title)) : ?>
    <div class="pricing-box__header">
      <?php if (isset($is_highlight) && $is_highlight) : ?>
        <span class="align-c pricing-box__highlight-text"><?php echo $_highlight_text; ?></span>
      <?php endif; ?>
      <h3 class="pricing-box__title"><?php echo $title; ?></h3>
      <?php if (!empty($pricing)) : ?>
        <p class="pricing-box__price">
          <span class="price"><?php echo $pricing; ?></span>
          <?php if (!empty($unit)) : ?>
            <span class="unit"><?php echo $unit; ?></span>
          <?php endif; ?>
          <?php if (!empty($duration)) : ?>
            <span class="duration"><?php echo $duration; ?></span>
          <?php endif; ?>
        </p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($description)) : ?>
    <div class="wysiwyg pricing-box__description">
      <?php echo $description; ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($button_text) && !empty($button_url)) : ?>
    <div class="pricing-box__footer">
      <?php
      the_block('button', array(
        'class' => 'align-c pricing-box__button',
        'button' => $button_text,
        'type' => $button_style,
        'url' => $button_url
      ));
      ?>
    </div>
  <?php endif; ?>
</div>
