<?php

// Prevent direct access.
if (!defined('ABSPATH')) exit;

/**
 * Class CodeTot_Shortcode
 * @package codetot
 * @since 0.0.1
 */
class CodeTot_Shortcode
{
  /**
   * Singleton instance
   *
   * @var CodeTot_Shortcode
   */
  private static $instance;

  /**
   * @var bool
   */
  private $enable_jquery_cdn;

  /**
   * Get singleton instance.
   *
   * @return CodeTot_Shortcode
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Class constructor
   */
  private function __construct()
  {
    $this->enable_jquery_cdn = true;

    add_action('init', array($this, 'register_shortcodes'));
  }

  public function register_shortcodes()
  {
    add_shortcode('social-link', function () {
      the_block('social-links', array(
        'class' => 'social-links--dark-contract social-links--footer-bottom'
      ));
    });

    add_shortcode('contact', function () {
     the_block('header-contact');
    });

    add_shortcode('search-form', function () {
     the_block('search-product-form');
    });

    add_shortcode('cart-icon', function () {
      the_block_part('header/cart-icon');
    });
  }
}

CodeTot_Shortcode::instance();
