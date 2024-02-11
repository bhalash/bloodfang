<?php

/**
 * Main Index Template
 * -----------------------------------------------------------------------------
 */

get_header();
global $paged;

if (have_posts()) {
  while (have_posts()) {
    the_post();
    bloodfang_partial('article', 'full');
  }
} else {
  bloodfang_partial('article', 'missing');
}

bloodfang_partial('pagination', 'site');
get_footer();

?>
