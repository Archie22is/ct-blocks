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
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'counters';
    $this->block_slug = 'counters';
    $this->block_title = __('Counters', 'ct-blocks');
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

    $this->svg_icon = '<svg id="counters" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M0 21l12-18 12 18h-24zm12-16.197l-10.132 15.197h20.263l-10.131-15.197" /></svg>';
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/counters.jpg';

    parent::__construct();
  }
}

Codetot_Block_Counters::instance();
