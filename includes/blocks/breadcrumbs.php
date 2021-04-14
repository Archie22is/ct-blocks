<?php

class Codetot_Block_Breadcrumbs extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var string
   */
  public $svg_icon;

  /**
   * @var string
   */
  public $preview_image_url;

  /**
   * Singleton instance
   *
   * @var Codetot_Block_Breadcrumbs
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Breadcrumbs
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
    $this->block_name = 'breadcrumbs';
    $this->block_slug = 'breadcrumbs';
    $this->block_title = __('Breadcrumbs', 'codetot');
    $this->fields = ['class'];

    ob_start();
    echo '<svg id="breadcrumbs" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11 1h2v22h-2v-11h-8l-3-3 3-3h8v-5zm13 5l-3-3h-7v6h7l3-3zm-10 5v4h6l2-2-2-2h-6z" /></svg>';
    $this->svg_icon = ob_get_clean();
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/breadcrumbs.jpg';

    parent::__construct();
  }
}

Codetot_Block_Breadcrumbs::instance();
