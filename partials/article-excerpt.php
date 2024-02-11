<?php

/**
 * Excerpted Article
 * -----------------------------------------------------------------------------
 */

?>

<article <?php post_class(['article', 'excerpt', 'vspace--full']); ?> id="article--<?php the_ID(); ?>">
    <header class="excerpt__header">
        <h4 class="excerpt__title title">
            <?php printf('<a class="%s" href="%s">%s</a>', 'navbar__title-link', get_the_permalink(), get_the_title()); ?>
        </h4>
        <?php if (!is_page()) : ?>
            <span class="postmeta text--small"><?php bloodfang_postmeta(); ?></span>
        <?php endif; ?>
    </header>
    <p class="article__content excerpt__content text--small">
        <?php echo get_the_excerpt(); ?>
    </p>
</article>
