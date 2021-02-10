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
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Codetot_Base_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

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
		if ( defined( 'CODETOT_BASE_VERSION' ) ) {
			$this->version = CODETOT_BASE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'codetot-base';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_public_hooks();
    $this->pro_blocks = apply_filters('codetot_pro_blocks', [
      'accordions',
      'bottom-cta',
      'breadcrumbs',
      'category-grid',
      'contact-section',
      'counters',
      'cta-form',
      'feature-grid',
      'guarantee-list',
      'hero-image',
      'hero-slider',
      'hero-banner',
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

	public function load_pro_blocks() {
    require_once CODETOT_BASE_DIR . 'includes/classes/interface-codetot-block.php';
    require_once CODETOT_BASE_DIR . 'includes/classes/class-codetot-block.php';

    foreach ($this->pro_blocks as $block) {
      require_once CODETOT_BASE_DIR . 'includes/pro-blocks/register/' . $block . '.php';
    }
  }

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Codetot_Base_Loader. Orchestrates the hooks of the plugin.
	 * - Codetot_Base_i18n. Defines internationalization functionality.
	 * - Codetot_Base_Admin. Defines all hooks for the admin area.
	 * - Codetot_Base_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once CODETOT_BASE_DIR . 'includes/class-codetot-base-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once CODETOT_BASE_DIR . 'includes/class-codetot-base-i18n.php';
		/**
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
    require_once CODETOT_BASE_DIR . 'admin/class-codetot-base-admin-acf.php';

    // Plugin features
    require_once CODETOT_BASE_DIR . 'includes/classes/class-codetot-gravity-forms.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once CODETOT_BASE_DIR . 'public/class-codetot-base-public.php';

		$this->loader = new Codetot_Base_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Codetot_Base_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Codetot_Base_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Codetot_Base_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action('template_include', $plugin_public, 'template_include');
		$this->loader->add_filter('theme_page_templates', $plugin_public, 'page_templates', 100);
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
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
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Codetot_Base_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
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
