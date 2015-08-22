<?php

/**
 * Search Results Template
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Sheepie
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU GPL v3.0
 * @version    3.0
 * @link       https://github.com/bhalash/sheepie
 */

get_header();

if (!is_single() && $paged > 0) {
    partial('pagination');
}

if (have_posts()) {
    while (have_posts()) {
        the_post();
        partial('article', 'full');
        printf('<hr>');
    }
} else {
    partial('article', 'missing');
}

partial('pagination');
get_footer(); ?>
