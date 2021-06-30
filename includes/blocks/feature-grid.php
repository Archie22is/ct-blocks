<?php

class Codetot_Block_Feature_Grid extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Feature_Grid
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Feature_Grid
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'feature-grid';
    $this->block_slug = 'feature_grid';
    $this->block_title = __('Feature Grid', 'ct-blocks');
    $this->fields = [
      // Settings
      'class',
      'anchor_name',
      'columns',
      'enable_card_border',
      'card_layout',
      'header_alignment',
      'content_alignment',
      'media_size',
      'background_contract',
      'background_type',
      // Content
      'title',
      'label',
      'description',
      'items',
    ];

    $this->svg_icon = '<svg id="feature_grid" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11 11h-11v-11h11v11zm13 0h-11v-11h11v11zm-13 13h-11v-11h11v11zm13 0h-11v-11h11v11z"/></svg>';
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/feature-grid.png';
    parent::__construct();
  }
}

Codetot_Block_Feature_Grid::instance();
