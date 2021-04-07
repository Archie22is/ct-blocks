<?php

class Codetot_Block_Product_Columns extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Product_Columns
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Product_Columns
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'product-columns';
    $this->block_slug = 'product_columns';
    $this->block_title = esc_html__('Product Columns', 'ct-peakshop');
    $this->fields = [
      // Settings
      'class',
      'slideshow',
      'header_alignment',
      'content_alignment',
      'columns',
      // Input
      'title',
      'description',
      'items',
    ];

    parent::__construct();
  }
}

Codetot_Block_Product_Columns::instance();
