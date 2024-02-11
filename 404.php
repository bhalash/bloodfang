<?php

/**
 * 404 Template
 * -----------------------------------------------------------------------------
 */

get_header();

?>

<div class="error" id="error--404">
    <div class="error__content">
        <h1 class="error__message"><?php _e('Error 404', 'bloodfang'); ?></h1>
        <p class="error__description"><?php _e('Page not found. :&#40;', 'bloodfang'); ?></p>
        <p class="error__home"><a href="<?php printf(site_url()); ?>"><?php _e('back to home', 'bloodfang'); ?></a></p>
    </div>
</div>

<?php get_footer(); ?>
