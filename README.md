LCM Drupal 8 Scaffolding
========================
[![Build Status](https://travis-ci.org/LastCallMedia/Drupal-Scaffold.svg?branch=master)](https://travis-ci.org/LastCallMedia/Drupal-Scaffold)
[![Dependency Status](https://www.versioneye.com/user/projects/57bd889169d9490042f72aac/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/57bd889169d9490042f72aac)

This is a boilerplate Drupal 8 build that bundles some standard tools to make it a good starting point for an enterprise scale Drupal build.  It is conceptually similar to [drupal-composer/drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold), but it has a much simpler (and more manual) Composer setup, and includes additional tools. 

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
