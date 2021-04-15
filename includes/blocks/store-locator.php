<?php

class Codetot_Block_Store_Locator extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Store_Locator
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Store_Locator
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'store-locator';
    $this->block_slug = 'store_locator';
    $this->block_title = __('Store Locator', 'ct-blocks');
    $this->fields = [
      'class',
      'anchor_name',
      'block_preset',
      'enter_addresses',
      'items'
    ];

    $this->svg_icon = '<svg id="store_locator" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 20l-6.455 4-5.545-4-5.545 4-6.455-4v-20l6.455 4 5.545-4 5.545 4 6.455-4v20zm-11.5-13h-1v-5.406l-4.5 3.246v4.16h-1v-4.106l-5-3.098v17.647l5 3.099v-6.542h1v6.374l4.5-3.246v-5.128h1v5.128l4.5 3.246v-5.374h1v5.542l5-3.099v-17.647l-5 3.098v3.106h-1v-3.16l-4.5-3.246v5.406zm8.172 7.016l-1.296-1.274 1.273-1.293-.708-.702-1.272 1.294-1.294-1.271-.703.702 1.296 1.276-1.273 1.296.703.703 1.277-1.298 1.295 1.275.702-.708zm-14.102-.606c-.373 0-.741-.066-1.092-.195l.407-1.105c.221.081.451.122.685.122.26 0 .514-.05.754-.149l.448 1.09c-.383.157-.787.237-1.202.237zm-2.601-2.374c-.535 0-.969.433-.969.968 0 .534.434.968.969.968.535 0 .969-.434.969-.968 0-.535-.434-.968-.969-.968zm11.271 1.591l-1.659-.945.583-1.024 1.66.945-.584 1.024zm-6.455-.02l-.605-1.011 1.638-.981.606 1.01-1.639.982zm3.918-1.408c-.243-.101-.5-.153-.763-.153-.231 0-.457.04-.674.118l-.402-1.108c.346-.125.708-.188 1.076-.188.419 0 .83.082 1.216.243l-.453 1.088z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_Store_Locator::instance();
