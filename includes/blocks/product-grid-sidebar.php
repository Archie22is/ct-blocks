<?php

class Codetot_Block_Product_Grid_Sidebar extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Product_Grid_Sidebar
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Product_Grid_Sidebar
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'product-grid-sidebar';
    $this->block_slug = 'product_grid_sidebar';
    $this->block_title = __('Product_Grid_Sidebar', 'codetot');
    $this->fields = [
      'block_preset',
      'layout',
      'header_alignment',
      'style_color',
      'title',
      'categories',
      'attribute',
      'numbers',
      'columns',
      'image_sidebar_items',
      'image_size',
      'button_text',
      'button_url',
      'button_target',
      'button_style'
    ];

    parent::__construct();
  }
}

Codetot_Block_Product_Grid_Sidebar::instance();
