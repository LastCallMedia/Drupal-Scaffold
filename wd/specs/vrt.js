/* eslint strict: ["error", "global"] */
/**
 * Mocha specs for Visual regression tests using wdio-visual-regression-service.
 */
'use strict';
const assert = require('assert');
const threshold = 1;

function assertNoDiff(results, message) {
  results.forEach(result => assert.ok(result.misMatchPercentage <= threshold, message));
}

describe('Site Design', function () {
  it('Homepage', async function () {
    await browser.url('/');
    const report = await browser.checkDocument();
    assertNoDiff(report, 'Homepage matches designs');
  });
});
