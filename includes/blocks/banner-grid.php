<?php

class Codetot_Block_Banner_Grid extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Banner_Grid
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Banner_Grid
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

    $this->block_name = 'banner-grid';
    $this->block_slug = 'banner_grid';
    $this->block_title = __('Banner Grid', 'codetot');
    $this->fields = [
      'block_preset',
      'class',
      'layout',
      'full_screen_layout',
      'columns_count',
      'enable_prev_next_buttons',
      'previous_next_style',
      'previous_next_alignment',
      'enable_page_dots',
      'page_dots_style',
      'page_dots_alignment',
      'cell_alignment',
      'enable_autoplay',
      'speed',
      'items'
    ];

    ob_start();
    echo '<svg id="banner_grid" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
      <path d="M5 14h14l-4.5 -4.5l4.5 -4.5h-14v16" />
    </svg>';
    $this->svg_icon = ob_get_clean();
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/banner_grid.jpg';

    parent::__construct();
  }
}

Codetot_Block_Banner_Grid::instance();
