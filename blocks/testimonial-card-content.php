<div class="testimonials__column">
  <figure class="testimonials__inner">
    <div class="testimonials__profile">
      <figcaption class="testimonials__info">
        <?php if (!empty($column['name'])) : ?>
          <p><?php echo $column['name'] ?></p>
        <?php endif; ?>
        <?php if (!empty($column['profession'])) : ?>
          <cite><?php echo $column['profession'] ?></cite>
        <?php endif; ?>
      </figcaption>
    </div>
    <blockquote class="testimonials__comment">
      <?php if (!empty($column['title'])) : ?>
        <h3><?php echo $column['title']; ?></h3>
      <?php endif; ?>
      <?php if (!empty($column['testimonial'])) : ?>
        <p><?php echo $column['testimonial']; ?></p>
      <?php endif; ?>
    </blockquote>
  </figure>
</div>
