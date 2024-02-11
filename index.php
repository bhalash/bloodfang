<?php

/**
 * Main Index Template
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Bloodfang
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU GPL v3.0
 * @version    1.0
 * @link       https://github.com/bhalash/bloodfang
 */

get_header();
global $paged;

if (have_posts()) {
    while (have_posts()) {
        the_post();
        bloodfang_partial('article', 'full');
    }
} else {
    bloodfang_partial('article', 'missing');
}

bloodfang_partial('pagination', 'site');
get_footer();

?>
