<?php
$layout = codetot_get_category_sidebar_on_single();
$post_grid_columns = codetot_get_category_column_number();
$post_card_style = codetot_get_category_post_card_style();
$container = codetot_site_container();
$sidebar = codetot_get_category_sidebar();
$class ='category-post';
$class .= !empty($layout) ? ' category-post--' .esc_attr($layout) : '';
?>
<div class="<?php echo $class; ?>">
  <div class="<?php echo $container; ?> category-post__container">
    <div class="grid category-post__grid">
      <div class="grid__col category-post__col category-post__col--wrapper">
        <?php
          the_block( 'page-header', array(
            'title' => single_cat_title("", false)
          ));
          if(!empty($query)) :
            if ( $query->have_posts() ) :
              the_block('post-grid', array(
                'query' => $query,
                'columns' => !empty($post_grid_columns) ? $post_grid_columns : '3',
                'card_style' => !empty($post_card_style) ? $post_card_style : 'style-1'
              ));
            else :

              _e( 'No posts were found.', 'codetot' );

            endif;
            the_block('pagination');
          endif;
        ?>
      </div>
      <?php if($layout !== 'no-sidebar') : ?>
        <div class="grid__col category-post__col category-post__col--sidebar">
          <?php
          the_block('post-sidebar', array(
            'sidebar' => $sidebar
          ));
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
