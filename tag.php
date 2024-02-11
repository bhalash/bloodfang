<?php

/**
 * Tag Archive Template
 * -----------------------------------------------------------------------------
 */

$tag = get_tag(get_query_var('tag_id'));

get_header();
bloodfang_partial('gohome');

printf('<h2 class="%s"><a href="%s">%s</a></h2>',
  'title vspace--double',
  get_tag_link($tag->term_taxonomy_id),
  $tag->name
);

$tag_posts = get_posts([
  'posts_per_page' => 30,
  'orderby' => 'date',
  'tax_query' => [
    'taxonomy' => $tag->taxonomy,
    'field' => 'slug',
    'terms' => $tag->slug
  ]
]);

foreach ($tag_posts as $post) {
  setup_postdata($post);
  bloodfang_partial('article', 'excerpt');
}

wp_reset_query();

printf('<hr class="%s">', 'vcenter--triple');
bloodfang_partial('pagination', 'site');
get_footer();

?>
