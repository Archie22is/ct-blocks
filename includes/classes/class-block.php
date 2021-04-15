<?php

abstract class Codetot_Base_Block {
  public function __construct() {
    add_filter('codetot_layout_fields', array($this, 'register_fields'));
    add_action('codetot_flexible_page_row', array($this, 'load_template'), 10, 2);
    add_filter('codetot_blocks_svg_icons', array($this, 'register_svg_icon'));
    add_filter('codetot_blocks_preview_images', array($this, 'register_preview_image_url'));
  }

  /**
   * @param array $fields
   * @return array
   * @throws Exception
   */
  public function register_fields($fields)
  {
    if (!empty($this->load_primary_fields()) && is_array($this->load_primary_fields())) {
      if (!empty($fields)) {
        $results = array_merge($fields, $this->load_primary_fields());
      } else {
        $results = $this->load_primary_fields();
      }
    } else {
      return [];
    }

    return $results;
  }

  /**
   * @return array|WP_Error
   * @throws Exception
   */
  public function load_primary_fields()
  {
    $available_paths = apply_filters('ct_blocks_fields_paths', [
      CODETOT_BLOCKS_DIR . 'includes/blocks'
    ]);

    try {
      foreach ($available_paths as $available_path) {
        $file_path = $available_path . '/' . $this->block_name . '.json';

        if (file_exists($file_path)) {
          return json_decode(file_get_contents($file_path), true);
        }
      }

      throw new Exception(sprintf(__('Block %s is not available.', 'ct-blocks'), $this->block_name . '.json'));
    } catch (Exception $e) {
      echo $e->getMessage();
      die();
    }
  }

  public function load_template($index, $layout) {
    if ($layout == $this->block_slug) {
      $data = codetot_get_sub_fields($this->fields);

      the_block($this->block_name, $data);
    }
  }

  public function get_default_svg_icon() {
    return '<svg id="' . esc_attr($this->block_slug) . '" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M12 0l-11 6v12.131l11 5.869 11-5.869v-12.066l-11-6.065zm7.91 6.646l-7.905 4.218-7.872-4.294 7.862-4.289 7.915 4.365zm-16.91 1.584l8 4.363v8.607l-8-4.268v-8.702zm10 12.97v-8.6l8-4.269v8.6l-8 4.269z"/></svg>';
  }

  public function register_preview_image_url($images) {
    if (!empty($this->preview_image_url)) {
      $images[$this->block_slug] = esc_url($this->preview_image_url);
    }

    return $images;
  }

  public function register_svg_icon($icons) {
    if (!empty($this->svg_icon)) {
      $icons[] = $this->svg_icon;
    } else {
      $icons[] = $this->get_default_svg_icon();
    }

    return $icons;
  }
}
