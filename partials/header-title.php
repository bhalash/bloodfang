<?php

/**
 * Theme Headline
 * -----------------------------------------------------------------------------
 * I separated this template because of the 404 switch. It was easier to wrap it
 * all up here.
 *
 */

$margin_class = (is_single() || is_page()) ? 'vspace--full' : 'vspace--double';

?>

<header class="headline noprint <?php echo $margin_class; ?>" id="headline">
  <h2 class="title vspace--half">
    <?php if (is_single() || is_page()) : ?>
      <?php printf('<a href="%s">%s</a>', get_the_permalink(), get_the_title()); ?>
    <?php else: ?>
      <?php printf('<a href="%s">%s</a>', home_url(), get_bloginfo('name')); ?>
    <?php endif; ?>
  </h2>

  <p>
    <?php if (is_single() || is_page()) : ?>
      <?php echo bloodfang_postmeta(); ?>
    <?php else : ?>
      <span class="text--italic"><?php bloginfo('description'); ?></span>
     <?php endif; ?>
  </p>
  <hr class="vcenter--full">
</header>
