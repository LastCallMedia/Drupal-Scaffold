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
    docker-compose up -d drupal varnish
    docker-compose exec drupal /bin/bash
    ```
- [ ] From the repository root (`/var/www` inside the Drupal container), install NPM and composer dependencies:
    ```bash
    yarn install
    composer install
    ```
- [ ] Visit the Drupal site in your browser to install Drupal and continue.  The default URL will be `http://localhost:8080`.

See the [documentation](docs/) for next steps.

---------------------------------------------

Getting started on an already prepared project
----------------------------------------------
_(These will be used when working from a repo already prepared for a specific project)_

1. Clone the repository to your local environment
2. Start the Docker environment and shell in:
    ```bash
    docker-compose up -d drupal varnish
    docker-compose exec drupal /bin/bash
    ```
3. Install dependencies:
    ```bash
    composer install
    yarn install
    ```
4. Run `composer site:import` to pull down a copy of the site's database.

Adding Modules/Themes
---------------------
You can use composer to bring in modules and themes.  Just run:

```
composer require drupal/ctools
```
Contributed modules and themes are .gitignored by default, meaning you need to run `gulp install` each time you clone the repository down.

Customizing the docroot
-----------------------
This tool is pre-configured for use on Pantheon.  Using it on Acquia or another host may require some adjustment of the docroot folder (currently web/).  We've tried to comment with "@docroot" in any locations where the docroot path is hard-coded to web/.

Using the Docker Images
-----------------------

Run `docker-compose up`. This makes the site available behind Varnish at [http://localhost/8080](http://localhost:8080).  The default Docker Compose configuration exposes the following ports:

* **8080**: Drupal direct connection. Skips Varnish, which is great for local development.
* **33306**: MySQL direct connection.  Useful for connecting to the database from the host machine.  A direct mysql connection can be made from the outside via: `mysql -h 127.0.0.1 --port 33306 -u drupal -pdrupal drupal`
* **8085**: Varnish, connected to Drupal.  If you want to use Varnish, uncomment it in `docker-compose.yml`
* **8983**: Solr direct connection.  Useful for debugging via Apache Solr web interface.

Important: Should you choose to run this setup in production, you should always remove the debug ports (noted in `docker-compose.yml`) for security.
