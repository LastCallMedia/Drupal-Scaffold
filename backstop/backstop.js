/* eslint-env node */
(function () {
  'use strict';

  var viewports = require('./viewports');
  var scenarios = require('./scenarios');

  module.exports = {
    id: 'visual',
    viewports: viewports,
    scenarios: scenarios,
    engine: 'slimer',
    paths: {
      bitmaps_reference: 'reference',
      bitmaps_test: 'comparisons',
      casper_scripts: '.',
      html_report: 'reports',
      ci_report: 'reports'
    },
    report: ['CI', 'browser']
  };
})();
