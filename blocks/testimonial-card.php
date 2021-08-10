<?php
ob_start();
echo '<span class="testimonial-card__icon is-open" aria-hidden="true">';
if (!empty($item['open_svg_icon'])) {
  echo apply_filters('codetot_block_testimonial_card_open_svg_icon', $item['open_svg_icon']);
} else {
  codetot_svg('quotation-marks-open', true);
}
echo '</span>';
$open_quote_icon = ob_get_clean();

ob_start();
echo '<span class="testimonial-card__icon is-close" aria-hidden="true">';
if (!empty($item['close_svg_icon'])) {
  echo apply_filters('codetot_block_testimonial_card_close_svg_icon', $item['close_svg_icon']);
} else {
  codetot_svg('quotation-marks-close', true);
}
echo '</span>';
$close_quote_icon = ob_get_clean();

ob_start();
if (!empty($item['image'])) : ?>
  <figure class="testimonial-card__image-wrapper">
    <?php the_block('image', array(
      'image' => $item['image'],
      'size' => 'thumbnail',
      'lazyload' => true,
      'class' => 'image--square image--cover testimonial-card__image'
    )); ?>
  </figure>
<?php endif;
$image_html = ob_get_clean();

ob_start();
echo '<footer class="testimonial-card__author-info">';
if (!empty($item['name'])) : ?>
  <p><?php echo $item['name'] ?></p>
<?php endif; ?>
<?php if (!empty($item['profession'])) : ?>
  <cite><?php echo $item['profession'] ?></cite>
<?php endif;
echo '</footer>';
$author_info = ob_get_clean();

ob_start();
echo '<figure class="testimonial-card__author">';
echo $image_html;
echo $author_info;
echo '</figure>';
$author_html = ob_get_clean();

if (!empty($item)) : ?>
  <div class="rel testimonial-card">
    <?php echo $open_quote_icon; ?>
    <blockquote class="wysiwyg testimonial-card__comment">
      <div class="testimonial-card__inner">
        <?php if (!empty($item['title'])) : ?>
          <p class="testimonial-card__title"><?php echo $item['title']; ?></p>
        <?php endif; ?>
        <?php echo $item['testimonial']; ?>
      </div>
      <?php echo $author_html; ?>
    </blockquote>
    <?php echo $close_quote_icon; ?>
  </div>
<?php endif; ?>
