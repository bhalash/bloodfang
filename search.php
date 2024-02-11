<?php

/**
 * Search Results Template
 * -----------------------------------------------------------------------------
 */

get_header();
get_search_form();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        bloodfang_partial('article', 'excerpt');
        printf('<hr class="%s">', 'vcenter--full');
    }
} else {
    bloodfang_partial('article', 'missing');
}

bloodfang_partial('pagination', 'site');
get_footer();

?>
