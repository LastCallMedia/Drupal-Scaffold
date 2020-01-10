Gulp
====

This project uses [Gulp](https://gulpjs.com/) to build front-end assets.  See [Gulp Drupal Tasks](https://github.com/LastCallMedia/gulp-drupal-tasks) for more information.

Gulp is installed globally on the `node` service in the Lando local development environment.

Configuration
-------------
Gulp configuration lives in `gulpconfig.js` in the repository root. You may also update `gulpfile.js` if you wish to add additional tasks.

Running
-------
* `lando gulp build` to run a one time asset compilation
* `lando gulp watch` to continually watch configured files and compile them on the fly

Uninstalling
------------
1. Remove `gulp-cli` from `globals` section of `node` service declaration in `.lando.yml`
2. Remove `gulp` entry from `tooling` section of `.lando.yml` 
1. Run `lando yarn remove gulp gulp-help lastcall-gulp-drupal-tasks` to remove the dependencies.
3. Delete `gulpconfig.js` and `gulpfile.js`
4. Commit changes.
