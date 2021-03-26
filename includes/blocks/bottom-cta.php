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
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'bottom-cta';
    $this->block_slug = 'bottom_cta';
    $this->block_title = __('Bottom CTA', 'codetot');
    $this->fields = ['block_preset',
      'class',
      'content_position',
      'background_contract' ,
      'background_image',
      'background_type' ,
      'content_alignment' ,
      'overlay',
      'label',
      'title',
      'description',
      'buttons'];

    parent::__construct();
  }
}

Codetot_Block_Bottom_Cta::instance();
