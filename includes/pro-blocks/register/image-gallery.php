<?php

class Codetot_Block_Image_Gallery extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Image_Gallery
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
   * @return Codetot_Block_Image_Gallery
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'image-gallery';
    $this->block_slug = 'image_gallery';
    $this->block_title = __('Image Gallery', 'codetot');
    $this->fields = ['style','items'];

    parent::__construct();
  }
}

Codetot_Block_Image_Gallery::instance();
