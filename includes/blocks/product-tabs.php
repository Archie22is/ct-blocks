<?php

class Codetot_Block_Product_Tabs extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Product_Tabs
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Product_Tabs
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'product-tabs';
    $this->block_slug = 'product_tabs';
    $this->block_title = esc_html__('Product Tabs', 'ct-peakshop');
    $this->fields = [
      // Settings
      'class',
      'tabs_alignment',
      'columns',
      // Input
      'title',
      'items',
    ];

    parent::__construct();
  }
}

Codetot_Block_Product_Tabs::instance();
