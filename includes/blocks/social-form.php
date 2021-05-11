<?php

class Codetot_Block_Social_Form extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Social_Form
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Social_Form
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'social-form';
    $this->block_slug = 'social_form';
    $this->block_title = __('Social Form', 'ct-blocks');
    $this->fields = [
      'class',
      'social_title',
      'social_description',
      'select_form'
    ];

    parent::__construct();
  }
}

Codetot_Block_Social_Form::instance();
