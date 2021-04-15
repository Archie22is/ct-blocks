<?php

function codetot_is_ct_blocks_localhost() {
  !empty($_SERVER['HTTP_X_CODETOT_BLOCK_HEADER']) && $_SERVER['HTTP_X_CODETOT_BLOCK_HEADER'] === 'development';
}
