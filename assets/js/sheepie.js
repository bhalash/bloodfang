/**
 * Bloodfang functions.
 */

(function(document, window) {
  /**
   * Loop DOM elements.
   */

  function loopDom(selector, callback) {
    [].forEach.call(document.querySelectorAll(selector), callback);
  }

  /**
   * Remove a specified selector from the DOM.
   *
   *  ['div', 'h3'].forEach(removeSelector);
   */

  function removeSelector(selector) {
    loopDom(selector, function(element) {
      element.parentNode.removeChild(element);
    });
  }

  /**
   * Add the supplied data-attribute to each instance of a selector.
   *
   *
   *  addDataToSelector('div', { ponies: 'Awesome!' }); // data-ponies="Awesome!"
   */

  function addDataToSelector(selector, data) {
    loopDom(selector, function(element) {
      Object.keys(data).forEach(function(key) {
        element.dataset[key] = data[key];
      });
    });
  }

  ['figure br'].forEach(removeSelector);
  addDataToSelector('main img', { click: 'modal:show:lightbox' });
})(document, window);
