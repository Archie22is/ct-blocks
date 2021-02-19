<?php
/**
 * @package    Codetot_Base
 * @subpackage Codetot_Base_Public
 * @author     CODE TOT JS <dev@codetot.com>
 */
class Codetot_Base_Public {
  /**
   * Singleton instance
   *
   * @var Codetot_Base_Public
   */
  private static $instance;

  /**
   * @var string
   */
  private $theme_environment;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Base_Public
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

		add_action('template_include', array($this, 'template_include'));
		add_action('theme_page_templates', array($this, 'page_templates'));
    add_action('wp_enqueue_scripts', array($this, 'load_css'));
    add_action('wp_enqueue_scripts', array($this, 'load_js'));
	}

	public function template_include($template) {
	  if (is_page()) {
      $page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

      if ($page_template === 'flexible') {
        $template = CODETOT_BLOCKS_DIR . '/public/templates/page-flexible.php';
      }
    }

	  return $template;
  }

  public function page_templates($post_templates) {
    $post_templates['flexible'] = __('Block Page', 'ct-blocks');

    return $post_templates;
  }

  public function load_css() {
    wp_enqueue_style('fancybox-style', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', null, '3.5.7', 'all');
    wp_enqueue_style('codetot-blocks-style', CODETOT_BLOCKS_PLUGIN_URI . '/assets/css/blocks-style' . $this->theme_environment . '.css', array('codetot-first-screen'), CODETOT_CHILD_VERSION);
  }

  public function load_js() {
    wp_enqueue_script('fancybox-script', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array('jquery'), '3.5.7', true);
    wp_enqueue_script('codetot-blocks-script', CODETOT_BLOCKS_PLUGIN_URI . '/assets/js/blocks-script' . $this->theme_environment . '.js', array('jquery'), CODETOT_CHILD_VERSION, true);
  }

    /**
   * @return bool
   */
  public function is_localhost()
  {
    return !empty($_SERVER['HTTP_X_CODETOT_BLOCK_HEADER']) && $_SERVER['HTTP_X_CODETOT_BLOCK_HEADER'] === 'development';
  }
}
