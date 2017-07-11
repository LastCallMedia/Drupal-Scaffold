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
      bitmaps_reference: __dirname + '/reference',
      bitmaps_test: __dirname + '/comparisons',
      casper_scripts: __dirname,
      html_report: __dirname + '/reports',
      ci_report: __dirname + '/reports'
    },
    report: ['CI', 'browser']
  };
})();
