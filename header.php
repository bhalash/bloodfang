<?php

/**
 * PHP Header File
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Bloodfang
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU GPL v3.0
 * @version    1.0
 * @link       https://github.com/bhalash/bloodfang
 */

global $post;
$charset = get_bloginfo('charset');
$html = get_bloginfo('html_type');

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- The mystery of life isn't a problem to solve, but a reality to experience. -->
    <meta http-equiv="Content-Type" content="<?php printf('%s; charset=%s', $html, $charset); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php if (is_single() || is_page()) : ?>
        <?php bloodfang_partial('gohome'); ?>
    <?php endif; ?>
    <main class="main" id="main">
        <?php if (!is_404() && !is_single() && !is_page()) {
            bloodfang_partial('header', 'title');
        } ?>
