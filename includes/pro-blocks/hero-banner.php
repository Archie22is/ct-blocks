<?php

class Codetot_Block_Hero_Banner extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Hero_Banner
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Hero_Banner
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'hero-banner';
    $this->block_slug = 'hero_banner';
    $this->block_title = __('Hero Banner', 'codetot');
    $this->fields = [
      'class',
      'block_preset',
      'display_left_menu',
      'menu',
      'slider_items',
      'description',
      'right_items'
    ];

    parent::__construct();
  }
}

Codetot_Block_Hero_Banner::instance();
