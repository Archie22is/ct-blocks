<div class="testimonials__column">
  <figure class="testimonials__inner">
    <div class="testimonials__profile" data-aos="fade-up">
      <?php if (!empty($column['image'])) : ?>
        <?php the_block('image', array(
          'image' => $column['image'],
          'class' => 'image--cover testimonials__image'
        )); ?>
      <?php endif; ?>
    </div>
  </figure>
</div>
