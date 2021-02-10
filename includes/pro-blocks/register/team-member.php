<?php

class Codetot_Block_Team_Member extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Team_Member
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Team_Member
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'team-member';
    $this->block_slug = 'team_member';
    $this->block_title = __('Team Member', 'codetot');
    $this->fields = ['style', 'background_type', 'title', 'label', 'description', 'items', 'items_layout', 'number_columns', 'item_style', 'button_text', 'button_url', 'button_style'];

    parent::__construct();
  }
}

Codetot_Block_Team_Member::instance();
