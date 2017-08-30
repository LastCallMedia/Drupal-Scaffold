/* eslint-env node */
/**
 * BackstopJS Scenarios.
 *
 * This is the "scenarios" portion of the Backstop config. A scenario details what page should
 * be captured, and what parts of it to capture.  With Drupal, we have to be mindful of dynamic
 * content, which will change over time and break your tests when the content changes.
 *
 * To deal with dynamic content, we can either hide it, using the 'hideSelectors' property,
 * or we can make it consistent by using javascript to rewrite (sanitize) parts of it.
 *
 * For more information, see
 *  https://github.com/garris/BackstopJS#here-is-the-configuration-that-backstop-genconfig-generates
 */
(function () {
  'use strict';

  var baseUrl = process.env.BASE_URL;

  module.exports = [
    {
      label: 'Homepage',
      url: baseUrl + '/',
      hideSelectors: [],
      removeSelectors: [],
      selectors: [
        'document'
      ],
      readyEvent: null,
      delay: 500,
      misMatchThreshold: 0.1
    }
  ];
})();

