<?php if (!empty($column)) : ?>
  <div class="testimonials__column">
    <figure class="testimonials__inner">
      <blockquote class="wysiwyg testimonials__comment" data-aos="fade-up">
        <div class="testimonials__icon testimonials__icon--open">
          <?php codetot_svg('quotation-marks-open', true) ?>
        </div>
        <?php if (!empty($column['title'])) : ?>
          <h3><?php echo $column['title']; ?></h3>
        <?php endif; ?>
        <?php if (!empty($column['testimonial'])) : ?>
          <p><?php echo $column['testimonial']; ?></p>
        <?php endif; ?>
        <div class="testimonials__icon testimonials__icon--close">
          <?php codetot_svg('quotation-marks-close', true) ?>
        </div>
      </blockquote>
      <div class="testimonials__profile" data-aos="fade-up">
        <?php if (!empty($column['image'])) : ?>
          <?php the_block('image', array(
            'image' => $column['image'],
            'class' => 'image--cover testimonials__image'
          )); ?>
        <?php endif; ?>
        <figcaption class="testimonials__info">
          <?php if (!empty($column['name'])) : ?>
            <p><?php echo $column['name'] ?></p>
          <?php endif; ?>
          <?php if (!empty($column['profession'])) : ?>
            <cite><?php echo $column['profession'] ?></cite>
          <?php endif; ?>
        </figcaption>
      </div>
    </figure>
  </div>
<?php endif; ?>
