(function($, document, window) {
  /**
   * Event subscribe/unsubscribe.
   */

  $.observer = $({});

  /**
   * Break up arguments object into useful data.
   *
   * For each action fragment (see below), broadcast an action with that
   * fragment's data:
   */

  $.observer.triggers = function(args) {
    var args = Array.prototype.slice.apply(args),
      triggers = args[0].split(':'),
      data = {};

    data = $.observer.triggers.data(triggers, args);
    triggers = $.observer.triggers.arr(triggers, args, data);

    return triggers;
  }

  /**
   * Construct data object for event.
   *
   * This hold information about the complete action (action, method and
   * target).
   *
   * fullAction is so because a full action has three parameters.
   */

  $.observer.triggers.data = function(triggers, args) {
    var target = null,
      fullAction = 3;

    if (triggers.length === fullAction) {
      target = triggers[2];
    } else if (typeof(args[1]) === 'string') {
      target = args[1];
    }

    return {
      action: triggers[0],
      method: triggers[1],
      target: target
    };
  }

  /**
   * Construct complete trigger stack for action.
   *
   *  'modal:show:lightbox' =
   *    'modal'
   *    'modal:show'
   *    'modal:show:lightbox'
   *
   * The last line is dense: jQuery's trigger takes an optional array of
   * parameters to apply. The first array element is the trigger action
   * detailed above. The second array element contains the data object
   * followed by all of the other arguments passed to the trigger.
   *
   *  return [event, [data, arg1, arg2, arg3]]
   *
   *  $.observer.trigger(event, [data, arg1, arg2, arg3])
   */

  $.observer.triggers.arr = function(triggers, args, data) {
    var trigger = '';

    // See explanation above.
    data = [data].concat(args.slice(1));

    return triggers.map(function(fragment, index) {
      if (index) {
        trigger = trigger.concat(':');
      }

      trigger = trigger.concat(fragment);
      return [trigger, data];
    });
  }

  /**
   * Subscribe and unsubscribe actions.
   *
   */

  $.each({ on: 'subscribe', off: 'unsubscribe' }, function(name, action) {
    $[action] = function() {
      $.observer[name].apply($.observer, arguments);
    }
  });

  /**
   * Broadcast action.
   *
   * More complex than the subscribe and unsubscribe, because it splits up the
   * triggering event into individual fragments to trigger individually:
   *
   * @example
   *
   *  'modal:show:lightbox' =
   *  'modal'
   *  'modal:show'
   *  'modal:show:lightbox'
   */

  $.broadcast = function() {
    $.observer.triggers(arguments).forEach(function(action) {
      $.observer.trigger.apply($.observer, action);
    });
  }

  /**
   * Click directive.
   *
   * Just an example, because that's all I need right now.
   */

  $(document).on('click tap', '[data-click]', function(event) {
    $.broadcast($(event.currentTarget).data('click'), event.currentTarget);
    return false;
  });
})(jQuery, document, window);
