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
    $this->block_title = __('Contact Section', 'ct-theme');
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

    $this->svg_icon = '<svg id="contact_section" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 21h-24v-18h24v18zm-23-16.477v15.477h22v-15.477l-10.999 10-11.001-10zm21.089-.523h-20.176l10.088 9.171 10.088-9.171z"/></svg>';
    $this->preview_image_url = CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/contact_section.jpg';

    parent::__construct();
  }
}

Codetot_Block_Contact_Section::instance();
