<?php
$_class = 'store-locator js-store-locator';
$_class .= !empty($block_preset) ? ' store-locator--' . esc_attr($block_preset) : false;

$container = codetot_site_container();
?>
<section class="<?php echo $_class;?>" <?php echo (post_type_exists('store')) ? 'data-post-type="true"' : false; ?> data-ct-block="store-locator">
<?php if(post_type_exists('store')) : ?>
  <div class="default-section__header">
    <div class="<?php echo $container; ?> default-section__container default-section__container--header">
      <?php the_block('store-locator-form'); ?>
    </div>
  </div>
<?php endif; ?>


  <div class="default-section__main">
    <div class="<?php echo $container; ?> default-section__container default-section__container--main">
      <div class="js-no-result sidebar-section__no-result">There is no matching map</div>
      <div class="sidebar-section__container">
        <div class="grid sidebar-section__block-grid js-sidebar-section">
          <div class="grid__col sidebar-section__block sidebar-section__block--sidebar">
            <div class="sidebar-section__inner<?php echo (!post_type_exists('store')) ? ' show' : false ?>">
            <?php if(post_type_exists('store')) : ?>
              <?php the_block('store-locator-item'); ?>
            <?php else: ?>
              <?php the_block('store-locator-input-item', array(
                'items' => $items
              )); ?>
            <?php endif; ?>
            </div>
          </div>
          <div class="grid__col sidebar-section__block sidebar-section__block--content">
            <div class="sidebar-section__inner">
              <?php the_block('store-locator-map'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>