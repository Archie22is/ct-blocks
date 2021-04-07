<?php
$post_args = array(
  'post_type' => 'store',
  'posts_per_page' => '-1',
  'category__in' => !empty($category) ? $category : '',
);

$post_query = new WP_Query($post_args);

if ($post_query->have_posts()) :
  while ($post_query->have_posts())  : $post_query->the_post(); ?>
    <?php
    // echo  get_the_id();
      $category = get_the_terms( get_the_id(), 'store_locator' );
      $store_locator_categoies = [];
     ?>
    <?php $address = get_field('address'); ?>
    <?php $hotline = get_field('hotline'); ?>
    <div class="store-locator-item js-data-location" data-categories="<?php foreach ( $category as $key=>$cat) echo $cat->term_id . ' '; ?>" data-title="<?php the_title() ?>" data-lat="<?php echo $address['lat']; ?>" data-lng="<?php echo $address['lng']; ?>">
      <h3 class="store-locator-item__title"><?php the_title(); ?></h3>
      <p class="f store-locator-item__address"><span class="f store-locator-item__icon"><?php codetot_svg('address', true); ?></span><?php echo $address['address']; ?></p>
      <a href="tel:<?php echo $hotline; ?>" class="f store-locator-item__phone"><span class="f store-locator-item__icon"><?php codetot_svg('hotline', true); ?></span><?php echo $hotline; ?></a>
      <?php
      $button_text = get_field('button_text');
      $button_style = get_field('button_style');
      $button_url = get_field('button_url');
      $target = get_field('target');

      if (!empty($button_text)) :
        the_block('button', array(
          'class' => empty($button_url) ? 'js-marker-action' : false,
          'button' => $button_text,
          'type' => !empty($button_style) ? $button_style : false,
          'url' => !empty($button_url) ? $button_url : false,
          'target' => !empty($target) ? $target : false
        ));
      endif;
      ?>
    </div>
  <?php
  endwhile; wp_reset_postdata();
endif;
?>
