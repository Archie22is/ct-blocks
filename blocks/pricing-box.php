<?php
$_class = 'f fdc pricing-box';
$_class .= !empty($class) ? ' ' . $class : '';
$_highlight_text = !empty($highlight_text) ? $highlight_text : esc_html__('Popular', 'ct-blocks');
$_has_icon = ($icon_style != 'no-style') ? 'has-icon' : '';
$_icon_style = !empty($icon_style) ? 'icon--' . $icon_style : 'icon--no-style';

switch ($icon_style) {
  case 'arrow-right':
    $icon = codetot_svg('arrow-right', false);
  break;

  case 'angle-right':
    $icon = codetot_svg('angle-right', false);
  break;

  case 'checked-red':
  case 'checked-green':
  case 'checked-blue':
  case 'checked-dark':
  case 'checked-white':
    $icon = codetot_svg('checked', false);
  break;

  default:
    $icon = '';
  break;
}
?>
<div class="<?php echo $_class; ?>">
  <?php if (!empty($title)) : ?>
    <div class="pricing-box__header">
      <?php if (isset($is_highlight) && $is_highlight) : ?>
        <span class="align-c pricing-box__highlight-text"><?php echo $_highlight_text; ?></span>
      <?php endif; ?>
      <h3 class="pricing-box__title"><?php echo $title; ?></h3>
      <?php if (!empty($pricing)) : ?>
        <p class="pricing-box__price">
          <span class="price"><?php echo $pricing; ?></span>
          <?php if (!empty($unit)) : ?>
            <span class="unit"><?php echo $unit; ?></span>
          <?php endif; ?>
          <?php if (!empty($duration)) : ?>
            <span class="duration"><?php echo $duration; ?></span>
          <?php endif; ?>
        </p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($description)) : ?>
    <div class="wysiwyg pricing-box__description <?php echo $_has_icon; ?>">
      <?php
        if ($icon_style != 'no-style'):
          $str = $description;
          $partern = '/<li>(.*?)<\/li>/';
          $subst = "<li class=\"pricing-box__feature\"><span class=\"pricing-box__icon $_icon_style \">$icon</span><span>$1</span></li>\n";
          $result = preg_replace($partern, $subst, $str);
          echo $result;
        else:
          echo $description;
        endif;
      ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($button_text) && !empty($button_url)) : ?>
    <div class="pricing-box__footer">
      <?php
      the_block('button', array(
        'class' => 'align-c pricing-box__button',
        'button' => $button_text,
        'type' => $button_style,
        'url' => $button_url
      ));
      ?>
    </div>
  <?php endif; ?>
</div>
