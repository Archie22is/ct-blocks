<?php
$container = codetot_site_container();
$_class = 'news-columns';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($number_categories) ? ' news-columns--' . $number_categories . '-columns' : ' news-columns--3-columns';
?>
<section class="<?php echo $_class; ?> news-columns--style-1">
  <div class="<?php echo $container; ?> news-columns__container">
    <?php if (!empty($title)) : ?>
      <div class="news-columns__header">
        <?php if (!empty($label)) : ?>
          <p class="news-columns__label" data-aos="fade-up"><?php echo $label; ?></p>
        <?php endif; ?>
        <h2 class="h2 news-columns__title" data-aos="fade-up"><?php echo $title; ?></h2>
      </div>
    <?php endif; ?>
    <div class="news-columns__main">
      <div class="grid news-columns__inner">
        <?php
        for ($i = 0; $i <= ($number_categories - 1); $i++) {

          $post_args = array(
            'post_type' => 'post',
            'posts_per_page' => !empty($number_posts) ? $number_posts : '3',
            'tax_query' => array(
              array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $category[$i]
              )
            ),
          );

          $post_query = new WP_Query($post_args);

          ?>
          <div class="grid__col news-columns__col" data-aos="fade-up" data-aos-duration="800">
            <?php if ($post_query->have_posts()) : ?>
              <h3 class="news-columns__post-title"><?php echo get_the_category_by_ID($category[$i]); ?></h3>
              <?php if (!empty($post_query)) : ?>
                <div class="news-columns__post" data-aos="fade-up" data-aos-duration="800">
                  <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
                    <a class="news-columns__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  <?php endwhile;
                  wp_reset_postdata(); ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
