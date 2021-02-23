<?php

if ( ! function_exists( 'codetot_get_page_id' ) ) {
  /**
   * Get page id
   *
   * @return int $page_id Page id
   */
  function codetot_get_page_id() {
    $page_id = get_queried_object_id();

    if ( class_exists( 'woocommerce' ) ) {
      if ( is_shop() ) {
        $page_id = get_option( 'woocommerce_shop_page_id' );
      } elseif ( is_product_category() ) {
        $page_id = false;
      }
    }

    return $page_id;
  }
}

if (!function_exists('codetot_page')) {
  function codetot_page() {
    the_content();

    wp_link_pages(
      array(
        'before'      => '<div class="page-links">' . __( 'Pages:', 'codetot-block' ),
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
      )
    );
  }
}

/**
 * @return string|void
 */
function codetot_get_page_title() {
  if ( is_singular( 'product' ) ) {
    return '';
  }

  $page_id = codetot_get_page_id();
  $title = get_the_title( $page_id );

  if ( is_archive() ) {
    $title = get_the_archive_title();
  } elseif ( is_home() ) {
    $title = esc_html__( 'Blog' );
  } elseif ( is_search() ) {
    $title = esc_html__( 'Search' );
  }

  return apply_filters('codetot_page_title', $title);
}

/**
 * @param bool $echo
 * @return string
 */
function codetot_logo_or_site_title($echo = false) {
  if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
    // Image logo.
    $logo = get_custom_logo();
    $html = is_home() ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
  } else {
    $tag = is_home() ? 'h1' : 'div';

    $html  = '<' . esc_attr( $tag ) . ' class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';
  }

  if ( ! $echo ) {
    return $html;
  }

  echo $html; // phpcs:ignore
}

/**
 * @param null $id
 * @param string $alt
 * @param bool $placeholder
 * @return mixed|string
 */
function codetot_image_alt( $id = null, $alt = '', $placeholder = false ) {
  if ( ! $id ) {
    if ( $placeholder ) {
      return esc_attr__( 'Placeholder image', 'codetot' );
    }
    return esc_attr__( 'Error image', 'codetot' );
  }

  $data    = get_post_meta( $id, '_wp_attachment_image_alt', true );
  $img_alt = ! empty( $data ) ? $data : $alt;

  return $img_alt;
}

/**
 * codetot_excerpt
 */
function codetot_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

function codetot_get_sidebar($sidebar_name) {
  ob_start();
  $no_widgets_msg = sprintf(__('Please add widgets to %s to display in this block.', 'ct-theme'), $sidebar_name);

  if( is_active_sidebar($sidebar_name)) {
    dynamic_sidebar($sidebar_name);
  } elseif( current_user_can('administrator')) {
    echo $no_widgets_msg;
  }
  return ob_get_clean();
}

function codetot_get_single_sidebar() {
  return get_global_option('codetot_post_layout') ?? 'no-sidebar';
}

function codetot_get_page_sidebar() {
  return get_global_option('codetot_page_layout') ?? 'no-sidebar';
}

function codetot_get_category_sidebar_on_single() {
  return get_global_option('codetot_category_layout') ?? 'no-sidebar';
}

function codetot_get_category_column_number() {
  return get_global_option('category_column_number') ?? '1';
}

function codetot_get_category_post_card_style() {
  return get_global_option('post_card_style') ?? 'style-1';
}

/**
 * @return string
 */
if ( ! function_exists( 'codetot_get_site_container_class' ) ) {
  function codetot_get_site_container_class()
  {
    $container_layout = get_global_option('codetot_container_layout') ?? 'boxed';
    return 'site-container-' . $container_layout;
  }
}

if ( ! function_exists( 'codetot_site_container' ) ) {
  /**
   * @return string
   */
  function codetot_site_container() {
    // boxed - fullwidth
    return !empty(get_global_option('codetot_container_layout')) ? 'container ' . sprintf('container--%s', get_global_option('codetot_container_layout')) : 'container container--fullwidth';
  }
}

if ( ! function_exists( 'codetot_header_class' ) ) {
  /**
   * Header class
   */
  function codetot_header_class() {
    $class[] = 'header';

    $header_layout = codetot_get_header_layout();
    $header_style_number = !empty($header_layout) ? str_replace('style-', '', esc_attr($header_layout)) : '1';
    $class[] = apply_filters( 'codetot_header_layout_classes', 'header--layout-' . $header_style_number );

    $enable_header_transparent = is_page() && function_exists('rwmb_meta') ? rwmb_meta('codetot_enable_header_transparent') : false;
    if ($enable_header_transparent) {
      $class[] = 'header--transparent';
    }

    $is_sticky = codetot_get_header_sticky();
    if ($is_sticky) {
      $class[] = 'header--sticky';
    }

    $header_background_color = codetot_get_header_background_color();
    $class[] = !empty($header_background_color) ? 'bg-' . esc_attr($header_background_color) : 'bg-white';

    $class = implode( ' ', array_filter( $class ) );

    echo esc_attr( $class );
  }
}

function codetot_get_google_maps_api_key() {
  return get_codetot_data('codetot_google_maps_api_key');
}

