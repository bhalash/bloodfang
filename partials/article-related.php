<?php

/**
 * Related Article Template
 * -----------------------------------------------------------------------------
 */

?>

<article <?php post_class(['vspace--half', 'article', 'related']); ?> id="article--<?php the_ID(); ?>">
  <header class="vspace--half">
    <h4 class="title vspace--quarter">
      <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h4>
    <p class="meta"><?php echo bloodfang_postmeta(); ?></p>
  </header>
  <p class="related__excerpt text--small">
    <?php if (strlen(get_the_excerpt()) < 40) : ?>
      <a class="related__thumbnail" href="<?php the_permalink(); ?>" rel="bookmark" <?php post_image_url_style($post, true); ?>></a>
    <?php else: ?>
      <?php echo substr(get_the_excerpt(), 0, 200); ?>...
    <?php endif; ?>
  </p>
</article>
