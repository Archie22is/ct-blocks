<?php
/**
 * @package    Codetot_Base
 * @subpackage Codetot_Blocks_Templates
 * @author     CODE TOT JSC <dev@codetot.com>
 * @since      2.0.0
 */
class Codetot_Blocks_Templates {
  /**
   * Singleton instance
   *
   * @var Codetot_Blocks_Templates
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Blocks_Templates
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

	public function __construct() {
		add_action('template_include', array($this, 'template_include'));
		add_action('theme_page_templates', array($this, 'page_templates'));
	}

	/**
	 * Add custom page template to load on frontend
	 *
	 * @param string $template
	 * @return void
	 */
	public function template_include($template) {
	  if (is_page()) {
      $page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

      if ($page_template === 'flexible') {
        $template = CODETOT_BLOCKS_DIR . '/includes/templates/page-flexible.php';
      }
    }

	  return $template;
  }

	/**
	 * Add custom page template in page editing screen
	 *
	 * @param array $post_templates
	 * @return array
	 */
  public function page_templates($post_templates) {
    $post_templates['flexible'] = __('Block Page', 'ct-blocks');

    return $post_templates;
  }
}
