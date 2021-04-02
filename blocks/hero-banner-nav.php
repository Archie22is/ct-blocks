<?php
/**
 * Hero Banner- Navigation
 */
$menu_obj = !empty($menu_id) ? wp_get_nav_menu_object($menu_id) : null;
$menu_title = !empty($menu_obj) ? $menu_obj->name : __('Categories', 'codetot');
if (!empty($menu_obj)) :
?>
  <div class="hero-banner__nav">
    <div class="hero-banner__nav-header">
      <p class="hero-banner__nav-title"><?php echo $menu_title; ?></p>
    </div>
    <div class="hero-banner__nav-list">
      <?php wp_nav_menu(array(
        'menu' => $menu_id,
        'container' => false,
        'menu_class' => 'hero-banner__menu',
        'depth' => 2
      )); ?>
    </div>
  </div>
<?php endif; ?>
