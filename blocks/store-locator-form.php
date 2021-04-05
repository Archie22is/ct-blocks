<?php

$province_args = array(
  'orderby' => 'menu_order',
  'order' => 'asc',
  'hide_empty' => false,
  'pad_counts' => true,
  'parent' => 0
);

$category_province_store = get_terms('store_locator', $province_args);
?>
<div class="store-locator-form">
  <div class="store-locator-form__area">
    <select name="" id="">
      <option value="">Viet Nam</option>
    </select>
  </div>
  <div class="store-locator-form__province">
    <select name="" id="">
      <?php
      foreach ($category_province_store as $category) : ?>
        <option><?php
          echo $category->name;
          ?></option>
      <?php endforeach;
      ?>
    </select>
  </div>
  <div class="store-locator-form__district">
    <select name="" id=""> <?php
      foreach ($category_province_store as $category) {
        $child_arg = array('hide_empty' => false, 'parent' => $category->term_id);
        $child_cat = get_terms('store_locator', $child_arg);

        foreach ($child_cat as $child_term) {
          echo '<option>' . $child_term->name . '</option>'; //Child Category
        }
      }
      ?>
    </select>
  </div>
  <div class="store-locator-form__submit">
    <input type="submit">
  </div>
</div>
