<?php

get_header();

global $wp_query;

the_block('breadcrumbs');

the_block('category-post', array(
  'query' => $wp_query,
));

wp_reset_query();

get_footer();
