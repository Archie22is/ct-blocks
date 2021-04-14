<?php

class Codetot_Block_Contact_Form extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * @var string
   */
  public $block_name;
  /**
   * @var string|void
   */
  public $block_title;
  /**
   * @var string
   */
  public $block_slug;
  /**
   * @var array
   */
  public $fields;

  /**
   * Singleton instance
   *
   * @var Codetot_Block_Contact_Form
   */
  private static $instance;

  /**
   * Get singleton instance.
   *

   * @return Codetot_Block_Contact_Form

   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'cta-form';
    $this->block_slug = 'cta_form';
    $this->block_title = __('Contact Form', 'codetot');
    $this->fields = [
      'style',
      'class',
      'title',
      'content',
      'select_form',
      'image',
      'background_image',
      'background_types' ,
      'overlay'
    ];

    ob_start();
    echo '<svg id="cta_form" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M2.598 9h-1.055c1.482-4.638 5.83-8 10.957-8 6.347 0 11.5 5.153 11.5 11.5s-5.153 11.5-11.5 11.5c-5.127 0-9.475-3.362-10.957-8h1.055c1.443 4.076 5.334 7 9.902 7 5.795 0 10.5-4.705 10.5-10.5s-4.705-10.5-10.5-10.5c-4.568 0-8.459 2.923-9.902 7zm12.228 3l-4.604-3.747.666-.753 6.112 5-6.101 5-.679-.737 4.608-3.763h-14.828v-1h14.826z"/></svg>';
    $this->svg_icon = ob_get_clean();
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/cta_form.jpg';

    parent::__construct();
  }
}

Codetot_Block_Contact_Form::instance();
