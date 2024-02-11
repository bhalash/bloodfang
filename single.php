<?php

/**
 * Single Post Template
 * -----------------------------------------------------------------------------
 */

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        bloodfang_partial('article', 'full');

        if (function_exists('rp_get_related')) {
            printf('<hr class="%s">', 'vspace--full noprint');
            printf('<div class="%s">', 'related-articles flex--three-col--article noprint');

            $related = rp_get_related([
                'count' => 3,
                'range' => [
                    'after' => date('Y-m-j') . '-180 days',
                    'before' => date('Y-m-j')
                ]
            ]);

            foreach ($related as $post) {
                setup_postdata($post);
                bloodfang_partial('article', 'related');
            }

            printf('</div>');
            wp_reset_postdata();
        }

        comments_template();
    }
} else {
    bloodfang_partial('article', 'missing');
}

get_footer();

?>
