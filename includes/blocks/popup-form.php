<?php

class Codetot_Block_Popup_Form extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Popup_Form
   */
  private static $instance;

  /**
   * Get singleton instance.
   *

   * @return Codetot_Block_Popup_Form

   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'popup-form';
    $this->block_slug = 'popup_form';
    $this->block_title = __('Popup Form', 'codetot');
    $this->fields = [
      'class',
      'block_preset',
      'select_form',
      'action_attribute',
      'label',
      'title',
      'description',
      'content'
    ];

    parent::__construct();
  }
}

Codetot_Block_Popup_Form::instance();
