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
    $this->block_title = esc_html__('Product Columns', 'ct-theme');
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

    $this->svg_icon = '<svg id="product_columns" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 6h-6v-6h6v6zm9-6h-6v6h6v-6zm9 0h-6v6h6v-6zm-18 9h-6v6h6v-6zm9 0h-6v6h6v-6zm9 0h-6v6h6v-6zm-18 9h-6v6h6v-6zm9 0h-6v6h6v-6zm9 0h-6v6h6v-6z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_Product_Columns::instance();
