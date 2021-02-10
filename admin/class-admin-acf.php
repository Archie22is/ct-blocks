<?php

class Codetot_Base_Admin_Acf {
  /**
   * Singleton instance
   *
   * @var Codetot_Base_Admin_Acf
   */
  private static $instance;

  /**
   * @var string
   */
  private $theme_version;
  /**
   * @var string
   */
  private $theme_environment;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Base_Admin_Acf
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
    $this->theme_version = wp_get_theme(get_template())->get('Version');
    $this->theme_environment = $this->is_localhost() ? '' : '.min';

    add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_style'));
    add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_script'));
    add_action('load-post.php', array($this, 'flexible_block_button_metabox'));
    add_action('load-post-new.php', array($this, 'flexible_block_button_metabox'));

    add_action('admin_head', array($this, 'setup_admin_head_js_variables'));
  }

  public function is_localhost()
  {
    return !empty($_SERVER['HTTP_X_CODETOT_HEADER']) && $_SERVER['HTTP_X_CODETOT_HEADER'] === 'development';
  }

  public function admin_enqueue_style() {
    wp_enqueue_style('codetot-admin-acf-style', CODETOT_BLOCKS_PLUGIN_URI . '/admin/css/admin.css', array(), $this->theme_version);
  }

  public function admin_enqueue_script() {
    global $pagenow;

    if ($pagenow = 'admin.php' && !empty($_GET['page']) && $_GET['page'] == 'ct-theme') {
      wp_enqueue_script('codetot-admin-settings', CODETOT_BLOCKS_PLUGIN_URI . '/admin/js/theme-settings.js', array('jquery'), CODETOT_BLOCKS_VERSION, true);
    }

    if ($pagenow = 'post.php' && !empty($_GET['post']) && $_GET['action'] === 'edit') {
      wp_enqueue_script('codetot-admin-flexible-page', CODETOT_BLOCKS_PLUGIN_URI . '/admin/js/edit-page.js', array('jquery', 'acf-input', 'acf-pro-input'), CODETOT_BLOCKS_VERSION, true);
    }
  }

  public function flexible_block_button_metabox() {
    add_action('add_meta_boxes', array($this, 'register_flexible_button_metabox'));
  }

  public function register_flexible_button_metabox() {
    add_meta_box(
      'codetot-flexible-button',
      __('Web Builder Blocks', 'codetot'),
      array($this, 'render_flexible_button_metabox'),
      '',
      'side',
      'high'
    );
  }

  public function render_flexible_button_metabox() {
    $field_object = acf_get_field('blocks');
    $blocks = array();
    if ($field_object['type'] === 'flexible_content' && count($field_object['layouts']) > 0) {}
    ?>
    <div class="ct__block-list js-block-list"></div>
    <div class="ct__preview-block js-preview-block">
      <div class="ct__header"><?php _e('Preview', 'codetot-theme') ?></div>
      <div class="js-preview-block-items"></div>
    </div>
    <div class="ct__svg"><?php codetot_svg('ct_svg', true); ?></div>
    <?php
  }

  public function setup_admin_head_js_variables() {
    echo '<script>';
    echo 'var CODETOT_PLUGIN_URL = "' . CODETOT_BLOCKS_PLUGIN_URI . '";';
    echo '</script>';
  }
}
