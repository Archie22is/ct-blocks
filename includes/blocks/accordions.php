<?php

class Codetot_Block_Accordions extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Accordions
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Accordions
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'accordions';
    $this->block_slug = 'accordions';
    $this->block_title = __('Accordions', 'codetot');
    $this->fields = [
      // Settings
      'class',
      'anchor_name',
      'layout',
      'is_fullwidth',
      'block_preset',
      'background_type',
      'header_alignment',
      // Fields
      'title',
      'description',
      'items'
    ];

    parent::__construct();
  }
}

Codetot_Block_Accordions::instance();
