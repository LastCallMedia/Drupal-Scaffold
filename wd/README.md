Webdriver.io Tests
==================

This directory contains tests that use [Webdriver IO](http://webdriver.io/) tests.  These tests are run using a real headless browser controlled through Selenium.  This testing setup is extremely flexible - it can be used for testing many different types of things.

These are end-to-end tests, which are the slowest type of testing, so it should be used judiciously, but it is often the only way to test things like the visual appearance, or complex navigation flows.

Front End Tests
---------------
Standard [Mocha](https://mochajs.org/) test cases can be run by writing the test cases in the `specs` directory.

Visual Regression Testing
-------------------------
Using the [wdio-visual-regression-service](https://www.npmjs.com/package/wdio-visual-regression-service), Visual regression tests can be performed in many browsers.  In the provided sample configuration, screenshots are captured to the `screenshots/taken` directory, and compared with reference samples in the `screenshots/reference` directory.  If a difference is found, a comparison image will be generated to highlight the difference, and placed into the `screenshots/diff` directory.
