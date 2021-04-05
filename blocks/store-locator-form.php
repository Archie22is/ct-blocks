<?php

$province_args = array(
  'orderby' => 'menu_order',
  'order' => 'asc',
  'hide_empty' => false,
  'pad_counts' => true,
  'parent' => 0
);

$category_province_store = get_terms('store_locator', $province_args);


foreach ($category_province_store as $category) :
  // var_dump($category);
endforeach;
?>
<div class="store-locator-form">
  <div class="store-locator-form__area js-area">
    <select name="" id="">
      <?php
      foreach ($category_province_store as $category) : ?>
        <option value=<?php  echo $category->term_id;?>>
          <?php  echo $category->name;?>
        </option>
      <?php endforeach;
      ?>
    </select>
  </div>
  <div class="store-locator-form__province js-province">
    <select name="" id=""> <?php
      foreach ($category_province_store as $category) {
        $child_arg = array('hide_empty' => false, 'parent' => $category->term_id);
        $child_cat = get_terms('store_locator', $child_arg);

        foreach ($child_cat as $child_term) {
          echo '<option class="js-province-'.$category->term_id.'">' . $child_term->name . '</option>'; //Child Category
        }
      }
      ?>
    </select>
  </div>
  <div class="store-locator-form__district js-district">
    <select name="" id="">
      <option value="">Viet Nam</option>
    </select>
  </div>
</div>
