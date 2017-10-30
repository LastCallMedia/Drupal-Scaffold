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
3. From the repository root: `yarn install` to install nodejs dependencies (or use `npm install` if you don't have yarn).
4. From the repository root: `gulp install` (or `node_modules/.bin/gulp install` if you don't have gulp  installed globally) to install bower and composer dependencies.
5. Edit the `composer.json`, `package.json`, and `bower.json` and rename the project as needed.
6. Rename the scaffold theme to match the project (including JS and SCSS files).
7. Initialize a new git repository and push work to it as normal

Getting started on an already prepared project
----------------------------------------------
_(These will be used when working from a repo already prepared for a specific project)_

1. Clone the repository to your local environment
2. Initalize nvm: `nvm install`
3. Install node packages: `yarn install`  (or use `npm install` if you don't have yarn).
4. Install composer and bower packages: `gulp install` (or `node_modules/.bin/gulp install` if you don't have gulp installed globally)
5. Commit and push work to repository as normal

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

* **8080**: Varnish, connected to Drupal.  This is a production-like environment.
* **8081**: Drupal direct connection. Skips Varnish, which is great for local development.
* **33306**: MySQL direct connection.  Useful for connecting to the database from the host machine.  A direct mysql connection can be made from the outside via: `mysql -h 127.0.0.1 --port 33306 -u drupal -pdrupal drupal`
* **8983**: Solr direct connection.  Useful for debugging via Apache Solr web interface.

Important: Should you choose to run this setup in production, you should always remove the debug ports (noted in `docker-compose.yml`) for security.
