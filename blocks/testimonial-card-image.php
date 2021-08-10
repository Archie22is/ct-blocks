<div class="testimonials__column">
  <figure class="testimonials__inner">
    <div class="testimonials__profile">
      <?php if (!empty($item['image'])) : ?>
        <?php the_block('image', array(
          'image' => $column['image'],
          'lazyload' => true,
          'class' => 'image--cover testimonials__image'
        )); ?>
      <?php endif; ?>
    </div>
  </figure>
</div>
