<?php

class Codetot_Block_Two_Up_Intro extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'two-up-intro';
    $this->block_slug = 'two_up_intro';
    $this->block_title = __('Two Up Intro', 'ct-blocks');
    $this->fields = [
      // Settings
      'class',
      'anchor_name',
      'block_preset',
      'block_spacing',
      'content_alignment',
      'image_position',
      'image_size',
      'media_size',
      'background_type',
      'background_contract',
      // Content
      'image',
      'label',
      'title',
      'content',
      'buttons'
    ];

    parent::__construct();
  }
}

Codetot_Block_Two_Up_Intro::instance();
