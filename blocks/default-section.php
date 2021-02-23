<?php
$_attrs = '';
$_attrs .= !empty($id) ? sprintf(' id="%s"', $id) : '';
$_attrs .= !empty($attributes) ? ' ' . $attributes : '';
$container = codetot_site_container();
$_class = 'default-section';
$_class .= !empty($class) ? ' ' . $class : '';

$_content = '';
if (!empty($content)) {
  if (!is_array($content)) {
    $_content = $content;
  } else {
    $_content = codetot_build_grid_columns($content, 'default-section');
  }
}

if (!empty($content)) : ?>
  <section class="<?php echo $_class; ?>"<?php if (!empty($_attrs)) : echo ' ' . $_attrs; endif; ?>>
    <?php if (!empty($header)) : ?>
      <div class="default-section__header">
        <div class="<?php echo $container; ?> default-section__container default-section__container--header">
          <?php echo $header; ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="default-section__main">
      <div class="<?php echo $container; ?> default-section__container default-section__container--main">
        <?php echo $_content; ?>
      </div>
    </div>
    <?php if (!empty($footer)) : ?>
      <div class="default-section__footer">
        <div class="<?php echo $container; ?> default-section__container default-section__container--footer">
          <?php echo $footer; ?>
        </div>
      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>
