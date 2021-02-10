<?php

class Codetot_Base_Gravity_Forms
{

  /**
   * Singleton instance
   *
   * @var Codetot_Base_Gravity_Forms
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Base_Gravity_Forms
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
    add_action('admin_menu', array($this, 'remove_pages'), 999);
    add_action('gform_enqueue_scripts', array($this, 'manage_assets'));

    // Force Gravity Forms to init scripts in the footer and ensure that the DOM is loaded before scripts are executed.
    add_filter('gform_init_scripts_footer', '__return_true');
    add_filter('gform_cdata_open', array($this, 'wrap_gform_cdata_open'), 1);
    add_filter('gform_cdata_close', array($this, 'wrap_gform_cdata_close'), 99);
  }

  public function manage_assets() {
    wp_dequeue_style( 'gforms_css' );
    wp_dequeue_style( 'gforms_reset_css' );
    wp_dequeue_style( 'gforms_formsmain_css' );
    wp_dequeue_style( 'gforms_ready_class_css' );
    wp_dequeue_style( 'gforms_browsers_css' );
  }

  public function remove_pages()
  {
    remove_submenu_page('gf_edit_forms', 'gf_addons');
    remove_submenu_page('gf_edit_forms', 'gf_help');
    remove_submenu_page('gf_edit_forms', 'gf_system_status');
  }

  public function wrap_gform_cdata_open($content = '')
  {
    if (!$this->do_wrap_gform_cdata()) {
      return $content;
    }
    $content = 'document.addEventListener( "DOMContentLoaded", function() { ' . $content;
    return $content;
  }

  public function wrap_gform_cdata_close($content = '')
  {
    if (!$this->do_wrap_gform_cdata()) {
      return $content;
    }
    $content .= ' }, false );';
    return $content;
  }

  public function do_wrap_gform_cdata()
  {
    if (
      is_admin()
      || (defined('DOING_AJAX') && DOING_AJAX)
      || isset($_POST['gform_ajax'])
      || isset($_GET['gf_page']) // Admin page (eg. form preview).
      || doing_action('wp_footer')
      || did_action('wp_footer')
    ) {
      return false;
    }
    return true;
  }
}

Codetot_Base_Gravity_Forms::instance();
