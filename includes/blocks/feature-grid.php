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
    $this->block_title = __('Feature Grid', 'codetot');
    $this->fields = [
      // Settings
      'class',
      'anchor_name',
      'box_content',
      'content_alignment',
      'image_size',
      'columns',
      'background_contract',
      'background_type',
      // Content
      'title',
      'description',
      'items',
    ];

    parent::__construct();
  }
}

Codetot_Block_Feature_Grid::instance();
