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
class Codetot_Base {

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
   * The instance of current options by Redux Framework
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
	public $options;
  /**
   * @var void
   */
  private $pro_blocks;

  /**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
    $this->version = CODETOT_BLOCKS_VERSION;
		$this->plugin_name = CODETOT_BLOCKS_PLUGIN_SLUG;

		add_action('plugins_loaded', array($this, 'load_translation'));

		$this->load_dependencies();

    Codetot_Base_Public::instance();
    Codetot_Base_Admin_Acf::instance();

    $this->pro_blocks = apply_filters('codetot_pro_blocks', [
      'hero-image',
      'hero-slider',
      'hero-banner',
      'accordions',
      'bottom-cta',
      'breadcrumbs',
      'category-grid',
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
      'product-tabs',
      'team-member',
      'testimonials',
      'three-up-card',
      'two-up-intro',
      'two-up-slider',
      'section-product',
    ]);
    $this->load_pro_blocks();
	}

	public function load_translation() {
    load_plugin_textdomain(
      'codetot-base',
      false,
      CODETOT_BLOCKS_DIR . '/languages/'
    );
  }

	public function load_pro_blocks() {
    require_once CODETOT_BLOCKS_DIR . 'includes/classes/interface-block.php';
    require_once CODETOT_BLOCKS_DIR . 'includes/classes/class-block.php';

    foreach ($this->pro_blocks as $block) {
      require_once CODETOT_BLOCKS_DIR . 'includes/pro-blocks/register/' . $block . '.php';
    }
  }

	private function load_dependencies() {
    require_once CODETOT_BLOCKS_DIR . 'admin/class-admin-acf.php';
		require_once CODETOT_BLOCKS_DIR . 'public/class-public.php';
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_options() {
    return $this->options;
  }
}
