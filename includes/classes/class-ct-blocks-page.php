<?php
/**
 * Default page block for setting up ACF Fields Flexible content
 *
 * @package ct_blocks/ct_blocks_page
 * @since   2.0.0
 * @author  CODE TOT JSC <dev@codetot.com>
 */
class Codetot_Blocks_Page {

  /**
   * Singleton instance
   *
   * @var Codetot_Blocks_Page
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Blocks_Page
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    add_action('init', function() {
      $this->register_flexible_block_fields();
    });

    add_action('wp', function() {
      add_filter('the_content', array($this, 'load_flexible_page_template'));
    });
  }

  /**
	 * Add custom filter for easy to override fields
	 *
   * @return mixed|void
   */
  public function register_layout_fields() {
    return apply_filters('codetot_layout_fields', []);
  }

	/**
	 * Register ACF field group
	 */
  public function register_flexible_block_fields() {
    if( function_exists('acf_add_local_field_group') ):

      acf_add_local_field_group(array(
        'key' => 'group_5fc0dd588aa21',
        'title' => 'Flexible Page',
        'fields' => array(
          array(
            'key' => 'field_5fc0dd65ac221',
            'label' => 'Blocks',
            'name' => 'blocks',
            'type' => 'flexible_content',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'layouts' => $this->register_layout_fields(),
            'button_label' => esc_html__('Add Block', 'ct-blocks'),
            'min' => '',
            'max' => '',
          ),
        ),
        'location' => array(
          array(
            array(
              'param' => 'page_template',
              'operator' => '==',
              'value' => 'flexible',
            ),
          ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array('the_content'),
        'active' => true,
        'description' => '',
      ));

    endif;
  }

	/**
	 * Filter default block fields
	 *
	 * @return array|void
	 */
  public function get_default_block_fields() {
    return array();
  }

	/**
	 * Load template on frontend
	 *
	 * @param string $content
	 * @return void
	 */
  public function load_flexible_page_template($content) {
    $template_slug = get_post_meta( get_the_ID(), '_wp_page_template', TRUE );

    if (!empty($template_slug) && $template_slug == 'flexible') {
      ob_start();
      if (have_rows('blocks')) {
        while ( have_rows('blocks') ) {

          the_row();

          do_action('codetot_flexible_page_row', get_row_index(), get_row_layout());
        }
      }

      return ob_get_clean();
    } else {
      return $content;
    }
  }
}

Codetot_Blocks_Page::instance();
