<?php

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
      foreach ($available_paths as $available_path) {
        $file_name = $available_path . '/' . $block_name . '.php';

        if (file_exists($file_name) && empty($path)) {
          $path = $file_name;
        }
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

if (!function_exists('get_block_part')) {
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
}

if (!function_exists('the_block_part')) {
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
}

if (!function_exists('codetot_is_dark_background')) {
  /**
   * @param string $background_name
   * @return bool
   */
  function codetot_is_dark_background($background_name)
  {
    return in_array($background_name, array('primary', 'secondary', 'dark', 'black'));
  }
}

if (!function_exists('codetot_block_generate_class')) {
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
}

if (!function_exists('_codetot_block_generate_class')) {
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
        $_class = ($value === true) ? ' section--hide-mobile' : '';
        break;

      case 'column':
        if (is_numeric((int)$value)) {
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
}

if (!function_exists('codetot_generate_block_background_class')) {
  /**
   * @param $background_type
   * @return string
   */
  function codetot_generate_block_background_class($background_type)
  {
    $_class = !empty($background_type) ? ' bg-' . esc_attr($background_type) : '';
    if (!empty($background_type) && codetot_is_dark_background($background_type)) {
      $_class .= ' is-dark-contract';
    }

    $_class .= !empty($background_type) && $background_type !== 'white' ? ' section-bg' : ' section';

    return $_class;
  }
}

if (!function_exists('codetot_build_content_block')) {
  /**
   * @param $args
   * @param $prefix_class
   * @return false|string
   */
  function codetot_build_content_block($args, $prefix_class) {
    $output_elements = [];
    $title_tag = (!empty($args['title_tag']) ? $args['title_tag'] : 'h2');
    $block_tag = (!empty($args['block_tag']) ? $args['block_tag'] : 'div');
    $_class = (!empty($args['default_class'])) ? $args['default_class'] : $prefix_class . '__header';

    if (!empty($args['label'])) {
      $output_elements['label'] = sprintf('<p class="%1$s__label">%2$s</p>', $prefix_class, $args['label']);
    }

    if (!empty($args['title'])) {
      $output_elements['label'] = sprintf('<%1$s class="%2$s__title">%3$s</%4$s>',
        $title_tag,
        $prefix_class,
        $args['title'],
        $title_tag
      );
    }

    if (!empty($args['description'])) {
      $output_elements['description'] = sprintf('<div class="wysiwyg %1$s__description">%2$s</div>', $prefix_class, $args['description']);
    }

    $_class .= !empty($args['alignment']) ? ' ' . $prefix_class . '--' . $args['alignment'] . ' section-header--' . $args['alignment'] : '';
    $_class .= !empty($args['class']) ? ' ' . $args['class'] : '';

    ob_start();
    printf('<%s class="%s">', $block_tag, $_class);
    if (isset($args['enable_container'])) : printf('<div class="%s %s__container">', codetot_site_container(), $prefix_class); endif;

    if (!empty($args['before_content']) ) :
      echo $args['before_content'];
    endif;
    echo implode('', $output_elements);

    if (!empty($args['after_content']) ) :
      echo $args['after_content'];
    endif;
    if (isset($args['enable_container'])) :
      printf('</div>');
    endif;
    printf('</%s>', $block_tag);
    return ob_get_clean();
  }
}

if (!function_exists('codetot_build_grid_columns')) {
  /**
   * Generate HTML markup for grid columns
   *
   * @param array $columns
   * @param string $prefix_class
   * @param array $args
   * @return string
   */
  function codetot_build_grid_columns($columns, $prefix_class, $args = [])
  {
    if (!is_array($columns)) {
      return '';
    }

    if (!empty($args) && !empty($args['grid_class'])) {
      $grid_class = $args['grid_class'];
    }

    ob_start(); ?>
    <div
      class="grid <?php echo $prefix_class; ?>__grid<?php if (!empty($grid_class)) : echo ' ' . $grid_class; endif; ?>">
      <?php foreach ($columns as $column) :
        $_column_class = 'grid__col';
        $_column_class .= ' ' .$prefix_class . '__col';
        $_column_class .= !empty($args) && !empty($args['column_class']) ? ' ' . $args['column_class'] : '';
        $_column_class .= !empty($args) && is_array($column) && !empty($column['class']) ? ' ' . $column['class'] : '';
        $_column_attr = !empty($args) && !empty($args['column_attributes']) ? ' ' . $args['column_attributes'] : '';

        ?>
        <div
          class="<?php echo $_column_class; ?>"<?php if (!empty($_column_attr)) : echo ' ' . $_column_attr; endif; ?>>
          <?php
          if (is_array($column) && !empty($column['content'])) {
            echo $column['content'];
          } else {
            echo $column;
          }
          ?>
        </div>
      <?php endforeach; ?>
    </div>
    <?php

    return ob_get_clean();
  }
}


if (!function_exists('codetot_build_slider_block')) {
  /**
   * Generate HTML markup for slider
   *
   * @param array $columns
   * @param string $prefix_class
   * @param array $args
   * @return string
   */
  function codetot_build_slider($columns, $prefix_class, $args = [])
  {
    if (!is_array($columns)) {
      return '';
    }

    if (!empty($args) && !empty($args['slider_class'])) {
      $slider_class = $args['slider_class'];
    }

    if (!empty($args) && !empty($args['slider_settings'])) {
      $slider_settings = $args['slider_settings'];
    }

    if (!empty($args) && !empty($args['slider_attributes'])) {
      $slider_attributes = $args['slider_attributes'];
    }

    ob_start(); ?>

    <div class="<?php echo $prefix_class; ?>__inner<?php if (!empty($slider_class)) : echo ' ' . $slider_class; endif; ?>"<?php if (!empty($slider_attributes)) : echo ' ' . $slider_attributes; endif; ?>>
      <div class="<?php echo $prefix_class; ?>__slider js-slider" <?php if (!empty($slider_settings)) : ?> data-carousel='<?= json_encode($slider_settings); ?>'<?php endif; ?>>
        <?php foreach ($columns as $column) : ?>
          <div class="<?php echo $prefix_class; ?>__slider-item js-slider-item">
            <?php echo $column; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php

    return ob_get_clean();
  }
}
