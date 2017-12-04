Initial Setup and Upgrading
===========================

Initial Setup
-------------
* Set the name of your project in `composer.json`
* Set the name of your project in `package.json`
* Set the following environment variables in .site.env:
  * TERMINUS_SITE
  * TERMINUS_SOURCE_ENVIRONMENT
* Set the following evironment variable in .env, or by exporting it in your ~/.bashrc or ~/.bash_profile files.
  * TERMINUS_MACHINE_TOKEN
* Rename the `scaffold` theme to whatever you want your theme to be called.

Upgrading
---------

### 2.0
* Add `composer-upstream-files` package: `composer require --no-update lastcall/composer-upstream-files:^1.0`
* Copy over `upstream-files` section of [`composer.json`](../composer.json)
* Copy over `scripts` from [`composer.json`](../composer.json)
* Run `composer update lastcall/composer-upstream-files` to update your `composer.lock`
* Run `composer upstream-files:update` to pull down the latest versions of all scaffold files and quasi-core files.  REVIEW CAREFULLY BEFORE COMMITTING.
* Run `yarn install` to install NPM dependencies and create a `yarn.lock` file.
* Cleanup any leftover files: `rm -rf default.behat.local.yml ci package-lock.json backstop phantomas ci circle.yml .travis.yml`
* Add `TERMINUS_SITE`, `TERMINUS_SOURCE_ENVIRONMENT` and `TERMINUS_MACHINE_TOKEN` variables to your CircleCI build.
* Commit everything to a `p-*` environment and push to trigger a build.
