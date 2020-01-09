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
Setting Up for Local Development
--------------------------------
This project is built using Drupal Scaffold. Before you begin, you must have Docker and Docker Compose installed on your local machine. For installation instructions, see the [Drupal Scaffold - Docker documentation](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/docker.md).

1. [Clone](https://help.github.com/articles/cloning-a-repository/) this repository.
2. If you haven't created and [set your Pantheon machine token](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/recipes/setting-machine-token.md), do that now.
3. [Start](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/docker.md#Running) the Docker environment and shell in:
    ```bash
    docker-compose up -d drupal
    docker-compose exec drupal bash
    ```
3. Install [Composer](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/composer.md#Running) dependencies:
    ```bash
    composer install
    ```
4. Install [NPM](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/npm.md#Running) dependencies:
    ```bash
    yarn install
    ```
5. Run `composer site:import` to pull down and import a copy of the site's database. If Pantheon gives you an error here, make sure you followed Step 2 above correctly and that you're running Docker in a new terminal window

6. Run `drupal site:mode  dev` to switch to dev configuration.

7. Run `gulp build` (or `gulp watch`) and `drush cr` (from within the Drupal root at `/var/www/web`) to compile the theme.

8. View your new local site in the browser at [http://localhost:8080/](http://localhost:8080/).

See the [Drupal Scaffold documentation](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/) for more information on how to use the tools and how to use this project. To find more information on the Docker stack, visit the [Docker documenation](https://github.com/LastCallMedia/Drupal-Scaffold/blob/master/docs/tools/docker.md).

Testing
--------
### Nightcrawler
Nightcrawler will run in CircleCI for each Pull Request, but if you want to test the PR locally use the following command
```
node_modules/.bin/nightcrawler crawl
```
### Backstop

Backstop is only tested manually, see [documentation](/backstop/README.md) to test your branch.

Both Nightcrawler and Backstop are using the same file to fetch URLs, if you want to add new pages to test the file is located [here](/backstop/page.json).
