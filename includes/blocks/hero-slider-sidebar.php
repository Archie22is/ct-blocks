<?php

class Codetot_Block_Hero_Slider_Sidebar extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Hero_Slider_Sidebar
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Hero_Slider_Sidebar
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'hero-slider-sidebar';
    $this->block_slug = 'hero_slider_sidebar';
    $this->block_title = __('Hero Slider Sidebar', 'ct-blocks');
    $this->fields = [
      'class',
      'banner_left',
      'banner_right'
    ];

    parent::__construct();
  }
}

Codetot_Block_Hero_Slider_Sidebar::instance();
