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
		add_action('template_include', array($this, 'template_include'));
		add_action('theme_page_templates', array($this, 'page_templates'));
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
}
