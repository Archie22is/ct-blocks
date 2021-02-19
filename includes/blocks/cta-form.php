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

    parent::__construct();
  }
}

Codetot_Block_Contact_Form::instance();
