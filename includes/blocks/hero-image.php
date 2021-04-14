<?php

class Codetot_Block_Hero_Image extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Hero_Image
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
   * @return Codetot_Block_Hero_Image
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'hero-image';
    $this->block_slug = 'hero_image';
    $this->block_title = __('Hero Image', 'ct-theme');
    $this->fields = [
      'class',
      'content_alignment',
      'spacing',
      'background_position',
      'background_contract',
      'overlay',
      'fullscreen',
      'image',
      'mobile_image',
      'label',
      'title',
      'description',
      'buttons'
    ];

    $this->svg_icon = '<svg id="hero_image" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 5v14h-20v-14h20zm2-2h-24v18h24v-18zm-14 13.952c-1.551-.265-3-1.615-3-3.242v-2.574l3 2.721v3.095zm2-2.103v-2.814c2.744-.515 2.897-3.494 2.062-5.035l-1.372 1.509-1.183-1.509-1.107 1.509-1.412-1.509c-.812 1.499-.752 4.516 2.012 5.035v4.965h1.489c1.817 0 3.511-1.473 3.511-3.291v-2.574l-4 3.714z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_Hero_Image::instance();
