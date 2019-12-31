
module.exports = async function(page, scenario, vp) {
  await page.evaluate(function (url) {
    if (!window.jQuery) {
      throw new Error(`jQuery was not found. This is usually caused by the server returning a 500 response. Please check ${url} in your browser.`);
    }
    // Disable jQuery animation for any future calls.
    jQuery.fx.off = true;
    // Immediately complete any in-progress animations.
    jQuery(':animated').finish();

  }, scenario.url);
  // Finally, wait for ajax to complete - this is to give alerts
  // time to finish rendering. This can take a while, especially
  // in local environments.
  await page.waitForFunction('jQuery.active == 0');

  // Add a slight delay.  This covers up some of the jitter caused
  // by weird network conditions, slow javascript, etc. We should
  // work to reduce this number, since it represents instability
  // in our styling.
  await page.waitFor(10000);

}
