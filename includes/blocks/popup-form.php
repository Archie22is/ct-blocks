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
    $this->block_title = __('Popup Form', 'ct-theme');
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

    $this->svg_icon = '<svg id="popup_form" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 6v12h-16v-12h16zm2-6h-20v20h20v-20zm-22 22v-19h-2v21h21v-2h-19z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_Popup_Form::instance();
