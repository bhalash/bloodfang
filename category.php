<?php

/**
 * Category Archive Template
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Bloodfang
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU GPL v3.0
 * @version    1.0
 * @link       https://github.com/bhalash/bloodfang
 */

$category = get_category(get_query_var('cat'));

get_header();
bloodfang_partial('gohome');

printf('<h2 class="%s"><a href="%s">%s</a></h2>',
    'title vspace--double',
    get_category_link($category),
    $category->name
);

$category_posts = get_posts([
    'category' => $category->cat_ID,
    'posts_per_page' => 30,
    'orderby' => 'date',
]);

foreach ($category_posts as $post) {
    setup_postdata($post);
    bloodfang_partial('article', 'excerpt');
}

wp_reset_query();

printf('<hr class="%s">', 'vcenter--triple');
bloodfang_partial('pagination', 'site');
get_footer();

?>
