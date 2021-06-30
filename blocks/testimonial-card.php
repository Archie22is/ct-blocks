<?php
ob_start();
echo '<span class="testimonial-card__icon is-open" aria-hidden="true">';
if (!empty($column['open_svg_icon'])) {
  echo apply_filters('codetot_block_testimonial_card_open_svg_icon', $column['open_svg_icon']);
} else {
  codetot_svg('quotation-marks-open', true);
}
echo '</span>';
$open_quote_icon = ob_get_clean();

ob_start();
echo '<span class="testimonial-card__icon is-close" aria-hidden="true">';
if (!empty($column['close_svg_icon'])) {
  echo apply_filters('codetot_block_testimonial_card_close_svg_icon', $column['close_svg_icon']);
} else {
  codetot_svg('quotation-marks-close', true);
}
echo '</span>';
$close_quote_icon = ob_get_clean();

ob_start();
if (!empty($column['image'])) : ?>
  <figure class="testimonial-card__image-wrapper">
    <?php the_block('image', array(
      'image' => $column['image'],
      'size' => 'thumbnail',
      'class' => 'image--square image--cover testimonial-card__image'
    )); ?>
  </figure>
<?php endif;
$image_html = ob_get_clean();

ob_start();
echo '<figure class="testimonial-card__author">';
echo $image_html;
echo '<footer class="testimonial-card__author-info">';
if (!empty($column['name'])) : ?>
  <p><?php echo $column['name'] ?></p>
<?php endif; ?>
<?php if (!empty($column['profession'])) : ?>
  <cite><?php echo $column['profession'] ?></cite>
<?php endif;
echo '</footer>';
echo '</figure>';
$author_html = ob_get_clean();

if (!empty($column)) : ?>
  <div class="rel testimonial-card">
    <?php echo $open_quote_icon; ?>
    <blockquote class="wysiwyg testimonial-card__comment">
      <div class="testimonial-card__inner">
        <?php if (!empty($column['title'])) : ?>
          <p class="testimonial-card__title"><?php echo $column['title']; ?></p>
        <?php endif; ?>
        <?php echo $column['testimonial']; ?>
      </div>
      <?php echo $author_html; ?>
    </blockquote>
    <?php echo $close_quote_icon; ?>
  </div>
<?php endif; ?>
