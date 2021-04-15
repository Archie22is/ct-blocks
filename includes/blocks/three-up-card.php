<?php

class Codetot_Block_Three_Up_Card extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Three_Up_Card
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
   * @return Codetot_Block_Three_Up_Card
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'three-up-card';
    $this->block_slug = 'three_up_card';
    $this->block_title = __('Three Up Card', 'codetot');
    $this->fields = ['anchor', 'class', 'alignment', 'items'];

    parent::__construct();
  }
}

Codetot_Block_Three_Up_Card::instance();
