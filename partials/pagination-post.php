<?php

/**
 * Next/Previous Post Pagination Link
 * -----------------------------------------------------------------------------
 */

?>

<nav class="pagination pagination--post noprint vcenter--full" id="pagination--post">
  <p class="pagination__previous previous-post meta">
    <?php next_post_link('%link', '%title', false); ?>
  </p>
  <p class="pagination__next next-post meta">
    <?php previous_post_link('%link', '%title', false); ?>
  </p>
</nav>
