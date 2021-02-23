<?php
/**
 * @packge Codetot_Pro_Toolkit
 * @subpackage Codetot_Pro_Toolkit_Block_Presets
 * @since 1.0.0
 */
if (!defined('ABSPATH')) exit;

class Codetot_Pro_Toolkit_Block_Presets {
  /**
   * Singleton instance
   *
   * @var Codetot_Pro_Toolkit_Block_Presets
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Pro_Toolkit_Block_Presets
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    add_filter('codetot_block_presets', array($this, 'load_block_presets'));
  }

  public function load_block_presets($presets) {
    $extra_presets = [];
    $numbers_of_presets = 6;
    for($i = 0; $i < $numbers_of_presets; $i++) {
      $extra_presets['preset-' . ($i + 1)] = sprintf(__('Preset %s', 'codetot-base'), $i + 1);
    }

    return array_merge($extra_presets, $presets);
  }
}

Codetot_Pro_Toolkit_Block_Presets::instance();
