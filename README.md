LCM Drupal 8 Scaffolding
========================
[![Build Status](https://circleci.com/gh/LastCallMedia/Drupal-Scaffold.svg?style=svg)](https://circleci.com/gh/LastCallMedia/Drupal-Scaffold)
[![Latest Stable Version](https://poser.pugx.org/lastcall/drupal-scaffold/v/stable)](https://packagist.org/packages/lastcall/drupal-scaffold)

This is a boilerplate Drupal 8 build that bundles some standard tools to make it a good starting point for an enterprise scale Drupal build.  It is conceptually similar to [drupal-composer/drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold), but it has a much simpler (and more manual) Composer setup, and includes additional tools.  For additional information on this project, see the [2016 Badcamp presentation slides](https://2016.badcamp.net/sites/default/files/session-files/FirstClassDevelopmentWorkflow.pdf)

Starting a New Project
----------------------
- [ ] Use composer to create a new project, starting from this repository as a template:
    ```bash
    composer create-project lastcall/drupal-scaffold PROJECTNAME
    ```
- [ ] Update the project's `name` in `.lando.yml`
- [ ] Bring up the local development environment.
    ```bash
    lando start
    ```
- [ ] Install project's php and frontend dependencies 
    ```bash
    lando yarn install
    lando composer install
    ```
- [ ] Visit the Drupal site at one of the urls output by lando.

See the [scaffold documentation](docs/scaffold.md) for next steps.

## Stop here!

Everything below this line applies to scaffold projects that are already set up. The section below will be the start of your project's README.

---------------------------------------------

Setting Up for Local Development
--------------------------------
This project is built using Drupal Scaffold. Before you begin, you must have Lando installed on your local machine. For installation instructions, see the [Drupal Scaffold - Lando documentation](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/lando.md).

1. [Clone](https://help.github.com/articles/cloning-a-repository/) this repository.
2. If you haven't created and [set your Pantheon machine token](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/recipes/setting-machine-token.md), do that now.
3. [Start](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/docker.md#Running) the Docker environment and shell in:
    ```bash
    lando start
    ```
3. Install [Composer](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/composer.md#Running) dependencies:
    ```bash
    lando composer install
    ```
4. Install [NPM](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/npm.md#Running) dependencies:
    ```bash
    lando yarn install
    ``` 
5. Import a database
    ```bash
    # Download a copy of the database backups from the hosting environment and save it to the projectroot
   lando db-import [file]
    ```
6. Compile and watch frontend assets
    ```bash
    lando gulp watch
    ```

8. View your new local site in the browser at a url provided by lando when running `lando start`

See the [Drupal Scaffold documentation](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/) for more information on how to use the tools and how to use this project.
