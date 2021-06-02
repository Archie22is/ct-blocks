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
    $this->block_title = __('News Columns', 'ct-blocks');
    $this->fields = [
      'class',
      'block_preset',
      'columns',
      'header_alignment',
      'background_type',
      'label',
      'title',
      'categories',
      'number_posts'
    ];

    $this->svg_icon = '<svg id="news_columns" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 6h-6v-6h6v6zm9-6h-6v6h6v-6zm9 0h-6v6h6v-6zm-18 9h-6v6h6v-6zm9 0h-6v6h6v-6zm9 0h-6v6h6v-6zm-18 9h-6v6h6v-6zm9 0h-6v6h6v-6zm9 0h-6v6h6v-6z"/></svg>';

    parent::__construct();
  }
}

Codetot_Block_News_Columns::instance();
