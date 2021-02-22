<?php

/**
 * @param string $block_name
 * @param array $args
 * @return false|string
 */
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

/**
 * @param string $block_name
 * @param array $args
 * @return void|WP_Error
 */
if ( ! function_exists( 'the_block' ) ) {
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
        $path = $available_paths[0] . '/' . $file_name . '.php';
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
/**
 * @param string $path_name
 * @return false|string
 */
function get_block_part($path_name)
{
  ob_start();
  the_block_part($path_name);
  return ob_get_clean();
}

/**
 * @param string $path_name
 */
function the_block_part($path_name)
{
  $available_paths = apply_filters('ct_theme_block_parts_paths', []);

  $path = '';

  try {
    foreach ($available_paths as $available_path) {
      $file_name = $available_path . '/' . esc_html($path_name) . '.php';

      if (file_exists($file_name)) {
        $path = $file_name;
      }
    }

    if (!empty($path)) {
      include($path);
    } else {
      if (WP_DEBUG) {
        var_dump($available_paths);
      }

      throw new Exception(sprintf(__('Block part %s is not available.', 'codetot'), $path_name));
    }
  } catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}

/**
 * @param array $array
 * @return array
 */
if ( ! function_exists( 'codetot_get_sub_fields' ) ) {
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
if ( ! function_exists( 'codetot_svg' ) ) {
  function codetot_svg($name, $echo = true)
  {
    $dir = get_template_directory() . '/assets/svg/';
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

function codetot_is_woocommerce_activated()
{
  return class_exists('WooCommerce');
}

/**
 * @param string $background_name
 * @return bool
 */
function codetot_is_dark_background($background_name)
{
  return in_array($background_name, array('primary', 'secondary', 'dark', 'black'));
}

/**
 * @param $args
 * @param $origin_class
 * @param string $extra_class
 * @return string
 */
function codetot_block_generate_class($args, $origin_class)
{
  $_class = array($origin_class);

  foreach ($args as $key => $arg) {
    $_class[$key] = _codetot_block_generate_class($key, $arg, $origin_class);
  }

  return implode(' ', $_class);
}

/**
 * @param string $key
 * @param string $value
 * @param string $prefix_class
 * @return string
 */
function _codetot_block_generate_class($key, $value, $prefix_class)
{
  /**
   * Available args
   *
   * block_preset
   * layout|main_layout
   * content_layout
   * header_alignment
   * content_alignment
   * background_type
   * column
   */

  $_class = '';

  switch ($key) {
    case 'block_preset':
      $_value = str_replace('preset-', '', $value);
      $_class = sprintf('%s--preset-%s', $prefix_class, $_value);
      break;

    case 'main_layout':
    case 'layout':
      $_class = sprintf('%s--layout-%s', $prefix_class, $value);
      break;

    case 'content_layout':
      $_class = sprintf('%s--content-layout-%s', $prefix_class, $value);
      break;

    case 'header_alignment':
      $_class = sprintf('%s--header-alignment-%s', $prefix_class, $value);
      break;

    case 'content_alignment':
      $_class = sprintf('%s--content-alignment-%s', $prefix_class, $value);
      break;

    case 'background_type':
      $new_class = sprintf('bg-%s', $value);
      $new_class .= $key == 'white' ? ' section' : sprintf(' %s--has-bg section-bg', $prefix_class);
      $new_class .= codetot_is_dark_background($value) ? sprintf(' %s--dark-contract', $prefix_class) : sprintf(' %s--light-contract', $prefix_class);

      $_class = $new_class;

      break;

    case 'hide_mobile':
      $_class = 'section--hide-mobile';
      break;

    case 'column':
      if (is_numeric((int) $value)) {
        $number_class = sprintf(_n('%s-column', '%s-columns', $value), $value);
      } else {
        $number_class = $value - '-columns';
      }

      $_class = sprintf('%s--%s', $prefix_class, $number_class);
      break;

    case 'fullscreen':
    case 'no_container':
      if (isset($value) && $value) {
        $_value = str_replace('_', '-', $key);
        $_class = sprintf('%s--%s', $prefix_class, $_value);
      }

      break;

    case 'class':
      $_class = $value;
      break;
  }

  return $_class;
}
