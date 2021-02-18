<?php

class Codetot_Block_News_Columns extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_News_Columns
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_News_Columns
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'news-columns';
    $this->block_slug = 'news_columns';
    $this->block_title = __('News Columns', 'codetot');
    $this->fields = [
      'class',
      'block_preset',
      'label',
      'title',
      'category',
      'number_posts',
      'number_categories'
    ];

    parent::__construct();
  }
}

Codetot_Block_News_Columns::instance();
