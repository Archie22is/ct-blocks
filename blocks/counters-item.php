<?php if (!empty($item)) : ?>
  <div class="f fdc counters__inner">
    <?php if (!empty($item['count'])) : ?>
      <p class="counters__count">
        <span class="h3 counters__count-number js-counter"><?php echo $item['count']; ?></span>
        <?php if (!empty($item['unit'])) : ?>
          <span class="counters__unit"><?php echo $item['unit']; ?></span>
        <?php endif; ?>
      </p>
    <?php endif; ?>
    <div class="counters__content">
      <?php if (!empty($item['title'])) : ?>
        <p class="bold-text counters__item-title"><?php echo $item['title']; ?></p>
      <?php endif; ?>
      <?php if (!empty($item['description'])) : ?>
        <p class="counters__item-description"><?php echo $item['description']; ?></p>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>
