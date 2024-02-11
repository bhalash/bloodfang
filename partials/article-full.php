<?php

/**
 * Full Article Template
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Bloodfang
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU GPL v3.0
 * @version    1.0
 * @link       https://github.com/bhalash/bloodfang
 */

?>

<article <?php post_class(['full', 'article']); ?> id="article--<?php the_ID(); ?>">
    <?php if (!is_single() && !is_page()) : ?>
        <header>
            <h3 class="title vspace--quarter">
                <?php printf('<a class="%s" href="%s">%s</a>', 'navbar__title-link', get_the_permalink(), get_the_title()); ?>
            </h3>
            <p class="noprint meta vspace--half"><?php echo bloodfang_postmeta(); ?></p>
        </header>
    <?php else: ?>
        <?php bloodfang_partial('header', 'title'); ?>
    <?php endif; ?>
    <div class="full__content vspace--full">
        <?php the_content(__('Read the rest of this post &raquo;', 'bloodfang')); ?>
    </div>

    <?php wp_link_pages(array(
        'before' => sprintf('<p class="%s">%s', 'pagination--article page-links', __('Page: ', 'bloodfang')),
        'after' => '</p>'
    )); ?>

    <?php if (is_single()) : ?>
        <?php bloodfang_partial('pagination', 'post'); ?>
        <hr class="vcenter--full">
        <footer class="footer vcenter--double">
            <div class="footer__author">
                <?php echo bloodfang_avatar(get_the_author_meta('ID'), get_the_author(), 'footer__avatar', ['size' => 150]); ?>
                <div class="footer__bio">
                    <h3 class="vspace--quarter title">by <?php the_author_meta('display_name'); ?></h3>
                    <h4 class="vspace--quarter meta"><?php the_tags(__('Tagged: ', 'bloodfang'), ', '); ?></h4>
                    <p class="meta"><?php the_author_meta('user_description'); ?></p>
                </div>
            </div>
        </footer>
    <?php else : ?>
        <hr class="vcenter--triple">
    <?php endif; ?>
</article>
