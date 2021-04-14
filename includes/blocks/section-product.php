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
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'section-product';
    $this->block_slug = 'section_product';
    $this->block_title = __('Section_Product', 'codetot');
    $this->fields = [
      'class',
      'title',
      'show_category',
      'show_shop_link',
      'section_align',
      'numbers',
      'columns',
      'categories',
      'attribute',
      'button_text',
      'button_url',
      'target',
      'button_style'
    ];

    $this->svg_icon = '<svg id="section_product" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M23 6.066v12.065l-11.001 5.869-11-5.869v-12.131l11-6 11.001 6.066zm-21.001 11.465l9.5 5.069v-10.57l-9.5-4.946v10.447zm20.001-10.388l-9.501 4.889v10.568l9.501-5.069v-10.388zm-5.52 1.716l-9.534-4.964-4.349 2.373 9.404 4.896 4.479-2.305zm-8.476-5.541l9.565 4.98 3.832-1.972-9.405-5.185-3.992 2.177z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_Section_Product::instance();
