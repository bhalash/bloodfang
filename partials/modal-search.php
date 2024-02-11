<?php

/**
 * Modal Search Input
 *
 * I separated this template because of the 404 switch. It was easier to wrap it
 * all up here.
 *
 */

?>

<div class="hidden modal-search noprint" data-modal="search" id="modal-search">
    <form class="modal-search__form" method="get" action="<?php echo esc_url(home_url('/')); ?>" autocomplete="off" novalidate>
        <fieldset>
            <input class="modal-search__input" id="modal-search__input" name="s" type="search" placeholder="<?php _e('search', 'bloodfang'); ?>" required="required">
            <label class="modal-search__label" for="modal-search__input"><?php _e('search', 'bloodfang'); ?></label>
        </fieldset>
    </form>
    <div class="social close">
        <a class="toggle" data-click="modal:hide:search" href="">
            <span class="social__icon">Search</span>
        </a>
    </div>
</div>
