<?php
$enable_sticky_header = codetot_get_header_sticky();
?>

<header id="masthead" class="<?php codetot_header_class(); ?>"
        data-sticky-header="<?php echo (int) $enable_sticky_header; ?>"
        data-block="header"
>
  <?php do_action('codetot_header'); ?>
</header>
