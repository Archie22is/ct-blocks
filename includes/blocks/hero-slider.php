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
    $this->block_title = __('Hero Slider', 'ct-blocks');
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

    $this->svg_icon = '<svg id="hero_slider" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 15c0-.552.448-1 1.001-1s.999.448.999 1-.446 1-.999 1-1.001-.448-1.001-1zm6.2 0l-1.7 2.6-1.3-1.6-3.2 4h10l-3.8-5zm7.8-5v14h-18v-14h18zm-2 2h-14v10h14v-10zm-6.462-9.385l2.244 5.385h2.167l-3.334-8-16.615 6.923 4 9.663v-5.265l-1.384-3.321 12.922-5.385z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_Hero_Slider::instance();
