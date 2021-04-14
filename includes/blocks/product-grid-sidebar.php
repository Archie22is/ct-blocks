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
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'product-grid-sidebar';
    $this->block_slug = 'product_grid_sidebar';
    $this->block_title = __('Product_Grid_Sidebar', 'ct-theme');
    $this->fields = [
      'block_preset',
      'image_left',
      'image_link',
      'title',
      'numbers',
      'layout',
      'columns',
      'style_color',
      'categories',
      'attribute',
      'button_text',
      'button_url',
      'button_target',
      'button_style'
    ];

    $this->svg_icon = '<svg id="product_grid_sidebar" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 3h-11v-2h11v2zm0 3h-11v2h11v-2zm0 5h-11v2h11v-2zm0 5h-11v2h11v-2zm0 5h-11v2h11v-2zm-13-20h-11v22h11v-22z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_Product_Grid_Sidebar::instance();
