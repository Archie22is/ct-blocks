<?php

class Codetot_Block_Bottom_Cta extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Bottom_Cta
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Bottom_Cta
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

    $this->block_name = 'bottom-cta';
    $this->block_slug = 'bottom_cta';
    $this->block_title = __('Bottom CTA', 'ct-blocks');
    $this->fields = [
      'enable_lazyload',
      'class',
      'anchor_name',
      'content_alignment',
      'background_image',
      'overlay',
      'background_type',
      'block_spacing',
      'block_container',
      'block_layout',
      // Content
      'label',
      'title',
      'description',
      'buttons'
    ];

    ob_start();
    echo '<svg id="bottom_cta" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path d="M21.5 24h-19C1.121 24 0 22.878 0 21.5v-19C0 1.122 1.121 0 2.5 0h19C22.879 0 24 1.122 24 2.5v19c0 1.378-1.121 2.5-2.5 2.5zM2.5 1C1.673 1 1 1.673 1 2.5v19c0 .827.673 1.5 1.5 1.5h19c.827 0 1.5-.673 1.5-1.5v-19c0-.827-.673-1.5-1.5-1.5z" />
      <path d="M23.5 18H.5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h23c.276 0 .5.224.5.5s-.224.5-.5.5zM20.5 21h-17c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h17c.276 0 .5.224.5.5s-.224.5-.5.5z" />
      <path d="M8.5 22c-.276 0-.5-.224-.5-.5v-2c0-.276.224-.5.5-.5s.5.224.5.5v2c0 .276-.224.5-.5.5zM7 13c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5zM12 13H9c-.276 0-.5-.224-.5-.5v-1C8.5 10.122 9.621 9 11 9c.275 0 .5-.224.5-.5v-1c0-.276-.225-.5-.5-.5H9c-.276 0-.5-.224-.5-.5S8.724 6 9 6h2c.827 0 1.5.673 1.5 1.5v1c0 .827-.673 1.5-1.5 1.5s-1.5.673-1.5 1.5v.5H12c.276 0 .5.224.5.5s-.224.5-.5.5zM16 13h-2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2c.275 0 .5-.224.5-.5v-1c0-.276-.225-.5-.5-.5h-2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2c.827 0 1.5.673 1.5 1.5v1c0 .827-.673 1.5-1.5 1.5z" />
      <path d="M16 10h-2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2c.275 0 .5-.224.5-.5v-1c0-.276-.225-.5-.5-.5h-2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2c.827 0 1.5.673 1.5 1.5v1c0 .827-.673 1.5-1.5 1.5z" />
    </svg>';
    $this->svg_icon = ob_get_clean();
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/bottom-cta.png';

    parent::__construct();
  }
}

Codetot_Block_Bottom_Cta::instance();
