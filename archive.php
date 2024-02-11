<?php

/**
 * Archive Template
 * -----------------------------------------------------------------------------
 */

get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
    bloodfang_partial('article', 'full');
    printf('<hr class="%s">', 'vcenter--double');
  }
} else {
  bloodfang_partial('article', 'missing');
}

bloodfang_partial('pagination', 'site');
get_footer();

?>
