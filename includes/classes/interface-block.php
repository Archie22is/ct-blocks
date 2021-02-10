<?php

interface Codetot_Base_Block_Interface {
  public function register_fields($fields);
  public function load_primary_fields();
  public function load_template($index, $layout);
}
