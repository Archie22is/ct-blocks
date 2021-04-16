<?php

class Codetot_Blocks_Admin {
  /**
   * Singleton instance
   *
   * @var Codetot_Blocks_Admin
   */
  private static $instance;

  /**
   * @var string
   */
  private $theme_version;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Blocks_Admin
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

    add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_style'));
    add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_script'));
    add_action('load-post.php', array($this, 'flexible_block_button_metabox'));
    add_action('load-post-new.php', array($this, 'flexible_block_button_metabox'));

    add_action('admin_head', array($this, 'setup_admin_head_js_variables'));
  }

  public function admin_enqueue_style() {
    wp_enqueue_style('codetot-admin-acf-style', CODETOT_BLOCKS_PLUGIN_URI . '/assets/css/admin-style.min.css', array('acf-pro-input'), $this->theme_version);
  }

  public function admin_enqueue_script() {
    global $pagenow;

    if ($pagenow = 'post.php' && !empty($_GET['post']) && $_GET['action'] === 'edit') {
      wp_enqueue_script('codetot-admin-scripts', CODETOT_BLOCKS_PLUGIN_URI . '/assets/js/admin-script.min.js', array('jquery', 'acf-input', 'acf-pro-input'), CODETOT_BLOCKS_VERSION, true);
    }
  }

  public function flexible_block_button_metabox() {
    add_action('add_meta_boxes', array($this, 'register_flexible_button_metabox'));
  }

  public function register_flexible_button_metabox() {
    global $pagenow;

    if (
      $pagenow === 'post.php' && get_post_type() === 'page' &&
      (!empty($_GET['action']) && $_GET['action'] === 'edit')
      ) {
        add_meta_box(
          'codetot-flexible-button',
          __('Web Builder Blocks', 'ct-theme'),
          array($this, 'render_flexible_button_metabox'),
          '',
          'side',
          'high'
        );
    }
  }

  public function render_flexible_button_metabox() {
    $copyright_text = sprintf(
      __('Build with <span class="ct-blocks__metabox__copyright-icon">%1$s</span> by <a href="%2$s" target="_blank">%3$s</a>', 'ct-theme'),
      '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="red" d="M12 4.435c-1.989-5.399-12-4.597-12 3.568 0 4.068 3.06 9.481 12 14.997 8.94-5.516 12-10.929 12-14.997 0-8.118-10-8.999-12-3.568z"/></svg>',
      'https://codetot.com',
      esc_html__('CODE TOT JSC', 'ct-theme')
    );
  ?>
    <div class="ct__block-list js-block-list"></div>
    <div class="ct__preview-block js-preview-block">
      <div class="js-preview-block-items"></div>
    </div>
    <div class="ct__svg">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
        <?php echo implode(PHP_EOL, apply_filters('codetot_blocks_svg_icons', [])); ?>
      </svg>
    </div>
    <div class="ct-blocks__metabox__footer">
      <p class="ct-blocks__metabox__copyright"><?php echo $copyright_text; ?></p>
    </div>
    <?php
  }

  public function setup_admin_head_js_variables() {
    $variables_css_file = CODETOT_BLOCKS_DIR . '/variables.css';
    $block_images = apply_filters('codetot_blocks_preview_images', [
      'page-title' => CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/page_title.png',
      'page-content' => CODETOT_BLOCKS_PLUGIN_URI . '/assets/img/page_content.png',
    ]);

    if (file_exists($variables_css_file)) {
      $file_content = file_get_contents($variables_css_file);

      echo '<style id="codetot-acf-variables-css">';
      echo $file_content;
      echo '</style>';
    }

    echo '<script>';
    echo 'var CODETOT_PLUGIN_URL = "' . CODETOT_BLOCKS_PLUGIN_URI . '";' . PHP_EOL;

    echo 'var CODETOT_BLOCKS_IMAGES = ' . json_encode($block_images) . ';';
    echo '</script>';
  }
}