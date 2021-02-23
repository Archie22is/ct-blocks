<?php
$container = codetot_site_container();
if (!empty($left_content) && !empty($right_content)) : ?>
  <div class="two-up<?php if (!empty($class)) : echo ' ' . $class; endif; ?>">
    <div class="<?php echo $container; ?> two-up__container">
      <div class="grid two-up__grid">
        <div class="grid__col two-up__col">
          <div class="two-up__inner"><?php echo $left_content; ?></div>
        </div>
        <div class="grid__col two-up__col">
          <div class="two-up__inner"><?php echo $right_content; ?></div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
