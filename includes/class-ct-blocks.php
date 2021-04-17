<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://codetot.com
 * @since      1.0.0
 *
 * @package    Codetot_Base
 * @subpackage Codetot_Base/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Codetot_Base
 * @subpackage Codetot_Base/includes
 * @author     CODE TOT JSC <dev@codetot.com>
 */
class Codetot_Base
{

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * @var array
   */
  private $plugin_blocks;

  /**
   * @var array
   */
  private $child_theme_blocks;

  /**
   * @var array
   */
  private $child_theme_settings;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct()
  {
    $this->version = CODETOT_BLOCKS_VERSION;
    $this->plugin_name = CODETOT_BLOCKS_PLUGIN_SLUG;

    add_action('plugins_loaded', array($this, 'load_translation'));

    $this->load_dependencies();

    Codetot_Blocks_Assets::instance();
    Codetot_Blocks_Admin::instance();
    Codetot_Blocks_Templates::instance();

    $this->plugin_blocks = $this->get_plugin_blocks();

    if (codetot_is_supported_theme()) {
      $this->child_theme_settings = $this->get_child_theme_settings();
      $this->child_theme_blocks = $this->get_child_theme_blocks();
    }

    $this->register_plugin_blocks_classes();

    if (codetot_is_supported_theme() && !empty($this->child_theme_blocks)) {
      $this->register_child_theme_block_classes();
    }

    add_action('plugins_loaded', array($this, 'load_all_blocks_paths'));
  }

  public function load_all_blocks_paths() {
    add_filter('ct_theme_block_paths', array($this, 'update_ct_theme_block_paths'));
    add_filter('ct_theme_block_parts_paths', array($this, 'update_block_parts_paths'));
    add_filter('ct_blocks_fields_paths', array($this, 'update_ct_blocks_fields_paths'));
  }

  public function get_plugin_blocks() {
    $plugin_blocks = codetot_load_json_array(CODETOT_BLOCKS_DIR . '/blocks.json');

    if (file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
      $woocommerce_blocks_list = codetot_load_json_array(CODETOT_BLOCKS_DIR . '/woocommerce-blocks.json');
      $plugin_blocks = array_merge($plugin_blocks, $woocommerce_blocks_list);
    }

    return $plugin_blocks;
  }

  public function get_child_theme_settings() {
    return codetot_load_json_array(get_stylesheet_directory() . '/blocks.json');
  }

  public function get_child_theme_blocks() {
    return !empty($this->child_theme_settings['blocks']) ? $this->child_theme_settings['blocks'] : [];
  }

  public function get_missing_block_name_message($block_name) {
    $error = new WP_Error('404', sprintf(__('Missing block class %s. Please contact Web Administrator.', 'ct-theme'), $block_name));

    return $error->get_error_message();
  }

  public function register_plugin_blocks_classes() {
    foreach ($this->plugin_blocks as $block_name) {
      $file_path = CODETOT_BLOCKS_DIR . 'includes/blocks/' . esc_attr($block_name) . '.php';

      if (file_exists($file_path)) {
        require_once $file_path;
      } else {
        echo $this->get_missing_block_name_message($block_name);
      }
    }
  }

  public function register_child_theme_block_classes() {
    if (empty($this->child_theme_blocks)) {
      return;
    }

    foreach($this->child_theme_blocks as $block_name) {
      $file_path = get_stylesheet_directory() . '/inc/blocks/'. esc_attr($block_name) . '.php';

      if (file_exists($file_path)) {
        require_once $file_path;
      } else {
        echo $this->get_missing_block_name_message($block_name);
      }
    }
  }

  public function update_ct_theme_block_paths($paths) {
    if (codetot_is_supported_theme() && !empty($this->child_theme_settings['blocks_path'])) {
      $paths[] = get_stylesheet_directory() . '/' . esc_attr($this->child_theme_settings['blocks_path']);
    }

    if (is_child_theme()) {
      $paths[] = get_template_directory() . '/blocks';
    }

    $paths[] = CODETOT_BLOCKS_DIR . 'blocks';

    return $paths;
  }

  public function update_block_parts_paths($paths) {
    if (codetot_is_supported_theme() && !empty($this->child_theme_settings['blocks_parts'])) {
      $paths[] = get_stylesheet_directory() . '/' . esc_attr($this->child_theme_settings['blocks_parts']);
    }

    if (is_child_theme()) {
      $paths[] = get_template_directory() . '/block-parts';
    }

    return $paths;
  }

  public function update_ct_blocks_fields_paths($paths) {
    if (codetot_is_supported_theme() && !empty($this->child_theme_settings['blocks_inc'])) {
      $paths[] = get_stylesheet_directory() . '/' . $this->child_theme_settings['blocks_inc'];
    }

    if (is_child_theme()) {
      $paths[] = get_template_directory() . '/inc/blocks';
    }

    return $paths;
  }

  public function load_translation()
  {
    load_plugin_textdomain(
      'ct-theme',
      false,
      CODETOT_BLOCKS_DIR . '/languages/'
    );
  }

  private function load_dependencies()
  {
    include_once CODETOT_BLOCKS_DIR . 'includes/helpers/data.php';
    include_once CODETOT_BLOCKS_DIR . 'includes/helpers/blocks.php';
    include_once CODETOT_BLOCKS_DIR . 'includes/helpers/env.php';
    include_once CODETOT_BLOCKS_DIR . 'includes/helpers/utils.php';

    require_once CODETOT_BLOCKS_DIR . 'includes/classes/interface-block.php';
    require_once CODETOT_BLOCKS_DIR . 'includes/classes/class-block.php';

    require_once CODETOT_BLOCKS_DIR . 'includes/classes/class-ct-blocks-templates.php';
    require_once CODETOT_BLOCKS_DIR . 'includes/classes/class-ct-blocks-page.php';
    require_once CODETOT_BLOCKS_DIR . 'includes/classes/class-ct-blocks-admin.php';
    require_once CODETOT_BLOCKS_DIR . 'includes/classes/class-ct-blocks-assets.php';
  }
}
