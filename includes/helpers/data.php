<?php

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

if (!function_exists('codetot_svg')) {
  function codetot_svg($name, $echo = true)
  {

    if (empty($name)) {
      return new WP_Error(
        '404',
        __('Missing svg file name', 'ct-theme')
      );
    }

    $paths = apply_filters('codetot_svg_paths', []);
    $svg_content = '';

    if (is_child_theme()) {
      $paths[] = get_stylesheet_directory() . '/assets/svg';
    }
    $paths[] = get_template_directory() . '/assets/svg';

    foreach($paths as $path) {
      $file_path = $path . '/' . $name . '.svg';

      if (file_exists($file_path) && empty($svg_content)) {
        $svg_content = file_get_contents($file_path);
      }
    }

    if (empty($svg_content)) {
      $svg_content = '<!-- No svg file for ' . $name . '.svg -->';
    }

    if ($echo) {
      echo $svg_content;

      return true;
    } else {
      return $svg_content;
    }
  }
}
