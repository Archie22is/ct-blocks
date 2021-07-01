<?php

class Codetot_Block_Hero_Title extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Hero_Title
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
   * @return Codetot_Block_Hero_Title
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->block_name = 'hero-title';
    $this->block_slug = 'hero_title';
    $this->block_title = __('Hero Title', 'ct-blocks');
    $this->fields = [
      'class',
      'content_alignment',
      'background_type',
      'label',
      'title',
      'description',
      'buttons'
    ];

    $this->svg_icon = '<svg  id="hero_title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><defs/><path d="M501.333 85.333H10.667C4.779 85.333 0 90.112 0 96s4.779 10.667 10.667 10.667h490.667c5.888 0 10.667-4.779 10.667-10.667s-4.78-10.667-10.668-10.667zM501.333 149.333H10.667C4.779 149.333 0 154.112 0 160s4.779 10.667 10.667 10.667h490.667c5.888 0 10.667-4.779 10.667-10.667s-4.78-10.667-10.668-10.667zM501.333 213.333H10.667C4.779 213.333 0 218.112 0 224s4.779 10.667 10.667 10.667h490.667c5.888 0 10.667-4.779 10.667-10.667s-4.78-10.667-10.668-10.667zM501.333 277.333H10.667C4.779 277.333 0 282.112 0 288s4.779 10.667 10.667 10.667h490.667c5.888 0 10.667-4.779 10.667-10.667s-4.78-10.667-10.668-10.667zM501.333 341.333H10.667C4.779 341.333 0 346.112 0 352s4.779 10.667 10.667 10.667h490.667c5.888 0 10.667-4.779 10.667-10.667-.001-5.888-4.78-10.667-10.668-10.667zM416 405.333H96c-5.888 0-10.667 4.779-10.667 10.667S90.112 426.667 96 426.667h320c5.888 0 10.667-4.779 10.667-10.667s-4.779-10.667-10.667-10.667z"/></svg>';
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/hero-title.png';

    parent::__construct();
  }
}

Codetot_Block_Hero_Title::instance();
