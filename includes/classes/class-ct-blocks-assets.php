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
    $this->theme_environment = $this->is_localhost() ? '' : '.min';

    add_action('wp_enqueue_scripts', array($this, 'load_css'));
    add_action('wp_enqueue_scripts', array($this, 'load_js'));
	}

  public function load_css() {
    wp_enqueue_style('codetot-blocks-style', CODETOT_BLOCKS_PLUGIN_URI . '/assets/css/blocks-style' . $this->theme_environment . '.css', array(), CODETOT_BLOCKS_VERSION);
  }

  public function load_js() {
    wp_enqueue_script('codetot-blocks-script', CODETOT_BLOCKS_PLUGIN_URI . '/assets/js/blocks-script' . $this->theme_environment . '.js', array('jquery'), CODETOT_BLOCKS_VERSION, true);
  }

  public function is_localhost() {
    return !empty($_SERVER['HTTP_X_CODETOT_BLOCK_HEADER']) && $_SERVER['HTTP_X_CODETOT_BLOCK_HEADER'] === 'development';
  }
}
