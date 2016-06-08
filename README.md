LCM Drupal 8 Scaffolding
========================

Initial Project Setup
-----

_(These are only needed for creating a new project repository)_

1. Run the following command to clone this project down.  Replace PROJECTNAME with the name of the folder you want to create for the project.
  ```
  composer create-project lastcallmedia/drupal-scaffold:dev-master PROJECTNAME --repository='{"type": "vcs", "url": "git@bitbucket.org:lastcall/d8-scaffolding-project.git"}'
  ```
1. Configure nvm to use the latest stable version `nvm install stable; nvm use stable;` 
2. From the docroot: `npm install` to install nodejs dependencies.
3. From the docroot: `gulp install` (or `node_modules/.bin/gulp install` if you don't have gulp  installed globally) to install bower and composer dependencies.
4. Edit the `composer.json` and `package.json`, and rename the project as needed.
5. Rename the scaffold theme to match the project (including JS and SCSS files).
6. Initialize a new git repository and push work to it as normal

Getting started on an already prepared project
----------------------------------------------
_(These will be used when working from a repo already prepared for a specific project)_

1. Clone the repository to your local environment
2. Configure nvm to use the latest stable version `nvm install stable; nvm use stable;` 
3. From the docroot: `npm install` to install nodejs dependencies.
4. From the docroot: `gulp install` (or `node_modules/.bin/gulp install` if you don't have gulp  installed globally) to install bower and composer dependencies.
5. Commit and push work to repository as normal

Adding Modules/Themes
---------------------
You can use composer to bring in modules and themes.  Just run:

```
composer require drupal/ctools
```
Contributed modules and themes are .gitignored by default, meaning:
* You need to run `composer install` each time you clone the repository down
* You need to run `composer update` each time a `git pull` updates composer.json