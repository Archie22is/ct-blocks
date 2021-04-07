<?php

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
    $this->register_flexible_block_fields();

    add_action('wp', function() {
      add_filter('the_content', array($this, 'load_flexible_page_template'));
    });
  }

  /**
   * @return mixed|void
   */
  public function register_layout_fields() {
    $default_fields = $this->get_default_block_fields();

    return apply_filters('codetot_layout_fields', $default_fields);
  }

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
            'button_label' => 'Add Block',
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
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array('the_content'),
        'active' => true,
        'description' => '',
      ));

    endif;
  }

  public function get_default_block_fields() {
    return array(
      'layout_5fc0dde27a510' => array(
        'key' => 'layout_5fc0dde27a510',
        'name' => 'page_title',
        'label' => 'Page Title',
        'display' => 'block',
        'sub_fields' => array(
          array(
            'key' => 'field_5fc0de07de7c9',
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_5fc03add7de7c9',
            'label' => 'Class',
            'name' => 'class',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_5fsad0c1967b',
            'label' => 'Content Alignment',
            'name' => 'content_alignment',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(),
            'allow_null' => 0,
            'other_choice' => 0,
            'default_value' => '',
            'layout' => 'vertical',
            'return_format' => 'value',
            'save_other_choice' => 0,
          ),
        ),
        'min' => '',
        'max' => '',
      ),
      'layout_5fc0dd6c6ab68' => array(
        'key' => 'layout_5fc0dd6c6ab68',
        'name' => 'page_content',
        'label' => 'Page Content',
        'display' => 'block',
        'sub_fields' => array(
          array(
            'key' => 'field_5fc0ddd17a50f',
            'label' => 'Content',
            'name' => 'content',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1,
            'delay' => 0,
          ),
        ),
        'min' => '',
        'max' => '',
      ),
    );
  }

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
