LCM Drupal 8 Scaffolding
========================

Setup
-----

1. Run the following command to clone this project down.  Replace PROJECTNAME with the name of the folder you want to create for the project.
  ```
  composer create-project lastcallmedia/drupal-scaffold:dev-master PROJECTNAME --repository='{"type": "vcs", "url": "git@bitbucket.org:lastcall/d8-scaffolding-project.git"}'
  ```
2. Run npm install to install nodejs dependencies.
3. Run `gulp install` (or `node_modules/.bin/gulp install` if you don't have gulp installed globally) to install bower and composer dependencies.
4. Edit the composer.json and package.json, and rename the project as needed.
5. Rename the scaffold theme to match the project (including JS and SCSS files).

Adding Modules/Themes
---------------------
You can use composer to bring in modules and themes.  Just run:

```
composer require drupal/ctools
```
Contributed modules and themes are .gitignored by default, meaning you need to run composer install each time you clone the repository down.