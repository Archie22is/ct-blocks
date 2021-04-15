<?php

abstract class Codetot_Base_Block {
  public function __construct() {
    add_filter('codetot_layout_fields', array($this, 'register_fields'));
    add_action('codetot_flexible_page_row', array($this, 'load_template'), 10, 2);
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
}
