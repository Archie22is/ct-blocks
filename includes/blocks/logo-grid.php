<?php

class Codetot_Block_Logo_Grid extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Logo_Grid
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Logo_Grid
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'logo-grid';
    $this->block_slug = 'logo_grid';
    $this->block_title = __('Logo Grid', 'codetot');
    $this->fields = [
      // Options
      'class',
      'anchor_name',
      'background_type',
      'enable_slideshow',
      'columns',
      'header_alignment',
      // Input
      'title',
      'description',
      'items'
    ];

    parent::__construct();
  }
}

Codetot_Block_Logo_Grid::instance();
