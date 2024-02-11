<?php

/**
 * Page Template
 * -----------------------------------------------------------------------------
 */

get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
    bloodfang_partial('article', 'full');
  }
} else {
  bloodfang_partial('article', 'missing');
}

get_footer();

?>
