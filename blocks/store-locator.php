<?php
/**
 * Block: Store Locator
 *
 * Available settings:
 * - class
 * - anchor_name
 */
$_class = 'store-locator';

$map_items =['ahihi'];
$sidebar_columns = !empty($sidebar) ? array_map(function($item) {
  return get_block('store-locator-item', array(
    'item' => $item,
    'class' => "js-data-location"
  ));
}, $sidebar) : [];

$sidebar = codetot_build_grid_columns($sidebar_columns, 'store-locator', array(
  'column_attributes' => 'data-aos="fade-up"',
  'column_class' => ''
));

$maps = !empty($map_items) ? array_map(function($item) {
  return get_block('store-locator-map', array(
    'item' => $item
  ));
}, $map_items) : [];

$content = codetot_build_grid_columns($maps, 'store-locator', array(
  'column_attributes' => 'data-aos="fade-up"',
  'column_class' => ''
)); ?>
<section data-ct-block="store-locator" data-aos="fade-up">

<div class="container">
  <?php the_block('store-locator-form'); ?>
</div>

<?php
the_block('sidebar-section', array(
  'id' => !empty($id) ? esc_attr($id) : '',
  'attributes' => ' data-aos="fade-up"',
  'class' => $_class,
  'sidebar' => $sidebar,
  'content' => $content
));
?>
</div>
