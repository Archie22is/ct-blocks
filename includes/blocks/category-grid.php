<?php

class Codetot_Block_Category_Grid extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Category_Grid
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Category_Grid
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'category-grid';
    $this->block_slug = 'category_grid';
    $this->block_title = __('Category Grid', 'ct-blocks');
    $this->fields = [
      // Settings
      'enable_lazyload',
      'enable_slider',
      'class',
      'anchor_name',
      'columns_count',
      'header_alignment',
      'content_alignment',
      'background_type',
      'background_contract',
      'block_preset',
      'image_size',
      // Content
      'title',
      'description',
      'select_categories'
    ];

    $this->svg_icon = '<svg id="category_grid" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 3h-12v-2h12v2zm0 3h-12v2h12v-2zm0 5h-12v2h12v-2zm0 5h-12v2h12v-2zm0 5h-12v2h12v-2zm-14-20h-10v10h10v-10zm0 12h-10v10h10v-10z"/></svg>';
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/category_grid.jpg';

    parent::__construct();
  }
}

Codetot_Block_Category_Grid::instance();
