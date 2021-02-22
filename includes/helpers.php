<?php

if (!function_exists('codetot_svg')) {
  function codetot_svg($name, $echo = true)
  {
    $dir  = get_stylesheet_directory() . '/assets/svg/';
    $path = $dir . $name . '.svg';
    $svg_content = '';

    if ($name && file_exists($path)) {
      $svg_content = file_get_contents($path);
    }

    if (empty($svg_content)) {
      $svg_content = '<!-- No svg file for ' . $name . ' -->';
    }

    if ($echo) {
      echo $svg_content;

      return true;
    } else {
      return $svg_content;
    }
  }
}

if (!function_exists('get_block')) {
  /**
   * @param string $block_name
   * @param array $args
   * @return false|string
   */
  function get_block($block_name, $args = array())
  {
    ob_start();
    the_block($block_name, $args);
    return ob_get_clean();
  }
}

if (!function_exists('the_block')) {
  /**
   * @param string $block_name
   * @param array $args
   * @return void|WP_Error
   */
  function the_block($block_name, $args = array())
  {
    if (empty($block_name)) {
      return new WP_Error(
        '404',
        __('Missing block name', 'ct-blocks')
      );
    }

    extract($args, EXTR_SKIP);

    $available_paths = apply_filters('ct_theme_block_paths', []);

    $path = '';

    try {
      if (count($available_paths) > 1) {
        foreach ($available_paths as $available_path) {
          $file_name = $available_path . '/' . $block_name . '.php';

          if (file_exists($file_name) && empty($path)) {
            $path = $file_name;
          }
        }
      } else {
        $path = $available_paths[0] . '/' . $block_name . '.php';
      }

      if (!empty($path)) {
        include($path);
      } else {
        if (WP_DEBUG) {
          var_dump($available_paths);
        }
        throw new Exception(sprintf(__('Block %s is not available.', 'codetot'), $block_name));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      die();
    }
  }
}

if (!function_exists('codetot_get_sub_fields')) {
  /**
   * @param array $array
   * @return array
   */
  function codetot_get_sub_fields($array)
  {
    if (empty($array) || !is_array($array)) {
      return array();
    }

    $output = array();

    foreach ($array as $key) {
      $output[$key] = get_sub_field($key);
    }

    return $output;
  }
}

if ( ! function_exists( 'codetot_site_container' ) ) {
  /**
   * @return string
   */
  function codetot_site_container() {
    // boxed - fullwidth
    return !empty(get_global_option('codetot_container_layout')) ? 'container ' . sprintf('container--%s', get_global_option('codetot_container_layout')) : 'container container--fullwidth';
  }
}

if (!function_exists('get_global_option')) {
  function get_global_option($field_name) {
    $options = get_option('ct_theme');

    return !empty($options[$field_name]) ? $options[$field_name] : null;
  }
}

if (!function_exists('get_codetot_data')) {
  function get_codetot_data($field_name) {
    $options = get_option('ct_data');

    return !empty($options[$field_name]) ? $options[$field_name] : null;
  }
}
