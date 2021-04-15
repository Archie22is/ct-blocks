<?php

class Codetot_Block_Hero_Slider extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Hero_Slider
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
   * @return Codetot_Block_Hero_Slider
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'hero-slider';
    $this->block_slug = 'hero_slider';
    $this->block_title = __('Hero Slider', 'codetot');
    $this->fields = [
      'class',
      'block_preset',
      'enable_prev_next_buttons',
      'enable_page_dots',
      'overlay',
      'content_alignment',
      'items',
      'previous_next_style',
      'previous_next_alignment',
      'page_dots_style',
      'page_dots_alignment'
    ];

    parent::__construct();
  }
}

Codetot_Block_Hero_Slider::instance();
