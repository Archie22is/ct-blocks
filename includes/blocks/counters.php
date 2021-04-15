<?php

class Codetot_Block_Counters extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Counters
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Counters
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'counters';
    $this->block_slug = 'counters';
    $this->block_title = __('Counters', 'codetot');
    $this->fields = [
      // Settings
      'class',
      'anchor_name',
      'layout',
      'layout_items',
      'columns',
      'header_alignment',
      'content_alignment',
      'background_type',
      // Input
      'title',
      'description',
      'counters'
    ];

    parent::__construct();
  }
}

Codetot_Block_Counters::instance();
