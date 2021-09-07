<?php

/**
 * Get array from file path .json
 *
 * @return array
 */
function codetot_load_json_array($file_path) {
  $list = file_exists($file_path) ? file_get_contents($file_path) : [];
  return !empty($list) ? json_decode($list, true) : [];
}

/**
 * Check if current child theme has supported tag
 *
 * @return array
 */
function codetot_is_supported_theme() {
  $theme_tags = wp_get_theme()->Get('Tags') ?? [];

  if (empty($theme_tags)) {
    return false;
  }

  return in_array('codetot-theme', $theme_tags);
}
