/**
 * Modals.
 */

(function($, document, window) {
  /**
   * Broadcast to hide all modals when <Esc> is depressed.
   */

  $(document).on('keydown', function(event) {
    switch (event.keyCode) {
      case 27: $.broadcast('modal:hide'); break;
    }
  });

  /**
   * Show specified modal.
   *
   * Show modal if data is set.
   */

  $.subscribe('modal:show', function(event, data) {
    if (data.target) {
      $.broadcast('modal:hide');
      $('[data-modal="' + data.target + '"]').removeClass('hidden').show();
    }
  });

  /**
   * Hide specified/all modals.
   *
   * If there is no data set, hide all modals.
   */

  $.subscribe('modal:hide', function(event, data) {
    var modal = '[data-modal]';

    if (data.target) {
      modal = '[data-modal="' + data.target + '"]';
    }

    $(modal).hide();
  });

  /**
   * Set lightbox image when the modal is shown.
   */

  $.subscribe('modal:show:lightbox', function(event, data, element) {
    data = {
      src: $(element).data('src') || $(element).attr('src'),
      alt: $(element).data('alt') || $(element).attr('alt')
    };

    $('.lightbox__image').attr(data);
  });

  /**
   * Focus the modal search input after it is displayed.
   */

  $.subscribe('modal:show:search', function() {
    $('.modal-search__input').focus();
  });
})(jQuery, document, window);
