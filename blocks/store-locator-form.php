<?php
$category_name = 'store_locator';
$province_args = array(
  'orderby' => 'menu_order',
  'order' => 'asc',
  'hide_empty' => false,
  'pad_counts' => true,
  'parent' => 0
);

$category_province_store = get_terms($category_name, $province_args);

$levels = ['country', 'province', 'district'];
?>

<div class="store-locator-form js-store-locator-form">

  <?php foreach ($levels as $level) { ?>
    <div class="store-locator-form__<?php echo $level ?> select-wrapper">
      <select class="js-<?php echo $level ?> store-locator-form__select">
        <?php
        if ($level === 'country') {
          printf('<option>Choose Country</option>');
        } elseif ($level === 'province') {
          printf('<option>Choose Province</option>');
        } else {
          printf('<option>Choose District</option>');
        }
        ?>
        <?php
        foreach ($category_province_store as $category) : ?>
          <?php
          $child_args = array('hide_empty' => false, 'parent' => $category->term_id);
          $child_cat = get_terms($category_name, $child_args);
          if ($level === 'country') {
            printf('<option value="%1$s">%2$s</option>', $category->term_id, $category->name);
          } else {
            foreach ($child_cat as $child_term) {
              if ($level === 'province') {
                printf('<option class="js-province-%1$s" data-country="%1$s" value="%2$s">%3$s</option>', $category->term_id, $child_term->term_id, $child_term->name);
              } else {
                $district_args = array('hide_empty' => false, 'parent' => $child_term->term_id);
                $district_cat = get_terms($category_name, $district_args);
                foreach ($district_cat as $district_term) {
                  printf('<option class="js-district-%1$s" data-province="%1$s" value="%2$s">%3$s</option>', $child_term->term_id, $district_term->term_id, $district_term->name);
                }
              }
            }
          }
        endforeach;
        ?>
      </select>
    </div>
  <?php }; ?>
</div>
