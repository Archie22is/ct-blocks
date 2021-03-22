<?php
$_class = 'post-grid';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($columns) ? ' post-grid--' . $columns .'-column': '';

if ( !empty($query) ) : ?>
  <div class="<?php echo $_class; ?>">
    <div class="post-grid__container">
      <div class="grid post-grid__grid">
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
