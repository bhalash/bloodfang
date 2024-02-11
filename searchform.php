<?php

/**
 * Searchform Template
 * -----------------------------------------------------------------------------
 */

global $wp_query;

$query = get_search_query();
$action = esc_url(home_url('/'));
$total = $wp_query->found_posts;
$result = __('result', 'bloodfang') . (abs($total) !== 1 ? 's' : '');

?>

<form class="noprint searchform vspace--half" id="searchform" method="get" action="<?php printf($action); ?>" autocomplete="off">
  <fieldset>
    <input class="searchform__input" id="searchform__input" name="s" placeholder="<?php _e('search', 'bloodfang'); ?>" type="text" required="required" value="<?php printf($query); ?>">
  </fieldset>
</form>
<div class="clearfix noprint searchform__meta meta">
  <span class="searchform__meta--left left-float"><?php printf('%d %s', $total, $result); ?></span>
  <?php if (function_exists('arc_search_url')) : ?>
    <span class="right-float">
      Sort by:

      <a href="<?php arc_search_url('asc'); ?>"><?php _e('oldest', 'bloodfang'); ?></a> |
      <a href="<?php arc_search_url('desc'); ?>"><?php _e('newest', 'bloodfang'); ?></a>
    </span>
  <?php endif; ?>
</div>
<hr class="vcenter--full noprint">
