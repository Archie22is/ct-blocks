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
    $this->block_title = esc_html__('Product Tabs', 'ct-theme');
    $this->fields = [
      'class',
      'header_alignment',
      'label',
      'title',
      'description',
      'numbers',
      'columns',
      'categories',
      'attribute',
      'button_text',
      'button_url',
      'target',
      'button_style'
    ];

    $this->svg_icon = '<svg id="product_tabs" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 6h-6v-6h6v6zm9-6h-6v6h6v-6zm9 0h-6v6h6v-6zm0 8h-24v16h24v-16z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_Product_Tabs::instance();
