<?php

/**
 * Related Posts
 * -----------------------------------------------------------------------------
 */

if (!defined('ABSPATH')) {
  die('-1');
}

/**
 * Get Related Posts from the Same Category
 * -----------------------------------------------------------------------------
 * Fetch posts related to given post, by category.
 *
 */

function rp_get_related($args) {
  $args = wp_parse_args($args, [
    'post' => get_the_id(),
    'count' => 3,
    'cache' => true,
    'range' => [
      'after' => date('Y-m-j') . '-180 days',
      'before' => date('Y-m-j')
    ]
  ]);

  if (!($post = get_post($args['post']))) {
    global $post;
  }

  $categories = get_the_category($post->ID) ?: get_option('default_category');
  $query_cat = [];

  foreach ($categories as $cat) {
    $query_cat[] = $cat->cat_ID;
  }

  $related = get_posts([
    'category__in' => $query_cat,
    'date_query' => [
      'inclusive' => true,
      'after' => $args['range']['after'],
      'before' => $args['range']['before']
    ],
    'numberposts' => $args['count'],
    'order' => 'DESC',
    'orderby' => 'rand',
    'perm' => 'readable',
    'post_status' => 'publish',
    'post__not_in' => [$post->ID]
  ]);

  if ($missing = $args['count'] - sizeof($related)) {
    $related = rp_filler_posts($post, $missing, $related);
  }

  return $related;
}

/**
 * Related Posts Filler
 * -----------------------------------------------------------------------------
 */

function rp_filler_posts($post, $count, $related_posts) {
  $excluded_posts = [$post->ID];

  foreach ($related_posts as $related) {
    $excluded_posts[] = $related->ID;
  }

  $filler_posts = get_posts([
    'numberposts' => $count,
    'order' => 'DESC',
    'orederby' => 'rand',
    'post__not_in' => $excluded_posts
  ]);

  return array_merge($related_posts, $filler_posts);
}

?>
