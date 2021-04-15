<?php

class Codetot_Block_Pricing_Tables extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Pricing_Tables
   */
  private static $instance;

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
   * Get singleton instance.
   *
   * @return Codetot_Block_Pricing_Tables
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'pricing-tables';
    $this->block_slug = 'pricing_tables';
    $this->block_title = __('Pricing Tables', 'codetot');
    $this->fields = [
      //setting
    'layout',
    'item_style',
    'block_preset',
    'header_alignment',
    'number_columns',
    'background_contract',
    'list_icon',
    'background_image',
    'enable_prev_next_buttons',
    'previous_next_style',
    'previous_next_alignment',
    'enable_page_dots',
    'page_dots_style',
    'page_dots_alignment',
    'cell_alignment',
    'enable_autoplay',
    'speed',
    //Input
    'title',
    'description',
    'items'
  ];

    parent::__construct();
  }
}

Codetot_Block_Pricing_Tables::instance();
