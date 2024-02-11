<?php

/**
 * Template Sidebar
 * -----------------------------------------------------------------------------
 */

if (is_active_sidebar('theme-widgets')) {
    printf('<hr class="%s">', 'vcenter--double');
    printf('<div id="%s">', 'widgets');
    dynamic_sidebar('theme-widgets');
    printf('</div>');
}

?>
