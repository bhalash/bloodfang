<?php

/**
 * Site Pagination Link
 * -----------------------------------------------------------------------------
 */

$page = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>

<nav class="noprint pagination pagination--site" id="pagination--site">
  <p class="pagination__previous previous-page meta">
    <?php previous_posts_link(__('Page ', 'bloodfang') . ($page - 1)); ?>
  </p>
  <?php if (function_exists('arc_query_has_pages') && arc_query_has_pages()) : ?>
    <p class="pagination__count meta">
      <?php arc_archive_page_count(true); ?>
    </p>
  <?php endif; ?>
  <p class="pagination__next next-page meta">
    <?php next_posts_link(__('Page ', 'bloodfang') . ($page + 1)); ?>
  </p>
</nav>
