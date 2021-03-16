<?php

class Codetot_Block_Contact_Section extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Contact_Section
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Contact_Section
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'contact-section';
    $this->block_slug = 'contact_section';
    $this->block_title = __('Contact Section', 'codetot');
    $this->fields = [
      'class',
      'full_screen_layout',
      'background_image',
      'contact_primary_layout',
      'contact_secondary_layout',
      'google_maps',
      'address',
      'contact_information',
      'contact_form',
      'contact_form_style'
    ];

    parent::__construct();
  }
}

Codetot_Block_Contact_Section::instance();
