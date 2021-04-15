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
    $this->block_title = __('Hero Image', 'codetot');
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

    parent::__construct();
  }
}

Codetot_Block_Hero_Image::instance();
