<?php

class Codetot_Block_Two_Up_Slider extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Two_Up_Slider
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
   * @return Codetot_Block_Two_Up_Slider
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'two-up-slider';
    $this->block_slug = 'two_up_slider';
    $this->block_title = __('Two Up Slider', 'codetot');
    $this->fields = ['content', 'button_text', 'button_url', 'images'];

    parent::__construct();
  }
}

Codetot_Block_Two_Up_Slider::instance();
