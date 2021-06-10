<?php
$container = codetot_site_container();
$_class = 'news-columns';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($background_type) ? ' bg-' . esc_attr($background_type) : '';
$_class .= !empty($background_type) && $background_type !== 'white' ? ' section-bg' : ' section';
$_class .= !empty($block_preset) ? ' news-columns--style-' . esc_attr($block_preset) : '';
$_class .= !empty($header_alignment) ? ' is-header-' .  $header_alignment : '';
$_class .= !empty($columns) ? ' has-'. $columns .'-columns' : '';


$args = array(
  'post_type' => 'post',
  'tax_query' => array(
    array(
      'taxonomy' => 'category',
      'field' => 'id',
      'terms' => $categories
    )
  ),
);

$query = new WP_Query($args);

ob_start(); ?>
<?php if (!empty($title)) : ?>
  <div class="news-columns__header">
    <?php if (!empty($label)) : ?>
      <p class="news-columns__label"><?php echo $label; ?></p>
    <?php endif; ?>
    <h2 class="h2 news-columns__title"><?php echo $title; ?></h2>
  </div>
<?php endif; ?>
<?php
$header = ob_get_clean();

ob_start();
if($query->have_posts()) {
  echo '<div class="grid news-columns_grid">';
  foreach( $categories as $category ):
    $post_args = array(
      'post_type' => 'post',
      'posts_per_page' => !empty($number_posts) ? $number_posts : '3',
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field' => 'id',
          'terms' => $category
        )
      ),
    );
    $post_query = new WP_Query($post_args);
     if ($post_query->have_posts()) : ?>
      <div class="grid__col default-section__col news-columns__col">
          <h3 class="news-columns__post-title"><?php echo get_the_category_by_ID($category); ?></h3>
          <?php if (!empty($post_query)) : ?>
            <ul class="news-columns__post">
              <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
                <li><a class="news-columns__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile;
              wp_reset_postdata(); ?>
            </ul>
          <?php endif; ?>
      </div>
    <?php endif;
  endforeach;
  echo '</div>';
}
$content = ob_get_clean();

the_block('default-section', array(
  'class' => $_class,
  'header' => !empty($title) ? $header : false,
  'content' => $content
));
