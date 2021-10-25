<?php
$item_attributes = isset($enable_schema) && $enable_schema ? ' itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"' : null;
$question_attributes = isset($enable_schema) && $enable_schema ? ' itemprop="name"' : null;
$answer_attributes = isset($enable_schema) && $enable_schema ? ' itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"' : null;
$answer_content_attributes = isset($enable_schema) && $enable_schema ? ' itemprop="text"' : null;

if (!empty($item) && !empty($item['title']) && !empty($item['content'])) : ?>

  <div class="w100 accordions__item"<?php echo $item_attributes; ?>>
    <div class="accordions__item-box">
      <button class="w100 f fw aic jcb accordions__item-header js-trigger">
        <span class="bold-text accordions__item-title"<?php echo $question_attributes; ?>><?php echo $item['title']; ?></span>
        <span class="accordions__item-icon" aria-hidden="true">
          <?php codetot_svg('plus', true); ?>
        </span>
      </button>
      <div class="accordions__item-content js-content"<?php echo $answer_attributes; ?>>
        <div class="accordions__item-text js-content-inner">
          <div class="wysiwyg mb-1 accordions__content"<?php echo $answer_content_attributes; ?>><?php echo $item['content']; ?></div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
