LCM Drupal 8 Scaffolding
========================
[![Build Status](https://travis-ci.org/LastCallMedia/Drupal-Scaffold.svg?branch=master)](https://travis-ci.org/LastCallMedia/Drupal-Scaffold)
[![Dependency Status](https://www.versioneye.com/user/projects/57bd889169d9490042f72aac/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/57bd889169d9490042f72aac)

This is a boilerplate Drupal 8 build that bundles some standard tools to make it a good starting point for an enterprise scale Drupal build.  It is conceptually similar to [drupal-composer/drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold), but it has a much simpler (and more manual) Composer setup, and includes additional tools.  For additional information on this project, see the [2016 Badcamp presentation slides](https://2016.badcamp.net/sites/default/files/session-files/FirstClassDevelopmentWorkflow.pdf)

Initial Project Setup
-----

_(These are only needed for creating a new project repository.  Remove this section of the readme once you are done.)_

1. Run the following command to clone this project down.  Replace PROJECTNAME with the name of the folder you want to create for the project.
  ```
  composer create-project lastcall/drupal-scaffold PROJECTNAME
  ```
2. Configure nvm to use the latest stable version `nvm install stable; nvm use stable;` 
3. From the docroot: `npm install` to install nodejs dependencies.
4. From the docroot: `gulp install` (or `node_modules/.bin/gulp install` if you don't have gulp  installed globally) to install bower and composer dependencies.
5. Edit the `composer.json`, `package.json`, and `bower.json` and rename the project as needed.
6. Rename the scaffold theme to match the project (including JS and SCSS files).
7. Initialize a new git repository and push work to it as normal

Getting started on an already prepared project
----------------------------------------------
_(These will be used when working from a repo already prepared for a specific project)_

1. Clone the repository to your local environment
2. Initalize nvm: `nvm install`
3. Install node packages: `npm install`
4. Install composer and bower packages: `gulp install` (or `node_modules/.bin/gulp install` if you don't have gulp installed globally)
5. Commit and push work to repository as normal

Adding Modules/Themes
---------------------
You can use composer to bring in modules and themes.  Just run:

```
composer require drupal/ctools
```
Contributed modules and themes are .gitignored by default, meaning you need to run `gulp install` each time you clone the repository down.

Using the Docker Images
-----------------------

#### Default configuration

To use the standard configuration, just run `docker-compose up`. This makes the site available behind Varnish at [http://localhost/8080](http://localhost:8080).

#### Development configuration

The default setup only exposes port 80 from varnish to the outside world (exposed as port 8080 to the host). This is great for production-like environments, but not for development where you may not want a reverse proxy, or you may need to connect directly to MySQL using a tool like Sequel Pro.

The standard `docker-compose.yml` can be overridden/added to using a `docker-compose.override.yml` file (which is ignored by the repository). This project includes an example override file that exposes ports to all relevant containers for direct access from the host in `docker-compose-development.override.yml`. Unless additional customization is needed, it is most likely enough to symlink `docker-compose-development.override.yml` to `docker-compose.override.yml`

`docker-compose-development.override.yml` uses environment variables to define which ports each container exposes to the host. These environment variables are defined in `.env` (also ignored from the repository). This project includes a `SETUP.env` file which shows how to define each environment variable, and can most likely be copied to `.env` and used verbatim. If you run into port conflicts, the ports in `.env` are arbitrary and can be changed to any port that is available.

The configurable container ports are:
* `EDGE_PORT`: Port used to access the site behind Varnish
  * ex `EDGE_PORT=8080`: The site is available behind Varnish at [http://localhost:8080](http://localhost:8080)
* `WEB_PORT`: Port used to access the site _without varnish_
  * ex `WEB_PORT=8081`: The site is directly available (with no reverse proxy in front) at [http://localhost:8081](http://localhost:8081)
* `MYSQL_PORT`: Port used to connect to MySQL from the host
  * ex `MYSQL_PORT=33306`, direct MySQL connection can be made from the command line using `mysql -h 127.0.0.1 --port 33306 -u drupal -pdrupal drupal`
* `SOLR_PORT`: Port used to access Solr server
  * ex `SOLR_PORT=8983`, the Solr web ui can be accessed at [http://localhost:8983](http://localhost:8983)