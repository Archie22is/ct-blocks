<?php

/**
 * Global settings applies to all options
 */

/**
 * Class Codetot_Acf
 */
class Codetot_Acf {
  /**
   * Singleton instance
   *
   * @var Codetot_Acf
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Acf
   */
  public final static function instance() {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    // Button settings
    add_filter('acf/load_field/name=button_style', array($this, 'load_button_styles'));
    add_filter('acf/load_field/name=button_target', array($this, 'load_button_targets'));
    add_filter('acf/load_field/name=button_size', array($this, 'load_button_sizes'));

    // Contact Form Select Settings
    add_filter('acf/load_field/name=contact_form', array($this, 'load_contact_form_options'));

    // Global Text Alignment
    add_filter('acf/load_field/name=content_position', array($this, 'load_alignments'));
    add_filter('acf/load_field/name=header_alignment', array($this, 'load_alignments'));
    add_filter('acf/load_field/name=footer_alignment', array($this, 'load_alignments'));
    add_filter('acf/load_field/name=content_alignment', array($this, 'load_alignments'));

    // Background Contract: Light/Dark
    add_filter('acf/load_field/name=background_contract', array($this, 'load_background_contract'));
    // Background Color
    add_filter('acf/load_field/name=background_type', array($this, 'load_background_types'));
    add_filter('acf/load_field/name=style_color', array($this, 'load_background_types'));
    add_filter('acf/load_field/name=background_type_item', array($this, 'load_background_types'));

    // Block Presets
    add_filter('acf/load_field/name=block_preset', array($this, 'load_block_presets'));
    add_filter('acf/load_field/name=block_spacing', array($this, 'load_block_spacing'));

    // Contact Section - Layout Settings
    add_filter('acf/load_field/name=contact_primary_layout', array($this, 'load_primary_layouts'));
    add_filter('acf/load_field/name=contact_secondary_layout', array($this, 'load_secondary_layouts'));
  }

  public function load_button_styles($field) {
    $field['choices'] = apply_filters('codetot_button_styles', array(
      'primary' => __('Primary', 'codetot'),
      'secondary' => __('Secondary', 'codetot'),
      'dark' => __('Dark', 'codetot'),
      'outline' => __('Outline', 'codetot'),
      'outline-white' => __('Outline (Dark Background)', 'codetot'),
      'link' => __('Link', 'codetot'),
      'link-white' => __('Link (Dark Background)', 'codetot')
    ));

    return $field;
  }

  public function load_button_targets($field) {
    $field['choices'] = array(
      '_self' => __('Same Window/Tab', 'codetot'),
      '_blank' => __('New Window/Tab', 'codetot')
    );
  }

  public function load_button_sizes($field) {
    $field['choices'] = apply_filters('codetot_button_sizes', array(
      'normal' => __('Normal', 'codetot'),
      'small' => __('Small', 'codetot'),
      'large' => __('Large', 'codetot')
    ));

    return $field;
  }

  public function load_contact_form_options($field) {
    if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
      $field['choices'] = array();

      $form_args = array(
        'post_type' => 'wpcf7_contact_form',
        'posts_per_page' => -1
      );

      $forms = get_posts($form_args);

      foreach($forms as $form) {
        $field['choices'][$form->ID] = $form->post_title;
      }

      $field['class'] = 'contact-form-7';
    }

    if ( class_exists( 'GFFormsModel' ) ) {
      $choices = [];

      foreach ( \GFFormsModel::get_forms() as $form ) {
        $choices[ $form->id ] = $form->title;
      }

      if (empty($choices)) {
        $choices[''] = __('No available forms.', 'codetot');
      }

      $field['choices'] = $choices;
      $field['class'] = 'gravity-forms';
    }

    return $field;
  }

  public function load_alignments($field) {
    $field['choices'] = array(
      'left' => __('Left', 'codetot'),
      'center' => __('Center', 'codetot'),
      'right' => __('Right', 'codetot')
    );

    return $field;
  }

  public function load_background_contract($field) {
    $field['choices'] = array(
      'light' => __('Light', 'codetot'),
      'dark' => __('Dark', 'codetot')
    );

    return $field;
  }

  public function load_background_types($field) {
    $field['choices'] = apply_filters('codetot_background_types', array(
      'white' => __('White', 'codetot'),
      'light' => __('Light', 'codetot'),
      'gray' => __('Gray', 'codetot'),
      'dark' => __('Dark', 'codetot'),
      'black' => __('Black', 'codetot'),
      'primary' => __('Primary', 'codetot'),
      'secondary' => __('Secondary', 'codetot')
    ));

    return $field;
  }

  public function load_block_presets($field) {
    $field['choices'] = apply_filters('codetot_block_presets', array(
      '' => __('No Preset', 'codetot')
    ));

    return $field;
  }

  public function load_block_spacing($field) {
    $field['choices'] = apply_filters('codetot_block_spacing', array(
      '' => __('Default', 'codetot'),
      's' => __('Small', 'codetot'),
      'm' => __('Medium', 'codetot'),
      'l' => __('Large', 'codetot'),
      'fullscreen' => __('Fullscreen', 'codetot')
    ));

    return $field;
  }

  public function load_primary_layouts($field) {
    $field['choices'] = array(
      'default' => __('Left Map - Right Content', 'codetot'),
      'switch' => __('Right Map - Left Content', 'codetot'),
      'top' => __('Top Map - Bottom Content', 'codetot'),
      'bottom' => __('Top Content - Bottom Map', 'codetot')
    );

    return $field;
  }

  public function load_secondary_layouts($field) {
    $field['choices'] = array(
      'default' => __('Top Content - Bottom Form', 'codetot'),
      'switch' => __('Top Form - Bottom Content', 'codetot'),
      'left' => __('Left Content - Right Form', 'codetot'),
      'right' => __('Left Form - Right Content', 'codetot')
    );

    return $field;
  }
}

Codetot_Acf::instance();
