LCM Drupal 8 Scaffolding
========================
[![Build Status](https://travis-ci.org/LastCallMedia/Drupal-Scaffold.svg?branch=master)](https://travis-ci.org/LastCallMedia/Drupal-Scaffold)
[![Dependency Status](https://www.versioneye.com/user/projects/57bd889169d9490042f72aac/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/57bd889169d9490042f72aac)

This is a boilerplate Drupal 8 build that bundles some standard tools to make it a good starting point for an enterprise scale Drupal build.  It is conceptually similar to [drupal-composer/drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold), but it has a much simpler (and more manual) Composer setup, and includes additional tools.  For additional information on this project, see the [2016 Badcamp presentation slides](https://2016.badcamp.net/sites/default/files/session-files/FirstClassDevelopmentWorkflow.pdf)

Starting a New Project
----------------------
- [ ] Use composer to create a new project, starting from this repository as a template:
    ```bash
    composer create-project lastcall/drupal-scaffold PROJECTNAME
    ```
- [ ] Bring up the Docker containers and enter the Drupal container.
    ```bash
    docker-compose up -d drupal
    docker-compose exec drupal /bin/bash
    ```
- [ ] From the repository root (`/var/www` inside the Drupal container), install NPM and composer dependencies:
    ```bash
    yarn install
    composer install
    ```
- [ ] Visit the Drupal site in your browser to install Drupal and continue.  The default URL will be `http://localhost:8080`.

See the [scaffold documentation](docs/scaffold.md) for next steps.

## Stop here!

Everything below this line applies to scaffold projects that are already set up. The section below will be the start of your project's README.

---------------------------------------------

Setting Up for Local Development
--------------------------------
Before you begin, you must have Docker and Docker Compose installed on your local machine.  For installation instructions, see the [Docker documentation](/docs/tools/docker.md).

1. [Clone](https://help.github.com/articles/cloning-a-repository/) this repository.
2. [Start](/docs/tools/docker.md#Running) the Docker environment and shell in:
    ```bash
    docker-compose up -d drupal
    docker-compose exec drupal bash
    ```
3. Install [Composer](/docs/tools/composer.md#Running) dependencies:
    ```bash
    composer install
    ```
4. Install [NPM](/docs/tools/npm.md#Running) dependencies:
    ```bash
    yarn install
    ```
5. Run `composer site:import` to pull down and import a copy of the site's database.

See the documentation(/docs) for more information on how to use the tools and how to use this project. For more information on the Docker stack, see the [Docker documenation](/docs/tools/docker.md).
