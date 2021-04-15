<?php

class Codetot_Block_Store_Locator extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Store_Locator
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Store_Locator
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'store-locator';
    $this->block_slug = 'store_locator';
    $this->block_title = __('Store Locator', 'ct-blocks');
    $this->fields = [
      'class',
      'anchor_name',
      'block_preset',
      'enter_addresses',
      'items'
    ];

    parent::__construct();
  }
}

Codetot_Block_Store_Locator::instance();
