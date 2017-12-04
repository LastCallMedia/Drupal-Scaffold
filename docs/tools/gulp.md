Gulp
====

This project uses [Gulp](https://gulpjs.com/) to build front-end assets.  See [Gulp Drupal Tasks](https://github.com/LastCallMedia/gulp-drupal-tasks) for more information.

Configuration
-------------
Gulp configuration lives in `gulpconfig.js` in the repository root. You may also update `gulpfile.js` if you wish to add additional tasks.

Running
-------
* `composer build` to run all Gulp build tasks.
* `node_modules/.bin/gulp` for access to more fine-grained tasks.

Uninstalling
------------
1. Run `yarn remove gulp gulp-help lastcall-gulp-drupal-tasks` to remove the dependencies.
2. Edit `composer.json` to remove the `build` and `build:watch` scripts.
3. Delete `gulpconfig.js` and `gulpfile.js`
4. Commit changes.


