<?php

class Codetot_Block_Video_Center extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Video_Center
   */
  private static $instance;

  /**
   * Get singleton instance.
   *

   * @return Codetot_Block_Video_Center

   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'video-center';
    $this->block_slug = 'video_center';
    $this->block_title = __('Video Center', 'codetot');
    $this->fields = [
      'label',
      'title',
      'description',
      'poster_image',
      'video',
    ];

    parent::__construct();
  }
}

Codetot_Block_Video_Center::instance();
