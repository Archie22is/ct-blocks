<?php
$container = codetot_site_container();
$_class = 'rel pricing-tables';
$_class .= !empty($class) ? ' ' . $class : '';
$_class .= !empty($background_image) ? ' section-bg' : ' section';
$_class .= !empty($background_contract) ? ' pricing-tables--' . esc_attr($background_contract) : '';
$_class .= !empty($layout) ? ' pricing-tables--' . esc_attr($layout) : '';
$_class .= !empty($number_columns) ? ' pricing-tables--' . esc_attr($number_columns) .'-column' : '';
?>
<section class="<?php echo $_class; ?>">
  <div class="rel z-1 <?php echo $container; ?> pricing-tables__container">
    <div class="grid pricing-tables__grid">
      <?php if(!empty($title)) : ?>
        <div class="grid__col pricing-tables__col pricing-tables__col--header" data-aos="fade-up">
          <h2 class="pricing-tables__title"><?php echo $title ?></h2>
        </div>
      <?php endif; ?>
      <?php if(!empty($description)) : ?>
        <div class="grid__col pricing-tables__col pricing-tables__col--description" data-aos="fade-up">
          <div class="wysiwyg pricing-tables__description">
            <?php echo $description; ?>
          </div>
        </div>
      <?php endif; ?>
      <?php if(!empty($items)) : ?>
        <div class="grid__col pricing-tables__col pricing-tables__col--main" data-aos="fade-up">
          <div class="f fw pricing-tables__inner">
            <?php foreach ($items as $item) : ?>
              <div class="pricing-tables__item">
                <?php the_block('pricing-box', array(
                  'style' => !empty($item_style) ? $item_style : 'style-1',
                  'distinctive' =>  $item['distinctive'],
                  'title' => $item['title'],
                  'pricing' => $item['pricing'],
                  'unit' => $item['unit'],
                  'items' => $item['feature'],
                  'button_text' => $item['button_text'],
                  'button_url' => $item['button_url']
                ))
                ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php if(!empty($background_image)): ?>
    <div class="abs pricing-tables__background">
      <?php the_block('image', array(
        'image' => $background_image,
        'class' => 'image--cover pricing-tables__background'
      )); ?>
    </div>
  <?php endif; ?>
</section>
