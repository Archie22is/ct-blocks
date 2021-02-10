<?php

class Codetot_Block_Section_Product extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Section_Product
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Section_Product
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'section-product';
    $this->block_slug = 'section_product';
    $this->block_title = __('Section_Product', 'codetot');
    $this->fields = [ 'class', 'title', 'section_align', 'numbers', 'columns', 'categories', 'attribute', 'button_text', 'button_url', 'target', 'button_style'];

    parent::__construct();
  }
}

Codetot_Block_Section_Product::instance();
