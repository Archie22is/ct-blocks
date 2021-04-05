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
?>

<div class="store-locator-form js-store-locator-form">
  <div class="store-locator-form__area">
    <select name="" id="" class="js-area">
      <?php
      foreach ($category_province_store as $category) : ?>
        <option value=<?php  echo $category->term_id;?>>
          <?php  echo $category->name;?>
        </option>
      <?php endforeach;
      ?>
    </select>
  </div>
  <div class="store-locator-form__province">
    <select name="" id="" class="js-province">
    <?php
      foreach ($category_province_store as $category) {
        $child_arg = array('hide_empty' => false, 'parent' => $category->term_id);
        $child_cat = get_terms($category_name, $child_arg);

        foreach ($child_cat as $child_term) {
          echo '<option class="js-province-'.$category->term_id.'"'. 'value="' . $child_term->term_id .'">' . $child_term->name . '</option>'; //Child Category
        }
      }
      ?>
    </select>
  </div>
  <div class="store-locator-form__district">
    <select name="" id="" class="js-district">
      <?php
        foreach ($category_province_store as $category) {
          $child_arg = array('hide_empty' => false, 'parent' => $category->term_id);
          $child_cat = get_terms($category_name, $child_arg);

          foreach ($child_cat as $child_term) {
            $district_arg = array('hide_empty' => false, 'parent' => $child_term->term_id);
            $district_cat = get_terms($category_name, $district_arg);
            foreach ($district_cat as $district_term) {
              echo '<option class="js-district-'.$child_term->term_id.'"'. 'value="' . $district_term->term_id .'">' . $district_term->name . '</option>'; //Child Category
            }
          }
        }
      ?>
      ?>
    </select>
  </div>
</div>
