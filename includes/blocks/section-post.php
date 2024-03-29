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
    $this->block_title = __('Section Post', 'ct-blocks');
    $this->fields = [
      // Settings
      'enable_lazyload',
      'enable_slider',
      'class',
      'anchor_name',
      'block_preset',
      'header_alignment',
      'background_type',
      'columns',
      'post_card_style',
      // Content
      'category',
      'number_posts',
      'label',
      'title',
      'description',
      'button_text',
      'button_url',
      'button_target',
      'button_style'
    ];

    $this->svg_icon = '<svg id="section_post" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18 18h6v6h-6v-6zm-9 6h6v-6h-6v6zm-9 0h6v-6h-6v6zm0-8h24v-16h-24v16z"/></svg>';
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/section-post.png';

    parent::__construct();
  }
}

Codetot_Block_Section_Post::instance();
