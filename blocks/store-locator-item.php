<?php
$post_args = array(
  'post_type' => 'store',
  'posts_per_page' => '-1',
  'category__in' => !empty($category) ? $category : '',
);

$post_query = new WP_Query($post_args);

if ($post_query->have_posts()) :
  while ($post_query->have_posts())  : $post_query->the_post(); ?>
    <?php $address = get_field('address'); ?>
    <div class="store-locator-item js-data-location" data-title="<?php the_title() ?>" data-lat="<?php echo $address['lat']; ?>" data-lng="<?php echo $address['lng']; ?>">
      <h3 class="store-locator-item__title"><?php the_title(); ?></h3>
      <p class="f store-locator-item__address"><span class="f"><?php codetot_svg('address', true); ?></span><?php echo $address['address']; ?></p>
      <a href="tel:<?php echo get_field('hotline'); ?>" class="f store-locator-item__phone"><span class="f"><?php codetot_svg('hotline', true); ?></span><?php echo get_field('hotline'); ?></a>
    </div>
  <?php
  endwhile; wp_reset_postdata();
endif;