function codetot_get_social_links() {
  $items = [];
  $setting_prefix = 'codetot_company_';
  $keys = ['facebook', 'youtube', 'zalo', 'instagram',' pinterest', 'linkedin'];

  foreach ($keys as $key) {
    $value = get_codetot_data($setting_prefix . $key);

    if (!empty($value)) {
      $items[] = array(
        'type' => $key,
        'url' => $value
      );
    }
  }

  return $items;
}

/**
 * @param WP_Post $post
 * @param array $types
 * @return array
 */
function codetot_get_share_post_links($post) {
  $types = ['linkedin', 'facebook', 'twitter', 'pinterest'];
  $items = array();

  if (!empty($types)) {
    foreach ($types as $type) {
      $items[] = array(
        'type' => $type,
        'url' => codetot_get_share_post_link($post, $type)
      );
    }
  }

  return $items;
}

/**
 * @param WP_Post $post
 * @param string $type
 * @return string
 */
function codetot_get_share_post_link($post, $type) {
  $post_link = get_permalink($post->ID);

  switch ($type) {

    case 'twitter';
      return sprintf('https://twitter.com/share?url=%s', get_permalink($post->ID));
      break;

    case 'pinterest':
      return sprintf('https://pinterest.com/pin/create/button/?url=%1$s&amp;media=%2$s&amp;description=%3$s',
        $post_link,
        (has_post_thumbnail() ? wp_get_attachment_image_url(get_post_thumbnail_id($post->ID)) : ''),
        get_the_title($post->ID)
      );
      break;

    case 'facebook':
      return sprintf('https://www.facebook.com/sharer.php?u=%1$s',
        $post_link
      );
      break;

    case 'linkedin':
      return sprintf('https://www.linkedin.com/shareArticle?mini=true&url=%1$s&title=%2$s',
        $post_link,
        get_the_title($post->ID)
      );
      break;
  }
}

/**
 * @param $background_type
 * @return string
 */
function codetot_generate_block_background_class($background_type) {
  $_class = !empty($background_type) ? ' bg-' . esc_attr($background_type) : '';
  if (!empty($background_type) && codetot_is_dark_background($background_type)) {
    $_class .= ' is-dark-contract';
  }

  $_class .= !empty($background_type) && $background_type !== 'white' ? ' section-bg' : ' section';

  return $_class;
}

/**
 * @param $args
 * @param $prefix_class
 * @return false|string
 */
function codetot_build_content_block($args, $prefix_class) {
  $output_elements = [];
  $title_tag = (!empty($args['title_tag']) ? $args['title_tag'] : 'h2');
  $block_tag = (!empty($args['block_tag']) ? $args['block_tag'] : 'header');

  if (!empty($args['label'])) {
    $output_elements['label'] = sprintf('<p class="%1$s__label">%2$s</p>', $prefix_class, $args['label']);
  }

  if (!empty($args['title'])) {
    $output_elements['label'] = sprintf('<%1$s class="%2$s__title">%3$s</%4$s>',
      $title_tag,
      $prefix_class,
      $args['title'],
      $title_tag
    );
  }

  if (!empty($args['description'])) {
    $output_elements['description'] = sprintf('<div class="wysiwyg %1$s__description">%2$s</div>', $prefix_class, $args['description']);
  }

  $_class = $prefix_class . '__header';
  $_class .= !empty($args['alignment']) ? ' ' . $prefix_class . '--' . $args['alignment'] . ' section-header--' . $args['alignment'] : '';
  $_class .= !empty($args['class']) ? ' ' . $args['class'] : '';

  ob_start();
  printf('<%s class="%s">', $block_tag, $_class);
  if (isset($args['enable_container'])) { printf('<div class="%s %s__container">', codetot_site_container(), $prefix_class); }
  echo implode('', $output_elements);
  if (isset($args['enable_container'])) {
    printf('</div>');
  }
  printf('</%s>', $block_tag);
  return ob_get_clean();
}

/**
 * Generate HTML markup for grid columns
 *
 * @param array $columns
 * @param string $prefix_class
 * @param array $args
 * @return string
 */
function codetot_build_grid_columns($columns, $prefix_class, $args = []) {
  if (!is_array($columns)) {
    return '';
  }

  if (!empty($args) && !empty($args['grid_class'])) {
    $grid_class = $args['grid_class'];
  }

  if (!empty($args) && !empty($args['column_class'])) {
    $column_class = $args['column_class'];
  }

  if (!empty($args) && !empty($args['column_attributes'])) {
    $column_attributes = $args['column_attributes'];
  }

  ob_start(); ?>
  <div class="grid <?php echo $prefix_class; ?>__grid<?php if (!empty($grid_class)) : echo ' ' . $grid_class; endif; ?>">
    <?php foreach ($columns as $column) : ?>
      <div class="grid__col <?php echo $prefix_class; ?>__col<?php if (!empty($column_class)) : echo ' ' . $column_class; endif; ?>"<?php if (!empty($column_attributes) && is_array($column_attributes)) : echo ' ' . $column_attributes; endif; ?>>
        <?php echo $column; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <?php

  return ob_get_clean();
}

function codetot_get_category_sidebar() {
  return codetot_get_sidebar('category-sidebar');
}
