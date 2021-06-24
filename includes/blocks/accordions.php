<?php

class Codetot_Block_Accordions extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Accordions
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Accordions
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

    $this->block_name = 'accordions';
    $this->block_slug = 'accordions';
    $this->block_title = __('Accordions', 'ct-blocks');
    $this->fields = [
      // Settings
      'class',
      'anchor_name',
      'layout',
      'is_fullwidth',
      'block_preset',
      'background_type',
      'header_alignment',
      // Fields
      'title',
      'description',
      'items'
    ];

    ob_start();
    echo '
    <svg id="accordions" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
      <path d="M0 4v8h16v-8h-16zM15 11h-14v-4h14v4z"></path>
      <path d="M0 0h16v3h-16v-3z"></path>
      <path d="M0 13h16v3h-16v-3z"></path>
    </svg>';
    $this->svg_icon = ob_get_clean();
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/accordions.png';

    parent::__construct();
  }
}

Codetot_Block_Accordions::instance();
