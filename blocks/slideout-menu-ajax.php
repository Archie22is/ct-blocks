<?php echo get_search_form(array('id' => 'slideout-menu-ajax')); ?>
<?php if (get_global_option('select_theme') === 'evo') : ; ?>
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
