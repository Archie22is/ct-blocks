<?php

class Codetot_Block_Testimonials extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Testimonials
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Testimonials
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'testimonials';
    $this->block_slug = 'testimonials';
    $this->block_title = __('Testimonials', 'codetot');
    $this->fields = [
      'class',
      'anchor_name',
      'block_preset',
      'background_contract',
      'background_type',
      'title',
      'label',
      'description',
      'columns'
    ];

    parent::__construct();
  }
}

Codetot_Block_Testimonials::instance();
