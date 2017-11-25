# Changelog

## [Unreleased]
### Changed
* Remove default setting for SIMPLETEST_DB - let it fall back to whatever connection is defined in settings.php.
* Remove dockerized settings in default.settings.php - this file will be used whenever KernelTestBase is executed, causing the site under test to pick up the Dockerized/local settings as it's own.
* Enabled Drupal js behaviors in Mannequin by default.
* Replace `ci/push-to-downstream.sh` with `bin/artifact.sh`.  This script should be faster, and handles nested .artifact.gitignore files.
* Use CACHE_HOST, CACHE_PORT, CACHE_PASSWORD in settings.docker.php instead of REDIS_* equivalents.  Bring into line with Pantheon settings.php.

### Added
* Add a default hash salt to settings.docker.php, overrideable using the DRUPAL_HASH_SALT environment variable.
* Add a selenium container to the default Docker Compose stack.
* Add `phpcs.xml.dist` to the repository root so we have the ability to configure rules on a per-site basis.
* Add `.eslintignore` to the repository root so we have more granularity on what files get linted.
* Add `pantheon.yml` for configuring web docroot in Pantheon deployments.

### Removed
* Removed Pattern Library module
* Removed dependency installation using `gulp install`.  Use `composer install` instead.
* Removed testing using `gulp test`.  Use `composer test` instead.
* Removed linting using `gulp check`.  Use `composer lint` instead.

## [1.4.0] - 2017-10-19
### Changed
* Use Legacy configuration for ESLint
* Drupal core update to 8.4.0
* Symfony component update to 3.3.*
* Update CHANGELOG to [Keep a Changelog](http://keepachangelog.com/en/1.0.0/) format 1.0.0.
* Use development Docker configuration by default.
* Update sites/default/services.yml with default CORS configuration from Drupal 8.4.0
* Move config directory outside of web root so it can be committed - [#35](https://github.com/LastCallMedia/Drupal-Scaffold/issues/35).

### Added
* Allow Docker ports to be configured [using environment variables](https://docs.docker.com/compose/environment-variables/#substituting-environment-variables-in-compose-files).
* Add [Mannequin](https://mannequin.io) support

### Deprecated
* Use of the Pattern Library module is now deprecated.  This module will be removed in 1.4.0.

## [1.3.0] - 2017-08-30
### Changed
* rm -rf composer dependencies before attempting final optimized install to fix Drupal console uninstall bug. See https://github.com/hechoendrupal/drupal-console-extend-plugin/issues/2
* gitignore "-n" file from backstop container.
* Bump MySQL max allowed packet to 16mb.
* Drupal core update to 8.3.7
* Drupal console update to 1.0.1
* Update Foundation to 6.4.  This enables the flex grid by default (see style.scss for how to switch back to the float grid).
* Add configuration for Behat Drupal messaging steps.

## [1.2.0] - 2017-03-23
### Changed
* Use a --base-url flag for setting the base url during tests on CircleCI.
* Move all gulp tasks to a npm module for maintainability. See https://github.com/LastCallMedia/gulp-drupal-tasks
* Update gulp configuration to a more tool-oriented syntax.  See gulpconfig.js
* Move phantomas tests to yml files instead of gulp configuration for easier visibility and reuse.
* Use configurable docroot for php docker container.
* Bring in foundation with npm and kill off bower.
* Explicitly require composer/installers to ensure drupal modules, themes, and core always get put in the right place.
* Refactor circle.yml so only the top section (environment and versions) needs to be changed for most projects.
* Use [yarn](https://yarnpkg.com/en/) instead of NPM.
* Remove the concept of a behat.local.yml

## [1.1.0] - 2017-01-09
### Changed
* Use a configurable PHPCS standard
* Add pantheon deployment tasks to circle.yml
* Allow skipping bower tasks if bower is not configured.
* Added visual regression testing with BackstopJS
* Added default font stack to Scaffold theme
* Added ability to export junit reports and artifacts from gulp tasks that provide them.
* Exclude all build tools and files from production build.
* Update to Foundation 6.3.0
* Added static Composer validation check
* Added Circle CI test steps
* Added drupal-profile installer support to composer.json

## [1.0.3] - 2017-01-09
### Changed
* Runs behat and performance tests out of the box with Travis.
* Move docroot into web/
* Update to Drupal core 8.2.x
* Add a debug configuration for docker-compose stack
* Fix docker environment detection
* Compile what-input with Foundation JS
* Specify engines in package.json for better CI detection.

## [1.0.2] - 2016-10-23
### Changed
* Add docker-compose stack for easy setup
* Scaffold theme enhancements (add logo, base menu theming, remove compiled assets)
* Properly set git attributes for .svg and .eot
* Remove gitignore for settings*.php - only ignore settings.local.php
* Coder check for .install files too
* Dependency updates (gulp-sourcemaps, gulp-phpcs, Drupal core)

## [1.0.1] - 2016-09-23
### Changed
* Add wysiwyg stylesheet
* No longer include behat.local.yml by default.  Use default settings for `drush rs` (127.0.0.1:8888) for behat base_url.
* Use default settings for `drush rs` (127.0.0.1:8888) for phantomas base url.
* Add csso for CSS optimization.
* Rename build:fonts to build:copy.
* Add imagemin option to build:copy task.
* Don't abort build:scss task on scss error (fixes watch breaking on invalid scss).


## [1.0.0-beta1] - 2016-08-14
### Added
* Initial beta release
