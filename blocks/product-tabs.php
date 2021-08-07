<?php
$container = codetot_site_container();


$_class = 'product-tabs';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($header_alignment) ? ' is-header-' . $header_alignment : '';
$_class .= !empty($footer_alignment) ? ' is-footer-' . $footer_alignment : '';
$_class .= !empty($header_alignment) ? ' product-tabs--nav-' . $header_alignment : '';
$_class .= !empty($columns) ? ' has-' . $columns . '-columns' : '';

$_columns = !empty($columns) && is_numeric($columns) ? $columns : 4;

$items = [];
foreach($categories as $index => $category) :
  $items[] = array(
    'id' => esc_attr($category->slug),
    'name' => esc_html($category->name),
    'category_id' => esc_attr($category->term_id),
    'is_active' => $index === 0
  );
endforeach;

// Generate header
ob_start(); ?>
<?php if(!empty($title)) : ?>
  <h2 class="h2 product-tabs__title"><?php echo $title; ?></h2>
<?php endif; ?>
<?php if (!empty($categories)) : ?>
  <ul class="f product-tabs__nav" aria-controls="product-tabs__tab" role="tablist">
    <?php foreach ($items as $item) : ?>
      <?php printf('<li class="product-tabs__item" role="tab" aria-controls="%1$s" aria-selected="%2$s">%3$s</li>',
        $item['id'],
        var_export($item['is_active'], true),
        $item['name']
      ); ?>
    <?php endforeach; ?>
  </ul>
  <div class="select-wrapper product-tabs__select-wrapper">
    <select class="product-tabs__select js-mobile">
      <?php foreach ($items as $item) :
        printf('<option value="%1$s" %2$s>%3$s</option>',
          $item['id'],
          $item['is_active'] ? ' selected' :'',
          $item['name']
        );
      endforeach; ?>
    </select>
  </div>
<?php endif; ?>
<?php
$header = ob_get_clean();

// Generate main content
ob_start();
foreach ($items as $item) :
 ?>
  <div class="product-tabs__tab-content js-tab-content" data-category-id="<?php echo $item['category_id']; ?>" id="<?php echo $item['id']; ?>" role="tabpanel" aria-expanded="<?php echo var_export($item['is_active'], true); ?>">
    <div class="rel product-tabs__inner">
      <ul class ="products columns-<?php echo esc_attr($_columns); ?> js-grid is-not-loaded"></ul>
      <?php the_block('loader', array(
        'class' => 'loader--dark product-tabs__loader'
      )); ?>
    </div>
  </div>
  <?php
endforeach;
$content = ob_get_clean();

$footer = !empty($button_text) && !empty($button_url) ?
  get_block('button', array(
    'class' => 'product-tabs__button',
    'type' => !empty($button_style) ? $button_style : 'primary',
    'button' => $button_text,
    'target' => $target,
    'url' => $button_url
  )) : '';

$block_attributes = array(
  'endpoint' => 'get_product_tabs_html',
  'postsPerPage' => $numbers,
  'queryType' => $attribute
);

the_block('default-section', array(
  'class' => $_class,
  'attributes' => ' data-ct-block="product-tabs" data-settings=\'' . json_encode($block_attributes) . '\'',
  'header' => $header,
  'content' => $content,
  'footer' => $footer
));
