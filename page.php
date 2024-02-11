<?php

/**
 * Page Template
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

if (have_posts()) {
    while (have_posts()) {
        the_post();
        bloodfang_partial('article', 'full');
    }
} else {
    bloodfang_partial('article', 'missing');
}

get_footer();

?>
