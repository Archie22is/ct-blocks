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

    add_action('wp_enqueue_scripts', array($this, 'load_assets'));
	}

  public function load_assets() {
    wp_enqueue_style('ct-blocks-style', CODETOT_BLOCKS_PLUGIN_URI . '/assets/css/frontend' . $this->theme_environment . '.css', array('codetot-global'), CODETOT_BLOCKS_VERSION);
    wp_enqueue_script('ct-blocks-script', CODETOT_BLOCKS_PLUGIN_URI . '/assets/js/frontend' . $this->theme_environment . '.js', array('jquery'), CODETOT_BLOCKS_VERSION, true);
  }

  public function is_localhost() {
    return !empty($_SERVER['HTTP_X_CODETOT_BLOCK_HEADER']) && $_SERVER['HTTP_X_CODETOT_BLOCK_HEADER'] === 'development';
  }
}
