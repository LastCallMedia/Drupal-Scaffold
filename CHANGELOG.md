# Changelog

## Unreleased
### Changed
* Fixed `composer site:import` command failing without returning a non-zero exit code.

## [2.0.0] - 2017-12-14
### Changed
* Enabled Drupal js behaviors in Mannequin by default.
* Remove dockerized settings in default.settings.php - this file will be used whenever KernelTestBase is executed, causing the site under test to pick up the Dockerized/local settings as it's own.
* Use `CACHE_HOST`, `CACHE_PORT`, `CACHE_PASSWORD` in `settings.docker.php` instead of REDIS_* equivalents.  This brings us into line with Pantheon's environment variables.
* Replace environment variables in the default CircleCI build: `PSITE` -> `TERMINUS_SITE`, `PSRCENV` -> `TERMINUS_SOURCE_ENVIRONMENT`, `PMACHINE` -> `TERMINUS_MACHINE_TOKEN`.  These variables will remain consistent with what we use in Docker.
* Use `yarn` in all documentation, CircleCI steps.  Yarn is a drop-in replacement for `npm` that is much faster.
* Configure ESLint through `.eslintignore` in repository root rather than custom Gulp configuration.
* Configure PHPCS through `phpcs.xml.dist` in repository root rather than custom Gulp configuration.
* Upgrade to [CircleCI 2.0](.circleci/config.yml). Circle 2.0 brings down build times and lets us keep the build environment much closer to the local development environment by using Docker.
* Disabled Varnish container by default, and moved Drupal to port 8080.  Varnish now runs on 8085 (when enabled).

### Added
* Add a default hash salt to settings.docker.php, overrideable using the `DRUPAL_HASH_SALT` environment variable.
* Add a selenium container to the default Docker Compose stack. Selenium is a powerful front end testing and automation tool that allows for cross-browser testing, and replaces the deprecated PhantomJS.
* Add `pantheon.yml` for configuring web docroot in Pantheon deployments.
* Start keeping documentation in `docs/`.
* Add shell scripts for:
  * [`create-artifact-environment-pantheon`](bin/create-artifact-environment-pantheon): Create a new multidev for a branch.
  * [`json-to-bash`](bin/json-to-bash): Converts a single level JSON object into bash export statements.
  * [`prune-artifact-branches`](bin/prune-artifact-branches): Prune branches off of an artifact repository that no longer exist on a source repository.
  * [`prune-artifact-environments-pantheon`](bin/prune-artifact-environments-pantheon): Prune multidev environments for branches that no longer exist on a source repository.
  * [`refresh-local-pantheon`](bin/refresh-local-pantheon): Encapsulates commands required to grab a fresh copy of the site DB from production from Pantheon and import it locally.
* Add [Composer Upstream Files](https://github.com/LastCallMedia/Composer-Upstream-Files) to ease maintenance burden of upstream files like Drupal's quasi-core files, and Scaffold related files.
* Added separate manifest files in [`/manifests`](/manifests) for use with Composer Upstream Files.  See [the readme](/manifests/README.md) for more information.
* Add [Blackfire](https://blackfire.io) to support performance optimization and profiling.  See [the Blackfire documentation](docs/tools/blackfire.md) for more information.
* Default Quicksilver hooks to mark New Relic deployment and execute deployment steps.
* Add VOLUME_FLAGS environment variable in `.env.example` for user guided caching in Docker Compose. See https://docs.docker.com/compose/compose-file/#caching-options-for-volume-mounts-docker-for-mac.
* Add a Composer script handler for the post-create-project event.  This handler will handle any conversion necessary to convert this project from an open source scaffolding tool to standard a Drupal site.

### Removed
* Removed Pattern Library module
* Removed dependency installation using `gulp install`.  Use `composer install` instead.
* Removed testing using `gulp test`.  Use `composer test` instead.
* Removed linting using `gulp check`.  Use `composer lint` instead.
* Removed BackstopJS due to instability and limited usefulness.  This tool is replaced by WebDriver.io.  See [documentation](docs/tools/wdio.md) for more information.
* Removed Phantomas due to instability.  There is no replacement for this tool.
* Removed `ci/push-to-downstream.sh` and replace with `node_modules/.bin/artifact.sh`, which is faster and handles nested .artifact.gitignores.  This is a new OSS package.  See [Artifact.sh](https://github.com/LastCallMedia/Artifact.sh).
* Removed `DOWNSTREAM` environment variable from CircleCI configuration.  The downstream repository is now calculated automatically via Terminus.

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
