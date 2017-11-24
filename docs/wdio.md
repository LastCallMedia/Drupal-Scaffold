Webdriver IO
============

Webdriver IO is an end-to-end testing tool that uses Selenium.  It can perform functional tests as well as Visual Regression tests.

Tests using Webdriver IO will be slower than any other type of test, so use them sparingly.

Configuration
-------------
Configuration lives in `wdio.conf.js`.  Test files live in the `wd/tests` directory.  


### Mocha Tests
Standard [Mocha](https://mochajs.org/) test cases can be run by writing the test cases in the `specs` directory.

### Visual Regression Testing
Visual regression tests can be run by writing test cases in the `wd/specs` directory.  VRT runs using [wdio-visual-regression-service](https://www.npmjs.com/package/wdio-visual-regression-service).  In the provided sample configuration, screenshots are captured to the `wd/screenshots/taken` directory, and compared with reference samples in the `wd/screenshots/reference` directory.  If a difference is found, a comparison image will be generated to highlight the difference, and placed into the `wd/screenshots/diff` directory.

Running
-------
* `node_modules/.bin/wdio` Run all tests.
* `node_modules/.bin/wdio --spec wd/tests/vrt.js` Run one test.

Uninstalling
------------
1. Run `yarn remove lastcall-scaffold-webdriver` to remove the Node modules required for the webdriver.
2. Edit `composer.json` to remove the `@test:wdio` key from the `test` script.
3. Remove the "Run WDIO" step from `.circleci/config.yml`.
4. Optionally, remove the `wd/` directory entirely.
5. Commit changes.
