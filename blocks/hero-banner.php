<?php
/**
 * Block: Hero Banner
 */
$block_class = codetot_block_generate_class(array(
  'block_preset' => $block_preset,
  'class' => $class
), 'hero-banner');

if (!empty($display_left_menu) && !empty($menu)) {
  $block_class .= ' hero-banner--has-navigation';
}

if (!empty($slider_items)) : ?>
  <div class="<?php echo $block_class; ?>" data-ct-block="hero-banner">
    <div class="container hero-banner__container">
      <div class="grid hero-banner__grid">
        <?php if (!empty($display_left_menu) && !empty($menu)) :
          ?>
          <div class="grid__col hero-banner__col hero-banner__col--navigation">
            <?php the_block('hero-banner-nav', array(
              'menu_id' => $menu
            )); ?>
          </div>
        <?php endif; ?>
        <div class="grid__col hero-banner__col hero-banner__col--slider">
          <?php the_block('hero-banner-slider', array(
            'items' => $slider_items,
            'navItems' => !empty($nav_slider_items) ? $nav_slider_items : false,
            'block_preset' => $block_preset
          )); ?>
        </div>
        <?php if (!empty($right_items)) : ?>
          <div class="grid__col hero-banner__col hero-banner__col--list">
            <div class="hero-banner__col-inner">
              <?php the_block('hero-banner-list', array(
                'items' => $right_items
              )); ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
