<?php if (!empty($item) && !empty($item['title']) && !empty($item['content'])) : ?>
  <div class="w100 accordions__item" itemscope
       itemtype="https://schema.org/FAQPage">
    <div class="accordions__item-box" itemscope itemprop="mainEntity"
         itemtype="https://schema.org/Question">
      <button class="w100 f fw aic jcb accordions__item-header js-trigger" itemprop="name">
        <span class="bold-text accordions__item-title"><?php echo $item['title']; ?></span>
        <span class="accordions__item-icon">
          <?php codetot_svg('plus', true); ?>
        </span>
      </button>
      <div class="d-none accordions__item-content js-content" itemscope=""
           itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <div class="accordions__item-text js-content-inner" itemprop="text">
          <div class="wysiwyg mb-1 accordions__content"><?php echo $item['content']; ?></div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
