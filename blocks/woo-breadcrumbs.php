<?php
$container = codetot_site_container();
?>

<div class="breadcrumbs breadcrumbs--woocommerce <?php if (!empty($class)) : echo ' ' . $class; endif; ?>">
  <div class="<?php echo $container; ?> breadcrumbs__container">
    <?php woocommerce_breadcrumb(); ?>
  </div>
</div>
