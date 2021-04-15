<?php

class Codetot_Block_Guarantee_List extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Guarantee_List
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Guarantee_List
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'guarantee-list';
    $this->block_slug = 'guarantee_list';
    $this->block_title = __('Guarantee List', 'codetot');
    $this->fields = [
      // Settings
      'class',
      'anchor_name',
      'block_preset',
      'background_type',
      'layout',
      'content_alignment',
      'fullscreen',
      'hide_mobile',
      // Input
      'items'
    ];

    parent::__construct();
  }
}

Codetot_Block_Guarantee_List::instance();
