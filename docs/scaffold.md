Scaffold Documentation
======================

Note: This page applies to the Last Call Media Drupal Scaffold project. Use this documentation to get a new project started, not for working on an existing project.

Starting a New Project
----------------------
- [ ] Use composer to create a new project, starting from this repository as a template:
    ```bash
    composer create-project lastcall/drupal-scaffold PROJECTNAME
    ```
- [ ] Bring up the Docker containers and enter the Drupal container.
    ```bash
    docker-compose up -d drupal varnish
    docker-compose exec drupal /bin/bash
    ```
- [ ] From the repository root (`/var/www` inside the Drupal container), install NPM and composer dependencies:
    ```bash
    yarn install
    composer install
    ```
- [ ] Visit the Drupal site in your browser to install Drupal and continue.  The default URL will be `http://localhost:8080`.

Customizing your Project
------------------------
As soon as you're up and running, you will want to remove the references to the "scaffold" nature of this project and make it your own.
- [ ] Set the name of your project under the `name` key in `composer.json` and `package.json`.  You don't ever need to publish the project using Composer or NPM, but it will help new developers get oriented.
- [ ] Rename the `scaffold` theme to something that fits your project.
- [ ] Open [`docker/drupal.env`](/docker/drupal.env) and set the environment variables there.
- [ ] Open [`web/private/scripts/deploy-steps.php`](/web/private/scripts/deploy-steps.php) and choose the deployment steps you want to use.
- [ ] Copy [`.env.example`](/.env.example) to `.env` and optionally set the variables in this file. This file should not be committed.
- [ ] Customize README.md by renaming, and removing everything above the horizontal rule.

Upgrading From a Previous Version
---------------------------------
Upgrading an older project is a very manual process - once you start a project, the files are yours to customize.  However, we'll do our best to document the upgrade process:

### Upgrading to 2.0
- [ ] Run `composer require --no-update lastcall/composer-upstream-files:^1.0` to add the `composer-upstream-files` package.
- [ ] Add the `upstream-files` section of [`composer.json`](/composer.json) to your `composer.json` file.
- [ ] Add the `scripts` section of [`composer.json`](/composer.json) to your `composer.json` file.
- [ ] Run `composer update lastcall/composer-upstream-files` to update your `composer.lock`
- [ ] Run `composer upstream-files:update` to pull down the latest versions of all scaffold files and quasi-core files.  REVIEW CAREFULLY BEFORE COMMITTING - you will definitely need to revert or manually merge some of the files.
- [ ] Run `yarn install` to install NPM dependencies and create a `yarn.lock` file.
- [ ] Run `yarn install` to install NPM dependencies and create a `yarn.lock` file.
- [ ] Cleanup any leftover files: `rm -rf default.behat.local.yml ci package-lock.json backstop phantomas ci circle.yml .travis.yml`
- [ ] Open [`docker/drupal.env`](/docker/drupal.env) and set the environment variables there.
- [ ] Copy [`.env.example`](/.env.example) to `.env` and optionally set the variables in this file. This file should not be committed.
- [ ] In CircleCI, add the `TERMINUS_MACHINE_TOKEN` variable (previously known as `PMACHINE`).
- [ ] Push a new `p-` branch to GitHub to trigger a circle build, and create a new PR to review your changes.
- [ ] Once your PR is merged, you can remove the `PMACHINE` token.

Customizing the docroot
-----------------------
This tool is pre-configured for use on Pantheon.  Using it on Acquia or another host may require some adjustment of the docroot folder (currently web/).  We've tried to comment with "@docroot" in any locations where the docroot path is hard-coded to web/.
