<?php
$_class = 'store-locator js-store-locator';
$container = codetot_site_container();
?>
<section class="<?php echo $_class; ?>" data-ct-block="store-locator">
  <div class="default-section__header">
    <div class="<?php echo $container; ?> default-section__container default-section__container--header">
      <?php the_block('store-locator-form'); ?>
    </div>
  </div>


  <div class="default-section__main">
    <div class="<?php echo $container; ?> default-section__container default-section__container--main">
      <div class="js-no-result sidebar-section__no-result">There is no matching map</div>
      <div class="sidebar-section__container">
        <div class="grid sidebar-section__block-grid js-sidebar-section">
          <div class="grid__col sidebar-section__block sidebar-section__block--sidebar">
            <div class="sidebar-section__inner">
              <?php the_block('store-locator-item'); ?>
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
