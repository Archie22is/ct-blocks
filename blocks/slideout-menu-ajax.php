<div class="header__vertical--logo">
  <?php codetot_logo_or_site_title(true); ?>
</div>

<?php echo get_search_form(array('id' => 'slideout-menu-ajax')); ?>
<?php

$locations = get_nav_menu_locations();
$menuPrimary = wp_get_nav_menu_object($locations['primary']);

?>
<?php if (get_global_option('select_theme') === 'evo') : ; ?>
<?php  $menuVertical = wp_get_nav_menu_object($locations['vertical_menu']); ?>
  <div class="header__vertical-header">
    <span class="header__vertical-icon"><?php codetot_svg('menu', true); ?></span>
    <span class="header__vertical-title"><?php echo $menuVertical->name; ?></span>
  </div>

  <?php if (has_nav_menu('primary')) :
    ob_start();
    wp_nav_menu(array(
      'theme_location' => 'vertical_menu',
      'container' => false,
      'menu_class' => 'header__vertical_menu'
    ));
    $primary_nav_html = ob_get_clean();

    echo $primary_nav_html;
  endif; ?>
<?php endif; ?>

<?php if (has_nav_menu('primary')) :
  ob_start();
  wp_nav_menu(array(
    'theme_location' => 'primary',
    'container' => 'nav',
    'container_class' => 'slideout-menu__nav',
    'menu_class' => 'slideout-menu__menu'
  ));
  $primary_nav = ob_get_clean();

  echo $primary_nav;
endif; ?>
