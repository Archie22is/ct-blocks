<?php
$_class = 'post-grid';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($columns) ? ' post-grid--' . $columns .'-column': '';
$container = codetot_site_container();

if ( !empty($query) ) : ?>
  <div class="<?php echo $_class; ?>">
    <div class="<?php echo $container; ?> post-grid__container">
      <div class="grid post-grid__grid" data-aos="fade-up" data-aos-duration="800">
        <?php while( $query->have_posts() ) : $query->the_post(); ?>
          <div class="f fdc grid__col post-grid__col">
            <?php the_block('post-card', array(
              'card_style' => !empty($card_style) ? $card_style : 'style-1'
            )); ?>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
