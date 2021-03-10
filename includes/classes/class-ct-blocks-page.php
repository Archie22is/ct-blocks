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

    add_action('codetot_flexible_page_row', array($this, 'load_default_blocks_template'));
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
            'key' => 'field_5ffc8d481j7bc6',
            'label' => 'Enable Container',
            'name' => 'enable_container',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33',
              'class' => '',
              'id' => '',
            ),
            'message' => 'Enable Container',
            'default_value' => 1,
            'ui' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
          ),
          array(
            'key' => 'field_5fsad0c1967b',
            'label' => 'Alignment',
            'name' => 'alignment',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'align-l' => 'Align Left',
              'align-c' => 'Align Center',
              'align-r' => 'Align Right',
            ),
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

  public function load_default_blocks_template() {
    $row = get_row_layout();

    switch($row):

      case 'page_title':

        $enable_container = get_sub_field('enable_container');
        $alignment = get_sub_field('alignment');
        $_class = get_sub_field('class');
        $_class .= empty($enable_container) ? ' page-header--no-container' : '';
        $_class .= !empty($alignment) ? ' ' . $alignment : ' align-l';

        the_block('page-header', array(
          'title' => get_sub_field('title'),
          'class' => $_class
        ));
        break;

      case 'page_content':

        echo '<div class="mt-1 mb-1 page-content">';
        echo '<div class="container">';
        echo '<div class="wysiwyg page-content__inner">';
        echo  get_sub_field('content');
        echo '</div>';
        echo '</div>';
        echo '</div>';

        break;

    endswitch;
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
