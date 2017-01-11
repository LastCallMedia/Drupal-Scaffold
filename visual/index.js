/**
 * Visual regression test script.
 *
 * Example usage:
 *   `node_modules/casperjs test visual/index.js`
 *
 * Options:
 *   base-url - Sets the base url for the tests (ex: --base-url=http://my.production.site)
 *   rebase   - Updates the reference screenshots (ex: --rebase)
 */
var phantomcss = require('phantomcss');

var base = casper.cli.get('base-url') || 'http://127.0.0.1:8888';

var breakpoints = {
  desktop: [1024, 768],
  tablet: [640, 768],
  phone: [320, 768],
};

phantomcss.init({
  rebase: casper.cli.get('rebase'),
  screenshotRoot: './visual/reference',
  comparisonResultRoot: './visual/comparisons',
  failedComparisonsRoot: './visual/failures',
  addIteratorToImage: false, // Don't name images like homepage_1.jpg.
});

// Snapshot the homepage.  In real life, you probably don't want to do exactly
// this, since the homepage will include a lot of dynamic content elements that
// will change over time.
casper.test.begin('Homepage', function() {
  casper.start(base + '/');

  Object.keys(breakpoints).forEach(function(k) {
    casper.then(function() {
      // Set the breakpoint and snapshot the page.
      casper.viewport(breakpoints[k][0], breakpoints[k][1]);
      phantomcss.screenshot('body', 'homepage-' + k);
    })
  });

  casper.then(function() {
    phantomcss.compareAll();
  });

  casper.run(function() {
    casper.test.done();
  });
});
