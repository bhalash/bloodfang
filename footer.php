<?php

/**
 * PHP Footer File
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
