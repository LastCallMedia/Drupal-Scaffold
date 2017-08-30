/* eslint-env node */
/**
 * This is the BackstopJS configuration.
 *
 * For more information, see viewsports.js, scenarios.js, and
 *   https://github.com/garris/BackstopJS#here-is-the-configuration-that-backstop-genconfig-generates
 */

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
    casper_scripts: 'scripts',
    html_report: 'reports',
    ci_report: 'reports'
  },
  report: ['CI', 'browser']
};
