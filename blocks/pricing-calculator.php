<?php

$header = codetot_build_content_block(array(
  'title' => $title,
  'description' => $description,
  'block_tag' => 'header'
), 'pricing-calculator');

$options = !empty($items) ? codetot_get_min_max_numbers($items) : [];

$columns = [];

// Build left column
ob_start();
if (!empty($left_title) || !empty($left_intro)) : ?>
  <div class="pricing-calculator__inner">
    <p class="label-text pricing-calculator__sub-title"><?php echo $left_title; ?></p>
    <p class="pricing-calculator__qty js-number"><?php echo $options['min']; ?></p>
    <div class="pricing-calculator__range-slider">
      <?php printf('<input type="range" class="js-rangeslider" min="%1$s" max="%2$s" value="%3$s" step="%4$s">',
        $options['min'],
        $options['max'],
        $options['min'],
        1
      ); ?>
    </div>
    <div class="pricing-calculator__left-intro"><?php echo $left_intro; ?></div>
  </div>
<?php endif;
$left_column = ob_get_clean();

if (!empty($left_column)) {
  $columns[] = $left_column;
}

// Build right column
ob_start();
if (!empty($right_title) || !empty($right_intro)) {
  ?>
  <div class="pricing-calculator__inner">
    <p class="label-text pricing-calculator__sub-title"><?php echo $right_title; ?></p>
    <div class="pricing-calculator__list">
      <?php foreach($items as $item) : ?>
        <div class="pricing-calculator__item js-item" data-min="<?php echo $item['min']; ?>" data-max="<?php echo $item['max']; ?>">
          <p class="pricing-calculator__price">
            <span class="number"><?php echo $item['price']; ?></span>
            <span class="duration"><?php echo $item['duration']; ?></span>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
    <?php if (!empty($button_text) && !empty($button_url)) : ?>
      <div class="pricing-calculator__cta">
        <?php the_block('button', array(
          'button' => $button_text,
          'url' => $button_url,
          'type' => 'primary',
          'class' => 'pricing-calculator__button'
        )); ?>
      </div>
    <?php endif; ?>
    <div class="pricing-calculator__right-intro"><?php echo $right_intro; ?></div>
  </div>
  <?php
}
$right_column = ob_get_clean();

if (!empty($right_column)) {
  $columns[] = $right_column;
}

$content = codetot_build_grid_columns($columns, 'pricing-calculator');

the_block('default-section', array(
  'class' => 'pricing-calculator has-2-columns',
  'attributes' => ' data-ct-block="pricing-calculator"',
  'header' => $header,
  'content' => $content
));
