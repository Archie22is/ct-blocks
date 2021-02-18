<?php
$container = codetot_site_container();
$_class = 'section-post';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($block_preset) ? ' section-post--' . $block_preset : '';

$post_args = array(
  'post_type' => 'post',
  'posts_per_page' => !empty($number_posts) ? $number_posts : '3',
  'category__in' => !empty($category) ? $category : '',
);

$post_query = new WP_Query($post_args);
if ($post_query->have_posts()) :?>
  <section class="<?php echo $_class; ?>">
    <div class="<?php echo $container; ?> section-post__container">
      <?php if (!empty($title)) : ?>
        <div class="section-post__header">
          <div class="section-post__inner">
            <?php if (!empty($label)) : ?>
              <p class="section-post__label" data-aos="fade-up"><?php echo $label; ?></p>
            <?php endif; ?>
            <h2 class="h2 section-post__title" data-aos="fade-up"><?php echo $title; ?></h2>
          </div>
        </div>
      <?php endif; ?>
      <div class="section-product_main">
        <?php
        the_block('post-grid', array(
          'label' => !empty($label) ? $label : '',
          'query' => $post_query,
          'columns' => !empty($post_grid_columns) ? $post_grid_columns : '3',
          'card_style' => !empty($post_card_style) ? $post_card_style : 'style-1'
        ));
        ?>
      </div>
    </div>
  </section>
<?php endif;
