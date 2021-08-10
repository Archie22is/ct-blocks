<div class="testimonials__item">
  <figure class="testimonials__inner">
    <div class="testimonials__profile">
      <figcaption class="testimonials__info">
        <?php if (!empty($item['name'])) : ?>
          <p><?php echo $item['name'] ?></p>
        <?php endif; ?>
        <?php if (!empty($item['profession'])) : ?>
          <cite><?php echo $item['profession'] ?></cite>
        <?php endif; ?>
      </figcaption>
    </div>
    <blockquote class="wysiwyg testimonials__comment">
      <?php if (!empty($item['title'])) : ?>
        <h3><?php echo $item['title']; ?></h3>
      <?php endif; ?>
      <?php if (!empty($item['testimonial'])) : ?>
        <p><?php echo $item['testimonial']; ?></p>
      <?php endif; ?>
    </blockquote>
  </figure>
</div>
