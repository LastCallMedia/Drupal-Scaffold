/* eslint strict: ["error", "global"] */
/**
 * Configuration file for webdriverio.
 *
 * @see docs/wdio.md
 */
'use strict';
var path = require('path');
var VisualRegressionCompare = require('wdio-visual-regression-service/compare');

function getScreenshotName(basePath) {
  return function (context) {
    var testName = context.test.title;
    var resolution = `${context.meta.viewport.width}x${context.meta.viewport.height}`;
    var browserVersion = parseInt(/\d+/.exec(context.browser.version)[0]);
    var browserName = context.browser.name;
    return path.join(basePath, `${testName}_${resolution}_${browserName}_v${browserVersion}.png`);
  };
}

const reporters = process.env.JUNIT ? ['dot', 'junit'] : ['dot'];
const reporterOptions = process.env.JUNIT ? {
  junit: {
    outputDir: process.env.JUNIT
  }
} : {};

exports.config = {
  host: 'selenium', // hostname for the Selenium server.
  specs: [path.join(__dirname, 'specs/*.js')], // test files kept here.
  capabilities: [{ // browsers to test in.
    browserName: 'chrome'
  }],
  baseUrl: 'http://drupal', // address the Drupal site is accessible on.
  plugins: {
    'wdio-screenshot': {}
  },
  services: [
    'visual-regression'
  ],
  visualRegression: {
    compare: new VisualRegressionCompare.LocalCompare({
      referenceName: getScreenshotName(path.join(__dirname, 'screenshots/reference')),
      screenshotName: getScreenshotName(path.join(__dirname, 'screenshots/taken')),
      diffName: getScreenshotName(path.join(__dirname, 'screenshots/diff')),
      viewports: [
        {width: 320, height: 480}
      ]
    })
  },
  reporters,
  reporterOptions
};
