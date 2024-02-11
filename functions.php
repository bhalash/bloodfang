<?php

/**
 * Main PHP Functions
 *
 */

$GLOBALS['bloodfang_version'] = '1.1.3';

/**
 * Bloodfang Setup
 */

add_action('after_setup_theme', function() {
  bloodfang_includes();

  remove_action('wp_head', 'wp_generator');

  remove_filter('the_content', 'convert_smilies');
  remove_filter('the_excerpt', 'convert_smilies');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');

  add_theme_support('title-tag');

  add_theme_support('automatic-feed-links');
  add_theme_support('post-thumbnails');

  add_theme_support('html5', [
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption'
  ]);

  $GLOBALS['content_width'] = 880;

  $bloodfang_social = new Social_Meta([
    'facebook' => 'bhalash',
    'twitter' => '@bhalash'
  ]);
});

/**
 * Theme Includes
 */

function bloodfang_includes() {
  $theme_includes = [
    'includes/bloodfang-assets.php',
    'includes/bloodfang-comments.php',
    'lib/related-posts.php',
    'lib/archive-functions.php',
    'lib/article-images.php',
    'lib/social-meta.php'
  ];

  foreach ($theme_includes as $include) {
    require(get_template_directory() . '/' . $include);
  }
}

/**
 * Partial Wrapper
 *
 * Shorthand wrapper for get_template_part to reduce the verbosity of calls.
 *
 */

function bloodfang_partial($name, $slug = '') {
  get_template_part('/partials/' . $name, $slug);
}

/**
 * Media Prefetch
 *
 * Set prefetch for a given media domain. Useful if your site is image heavy.
 * Media prefetch domain: If null or empty, defaults to site domain.
 */

add_action('wp_head', function() {
  $prefetch = [
    'ix.bhalash.com', preg_replace('/^www\./','', $_SERVER['SERVER_NAME'])
  ];

  foreach ($prefetch as $domain) {
    printf('<link rel="dns-prefetch" href="//%s">', $domain);
  }
});

/**
 * Register Theme Widget Areas
 */

add_action('widgets_init', function() {
  register_sidebar([
    'id' => 'theme-widgets',
    'name' => __('Bloodfang Footer Widgets', 'bloodfang'),
    'description' => __('Bloodfang\'s widgets will display in the mail column, below all other content.', 'bloodfang'),
    'before_widget' => '<div class="sidebar-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ]);
});

/**
 * Register Theme Navigation Menus
 */

add_action('init', function() {
  register_nav_menus([
    'top-menu' => __('Header Menu', 'bloodfang'),
    'top-social' => __('Header Social Links', 'bloodfang')
  ]);
});

/**
 * Custom Search Link Icon
 *
 @return string     $wrap     Nav menu wrapped in string.
 */

function bloodfang_nav_menu_search() {
  $search = sprintf(
    '<li class="%s"><a class="toggle" data-click="modal:show:search" href=""><span class="%s">%s</span></a></li>',
    'search menu-item menu-item-type-custom menu-item-object-custom social',
    'social__icon',
    __('Search', 'bloodfang')
  );

  $wrap  = '<ul id="%1$s" class="%2$s">';
  $wrap .= '%3$s';
  $wrap .= $search;
  $wrap .= '</ul>';

  return $wrap;
}

/**
 * Add Social CSS Class to Menu Items
 *
 * Used to set social icon style.
 *
 */

add_filter('nav_menu_css_class', function($classes, $item) {
  $classes[] = 'social';
  return $classes;
}, 10, 2);

/**
 * Get Avatar URL
 *
 */

function bloodfang_avatar($id_or_email, $alt = '', $classes = '', $args = null) {
  $avatar = get_avatar_url($id_or_email, $args);
  return sprintf('<img class="%s" src="%s" alt="%s" />', $classes, $avatar, $alt);
}

/**
 * Post Meta Information
 *
 * Output post header information (category and date).
 */

function bloodfang_postmeta() {
  printf('<a href="%s"><time rel="date" datetime="%s">%s</time></a>',
    get_month_link(get_the_time('Y'), get_the_time('n')),
    get_the_time('Y-m-d H:i'),
    get_the_time(get_option('date_format'))
  );

  _e(' in ', 'bloodfang');
  the_category(', ');
  edit_post_link(__('edit post', 'bloodfang'), ' / ', '');
}

/**
 * Remove empty paragraphs created by wpautop()
 *
 */

add_filter('the_content', function($content) {
  $content = force_balance_tags($content);
  $content = preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
  $content = preg_replace('~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content);
  return $content;
}, 20, 1);

?>
