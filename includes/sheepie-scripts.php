<?php

/**
 * Sheepie Theme Scripts
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Sheepie
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU GPL v3.0
 * @version    1.0
 * @link       https://github.com/bhalash/sheepie
 */

add_action('wp_enqueue_scripts', function() {
    $assets = get_template_directory_uri() . '/assets/';
    $js_path = $assets . 'js/min/';
    $css_path = $assets . 'css/';
    $node_path = get_template_directory_uri() . '/node_modules/';

    $sheepie_js = [
        'functions' => [$js_path . 'sheepie.js', []],
    ];

    $sheepie_conditional_js = [
        // Internet Explorer conditional JS.
        // 'html5-shiv' => [
        //     $node_path . 'html5shiv/dist/html5shiv.min.js',
        //     'lte IE 9',
        //     []
        // ]
    ];

    // All Google Fonts to be loaded.
    $sheepie_fonts = ['Open Sans', 'Lato:900', 'Source Code Pro'];

    // Compressed, compiled theme CSS.
    $sheepie_css = ['main-style' => $css_path . 'style.css',];

    $sheepie_conditional_css = [
        // Internet Explorer conditiional CSS.
        'ie-fallback' => [
            $css_path . 'ie.css',
            'lte IE 9'
        ]
    ];

    sheepie_js($sheepie_js, $sheepie_conditional_js, $js_path);
    sheepie_css($sheepie_css, $sheepie_conditional_css, $sheepie_fonts);
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
 * Sheepie JavaScript Loader
 * -----------------------------------------------------------------------------
 * Load all theme JavaScript.
 *
 * @param   array       $sheepie_js                Main scripts..
 * @param   array       $sheepie_conditional_js    IE conditional scripts.
 * @param   string      $js_path                   Path to JavaScript assets.
 */

function sheepie_js($sheepie_js, $sheepie_conditional_js, $js_path) {
    if (!is_404()) {
        foreach ($sheepie_js as $name => $script) {
            wp_enqueue_script($name, $script[0], $script[1], $GLOBALS['sheepie_version'], true);
        }
    }

    foreach ($sheepie_conditional_js as $name => $script) {
        wp_enqueue_script($name, $script[0], $script[2], $GLOBALS['sheepie_version'], false);
        wp_script_add_data($name, 'conditional', $script[1]);
    }

    if (is_singular()) {
        wp_enqueue_script('comment-reply');
    }
}

/**
 * Sheepie CSS Loader
 * -----------------------------------------------------------------------------
 * Load all theme CSS and related Google typefaces.
 *
 * @param   array       $css                Ordinary, main stylehseets.
 * @param   array       $conditional_css    IE conditional stylesheets.
 * @param   array       $fonts              Google fonts to be loaded.
 */

function sheepie_css($css, $conditional_css, $fonts) {
    foreach ($css as $name => $style) {
        wp_enqueue_style($name, $style, [], $GLOBALS['sheepie_version']);
    }

    if (!empty($fonts)) {
        wp_register_style('google-fonts', sheepie_google_font_url($fonts));
        wp_enqueue_style('google-fonts');
    }

    foreach ($conditional_css as $name => $style) {
        $path = $style[0];
        $condition = $style[1];

        wp_enqueue_style($name, $path, [], $GLOBALS['sheepie_version']);
        wp_style_add_data($name, 'conditional', $condition);
    }
}

/**
 * Parse Google Fonts from Array
 * -----------------------------------------------------------------------------
 * @param   array   $fonts          Array of fonts to be used.
 * @return  string  $google_url     Parsed URL of fonts to be enqueued.
 */

function sheepie_google_font_url($fonts) {
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

/**
 * Prevent WordPress Embed Helper Loading
 * -----------------------------------------------------------------------------
 */

add_action('wp_footer', function() {
    wp_deregister_script('wp-embed');
});

?>
