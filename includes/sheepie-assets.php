<?php

/**
 * Bloodfang Assets
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Bloodfang
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU GPL v3.0
 * @version    1.0
 * @link       https://github.com/bhalash/bloodfang
 */

add_action('wp_enqueue_scripts', function() {
    $paths = [];
    $paths['css'] = get_template_directory_uri() . '/assets/css/';
    $paths['js'] = get_template_directory_uri() . '/assets/js/min/';

    $assets = [];

    $assets['fonts'] = [
        // 'font:variant,variant'
        'Merriweather:300,700', 'Open Sans:400,700', 'Lato:400,900', 'Source Code Pro'
    ];

    $assets['css'] = [
        // 'style-name' => 'style_path'
        'main' => 'style.css',
    ];

    $assets['js'] = [
        // 'script-name' => ['script_path', ['dependency']
        'functions' => ['bloodfang.js', ['jquery']]
    ];

    bloodfang_css($assets, $paths);
    bloodfang_js($assets, $paths);
});

/*
 * Asynchronous Script Load
 * -----------------------------------------------------------------------------
 * So, fair warning: this will break the shit out of WordPress jQuery plugins.
 * Like, badly break shit if scripts are loaded which depend on others. My
 * theme's JS is optimized to sidestep this problem.
 *
 * @link http://www.davidtiong.com/using-defer-or-async-with-scripts-in-wordpress/
 */

add_filter('script_loader_tag', function($tag, $handle) {
    $defer_type = 'async';

    if (is_admin()) {
        return $tag;
    }

    if (strpos($tag, '/wp-includes/js/jquery/jquery')) {
        return $tag;
    }

    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)
        && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.') !== false) {

        return $tag;
    }

    return str_replace(' src', " $defer_type src ", $tag);
}, 10, 2);

/*
 * Load Site JS in Footer
 * -----------------------------------------------------------------------------
 * @link http://www.kevinleary.net/move-javascript-bottom-wordpress/#comment-56740
 */

if (!is_admin()) {
    add_action('wp_enqueue_scripts', function() {
        remove_action('wp_head', 'wp_print_scripts');
        remove_action('wp_head', 'wp_print_head_scripts', 9);
        remove_action('wp_head', 'wp_enqueue_scripts', 1);
    });
}

/**
 * JavaScript Asset Loader
 * -----------------------------------------------------------------------------
 * Load all theme JavaScript.
 *
 * @param   array       $assets         Theme JavaScript assets.
 * @param   array       $paths          Theme asset paths.
 */

function bloodfang_js($assets, $paths) {
    $js = $assets['js'];
    $version = $GLOBALS['bloodfang_version'];

    if (!empty($js)) {
        foreach ($js as $name => $script) {
            wp_enqueue_script($name, $paths['js'] . $script[0], $script[1], $version, true);
        }
    }

    if (is_singular()) {
        wp_enqueue_script('comment-reply');
    }
}

/**
 * CSS Asset Loader
 * -----------------------------------------------------------------------------
 * Load all theme CSS and related Google typefaces.
 *
 * @param   array       $assets         Theme CSS assets.
 * @param   array       $paths          Theme asset paths.
 */

function bloodfang_css($assets, $paths) {
    $css = $assets['css'];
    $fonts = $assets['fonts'];
    $version = $GLOBALS['bloodfang_version'];

    if (!empty($fonts)) {
        wp_register_style('google-fonts', bloodfang_google_font_url($fonts));
        wp_enqueue_style('google-fonts');
    }

    if (!empty($css)) {
        foreach ($css as $name => $path) {
            wp_enqueue_style($name, $paths['css'] . $path, [], $version);
        }
    }
}

/**
 * Parse Google Fonts from Array
 * -----------------------------------------------------------------------------
 * @param   array   $fonts          Array of fonts to be used.
 * @return  string  $google_url     Parsed URL of fonts to be enqueued.
 */

function bloodfang_google_font_url($fonts) {
    $google_url = '//fonts.googleapis.com/css?family=';

    foreach ($fonts as $index => $font) {
        $google_url .= str_replace(' ', '+', $font);

        if ($index < count($fonts) - 1) {
            $google_url .= '|';
        }
    }

    return $google_url;
}

/**
 * Tiny MCE Editor Stylehseet
 * -----------------------------------------------------------------------------
 */

add_action('admin_init', function() {
    add_editor_style(get_template_directory_uri() . '/assets/css/editor.css');
});

?>
