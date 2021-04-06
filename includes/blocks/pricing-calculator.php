<?php

class Codetot_Block_Pricing_Calculator extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Pricing_Calculator
   */
  private static $instance;

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
   * Get singleton instance.
   *
   * @return Codetot_Block_Pricing_Calculator
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'pricing-calculator';
    $this->block_slug = 'pricing_calculator';
    $this->block_title = __('Pricing Calculator', 'ct-blocks');
    $this->fields = [
      'title',
      'description',
      'left_title',
      'left_intro',
      'right_title',
      'right_intro',
      'button_text',
      'button_url',
      'items'
  ];

    parent::__construct();
  }
}

Codetot_Block_Pricing_Calculator::instance();
