<?php

class Codetot_Block_Product_Tabs_Slider extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Product_Tabs_Slider
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Product_Tabs_Slider
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'product-tabs-slider';
    $this->block_slug = 'product_tabs_slider';
    $this->block_title = __('Product Tabs Slider', 'ct-blocks');
    $this->fields = ['class', 'header_alignment', 'columns','number','background_type', 'title', 'label', 'description','product_tabs'];

    parent::__construct();
  }
}

Codetot_Block_Product_Tabs_Slider::instance();
