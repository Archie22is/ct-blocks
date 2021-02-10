<?php

class Codetot_Block_Section_Post extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Section_Post
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Section_Post
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'section-post';
    $this->block_slug = 'section_post';
    $this->block_title = __('Section Post', 'codetot');
    $this->fields = [
      'class',
      'block_preset',
      'label',
      'title',
      'category',
      'number_posts',
      'post_grid_columns',
      'post_card_style'
    ];

    parent::__construct();
  }
}

Codetot_Block_Section_Post::instance();
