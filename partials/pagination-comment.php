<?php

/**
 * Comment Pagination Links
 * -----------------------------------------------------------------------------
 */

?>

<nav class="pagination pagination--comment noprint" id="pagination--comment">
    <p class="pagination__previous previous-comment meta">
        <?php previous_comments_link(__('Previous', 'bloodfang')); ?>
    </p>
    <p class="pagination__count meta">
        <?php get_comment_pages_count(); ?>
    </p>
    <p class="pagination__next next-comment meta">
        <?php next_comments_link(__('Next', 'bloodfang')); ?>
    </p>
</nav>
