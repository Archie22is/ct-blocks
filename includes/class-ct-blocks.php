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
  private $blocks;

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
    add_filter('ct_theme_block_paths', array($this, 'load_block_paths'));
    add_filter('ct_theme_block_parts_paths', array($this, 'load_block_parts_paths'));

    include_once CODETOT_BLOCKS_DIR . 'includes/helpers.php';

    $this->load_dependencies();

    Codetot_Base_Public::instance();
    Codetot_Base_Admin_Acf::instance();

    $this->blocks = apply_filters('codetot_pro_blocks', [
      'hero-image',
      'hero-slider',
      'hero-banner',
      'accordions',
      'bottom-cta',
      'breadcrumbs',
      'contact-section',
      'counters',
      'cta-form',
      'feature-grid',
      'guarantee-list',
      'image-gallery',
      'image-row',
      'news-columns',
      'logo-grid',
      'section-post',
      'pricing-tables',
      'team-member',
      'testimonials',
      'three-up-card',
      'two-up-intro',
      'two-up-slider'
    ]);

    $this->load_theme_blocks();
    $this->load_blocks();
  }

  public function is_supported_theme() {
    $theme_tags = wp_get_theme()->Get('Tags') ?? [];

    return in_array('codetot-theme', $theme_tags);
  }

  public function load_translation()
  {
    load_plugin_textdomain(
      'codetot-base',
      false,
      CODETOT_BLOCKS_DIR . '/languages/'
    );
  }

  public function load_block_paths($paths)
  {
    $paths[] = CODETOT_BLOCKS_DIR . 'blocks';

    return $paths;
  }

  public function load_block_parts_paths($paths)
  {
    $paths[] = CODETOT_BLOCKS_DIR . 'blocks';

    return $paths;
  }

  public function load_theme_blocks() {
    if ($this->is_supported_theme()) {
      $theme_settings_json_file = get_theme_file_path() . '/blocks.json';
      if (file_exists($theme_settings_json_file)) {
        $theme_settings_raw_content = file_get_contents($theme_settings_json_file);
        $theme_settings = $theme_settings_raw_content !== false ? json_decode($theme_settings_raw_content, true) : null;

        if (!empty($theme_settings['blocks'])) {
          add_action('ct_blocks_after_load_blocks', function() use($theme_settings) {
            foreach($theme_settings['blocks'] as $block_name) {
              require_once get_stylesheet_directory() . '/' . $theme_settings['blocks_inc'] . '/' . $block_name . '.php';
            }
          });

          add_action('ct_blocks_fields_paths', function($paths) use($theme_settings) {
            $paths[] = get_stylesheet_directory() . '/' . $theme_settings['blocks_inc'];

            return $paths;
          });

          add_action('ct_theme_block_paths', function($paths) use($theme_settings) {
            $paths[] = get_stylesheet_directory() . '/' . $theme_settings['blocks_path'];


            if (is_child_theme()) {
              $paths[] = get_template_directory() . '/blocks';
            }

            return $paths;
          });

          add_action('ct_theme_block_parts_paths', function($paths) use($theme_settings) {
            $paths[] = get_theme_file_path() . '/' . $theme_settings['blocks_part'];

            if (is_child_theme()) {
              $paths[] = get_template_directory() . '/block-parts';
            }

            return $paths;
          });
        }
      }
    }
  }

  public function load_blocks()
  {
    require_once CODETOT_BLOCKS_DIR . 'includes/classes/interface-block.php';
    require_once CODETOT_BLOCKS_DIR . 'includes/classes/class-block.php';
    require_once CODETOT_BLOCKS_DIR . 'includes/helpers/utils.php';

    do_action('ct_blocks_before_load_blocks');

    foreach ($this->blocks as $block) {
      require_once CODETOT_BLOCKS_DIR . 'includes/blocks/' . $block . '.php';
    }

    do_action('ct_blocks_after_load_blocks');

    require_once CODETOT_BLOCKS_DIR . 'includes/classes/class-ct-blocks-page.php';
  }

  private function load_dependencies()
  {
    require_once CODETOT_BLOCKS_DIR . 'admin/class-admin-acf.php';
    require_once CODETOT_BLOCKS_DIR . 'public/class-public.php';
  }
}
