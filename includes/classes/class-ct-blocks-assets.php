<?php
/**
 * @package    Codetot_Base
 * @subpackage Codetot_Blocks_Assets
 * @author     CODE TOT JS <dev@codetot.com>
 */
class Codetot_Blocks_Assets {
  /**
   * Singleton instance
   *
   * @var Codetot_Blocks_Assets
   */
  private static $instance;

  /**
   * @var string
   */
  private $theme_environment;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Blocks_Assets
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

	public function __construct() {
		$this->theme_version = $this->is_localhost() ? substr(sha1(rand()), 0, 6) : CODETOT_BLOCKS_VERSION;
		$this->theme_environment = $this->is_localhost() ? '' : '.min';

    add_action('wp_enqueue_scripts', array($this, 'load_assets'), 10);
	}

  public function load_assets() {
		if (!$this->is_localhost()) {
			wp_enqueue_style('ct-blocks-frontend-legacy-style', CODETOT_BLOCKS_PLUGIN_URI . '/assets/css/legacy-frontend.min.css', array(), $this->theme_version);
			wp_enqueue_style('ct-blocks-frontend-style', CODETOT_BLOCKS_PLUGIN_URI . '/assets/css/frontend.min.css', array(), $this->theme_version);
		}

		wp_enqueue_script('ct-blocks-frontend-legacy-script', CODETOT_BLOCKS_PLUGIN_URI . '/assets/js/legacy-frontend' . $this->theme_environment . '.js', array('jquery'), $this->theme_version, true);
		wp_enqueue_script('ct-blocks-frontend-script', CODETOT_BLOCKS_PLUGIN_URI . '/assets/js/frontend' . $this->theme_environment . '.js', array(), $this->theme_version, true);
	}

  public function is_localhost() {
    return !empty($_SERVER['HTTP_X_CODETOT_BLOCKS_HEADER']) && $_SERVER['HTTP_X_CODETOT_BLOCKS_HEADER'] === 'development';
  }
}
