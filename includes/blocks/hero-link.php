<?php

class Codetot_Block_Hero_Link extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Hero_Link
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Hero_Link
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

    $this->block_name = 'hero-link';
    $this->block_slug = 'hero_link';
    $this->block_title = __('Hero Link', 'ct-block');
    $this->fields = [
      'class',
      'anchor_name',
      'block_preset',
      'page_dots_style',
      'enable_page_dots',
      'previous_next_style',
      'enable_prev_next_buttons',
      'items'
    ];

    ob_start();
    echo '<svg width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
      <path d="M5 14h14l-4.5 -4.5l4.5 -4.5h-14v16" />
    </svg>';
    $this->svg_icon = ob_get_clean();
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/mobile_hero_slider.jpg';

    parent::__construct();
  }
}

Codetot_Block_Hero_Link::instance();
