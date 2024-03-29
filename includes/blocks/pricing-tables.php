<?php

class Codetot_Block_Pricing_Tables extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * Singleton instance
   *
   * @var Codetot_Block_Pricing_Tables
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
   * @return Codetot_Block_Pricing_Tables
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
    $this->block_name = 'pricing-tables';
    $this->block_slug = 'pricing_tables';
    $this->block_title = __('Pricing Tables', 'ct-blocks');
    $this->fields = [
      // setting
      'class',
      'anchor_name',
      'enable_slider',
      'block_preset',
      'item_style',
      'header_alignment',
      'content_alignment',
      'columns',
      'background_contract',
      'background_type',
      // Input
      'highlight_text',
      'title',
      'description',
      'items'
    ];

    $this->svg_icon = '<svg id="pricing_tables" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18 10c-3.313 0-6 2.687-6 6s2.687 6 6 6 6-2.687 6-6-2.687-6-6-6zm.5 8.474v.526h-.5v-.499c-.518-.009-1.053-.132-1.5-.363l.228-.822c.478.186 1.114.383 1.612.27.574-.13.692-.721.057-1.005-.465-.217-1.889-.402-1.889-1.622 0-.681.52-1.292 1.492-1.425v-.534h.5v.509c.362.01.768.073 1.221.21l-.181.824c-.384-.135-.808-.257-1.222-.232-.744.043-.81.688-.29.958.856.402 1.972.7 1.972 1.773.001.858-.672 1.315-1.5 1.432zm-7.911-5.474h-2.589v-2h3.765c-.484.602-.881 1.274-1.176 2zm-.589 3h-2v-2h2.264c-.166.641-.264 1.309-.264 2zm2.727-6h-4.727v-2h7v.589c-.839.341-1.604.822-2.273 1.411zm2.273-6h-7v-2h7v2zm0 3h-7v-2h7v2zm-4.411 12h-2.589v-2h2.069c.088.698.264 1.369.52 2zm-10.589-11h7v2h-7v-2zm0 3h7v2h-7v-2zm12.727 11h-4.727v-2h3.082c.438.753.994 1.428 1.645 2zm-12.727-5h7v2h-7v-2zm0 3h7v2h-7v-2zm0-6h7v2h-7v-2z"/></svg>';
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/pricing-tables.png';

    parent::__construct();
  }
}

Codetot_Block_Pricing_Tables::instance();
