<?php
$container = codetot_site_container();
$is_full_screen = !empty($enable_full_screen_layout) ? ' image-row--full-screen' : '';
?>
<div class="image-row image-row--<?php echo count($columns); ?>-columns<?php if (!empty($is_full_screen)) : echo $is_full_screen; endif; ?>" data-aos="fade-up">
  <div class="<?php echo $container; ?> image-row__container">
    <div class="image-row__wrapper">
      <div class="grid image-row__grid">
        <?php foreach($columns as $key => $column) : ?>
          <div class="grid__col image-row__col image-row__col--<?php echo $column['column_width']; ?>">
            <a class="image-row__link" href="<?php echo $column['url']; ?>">
              <?php the_block('image', array(
                'image' => $column['image']['ID'],
                'class' => 'image--cover image-row__image'
              )); ?>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
