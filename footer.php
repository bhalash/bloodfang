<?php

/**
 * PHP Footer File
 * -----------------------------------------------------------------------------
 */

?>
        <?php get_sidebar(); ?>
        <nav class="menu">
            <?php wp_nav_menu([
                'theme_location' => 'top-social',
                'container' => '',
                'menu_class' => 'menu__list',
                'link_before' => '<span class="social__icon">',
                'link_after' => '</span>',
                'items_wrap' =>  bloodfang_nav_menu_search()
            ]); ?>
        </nav>
    </main> <?php // End #main ?>
    <?php if (!is_404()) {
        bloodfang_partial('modal', 'lightbox');
        bloodfang_partial('modal', 'search');
    }

    wp_footer(); ?>
</body>
</html>
