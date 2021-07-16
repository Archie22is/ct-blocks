<?php

class Codetot_Block_Image_Row extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Image_Row
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Image_Row
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'image-row';
    $this->block_slug = 'image_row';
    $this->block_title = __('Image Row', 'ct-blocks');
    $this->fields = [
      // Settings
      'lazyload',
      'class',
      'anchor_name',
      'enable_full_screen_layout',
      'space_between',
      'header_alignment',
      'content_alignment',
      'footer_alignment',
      // Content
      'title',
      'description',
      'columns',
      'buttons'
    ];

    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/image-row.png';

    parent::__construct();
  }
}

Codetot_Block_Image_Row::instance();
